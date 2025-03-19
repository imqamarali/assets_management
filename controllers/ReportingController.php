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

class ReportingController extends Controller
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
        return $this->render('index');
    }
	public function actionRoute()
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

        $asset_Q = 'SELECT * FROM public."a_route"';

        $assets_list = Yii::$app->db->createCommand($asset_Q)->queryAll();

        // Fetch data for dropdowns
        $provinces = Yii::$app->db->createCommand('SELECT "ID", "name" FROM public."a_province"')->queryAll();
        

        return $this->render('route', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'assets_list' => $assets_list,
            
        ]);
    }
	public function actionContractsummary()
    {
        $where = '1=1'; // Start with a true condition to simplify appending filters

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();

            if (isset($data['apply_search']) && $data['apply_search'] == 'Search') {
				
                if (isset($data['year']) && !empty($data['year'])) {
                    $years= implode(', ',$data['year']);//exit;
					
					$where .= " AND cont.amp_year in (".$years.")";
                }
				if (isset($data['name']) && !empty($data['name'])) {
                    $where .= " AND cont.contract_no LIKE '%" . $data['name'] . "%'";
                }
                if (isset($data['region']) && !empty($data['region'])) {
                    $where .= " AND cont.region_id = '" . $data['region'] . "'";
                }
                if (isset($data['province']) && !empty($data['province'])) {
                    $where .= " AND cont.province_id = '" . $data['province'] . "'";
                }
				if (isset($data['district']) && !empty($data['district'])) {
                    $where .= " AND na.district_id = '" . $data['district'] . "'";
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

        $asset_Q = 'SELECT cont.*, contr."company_name" as contractor_name, t.name AS type_name,ms.name AS scope_name,
                    r.name AS region_name,u.name AS unit_name,
                    rt.name AS route_name,d.name AS district_name
                    FROM public."m_contract" as cont
                    LEFT JOIN public."m_contractor" AS contr ON cont."contractor_id" = contr."id"
                    LEFT JOIN public."a_region" AS r ON cont."region_id" = r."ID"
                    LEFT JOIN public."m_scope" AS ms ON cont.scope = ms."id"
                    LEFT JOIN public."m_type" AS t ON cont.type_of_work = t."id"
                    LEFT JOIN public."u_unit" AS u ON cont.unit = u."ID"
                    LEFT JOIN public."a_route" AS rt ON cont.route_id = rt.id
                    LEFT JOIN public."a_district" AS d ON cont.district_id = d.id where '. $where .' limit 200';

        $assets_list = Yii::$app->db->createCommand($asset_Q)->queryAll();

        // Fetch data for dropdowns
        $provinces = Yii::$app->db->createCommand('SELECT "ID", "name" FROM public."a_province"')->queryAll();
        

        return $this->render('contractsummary', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'assets_list' => $assets_list,
            
        ]);
    }
	
	
	
	public function actionAmpsummary()
    {
        $permissions = Yii::$app->Component->CheckPermissions(27, 44)[0];

        if ($permissions['can_view'] == '0') {
         //   Yii::$app->session->setFlash('toast', 'Unauthorized access.');
           // return $this->redirect(['contract/index']);
        }
        if (!isset($_REQUEST['referance']) && empty($_REQUEST['referance'])) {
            //Yii::$app->session->setFlash('toast', 'Unauthorized access.');
            //return $this->redirect(['contract/index']);
        }

        //$ref = $_REQUEST['referance'];


        $type_list = Yii::$app->db->createCommand('SELECT * FROM public."m_type"')->queryAll();
        $scope_list = Yii::$app->db->createCommand('SELECT * FROM public."m_scope"')->queryAll();
        $region_list = Yii::$app->db->createCommand('SELECT * FROM public."a_region"')->queryAll();
        $unit_list = Yii::$app->db->createCommand('SELECT * FROM public."u_unit" ')->queryAll();
        $route_list = Yii::$app->db->createCommand('SELECT * FROM public."a_route" ORDER BY id ASC ')->queryAll();
        $zone_list = Yii::$app->db->createCommand('SELECT * FROM public."a_zone"')->queryAll();
        $district_list = Yii::$app->db->createCommand('SELECT * FROM public."a_district" ')->queryAll();
        $treatment_list = Yii::$app->db->createCommand('	SELECT * FROM public."m_treatment" ORDER BY id ASC ')->queryAll();


        $main_list = Yii::$app->db->createCommand(
            'SELECT id, title, year, create_date,status FROM public."amp_main"
           '
        )->queryOne();


        $amp_sub = 'SELECT asub.id, asub."AMP_id", asub.typeofwork_id, asub.scope_id,
                asub.discription, asub.region_id, asub.unit_id, asub.route_id, asub.zone_id,
                asub.district_id, asub.engineer_estimate, asub.cost, asub.remarks, asub.status,
				amp.title as amp_name, t.name AS type_name,ms.name AS scope_name, r.name AS region_name,u.name AS unit_name,
                rt.name AS route_name, z."Name" AS zone_name,d.name AS district_name
                FROM public."amp_sub" as asub
                LEFT JOIN public."amp_main" AS amp ON asub."AMP_id" = amp."id"
                LEFT JOIN public."a_region" AS r ON asub.region_id = r."ID"
                LEFT JOIN public."m_scope" AS ms ON asub.scope_id = ms."id"
                LEFT JOIN public."m_type" AS t ON asub.typeofwork_id = t."id"
                LEFT JOIN public."u_unit" AS u ON asub.unit_id = u."ID"
                LEFT JOIN public."a_route" AS rt ON asub.route_id = rt.id
                LEFT JOIN public."a_zone" AS z ON asub.zone_id = z.id
                LEFT JOIN public."a_district" AS d ON asub.district_id = d.id
                 ';
        $amp_sub_list = Yii::$app->db->createCommand($amp_sub)->queryAll();
        $main_list['amp_sub_list'] = $amp_sub_list;
        $amp_sub = 'SELECT asD.*, asub.discription as asub_name, amp.title AS amp_main_name,  tr.name as treatment_name,
                    t.name as type_name
                    FROM public."amp_sub_bdetail" as asD
                    LEFT JOIN public."amp_sub" AS asub ON asub."id" = asD."AMP_sub_id"
                    LEFT JOIN public."amp_main" AS amp ON amp."id" = asD."AMP_main_id"
					LEFT JOIN public."m_treatment" as tr ON asD.treatment = tr."id"
                    LEFT JOIN public."m_type" AS t ON asub.typeofwork_id = t."id"
                    ';
        $amp_details = Yii::$app->db->createCommand($amp_sub)->queryAll();
        $main_list['amp_details'] = $amp_details;



        $amp_list = Yii::$app->db->createCommand('SELECT id, title, year, create_date,status FROM public."amp_main";')->queryAll();
        $amp_sub = 'SELECT asub.id, asub."AMP_id", asub.typeofwork_id, asub.scope_id,
                asub.discription, asub.region_id, asub.unit_id, asub.route_id, asub.zone_id,
                asub.district_id, asub.engineer_estimate, asub.cost, asub.remarks, asub.status,
				amp.title as amp_name, t.name AS type_name,ms.name AS scope_name, r.name AS region_name,u.name AS unit_name,
                rt.name AS route_name, z."Name" AS zone_name,d.name AS district_name
                FROM public."amp_sub" as asub
                LEFT JOIN public."amp_main" AS amp ON asub."AMP_id" = amp."id"
                LEFT JOIN public."a_region" AS r ON asub.region_id = r."ID"
                LEFT JOIN public."m_scope" AS ms ON asub.scope_id = ms."id"
                LEFT JOIN public."m_type" AS t ON asub.typeofwork_id = t."id"
                LEFT JOIN public."u_unit" AS u ON asub.unit_id = u."ID"
                LEFT JOIN public."a_route" AS rt ON asub.route_id = rt.id
                LEFT JOIN public."a_zone" AS z ON asub.zone_id = z.id
                LEFT JOIN public."a_district" AS d ON asub.district_id = d.id;';
        $amp_sub_list = Yii::$app->db->createCommand($amp_sub)->queryAll();
        $amp_sub = 'SELECT asD.*, asub.discription as asub_name, amp.title AS amp_main_name,  tr.name as treatment_name,
                    t.name as type_name
                    FROM public."amp_sub_bdetail" as asD
                    LEFT JOIN public."amp_sub" AS asub ON asub."AMP_id" = asD."id"
                    LEFT JOIN public."amp_main" AS amp ON asub."AMP_id" = amp."id"
					LEFT JOIN public."m_treatment" as tr ON asD.treatment = tr."id"
                    LEFT JOIN public."m_type" AS t ON asub.typeofwork_id = t."id"';
        $amp_details_list = Yii::$app->db->createCommand($amp_sub)->queryAll();

        return $this->render('ampsummary', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'main_info' => $main_list,
            'amp_main' => $amp_list,
            'amp_sub_list' => $amp_sub_list,
            'amp_details_list' => $amp_details_list,
            'type_list' => $type_list,
            'scope_list' => $scope_list,
            'region_list' => $region_list,
            'unit_list' => $unit_list,
            'treatment_list' => $treatment_list,
            'route_list' => $route_list,
            'zone_list' => $zone_list,
            'district_list' => $district_list,

        ]);
    }

	public function actionRoutewizeyearamp()
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

        $asset_Q = 'SELECT * FROM public."a_route"';

        $assets_list = Yii::$app->db->createCommand($asset_Q)->queryAll();

        // Fetch data for dropdowns
        $provinces = Yii::$app->db->createCommand('SELECT "ID", "name" FROM public."a_province"')->queryAll();
        

        return $this->render('routewizeyearamp', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'assets_list' => $assets_list
            
        ]);
    }
	public function actionRegionwizeyearamp()
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

        $asset_Q = 'SELECT * FROM public."a_region"';

        $assets_list = Yii::$app->db->createCommand($asset_Q)->queryAll();

        // Fetch data for dropdowns
        $provinces = Yii::$app->db->createCommand('SELECT "ID", "name" FROM public."a_province"')->queryAll();
        

        return $this->render('regionwizeyearamp', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'assets_list' => $assets_list
            
        ]);
    }
	public function actionRouteunit()
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

        $asset_Q = 'SELECT * FROM public."u_unit"';
        $assets_list = Yii::$app->db->createCommand($asset_Q)->queryAll();

        // Fetch data for dropdowns
        $provinces = Yii::$app->db->createCommand('SELECT "ID", "name" FROM public."a_province"')->queryAll();
		$provinces = Yii::$app->db->createCommand('SELECT "ID", "name" FROM public."a_province"')->queryAll();
        

        return $this->render('routeunit', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'assets_list' => $assets_list
            
        ]);
    }
}
