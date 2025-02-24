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

class NotificationController extends Controller
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
        $actions = 'notification/' . $action->id;
        if (Yii::$app->session->has('user_array') == NULL)
            $this->redirect(['site/index']);
        else if (Yii::$app->Permissions->checkMethod($actions)) {
            $this->enableCsrfValidation = false;
            return parent::beforeAction($action);
        } else {
            Yii::$app->session->setFlash('toast', 'Unauthorized access... Please contact support team.');
            $this->redirect(['site/index']);
        }
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionContractnotifications()
    {

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            // echo json_encode($data);
            // exit;

            if (isset($data['save_record'])) {

                $transaction = Yii::$app->db->beginTransaction();

                if ($data['save_record'] == 'delete_record') {
                    $id = $data['id'];
                    Yii::$app->db->createCommand()->delete('m_contract', ['id' => $id])->execute();
                    $transaction->commit();
                    Yii::$app->session->setFlash('toast', 'Record deleted successfully!');
                    return $this->redirect(['contract/contract']);
                } else {

                    // {"save_record":"save_record","id":"","contract_no":"101","contractor_id":"2",
                    //  "status":"1","area":"123","typeofwork_id":"1","scope_id":"1","unit_id":"2",
                    //  "region_id":"1","route_id":"1","district_id":"2","progress":"57",
                    //  "engineer_estimate":"15000","contract_date":"2025-01-30","date_of_completion":"2025-02-28",
                    //  "bid_cost":"50000","finance_ref_code":"13242"}
                    try {
                        $id = $data['id'];
                        $contract_no = $data['contract_no'];
                        $contractor_id = $data['contractor_id'];
                        $type_of_work = $data['typeofwork_id'];
                        $scope_id = $data['scope_id'];
                        $unit_id = $data['unit_id'];
                        $region_id = $data['region_id'];
                        $route_id = $data['route_id'];
                        $district_id = $data['district_id'];
                        $progress = $data['progress'];
                        $engineer_estimate = $data['engineer_estimate'];
                        $contract_date = $data['contract_date'];
                        $date_of_completion = $data['date_of_completion'];
                        $bid_cost = $data['bid_cost'];
                        $finance_ref_code = $data['finance_ref_code'];
                        $area = $data['area'];
                        $status = 0; //$data['status'];

                        // id, contract_no, contractor_id, area, type_of_work, scope, contract_date, 
                        // date_of_com, engineer_estimate, bid_cost, date_of_completion, progress, 
                        // unit, status, region_id, route_id, district_id, finance_ref_code)
                        if ($id) {
                            Yii::$app->db->createCommand()->update('m_contract', [
                                'contract_no' => $contract_no,
                                'contractor_id' => $contractor_id,
                                'area' => $area,
                                'type_of_work' => $type_of_work,
                                'scope' => $scope_id,
                                'contract_date' => $contract_date,
                                'date_of_com' => $date_of_completion,
                                'engineer_estimate' => $engineer_estimate,
                                'bid_cost' => $bid_cost,
                                'date_of_completion' => $date_of_completion,
                                'progress' => $progress,
                                'unit' => $unit_id,
                                'region_id' => $region_id,
                                'route_id' => $route_id,
                                'district_id' => $district_id,
                                'finance_ref_code' => $finance_ref_code,
                                'status' => $status
                            ], ['id' => $id])->execute();
                        } else {
                            Yii::$app->db->createCommand()->insert('m_contract', [
                                'contract_no' => $contract_no,
                                'contractor_id' => $contractor_id,
                                'area' => $area,
                                'type_of_work' => $type_of_work,
                                'scope' => $scope_id,
                                'contract_date' => $contract_date,
                                'date_of_com' => $date_of_completion,
                                'engineer_estimate' => $engineer_estimate,
                                'bid_cost' => $bid_cost,
                                'date_of_completion' => $date_of_completion,
                                'progress' => $progress,
                                'unit' => $unit_id,
                                'region_id' => $region_id,
                                'route_id' => $route_id,
                                'district_id' => $district_id,
                                'finance_ref_code' => $finance_ref_code,
                                'status' => $status
                            ])->execute();
                        }
                        $transaction->commit();
                        Yii::$app->session->setFlash('toast', 'Record saved successfully!');
                        return $this->redirect(['contract/contract']);
                    } catch (\Exception $e) {
                        echo 'Internal Exception: ' . $e->getMessage();
                        exit;
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('toast', 'Internal Exception: ' . $e->getMessage());
                        return $this->redirect(['contract/contract']);
                    }
                }
            }
        }

        $contractors_list = Yii::$app->db->createCommand('SELECT * FROM public."m_contractor" ORDER BY id ASC')->queryAll();

        $type_list = Yii::$app->db->createCommand('SELECT * FROM public."m_type"')->queryAll();
        $scope_list = Yii::$app->db->createCommand('SELECT * FROM public."m_scope"')->queryAll();
        $unit_list = Yii::$app->db->createCommand('SELECT * FROM public."u_unit" ')->queryAll();
        $region_list = Yii::$app->db->createCommand('SELECT * FROM public."a_region"')->queryAll();
        $route_list = Yii::$app->db->createCommand('SELECT * FROM public."a_route" ORDER BY id ASC ')->queryAll();
        $district_list = Yii::$app->db->createCommand('SELECT * FROM public."a_district" ')->queryAll();


        $contract_Q = 'SELECT cont.*, contr."company_name" as contractor_name, t.name AS type_name,ms.name AS scope_name,
                    r.name AS region_name,u.name AS unit_name,
                    rt.name AS route_name,d.name AS district_name
                    FROM public."m_contract" as cont
                    LEFT JOIN public."m_contractor" AS contr ON cont."contractor_id" = contr."id"
                    LEFT JOIN public."a_region" AS r ON cont."region_id" = r."ID"
                    LEFT JOIN public."m_scope" AS ms ON cont.scope = ms."id"
                    LEFT JOIN public."m_type" AS t ON cont.type_of_work = t."id"
                    LEFT JOIN public."u_unit" AS u ON cont.unit = u."ID"
                    LEFT JOIN public."a_route" AS rt ON cont.route_id = rt.id
                    LEFT JOIN public."a_district" AS d ON cont.district_id = d.id
                    WHERE cont.status=0 OR cont.status=4
                    ';
        $contract_list = Yii::$app->db->createCommand($contract_Q)->queryAll();

        return $this->render('contractnotifications', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'contract_list' => $contract_list,
            'contractors_list' => $contractors_list,
            'type_list' => $type_list,
            'scope_list' => $scope_list,
            'region_list' => $region_list,
            'unit_list' => $unit_list,
            'route_list' => $route_list,
            'district_list' => $district_list,

        ]);
    }
    public function actionContractdetails()
    {
        $permissions = Yii::$app->Component->CheckPermissions(24, 38)[0];

        if ($permissions['can_view'] == '0') {
            Yii::$app->session->setFlash('toast', 'Unauthorized access.');
            return $this->redirect(['contract/index']);
        }
        if (!isset($_REQUEST['referance']) && empty($_REQUEST['referance'])) {
            Yii::$app->session->setFlash('toast', 'Unauthorized access.');
            return $this->redirect(['contract/index']);
        }

        $ref = $_REQUEST['referance'];

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            // echo json_encode($data);
            // exit;

            if (isset($data['save_record'])) {

                $transaction = Yii::$app->db->beginTransaction();

                try {
                    // {"contract_id":"1","status":"1","comment":"qw"}
                    $id = $data['contract_id'];
                    $comment = $data['comment'];
                    $status = $data['status'];

                    Yii::$app->db->createCommand()->update('m_contract', [
                        'status' => $status,
                        'comments' => $comment
                    ], ['id' => $id])->execute();
                    $transaction->commit();
                    Yii::$app->session->setFlash('toast', 'Record saved successfully!');

                    if ($status == 1) //If Approved return to home
                    {
                        return $this->redirect(['notification/contractnotifications']);
                    }

                    if (!isset($_REQUEST['referance']) && empty($_REQUEST['referance'])) {
                        Yii::$app->session->setFlash('toast', 'Unauthorized access.');
                        return $this->redirect(['notification/contractnotifications']);
                    }
                    return $this->redirect(['notification/contractdetails', 'referance' => $_REQUEST['referance']]);
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('toast', 'Internal Exception: ' . $e->getMessage());

                    if (!isset($_REQUEST['referance']) && empty($_REQUEST['referance'])) {
                        Yii::$app->session->setFlash('toast', 'Unauthorized access.');
                        return $this->redirect(['notification/contractnotifications']);
                    }
                    return $this->redirect(['notification/contractdetails', 'referance' => $_REQUEST['referance']]);
                }
            }
        }

        $type_list = Yii::$app->db->createCommand('SELECT * FROM public."m_type"')->queryAll();
        $scope_list = Yii::$app->db->createCommand('SELECT * FROM public."m_scope"')->queryAll();
        $unit_list = Yii::$app->db->createCommand('SELECT * FROM public."u_unit" ')->queryAll();
        $region_list = Yii::$app->db->createCommand('SELECT * FROM public."a_region"')->queryAll();
        $route_list = Yii::$app->db->createCommand('SELECT * FROM public."a_route" ORDER BY id ASC ')->queryAll();
        $district_list = Yii::$app->db->createCommand('SELECT * FROM public."a_district" ')->queryAll();

        $treatment_list = Yii::$app->db->createCommand('	SELECT * FROM public."m_treatment" ORDER BY id ASC ')->queryAll();



        $contract_Q = 'SELECT cont.*, contr."company_name" as contractor_name, t.name AS type_name,ms.name AS scope_name,
                    r.name AS region_name,u.name AS unit_name,
                    rt.name AS route_name,d.name AS district_name
                    FROM public."m_contract" as cont
                    LEFT JOIN public."m_contractor" AS contr ON cont."contractor_id" = contr."id"
                    LEFT JOIN public."a_region" AS r ON cont."region_id" = r."ID"
                    LEFT JOIN public."m_scope" AS ms ON cont.scope = ms."id"
                    LEFT JOIN public."m_type" AS t ON cont.type_of_work = t."id"
                    LEFT JOIN public."u_unit" AS u ON cont.unit = u."ID"
                    LEFT JOIN public."a_route" AS rt ON cont.route_id = rt.id
                    LEFT JOIN public."a_district" AS d ON cont.district_id = d.id
                    WHERE cont."id" = ' . $ref . ' ';

        $contract = Yii::$app->db->createCommand($contract_Q)->queryOne();

        return $this->render('contractdetails', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'contract' => $contract,
            'type_list' => $type_list,
            'scope_list' => $scope_list,
            'region_list' => $region_list,
            'unit_list' => $unit_list,
            'route_list' => $route_list,
            'district_list' => $district_list,
            'treatment_list' => $treatment_list
        ]);
    }
    public function actionProgressnotifications()
    {

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            // echo json_encode($data);
            // exit;

            if (isset($data['save_record'])) {

                $transaction = Yii::$app->db->beginTransaction();

                if ($data['save_record'] == 'delete_record') {
                    $id = $data['id'];
                    Yii::$app->db->createCommand()->delete('m_contract', ['id' => $id])->execute();
                    $transaction->commit();
                    Yii::$app->session->setFlash('toast', 'Record deleted successfully!');
                    return $this->redirect(['contract/contract']);
                } else {

                    // {"save_record":"save_record","id":"","contract_no":"101","contractor_id":"2",
                    //  "status":"1","area":"123","typeofwork_id":"1","scope_id":"1","unit_id":"2",
                    //  "region_id":"1","route_id":"1","district_id":"2","progress":"57",
                    //  "engineer_estimate":"15000","contract_date":"2025-01-30","date_of_completion":"2025-02-28",
                    //  "bid_cost":"50000","finance_ref_code":"13242"}
                    try {
                        $id = $data['id'];
                        $contract_no = $data['contract_no'];
                        $contractor_id = $data['contractor_id'];
                        $type_of_work = $data['typeofwork_id'];
                        $scope_id = $data['scope_id'];
                        $unit_id = $data['unit_id'];
                        $region_id = $data['region_id'];
                        $route_id = $data['route_id'];
                        $district_id = $data['district_id'];
                        $progress = $data['progress'];
                        $engineer_estimate = $data['engineer_estimate'];
                        $contract_date = $data['contract_date'];
                        $date_of_completion = $data['date_of_completion'];
                        $bid_cost = $data['bid_cost'];
                        $finance_ref_code = $data['finance_ref_code'];
                        $area = $data['area'];
                        $status = 0; //$data['status'];

                        // id, contract_no, contractor_id, area, type_of_work, scope, contract_date, 
                        // date_of_com, engineer_estimate, bid_cost, date_of_completion, progress, 
                        // unit, status, region_id, route_id, district_id, finance_ref_code)
                        if ($id) {
                            Yii::$app->db->createCommand()->update('m_contract', [
                                'contract_no' => $contract_no,
                                'contractor_id' => $contractor_id,
                                'area' => $area,
                                'type_of_work' => $type_of_work,
                                'scope' => $scope_id,
                                'contract_date' => $contract_date,
                                'date_of_com' => $date_of_completion,
                                'engineer_estimate' => $engineer_estimate,
                                'bid_cost' => $bid_cost,
                                'date_of_completion' => $date_of_completion,
                                'progress' => $progress,
                                'unit' => $unit_id,
                                'region_id' => $region_id,
                                'route_id' => $route_id,
                                'district_id' => $district_id,
                                'finance_ref_code' => $finance_ref_code,
                                'status' => $status
                            ], ['id' => $id])->execute();
                        } else {
                            Yii::$app->db->createCommand()->insert('m_contract', [
                                'contract_no' => $contract_no,
                                'contractor_id' => $contractor_id,
                                'area' => $area,
                                'type_of_work' => $type_of_work,
                                'scope' => $scope_id,
                                'contract_date' => $contract_date,
                                'date_of_com' => $date_of_completion,
                                'engineer_estimate' => $engineer_estimate,
                                'bid_cost' => $bid_cost,
                                'date_of_completion' => $date_of_completion,
                                'progress' => $progress,
                                'unit' => $unit_id,
                                'region_id' => $region_id,
                                'route_id' => $route_id,
                                'district_id' => $district_id,
                                'finance_ref_code' => $finance_ref_code,
                                'status' => $status
                            ])->execute();
                        }
                        $transaction->commit();
                        Yii::$app->session->setFlash('toast', 'Record saved successfully!');
                        return $this->redirect(['contract/contract']);
                    } catch (\Exception $e) {
                        echo 'Internal Exception: ' . $e->getMessage();
                        exit;
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('toast', 'Internal Exception: ' . $e->getMessage());
                        return $this->redirect(['contract/contract']);
                    }
                }
            }
        }

        $contractors_list = Yii::$app->db->createCommand('SELECT * FROM public."m_contractor" ORDER BY id ASC')->queryAll();

        $type_list = Yii::$app->db->createCommand('SELECT * FROM public."m_type"')->queryAll();
        $scope_list = Yii::$app->db->createCommand('SELECT * FROM public."m_scope"')->queryAll();
        $unit_list = Yii::$app->db->createCommand('SELECT * FROM public."u_unit" ')->queryAll();
        $region_list = Yii::$app->db->createCommand('SELECT * FROM public."a_region"')->queryAll();
        $route_list = Yii::$app->db->createCommand('SELECT * FROM public."a_route" ORDER BY id ASC ')->queryAll();
        $district_list = Yii::$app->db->createCommand('SELECT * FROM public."a_district" ')->queryAll();


        $user_level = Yii::$app->session->get('user_array')['user_level'];

        $progress_status = '';
        switch ($user_level) {
            case 1:
                $progress_status = ''; //Show ALL
                break;
            case 2:
                $progress_status = ' AND (cp.status = 3 OR cp.status = -3)';
                break;
            case 3:
                $progress_status = ' AND (cp.status = 4 OR cp.status = -4)';
                break;
            case 4:
                $progress_status = ' AND (cp.status = 5 OR cp.status = -5)';
                break;
            case 5:
                $progress_status = ' AND (cp.status = 6 OR cp.status = -6)';
                break;
            default:
                $progress_status = '';
                break;
        }

        $contract_Q = 'SELECT cont.*, contr."company_name" as contractor_name,
                    t.name AS type_name,ms.name AS scope_name,
                    r.name AS region_name,u.name AS unit_name,
                    rt.name AS route_name,d.name AS district_name,
                    cp.id as progress_id, cp.task,cp.details,
                    cp.progress, cp.start_date, cp.end_date, cp.status as progress_status,
                    cp.submission_date, emp.name as submitted_by
                    FROM public."m_contract" as cont
                    LEFT JOIN public."m_contractor" AS contr ON cont."contractor_id" = contr."id"
                    LEFT JOIN public."a_region" AS r ON cont."region_id" = r."ID"
                    LEFT JOIN public."m_scope" AS ms ON cont.scope = ms."id"
                    LEFT JOIN public."m_type" AS t ON cont.type_of_work = t."id"
                    LEFT JOIN public."u_unit" AS u ON cont.unit = u."ID"
                    LEFT JOIN public."a_route" AS rt ON cont.route_id = rt.id
                    LEFT JOIN public."a_district" AS d ON cont.district_id = d.id
                    LEFT JOIN public."m_contract_progress" AS cp ON cont.id = cp.contract_id
                    LEFT JOIN public.employee AS emp ON emp.id = cp.submitted_by
                    WHERE cont.status=1 ' . $progress_status . '
                    ORDER BY cont.id ASC';
        $contract_list = Yii::$app->db->createCommand($contract_Q)->queryAll();

        return $this->render('progressnotifications', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'contract_list' => $contract_list,
            'contractors_list' => $contractors_list,
            'type_list' => $type_list,
            'scope_list' => $scope_list,
            'region_list' => $region_list,
            'unit_list' => $unit_list,
            'route_list' => $route_list,
            'district_list' => $district_list,

        ]);
    }
}
