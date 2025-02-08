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

class AmpController extends Controller
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
        if (Yii::$app->session->has('user_array') == NULL)
            $this->redirect(['site/index']);
        else {
            $this->enableCsrfValidation = true;
            return parent::beforeAction($action);
        }
    }

    public function actionIndex()
    {

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            // echo json_encode($data);
            // exit;

            if (isset($data['save_record'])) {

                $transaction = Yii::$app->db->beginTransaction();

                // {"save_record":"save_record","id":"1","title":"New Record1111","year":"2025","status":"1"}
                if ($data['save_record'] == 'delete_record') {
                    $id = $data['id'];
                    Yii::$app->db->createCommand()->delete('amp_main', ['id' => $id])->execute();
                    $transaction->commit();
                    Yii::$app->session->setFlash('toast', 'Record deleted successfully!');
                    return $this->redirect(['amp/index']);
                } else {
                    try {
                        $id = $data['id'];
                        $title = $data['title'];
                        $year = $data['year'];
                        $status = $data['status'];

                        if ($id) {
                            Yii::$app->db->createCommand()->update('amp_main', [
                                'title' => $title,
                                'year' => $year,
                                'status' => $status,
                            ], ['id' => $id])->execute();
                        } else {
                            Yii::$app->db->createCommand()->insert('amp_main', [
                                'title' => $title,
                                'year' => $year,
                                'status' => $status,
                            ])->execute();
                        }
                        $transaction->commit();
                        Yii::$app->session->setFlash('toast', 'Record saved successfully!');
                        return $this->redirect(['amp/index']);
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('toast', 'Internal Exception: ' . $e->getMessage());
                        return $this->redirect(['amp/index']);
                    }
                }
            }
        }

        $main_list = Yii::$app->db->createCommand(
            'SELECT id, title, year, create_date,status FROM public."amp_main";'
        )->queryAll();



        return $this->render('index', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'main_list' => $main_list
        ]);
    }

    public function actionamp_sub()
    {


        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            // echo json_encode($data);
            // exit;

            if (isset($data['save_record'])) {

                $transaction = Yii::$app->db->beginTransaction();

                // {"save_record":"save_record","id":"","title":"New Title","status":"1",
                //  "amp_id":"3","typeofwork_id":"1","scope_id":"1","region_id":"1",
                //  "unit_id":"2","route_id":"1","zone_id":"1","district_id":"2",
                //  "engineer_estimate":"Estimate","cost":"Cost","remarks":"Remarks",
                // "details":"Details Here"}
                if ($data['save_record'] == 'delete_record') {
                    $id = $data['id'];
                    Yii::$app->db->createCommand()->delete('amp_sub', ['id' => $id])->execute();
                    $transaction->commit();
                    Yii::$app->session->setFlash('toast', 'Record deleted successfully!');
                    return $this->redirect(['amp/amp_sub']);
                } else {
                    try {
                        $id = $data['id'];
                        $amp_id = $data['amp_id'];
                        $typeofwork_id = $data['typeofwork_id'];
                        $scope_id = $data['scope_id'];
                        $region_id = $data['region_id'];
                        $unit_id = $data['unit_id'];
                        $route_id = $data['route_id'];
                        $zone_id = $data['zone_id'];
                        $district_id = $data['district_id'];
                        $engineer_estimate = $data['engineer_estimate'];
                        $cost = $data['cost'];
                        $remarks = $data['remarks'];
                        $status = $data['status'];
                        $discription = $data['details'];
                        $status = $data['status'];
                        if ($id) {
                            Yii::$app->db->createCommand()->update('amp_sub', [
                                'AMP_id' => $amp_id,
                                'typeofwork_id' => $typeofwork_id,
                                'scope_id' => $scope_id,
                                'region_id' => $region_id,
                                'unit_id' => $unit_id,
                                'route_id' => $route_id,
                                'zone_id' => $zone_id,
                                'district_id' => $district_id,
                                'engineer_estimate' => $engineer_estimate,
                                'cost' => $cost,
                                'remarks' => $remarks,
                                'status' => $status,
                                'discription' => $discription,
                            ], ['id' => $id])->execute();
                        } else {
                            Yii::$app->db->createCommand()->insert('amp_sub', [
                                'AMP_id' => $amp_id,
                                'typeofwork_id' => $typeofwork_id,
                                'scope_id' => $scope_id,
                                'region_id' => $region_id,
                                'unit_id' => $unit_id,
                                'route_id' => $route_id,
                                'zone_id' => $zone_id,
                                'district_id' => $district_id,
                                'engineer_estimate' => $engineer_estimate,
                                'cost' => $cost,
                                'remarks' => $remarks,
                                'status' => $status,
                                'discription' => $discription,
                            ])->execute();
                        }
                        $transaction->commit();
                        Yii::$app->session->setFlash('toast', 'Record saved successfully!');
                        return $this->redirect(['amp/amp_sub']);
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('toast', 'Internal Exception: ' . $e->getMessage());
                        return $this->redirect(['amp/amp_sub']);
                    }
                }
            }
        }


        $main_list = Yii::$app->db->createCommand('SELECT id, title, year, create_date,status FROM public."amp_main";')->queryAll();
        $type_list = Yii::$app->db->createCommand('SELECT * FROM public."M_type"')->queryAll();
        $scope_list = Yii::$app->db->createCommand('SELECT * FROM public."M_scope"')->queryAll();
        $region_list = Yii::$app->db->createCommand('SELECT * FROM public."a_region"')->quseryAll();
        $unit_list = Yii::$app->db->createCommand('SELECT * FROM public."U_unit" ')->queryAll();
        $route_list = Yii::$app->db->createCommand('SELECT * FROM public."a_route" ORDER BY id ASC ')->queryAll();
        $zone_list = Yii::$app->db->createCommand('SELECT * FROM public."a_zone"')->queryAll();
        $district_list = Yii::$app->db->createCommand('SELECT * FROM public."a_district" ')->queryAll();


        $amp_sub = 'SELECT asub.id, asub."AMP_id", asub.typeofwork_id, asub.scope_id,
                asub.discription, asub.region_id, asub.unit_id, asub.route_id, asub.zone_id,
                asub.district_id, asub.engineer_estimate, asub.cost, asub.remarks, asub.status,
				amp.title as amp_name, t.name AS type_name,ms.name AS scope_name, r.name AS region_name,u.name AS unit_name,
                rt.name AS route_name, z."Name" AS zone_name,d.name AS district_name
                FROM public."amp_sub" as asub
                LEFT JOIN public."amp_main" AS amp ON asub."AMP_id" = amp."id"
                LEFT JOIN public."a_region" AS r ON asub.region_id = r."ID"
                LEFT JOIN public."M_scope" AS ms ON asub.scope_id = ms."id"
                LEFT JOIN public."M_type" AS t ON asub.typeofwork_id = t."id"
                LEFT JOIN public."U_unit" AS u ON asub.unit_id = u."ID"
                LEFT JOIN public."a_route" AS rt ON asub.route_id = rt.id
                LEFT JOIN public."a_zone" AS z ON asub.zone_id = z.id
                LEFT JOIN public."a_district" AS d ON asub.district_id = d.id;';
        $amp_sub_list = Yii::$app->db->createCommand($amp_sub)->queryAll();

        return $this->render('amp_sub', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'amp_sub_list' => $amp_sub_list,
            'amp_main' => $main_list,
            'type_list' => $type_list,
            'scope_list' => $scope_list,
            'region_list' => $region_list,
            'unit_list' => $unit_list,
            'route_list' => $route_list,
            'zone_list' => $zone_list,
            'district_list' => $district_list,


        ]);
    }


    public function actionamp_sub_details()
    {
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            // echo json_encode($data);
            // exit;

            if (isset($data['save_record'])) {

                $transaction = Yii::$app->db->beginTransaction();

                // {"save_record":"save_record","id":"","amp_id":"1","amp_sub_id":"1","treatment_id":"1",
                //  "typeofwork_id":"1","km_from":"10","km_to":"20","location_from":"L1","location_to":"L10",
                //  "direction":"E-W","length":"10KM","status":"1","details":"Testing Details."}

                if ($data['save_record'] == 'delete_record') {
                    $id = $data['id'];
                    Yii::$app->db->createCommand()->delete('amp_sub_bdetail', ['id' => $id])->execute();
                    $transaction->commit();
                    Yii::$app->session->setFlash('toast', 'Record deleted successfully!');
                    return $this->redirect(['amp/amp_sub_details']);
                } else {
                    try {
                        $id = $data['id'];
                        $amp_id = $data['amp_id'];
                        $amp_sub_id = $data['amp_sub_id'];
                        $km_from = $data['km_from'];
                        $km_to = $data['km_to'];
                        $direction = $data['direction'];
                        $typeofwork_id = $data['typeofwork_id'];
                        $treatment_id = $data['treatment_id'];
                        $length = $data['length'];
                        $location_from = $data['location_from'];
                        $location_to = $data['location_to'];
                        $discription = $data['details'];
                        $status = $data['status'];
                        if ($id) {

                            Yii::$app->db->createCommand()->update('amp_sub_bdetail', [
                                "AMP_main_id" => $amp_id,
                                "amp_sub_id" => $amp_sub_id,
                                'km_from' => $km_from,
                                'km_to' => $km_to,
                                'direction' => $direction,
                                'type_of_work' => $typeofwork_id,
                                'treatment' => $treatment_id,
                                'lenght' => $length,
                                'location_from' => $location_from,
                                'location_to' => $location_to,
                                'discription' => $discription,
                                'status' => $status,
                            ], ['id' => $id])->execute();
                        } else {
                            Yii::$app->db->createCommand()->insert('amp_sub_bdetail', [
                                "AMP_main_id" => $amp_id,
                                "amp_sub_id" => $amp_sub_id,
                                'km_from' => $km_from,
                                'km_to' => $km_to,
                                'direction' => $direction,
                                'type_of_work' => $typeofwork_id,
                                'treatment' => $treatment_id,
                                'lenght' => $length,
                                'location_from' => $location_from,
                                'location_to' => $location_to,
                                'discription' => $discription,
                                'status' => $status,
                            ])->execute();
                        }
                        $transaction->commit();
                        Yii::$app->session->setFlash('toast', 'Record saved successfully!');
                        return $this->redirect(['amp/amp_sub_details']);
                    } catch (\Exception $e) {
                        $transaction->rollBack();

                        Yii::$app->session->setFlash('toast', 'Internal Exception: ' . $e->getMessage());
                        return $this->redirect(['amp/amp_sub_details']);
                    }
                }
            }
        }


        $main_list = Yii::$app->db->createCommand('SELECT id, title, year, create_date,status FROM public."amp_main";')->queryAll();
        $amp_sub_list = Yii::$app->db->createCommand('SELECT id, discription as name FROM public."amp_sub";')->queryAll();
        $type_list = Yii::$app->db->createCommand('SELECT * FROM public."M_type"')->queryAll();
        $treatment_list = Yii::$app->db->createCommand('	SELECT * FROM public."M_treatment " ORDER BY id ASC ')->queryAll();
        $amp_sub = 'SELECT asD.*, asub.discription as asub_name, amp.title AS amp_main_name,  tr.name as treatment_name,
                    t.name as type_name
                    FROM public."amp_sub_bdetail" as asD
                    LEFT JOIN public."amp_sub" AS asub ON asub."AMP_id" = asD."id"
                    LEFT JOIN public."amp_main" AS amp ON asub."AMP_id" = amp."id"
					LEFT JOIN public."M_treatment " as tr ON asD.treatment = tr."id"
                    LEFT JOIN public."M_type" AS t ON asub.typeofwork_id = t."id"';
        $amp_details_list = Yii::$app->db->createCommand($amp_sub)->queryAll();

        return $this->render('amp_sub_details', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'amp_details_list' => $amp_details_list,
            'amp_sub_list' => $amp_sub_list,
            'amp_main' => $main_list,
            'treatment_list' => $treatment_list,
            'type_list' => $type_list
        ]);
    }
}
