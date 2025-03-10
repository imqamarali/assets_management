<?php

namespace app\controllers;

use Yii;
use yii\web\BadRequestHttpException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use yii\data\Pagination;

class AssetsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    public function beforeAction($action)
    {
        $actions = 'assets/' . $action->id;
        if (Yii::$app->session->has('user_array') == NULL)
            $this->redirect(['site/index']);
        else if (Yii::$app->Permissions->checkMethod($actions)) {
            $this->enableCsrfValidation = true;
            return parent::beforeAction($action);
        } else {
            Yii::$app->session->setFlash('toast', 'Unauthorized access... Please contact support team.');
            $this->redirect(['site/index']);
        }
    }
    public function actionIndex()
    {
        $module_features = Yii::$app->Permissions->getModuleFeatures(23); // Asset Management Module id 23
        if (count($module_features) < 1) $this->redirect(['site/index']); // If Not permission found redirect to Home!

        $submenus = isset($module_features[0]['submenus']) ? $module_features[0]['submenus'] : [];

        // Check if there is at least one submenu with can_view = true
        $hasViewPermission = false;
        foreach ($submenus as $submenu) {
            if (isset($submenu['can_view']) && $submenu['can_view'] === true) {
                $hasViewPermission = true;
                break;
            }
        }
        if (!$hasViewPermission) {
            $this->redirect(['site/index']);
        }
        return $this->render('index', [
            'submenus' => $submenus
        ]);
    }

    public function actionList()
    {
        $where = '1=1'; // Start with a true condition to simplify appending filters

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();

            if (isset($data['apply_search']) && $data['apply_search'] == 'Search') {
                if (isset($data['name']) && !empty($data['name'])) {
                    $where .= " AND na.name LIKE '%" . $data['name'] . "%'";
                }
                if (isset($data['province']) && !empty($data['province'])) {
                    $where .= " AND na.province_id = '" . $data['province'] . "'";
                }
                if (isset($data['district']) && !empty($data['district'])) {
                    $where .= " AND na.district_id = '" . $data['district'] . "'";
                }
                if (isset($data['tehsil']) && !empty($data['tehsil'])) {
                    $where .= " AND na.techsil_id = '" . $data['tehsil'] . "'";
                }
                if (isset($data['zone']) && !empty($data['zone'])) {
                    $where .= " AND na.zone_id = '" . $data['zone'] . "'";
                }
                if (isset($data['unit']) && !empty($data['unit'])) {
                    $where .= " AND na.\"M_Unit_id\" = '" . $data['unit'] . "'";
                }
                if (isset($data['type']) && !empty($data['type'])) {
                    $where .= " AND na.type_id = '" . $data['type'] . "'";
                }
                if (isset($data['route']) && !empty($data['route'])) {
                    $where .= " AND na.\"Route_id\" = '" . $data['route'] . "'";
                }
                if (isset($data['km_from']) && !empty($data['km_from'])) {
                    $where .= " AND na.km_from >= " . (float)$data['km_from'];
                }
                if (isset($data['km_to']) && !empty($data['km_to'])) {
                    $where .= " AND na.km_to <= " . (float)$data['km_to'];
                }
            }
        }

        // Count total assets for pagination
        $countQuery = 'SELECT COUNT(*) FROM public."n_asset" na
            LEFT JOIN public."a_province" ap ON na.province_id = ap."ID"
            LEFT JOIN public."a_district" ad ON na.district_id = ad.id
            LEFT JOIN public."a_tehsil" at ON na.techsil_id = at.id
            LEFT JOIN public."a_zone" az ON na.zone_id = az.id
            LEFT JOIN public."a_route" ar ON na."Route_id" = ar.id
            LEFT JOIN public."u_unit" uu ON na."M_Unit_id" = uu."ID"
            LEFT JOIN public."m_type" mt ON na.type_id = mt.id
            WHERE ' . $where;

        $totalCount = Yii::$app->db->createCommand($countQuery)->queryScalar();

        $pages = new Pagination(['totalCount' => $totalCount]);
        $pages->setPageSize(10);

        $asset_Q = 'SELECT 
                na.id, na.province_id, ap."name" as province_name, 
                na.district_id, ad.name as district_name, 
                na.techsil_id, at.name as tehsil_name, 
                na.zone_id, az."Name" as zone_name, 
                na."M_Unit_id", uu.name as unit_name, 
                na."Location", 
                na."Section_id", 
                na."Route_id", ar."name" as route_name, 
                na.direction_id, 
                na.type_id, mt."name" as type_name, 
                na.name, na."Asset_id", na.unit, 
                na.longitude, na.latitude, na.elevation, 
                na.metadata, na.km_from, na.km_to, na."Range", 
                na.reference, na.address, na.geom, 
                na."Reg", na.status, na.create_date
            FROM public."n_asset" na
            LEFT JOIN public."a_province" ap ON na.province_id = ap."ID"
            LEFT JOIN public."a_district" ad ON na.district_id = ad.id
            LEFT JOIN public."a_tehsil" at ON na.techsil_id = at.id
            LEFT JOIN public."a_zone" az ON na.zone_id = az.id
            LEFT JOIN public."a_route" ar ON na."Route_id" = ar.id
            LEFT JOIN public."u_unit" uu ON na."M_Unit_id" = uu."ID"
            LEFT JOIN public."m_type" mt ON na.type_id = mt.id
            WHERE ' . $where . '
            LIMIT ' . $pages->limit . ' OFFSET ' . $pages->offset;

        $assets_list = Yii::$app->db->createCommand($asset_Q)->queryAll();




        // Fetch data for dropdowns
        $provinces = Yii::$app->db->createCommand('SELECT "ID", "name" FROM public."a_province"')->queryAll();
        $districts = Yii::$app->db->createCommand('SELECT id, name FROM public."a_district"')->queryAll();
        $tehsils = Yii::$app->db->createCommand('SELECT id, name FROM public."a_tehsil"')->queryAll();
        $zones = Yii::$app->db->createCommand('SELECT id, "Name" as name FROM public."a_zone"')->queryAll();
        $routes = Yii::$app->db->createCommand('SELECT id, "name" FROM public."a_route"')->queryAll();
        $units = Yii::$app->db->createCommand('SELECT "ID", "name" FROM public."u_unit"')->queryAll();
        $types = Yii::$app->db->createCommand('SELECT id, "name" FROM public."m_type"')->queryAll();

        return $this->render('assets_list', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'assets_list' => $assets_list,
            'province_list' => $provinces,
            'districts' => $districts,
            'tehsils' => $tehsils,
            'zones' => $zones,
            'routes' => $routes,
            'units' => $units,
            'types' => $types,
            'pages' => $pages,
        ]);
    }
    public function actionSave()
    {
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            $transaction = Yii::$app->db->beginTransaction();

            try {
                if (isset($data['save_record'])) {
                    if ($data['save_record'] == 'delete_record') {
                        $id = $data['id'];
                        Yii::$app->db->createCommand()->delete('public.n_asset', ['id' => $id])->execute();
                        $transaction->commit();
                        Yii::$app->session->setFlash('toast', 'Record deleted successfully!');
                    } else {
                        $recordData = [
                            'province_id' => $data['province_id'],
                            'district_id' => $data['district_id'],
                            'techsil_id' => $data['techsil_id'],
                            'zone_id' => $data['zone_id'],
                            'M_Unit_id' => $data['M_Unit_id'],
                            'Location' => $data['Location'],
                            'Section_id' => $data['Section_id'],
                            'Route_id' => $data['Route_id'],
                            'direction_id' => $data['direction_id'],
                            'type_id' => $data['type_id'],
                            'name' => $data['name'],
                            'Asset_id' => $data['Asset_id'],
                            'unit' => $data['unit'],
                            'longitude' => $data['longitude'],
                            'latitude' => $data['latitude'],
                            'elevation' => $data['elevation'],
                            'metadata' => $data['metadata'],
                            'km_from' => $data['km_from'],
                            'km_to' => $data['km_to'],
                            'Range' => $data['Range'],
                            'reference' => $data['reference'],
                            'address' => $data['address'],
                            'geom' => $data['geom'],
                            'Reg' => $data['Reg'],
                            'status' => $data['status'],
                        ];

                        if (isset($data['id']) && !empty($data['id'])) {

                            $id = $data['id'];

                            Yii::$app->db->createCommand()->update('public.n_asset', $recordData, ['id' => $id])->execute();
                            Yii::$app->session->setFlash('toast', 'Record updated successfully!');
                        } else {
                            $recordData['create_date'] = date('Y-m-d H:i:s');
                            Yii::$app->db->createCommand()->insert('public.n_asset', $recordData)->execute();
                            Yii::$app->session->setFlash('toast', 'Record saved successfully!');
                        }

                        $transaction->commit();
                    }
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('toast', 'Error: ' . $e->getMessage());
            }

            return $this->redirect(['assets/list']);
        }
    }
    public function actionZone()
    {
        $filter = '';
        $params = [];
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            // echo json_encode($data);
            // exit;
            //{"name":"","code":"","apply_search":"Search"}

            if (isset($data['apply_search']) && $data['apply_search'] == 'Search') {
                if (!empty($data['name'])) {
                    $name = $data['name'];
                    $filter .= ' AND "Name" LIKE :name';
                    $params[':name'] = '%' . $name . '%';
                }

                if (!empty($data['code'])) {
                    $code = $data['code'];
                    $filter .= ' AND "Code" LIKE :code';
                    $params[':code'] = '%' . $code . '%';
                }
            } elseif (isset($data['save_record'])) {

                $transaction = Yii::$app->db->beginTransaction();

                // {"save_record":"save_record","id":"","title":"Zone 1","code":"Z1","status":"1"}
                if ($data['save_record'] == 'delete_record') {
                    $id = $data['id'];
                    Yii::$app->db->createCommand()->delete('a_zone', ['id' => $id])->execute();
                    $transaction->commit();
                    Yii::$app->session->setFlash('toast', 'Record deleted successfully!');
                    return $this->redirect(['assets/zone']);
                } else {
                    try {
                        $id = $data['id'];
                        $title = $data['title'];
                        $code = $data['code'];
                        $status = $data['status'];
                        if ($id) {
                            Yii::$app->db->createCommand()->update('a_zone', [
                                'Name' => $title,
                                'Code' => $code,
                                'status' => $status,
                            ], ['id' => $id])->execute();
                        } else {
                            Yii::$app->db->createCommand()->insert('a_zone', [
                                'Name' => $title,
                                'Code' => $code,
                                'status' => $status,
                            ])->execute();
                        }
                        $transaction->commit();
                        Yii::$app->session->setFlash('toast', 'Record saved successfully!');
                        return $this->redirect(['assets/zone']);
                    } catch (\Exception $e) {

                        $transaction->rollBack();
                        Yii::$app->session->setFlash('toast', 'Internal Exception: ' . $e->getMessage());
                        return $this->redirect(['assets/zone']);
                    }
                }
            }
        }

        $query = 'SELECT * FROM public."a_zone" WHERE 1=1' . $filter;
        $zone_list = Yii::$app->db->createCommand($query, $params)->queryAll();
        return $this->render('zone', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'zone_list' => $zone_list
        ]);
    }
    public function actionRegion()
    {
        $filter = '1=1'; // Start with a true condition to simplify appending filters
        $params = [];

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();

            if (isset($data['apply_search']) && $data['apply_search'] == 'Search') {
                if (!empty($data['name'])) {
                    $filter .= ' AND ar.name LIKE :name';
                    $params[':name'] = '%' . $data['name'] . '%';
                }

                if (!empty($data['code'])) {
                    $filter .= ' AND ar.code LIKE :code';
                    $params[':code'] = '%' . $data['code'] . '%';
                }

                if (!empty($data['zone'])) {
                    $filter .= ' AND ar.zone_id = :zone';
                    $params[':zone'] = $data['zone'];
                }
            } elseif (isset($data['save_record'])) {

                $transaction = Yii::$app->db->beginTransaction();

                // {"save_record":"save_record","id":"","title":"Region 1","zone_id":"1","code":"R1","status":"1"}
                // {"save_record":"save_record","id":"1","title":"Region 1111","zone_id":"1","code":"R1","status":"1"}}
                if ($data['save_record'] == 'delete_record') {
                    $id = $data['id'];
                    Yii::$app->db->createCommand()->delete('a_region', ['ID' => $id])->execute();
                    $transaction->commit();
                    Yii::$app->session->setFlash('toast', 'Record deleted successfully!');
                    return $this->redirect(['assets/region']);
                } else {
                    try {
                        $id = $data['id'];
                        $title = $data['title'];
                        $zone_id = $data['zone_id'];
                        $code = $data['code'];
                        $status = $data['status'];

                        if ($id) {
                            Yii::$app->db->createCommand()->update('a_region', [
                                'zone_id' => $zone_id,
                                'name' => $title,
                                'code' => $code,
                                'status' => $status,
                            ], ['ID' => $id])->execute();
                        } else {
                            Yii::$app->db->createCommand()->insert('a_region', [
                                'zone_id' => $zone_id,
                                'name' => $title,
                                'code' => $code,
                                'status' => $status,
                            ])->execute();
                        }
                        $transaction->commit();
                        Yii::$app->session->setFlash('toast', 'Record saved successfully!');
                        return $this->redirect(['assets/region']);
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('toast', 'Internal Exception: ' . $e->getMessage());
                        return $this->redirect(['assets/region']);
                    }
                }
            }
        }

        // Construct the SQL query with filters
        $query = 'SELECT ar.*, az."Name" AS zone_name
              FROM public."a_region" AS ar
              LEFT JOIN public."a_zone" AS az ON ar.zone_id = az."id"
              WHERE ' . $filter . ' 
              ORDER BY ar."ID" ASC';

        // Execute the query with parameters
        $region_list = Yii::$app->db->createCommand($query, $params)->queryAll();

        // Fetch data for the zone dropdown
        $zone_list = Yii::$app->db->createCommand('SELECT * FROM public."a_zone"')->queryAll();

        return $this->render('region', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'region_list' => $region_list,
            'zone_list' => $zone_list,
        ]);
    }
    public function actionProvince()
    {
        $filter = '1=1';
        $params = [];

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();



            if (isset($data['apply_search']) && $data['apply_search'] == 'Search') {
                if (isset($data['name'])  && !empty($data['name'])) {
                    $name = $data['name'];
                    $filter .= ' AND "name" LIKE :name';
                    $params[':name'] = '%' . $name . '%';
                }
                if (isset($data['code'])  && !empty($data['code'])) {
                    $code = $data['code'];
                    $filter .= ' AND "code" LIKE :code';
                    $params[':code'] = '%' . $code . '%';
                }
                if (isset($data['details'])  && !empty($data['details'])) {
                    $details = $data['details'];
                    $filter .= ' AND details LIKE :details';
                    $params[':details'] = '%' . $details . '%';
                }
            } elseif (isset($data['save_record'])) {

                $transaction = Yii::$app->db->beginTransaction();

                // {"save_record":"save_record","id":"","title":"1","code":"2","status":"1","details":"4"}
                if ($data['save_record'] == 'delete_record') {
                    $id = $data['id'];
                    Yii::$app->db->createCommand()->delete('a_province', ['ID' => $id])->execute();
                    $transaction->commit();
                    Yii::$app->session->setFlash('toast', 'Record deleted successfully!');
                    return $this->redirect(['assets/province']);
                } else {
                    try {
                        $id = $data['id'];
                        $title = $data['title'];
                        $details = $data['details'];
                        $code = $data['code'];
                        $status = $data['status'];
                        if ($id) {
                            Yii::$app->db->createCommand()->update('a_province', [
                                'name' => $title,
                                'details' => $details,
                                'code' => $code,
                                'status' => $status,
                            ], ['ID' => $id])->execute();
                        } else {
                            Yii::$app->db->createCommand()->insert('a_province', [
                                'name' => $title,
                                'details' => $details,
                                'code' => $code,
                                'status' => $status,
                            ])->execute();
                        }
                        $transaction->commit();
                        Yii::$app->session->setFlash('toast', 'Record saved successfully!');
                        return $this->redirect(['assets/province']);
                    } catch (\Exception $e) {

                        $transaction->rollBack();

                        echo json_encode('Internal Exception: ' . $e->getMessage());
                        exit;
                        Yii::$app->session->setFlash('toast', 'Internal Exception: ' . $e->getMessage());
                        return $this->redirect(['assets/province']);
                    }
                }
            }
        }

        $query = 'SELECT * FROM public."a_province" WHERE ' . $filter;
        $province_list = Yii::$app->db->createCommand($query, $params)->queryAll();


        return $this->render('province', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'province_list' => $province_list
        ]);
    }
    public function actionDistrict()
    {
        $filter = '1=1';
        $params = [];
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            // echo json_encode($data);
            // exit;

            // {"name":"","code":"","province":"","apply_search":"Search"}

            if (isset($data['apply_search']) && $data['apply_search'] == 'Search') {
                if (!empty($data['name'])) {
                    $filter .= ' AND ad.name LIKE :name';
                    $params[':name'] = '%' . $data['name'] . '%';
                }

                if (!empty($data['code'])) {
                    $filter .= ' AND ad.code LIKE :code';
                    $params[':code'] = '%' . $data['code'] . '%';
                }

                if (!empty($data['province'])) {
                    $filter .= ' AND ad.province_id = :province';
                    $params[':province'] = $data['province'];
                }
            } elseif (isset($data['save_record'])) {

                $transaction = Yii::$app->db->beginTransaction();

                // {"save_record":"save_record","id":"","title":"Rawalpindi","province_id":"3","code":"RWP","status":"1"}
                if ($data['save_record'] == 'delete_record') {
                    $id = $data['id'];
                    Yii::$app->db->createCommand()->delete('a_district', ['id' => $id])->execute();
                    $transaction->commit();
                    Yii::$app->session->setFlash('toast', 'Record deleted successfully!');
                    return $this->redirect(['assets/district']);
                } else {
                    try {
                        $id = $data['id'];
                        $title = $data['title'];
                        $province_id = $data['province_id'];
                        $code = $data['code'];
                        $status = $data['status'];

                        if ($id) {
                            Yii::$app->db->createCommand()->update('a_district', [
                                'province_id' => $province_id,
                                'name' => $title,
                                'code' => $code,
                                'status' => $status,
                            ], ['id' => $id])->execute();
                        } else {
                            Yii::$app->db->createCommand()->insert('a_district', [
                                'province_id' => $province_id,
                                'name' => $title,
                                'code' => $code,
                                'status' => $status,
                            ])->execute();
                        }
                        $transaction->commit();
                        Yii::$app->session->setFlash('toast', 'Record saved successfully!');
                        return $this->redirect(['assets/district']);
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('toast', 'Internal Exception: ' . $e->getMessage());
                        return $this->redirect(['assets/district']);
                    }
                }
            }
        }



        // Fetch filtered district list
        $query = 'SELECT ad.id, ad.province_id, ad.name, ad.code, ad.status, ap.name AS province_name
              FROM public."a_district" AS ad
              LEFT JOIN public."a_province" AS ap ON ad.province_id = ap."ID"
              WHERE ' . $filter . '
              ORDER BY ad.id ASC';
        $district_list = Yii::$app->db->createCommand($query, $params)->queryAll();


        $province_list = Yii::$app->db->createCommand('SELECT * FROM public."a_province"')->queryAll();



        return $this->render('district', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'district_list' => $district_list,
            'province_list' => $province_list
        ]);
    }
    public function actionRoute()
    {
        $filter = '1=1';
        $params = [];
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            // echo json_encode($data);
            // exit;
            if (isset($data['apply_search']) && $data['apply_search'] == 'Search') {
                if (isset($data['name'])  && !empty($data['name'])) {
                    $name = $data['name'];
                    $filter .= ' AND "name" LIKE :name';
                    $params[':name'] = '%' . $name . '%';
                }
                if (isset($data['code'])  && !empty($data['code'])) {
                    $code = $data['code'];
                    $filter .= ' AND "code" LIKE :code';
                    $params[':code'] = '%' . $code . '%';
                }
                if (
                    isset($data['details'])  && !empty($data['details'])
                ) {
                    $details = $data['details'];
                    $filter .= ' AND details LIKE :details';
                    $params[':details'] = '%' . $details . '%';
                }
            } elseif (isset($data['apply_search']) && $data['apply_search'] == 'Search') {
                if (!empty($data['name'])) {
                    $name = $data['name'];
                    $filter .= ' AND "Name" LIKE :name';
                    $params[':name'] = '%' . $name . '%';
                }

                if (!empty($data['code'])) {
                    $code = $data['code'];
                    $filter .= ' AND "Code" LIKE :code';
                    $params[':code'] = '%' . $code . '%';
                }
            } elseif (isset($data['save_record'])) {

                $transaction = Yii::$app->db->beginTransaction();

                // {"save_record":"save_record","id":"","title":"Region 1","zone_id":"1","code":"R1","status":"1"}
                // {"save_record":"save_record","id":"1","title":"Region 1111","zone_id":"1","code":"R1","status":"1"}}
                if ($data['save_record'] == 'delete_record') {
                    $id = $data['id'];
                    Yii::$app->db->createCommand()->delete('a_route', ['id' => $id])->execute();
                    $transaction->commit();
                    Yii::$app->session->setFlash('toast', 'Record deleted successfully!');
                    return $this->redirect(['assets/route']);
                } else {
                    try {
                        $id = $data['id'];
                        $title = $data['title'];
                        $details = $data['details'];
                        $from = $data['from'];
                        $to = $data['to'];
                        $code = $data['code'];
                        $status = $data['status'];

                        if ($id) {
                            Yii::$app->db->createCommand()->update('a_route', [
                                'name' => $title,
                                'details' => $details,
                                'from' => $from,
                                'to' => $to,
                                'code' => $code,
                                'status' => $status,
                            ], ['id' => $id])->execute();
                        } else {
                            Yii::$app->db->createCommand()->insert('a_route', [
                                'name' => $title,
                                'details' => $details,
                                'from' => $from,
                                'to' => $to,
                                'code' => $code,
                                'status' => $status,
                            ])->execute();
                        }
                        $transaction->commit();
                        Yii::$app->session->setFlash('toast', 'Record saved successfully!');
                        return $this->redirect(['assets/route']);
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('toast', 'Internal Exception: ' . $e->getMessage());
                        return $this->redirect(['assets/route']);
                    }
                }
            }
        }


        $query = 'SELECT * FROM public."a_route" WHERE ' . $filter;
        $route_list = Yii::$app->db->createCommand($query, $params)->queryAll();

        return $this->render('route', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'route_list' => $route_list,
        ]);
    }
    public function actionLayers()
    {
        $filter = '1=1';
        $params = [];
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();



            if (isset($data['apply_search']) && $data['apply_search'] == 'Search') {
                if (!empty($data['name'])) {
                    $name = $data['name'];
                    $filter .= ' AND "name" LIKE :name';
                    $params[':name'] = '%' . $name . '%';
                }

                if (!empty($data['code'])) {
                    $code = $data['code'];
                    $filter .= ' AND "code" LIKE :code';
                    $params[':code'] = '%' . $code . '%';
                }
            } elseif (isset($data['save_record'])) {

                $transaction = Yii::$app->db->beginTransaction();

                // {"save_record":"save_record","id":"","title":"1","code":"2","status":"1","details":"4"}
                if ($data['save_record'] == 'delete_record') {
                    $id = $data['id'];
                    Yii::$app->db->createCommand()->delete('a_layers', ['id' => $id])->execute();
                    $transaction->commit();
                    Yii::$app->session->setFlash('toast', 'Record deleted successfully!');
                    return $this->redirect(['assets/layers']);
                } else {
                    try {
                        $id = $data['id'];
                        $title = $data['title'];
                        $p_layer = $data['p_layer'];
                        $code = $data['code'];
                        $status = $data['status'];
                        if ($id) {
                            Yii::$app->db->createCommand()->update('a_layers', [
                                'name' => $title,
                                'p_layer' => $p_layer,
                                'code' => $code,
                                'status' => $status,
                            ], ['id' => $id])->execute();
                        } else {
                            Yii::$app->db->createCommand()->insert('a_layers', [
                                'name' => $title,
                                'p_layer' => $p_layer,
                                'code' => $code,
                                'status' => $status,
                            ])->execute();
                        }
                        $transaction->commit();
                        Yii::$app->session->setFlash('toast', 'Record saved successfully!');
                        return $this->redirect(['assets/layers']);
                    } catch (\Exception $e) {

                        $transaction->rollBack();
                        Yii::$app->session->setFlash('toast', 'Internal Exception: ' . $e->getMessage());
                        return $this->redirect(['assets/layers']);
                    }
                }
            }
        }

        $query = 'SELECT * FROM public."a_layers" WHERE ' . $filter;
        $layers_list = Yii::$app->db->createCommand($query, $params)->queryAll();


        return $this->render('layers', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'layers_list' => $layers_list
        ]);
    }
    public function actionUnit()
    {
        $filter = '1=1';
        $params = [];
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            // echo json_encode($data);
            // exit;

            if (isset($data['apply_search']) && $data['apply_search'] == 'Search') {
                if (!empty($data['name'])) {
                    $name = $data['name'];
                    $filter .= ' AND au."name" LIKE :name';
                    $params[':name'] = '%' . $name . '%';
                }
                if (!empty($data['region'])) {
                    $region = $data['region'];
                    $filter .= ' AND au.region_id LIKE :region';
                    $params[':region'] = '%' . $region . '%';
                }
                if (!empty($data['code'])) {
                    $code = $data['code'];
                    $filter .= ' AND au."code" LIKE :code';
                    $params[':code'] = '%' . $code . '%';
                }
            } elseif (isset($data['save_record'])) {

                $transaction = Yii::$app->db->beginTransaction();

                // {"save_record":"save_record","id":"","title":"Unit 1","region_id":"1","code":"U1",
                //  "status":"1","details":"Unit Details"}

                if ($data['save_record'] == 'delete_record') {
                    $id = $data['id'];
                    Yii::$app->db->createCommand()->delete('U_unit', ['ID' => $id])->execute();
                    $transaction->commit();
                    Yii::$app->session->setFlash('toast', 'Record deleted successfully!');
                    return $this->redirect(['assets/unit']);
                } else {
                    try {
                        $id = $data['id'];
                        $title = $data['title'];
                        $region_id = $data['region_id'];
                        $code = $data['code'];
                        $status = $data['status'];
                        $details = $data['details'];

                        if ($id) {
                            Yii::$app->db->createCommand()->update('U_unit', [
                                'region_id' => $region_id,
                                'name' => $title,
                                'details' => $details,
                                'status' => $status,
                                'code' => $code,
                            ], ['ID' => $id])->execute();
                        } else {
                            Yii::$app->db->createCommand()->insert('U_unit', [
                                'region_id' => $region_id,
                                'name' => $title,
                                'details' => $details,
                                'status' => $status,
                                'code' => $code,
                            ])->execute();
                        }
                        $transaction->commit();
                        Yii::$app->session->setFlash('toast', 'Record saved successfully!');
                        return $this->redirect(['assets/unit']);
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('toast', 'Internal Exception: ' . $e->getMessage());
                        return $this->redirect(['assets/unit']);
                    }
                }
            }
        }

        $query = 'SELECT au.*, ar."name" AS region_name
                    FROM public."u_unit" AS au
                    LEFT JOIN public."a_region" AS ar ON au.region_id = ar."ID"
                    WHERE ' . $filter;
        $unit_list = Yii::$app->db->createCommand($query, $params)->queryAll();


        $region_list = Yii::$app->db->createCommand('SELECT * FROM public."a_region"')->queryAll();



        return $this->render('unit', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'unit_list' => $unit_list,
            'region_list' => $region_list
        ]);
    }
}
