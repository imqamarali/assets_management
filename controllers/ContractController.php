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

class ContractController extends Controller
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
        $actions = 'contract/' . $action->id;
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
        $module_features = Yii::$app->Permissions->getModuleFeatures(24); // Contract Management Module id 23

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

    public function actionContractor()
    {

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            // echo json_encode($data);
            // exit;

            if (isset($data['save_record'])) {

                $transaction = Yii::$app->db->beginTransaction();

                // {"save_record":"save_record","id":"","title":"Company Name","ntn":"101","area":"1001",
                // "phone_no":"1234567890","contact_person":"1234567","mobile_no":"2345678",
                // "contractor_no":"123432","secp_no":"123432","pec_no":"123432",
                // "details":"Testing Details","status":"1"}
                if ($data['save_record'] == 'delete_record') {
                    $id = $data['id'];
                    Yii::$app->db->createCommand()->delete('m_contractor', ['id' => $id])->execute();
                    $transaction->commit();
                    Yii::$app->session->setFlash('toast', 'Record deleted successfully!');
                    return $this->redirect(['contract/contractor']);
                } else {
                    try {
                        $id = $data['id'];
                        $company_name = $data['title'];
                        $phone_no = $data['phone_no'];
                        $contact_person = $data['contact_person'];
                        $mobile_no = $data['mobile_no'];
                        $address = $data['details'];
                        $contractor_no = $data['contractor_no'];
                        $secp_no = $data['secp_no'];
                        $pec_no = $data['pec_no'];
                        $area = $data['area'];
                        $ntn_no = $data['ntn'];
                        $status = $data['status'];

                        // echo json_encode([
                        //     'company_name' => $company_name,
                        //     'phone_no' => $phone_no,
                        //     'contact_person' => $contact_person,
                        //     'mobile_no' => $mobile_no,
                        //     'address' => $address,
                        //     'contractor_no' => $contractor_no,
                        //     'pec_no' => $pec_no,
                        //     'secp_no' => $secp_no,
                        //     'area' => $area,
                        //     'ntn_no' => $ntn_no,
                        //     'status' => $status
                        // ]);
                        // exit;

                        // id, "company_name ", phone_no, contact_person, mobile_no, address, 
                        //      contractor_no, secp_no, pec_no, area, ntn_no, status
                        if ($id) {
                            Yii::$app->db->createCommand()->update('m_contractor', [
                                'company_name ' => $company_name,
                                'phone_no' => $phone_no,
                                'contact_person' => $contact_person,
                                'mobile_no' => $mobile_no,
                                'address' => $address,
                                'contractor_no' => $contractor_no,
                                'pec_no' => $pec_no,
                                'secp_no' => $secp_no,
                                'area' => $area,
                                'ntn_no' => $ntn_no,
                                'status' => $status
                            ], ['id' => $id])->execute();
                        } else {
                            Yii::$app->db->createCommand()->insert('m_contractor', [
                                'company_name ' => $company_name,
                                'phone_no' => $phone_no,
                                'contact_person' => $contact_person,
                                'mobile_no' => $mobile_no,
                                'address' => $address,
                                'contractor_no' => $contractor_no,
                                'pec_no' => $pec_no,
                                'secp_no' => $secp_no,
                                'area' => $area,
                                'ntn_no' => $ntn_no,
                                'status' => $status
                            ])->execute();
                        }
                        $transaction->commit();
                        Yii::$app->session->setFlash('toast', 'Record saved successfully!');
                        return $this->redirect(['contract/contractor']);
                    } catch (\Exception $e) {
                        echo 'Internal Exception: ' . $e->getMessage();
                        exit;
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('toast', 'Internal Exception: ' . $e->getMessage());
                        return $this->redirect(['contract/contractor']);
                    }
                }
            }
        }

        $contractors_list = Yii::$app->db->createCommand('SELECT * FROM public."m_contractor" ORDER BY id ASC')->queryAll();



        return $this->render('contractor', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'contractors_list' => $contractors_list
        ]);
    }
    /*
    Contract Status
    0. Un-approved
    1. Approved & In-progress
    2. Approved & Discontinued
    3. Completed

*/
    public function actionContract()
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


        $contract_Q = 'SELECT cont.*, contr."company_name " as contractor_name, t.name AS type_name,ms.name AS scope_name,
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
';
        $contract_list = Yii::$app->db->createCommand($contract_Q)->queryAll();

        return $this->render('contract', [
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

        $type_list = Yii::$app->db->createCommand('SELECT * FROM public."m_type"')->queryAll();
        $scope_list = Yii::$app->db->createCommand('SELECT * FROM public."m_scope"')->queryAll();
        $unit_list = Yii::$app->db->createCommand('SELECT * FROM public."u_unit" ')->queryAll();
        $region_list = Yii::$app->db->createCommand('SELECT * FROM public."a_region"')->queryAll();
        $route_list = Yii::$app->db->createCommand('SELECT * FROM public."a_route" ORDER BY id ASC ')->queryAll();
        $district_list = Yii::$app->db->createCommand('SELECT * FROM public."a_district" ')->queryAll();

        $treatment_list = Yii::$app->db->createCommand('	SELECT * FROM public."m_treatment" ORDER BY id ASC ')->queryAll();



        $contract_Q = 'SELECT cont.*, contr."company_name " as contractor_name, t.name AS type_name,ms.name AS scope_name,
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
        $contract_sub_Q = 'SELECT cc.*, cont."contract_no", contr."company_name ",
                            t."name" as type_name, mt."name" as treatment_name
                            FROM public."m_contract_cub" cc
                            LEFT JOIN public."m_contract" cont ON cc."contract_id" = cont.id
                            LEFT JOIN public."m_contractor" AS contr ON cont."contractor_id" = contr."id"
                            LEFT JOIN public."m_type" AS t ON cc."type_of_work" = t."id"
                            LEFT JOIN public."m_treatment" AS mt ON cc."treatment" = mt."id"
                            WHERE cont."id" = ' . $ref . ' ';
        $contract_revised_Q = 'SELECT cr.*,cont."contract_no",contr."company_name " as company_name, t."name" as type_name  FROM public."m_contract_revised" cr
                    LEFT JOIN public."m_contract" cont ON cr."contract_id" = cont.id
                    LEFT JOIN public."m_contractor" AS contr ON cont."contractor_id" = contr."id"
                    LEFT JOIN public."m_type" AS t ON cont.type_of_work = t."id"
                    WHERE cont."id" = ' . $ref . ' ';
        $contract_pay_Q = 'SELECT cp.*, cont."contract_no", contr."company_name "
                            FROM public."m_contract_payments" cp
                            LEFT JOIN public."m_contract" cont ON cp."contract_id" = cont.id
                            LEFT JOIN public."m_contractor" AS contr ON cont."contractor_id" = contr."id"
                            WHERE cont."id" = ' . $ref . ' ';

        $contract = Yii::$app->db->createCommand($contract_Q)->queryOne();
        $contract_sub_list = Yii::$app->db->createCommand($contract_sub_Q)->queryAll();
        $contract_revised_list = Yii::$app->db->createCommand($contract_revised_Q)->queryAll();
        $contract_pay_list = Yii::$app->db->createCommand($contract_pay_Q)->queryAll();

        $contract['contract_sub'] = $contract_sub_list;
        $contract['contract_revised'] = $contract_revised_list;
        $contract['contract_payment'] = $contract_pay_list;

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

    public function actionContract_revised()
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
                    if (!isset($_REQUEST['referance']) && empty($_REQUEST['referance'])) {
                        Yii::$app->session->setFlash('toast', 'Unauthorized access.');
                        return $this->redirect(['contract/index']);
                    }
                    return $this->redirect(['contract/contractdetails', 'referance' => $_REQUEST['referance']]);
                } else {

                    // {"save_record":"save_record","id":"","contract_id":"1","status":"1",
                    //  "typeofwork_id":"1","revised_amount":"12000","revised_date":"2025-01-30",
                    //  "remarks":"Testing..."}
                    try {
                        $id = $data['id'];
                        $contract_id = $data['contract_id'];
                        $type = $data['typeofwork_id'];
                        $revised_amount = $data['revised_amount'];
                        $revised_date = $data['revised_date'];
                        $remarks = $data['remarks'];
                        $status = $data['status'];

                        // id, contract_id, type, revised_amount, revised_date, remarks, create_date, status

                        if ($id) {
                            Yii::$app->db->createCommand()->update('m_contract', [
                                'contract_id' => $contract_id,
                                'type' => $type,
                                'revised_amount' => $revised_amount,
                                'revised_date' => $revised_date,
                                'remarks' => $remarks,
                                'create_date' => date('Y-m-d'),
                                'status' => $status
                            ], ['id' => $id])->execute();
                        } else {
                            Yii::$app->db->createCommand()->insert('m_contract', [
                                'contract_id' => $contract_id,
                                'type' => $type,
                                'revised_amount' => $revised_amount,
                                'revised_date' => $revised_date,
                                'remarks' => $remarks,
                                'create_date' => date('Y-m-d'),
                                'status' => $status
                            ])->execute();
                        }
                        $transaction->commit();
                        Yii::$app->session->setFlash('toast', 'Record saved successfully!');
                        if (!isset($_REQUEST['referance']) && empty($_REQUEST['referance'])) {
                            Yii::$app->session->setFlash('toast', 'Unauthorized access.');
                            return $this->redirect(['contract/index']);
                        }
                        return $this->redirect(['contract/contractdetails', 'referance' => $_REQUEST['referance']]);
                    } catch (\Exception $e) {

                        $transaction->rollBack();
                        Yii::$app->session->setFlash('toast', 'Internal Exception: ' . $e->getMessage());
                        if (!isset($_REQUEST['referance']) && empty($_REQUEST['referance'])) {
                            Yii::$app->session->setFlash('toast', 'Unauthorized access.');
                            return $this->redirect(['contract/index']);
                        }
                        return $this->redirect(['contract/contractdetails', 'referance' => $_REQUEST['referance']]);
                    }
                }
            }
        }
        $contract_Q = 'SELECT cont.*, contr."company_name " as contractor_name, t.name AS type_name,ms.name AS scope_name,
                    r.name AS region_name,u.name AS unit_name,
                    rt.name AS route_name,d.name AS district_name
                    FROM public."m_contract" as cont
                    LEFT JOIN public."m_contractor" AS contr ON cont."contractor_id" = contr."id"
                    LEFT JOIN public."a_region" AS r ON cont."region_id" = r."ID"
                    LEFT JOIN public."m_scope" AS ms ON cont.scope = ms."id"
                    LEFT JOIN public."m_type" AS t ON cont.type_of_work = t."id"
                    LEFT JOIN public."u_unit" AS u ON cont.unit = u."ID"
                    LEFT JOIN public."a_route" AS rt ON cont.route_id = rt.id
                    LEFT JOIN public."a_district" AS d ON cont.district_id = d.id;';
        $contract_list = Yii::$app->db->createCommand($contract_Q)->queryAll();
        $type_list = Yii::$app->db->createCommand('SELECT * FROM public."m_type"')->queryAll();

        $contract_revised_list = Yii::$app->db->createCommand(
            'SELECT cr.*,cont."contract_no",contr."company_name " as company_name, t."name" as type_name  FROM public."m_contract_revised" cr
                    LEFT JOIN public."m_contract" cont ON cr."contract_id" = cont.id
                    LEFT JOIN public."m_contractor" AS contr ON cont."contractor_id" = contr."id"
                    LEFT JOIN public."m_type" AS t ON cont.type_of_work = t."id"
                    ORDER BY id ASC '
        )->queryAll();


        return $this->render('contract_revised', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'contract_revised_list' => $contract_revised_list,
            'contract_list' => $contract_list,
            'type_list' => $type_list

        ]);
    }

    public function actionContract_sub()
    {
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            // echo json_encode($data);
            // exit;

            if (isset($data['save_record'])) {

                $transaction = Yii::$app->db->beginTransaction();

                // {"save_record":"save_record","id":"","contact_id":"1","treatment_id":"1",
                //  "typeofwork_id":"1","km_from":"10","km_to":"20","location_from":"10",
                //  "location_to":"40","status":"1","direction":"1","length":"1","details":"1234rfdvsf"}

                if ($data['save_record'] == 'delete_record') {
                    $id = $data['id'];
                    Yii::$app->db->createCommand()->delete('m_contract_cub', ['id' => $id])->execute();
                    $transaction->commit();
                    Yii::$app->session->setFlash('toast', 'Record deleted successfully!');
                    if (!isset($_REQUEST['referance']) && empty($_REQUEST['referance'])) {
                        return $this->redirect(['contract/index']);
                    }
                    return $this->redirect(['contract/contractdetails', 'referance' => $_REQUEST['referance']]);
                } else {
                    try {
                        $id = $data['id'];
                        $contract_id = $data['contract_id'];
                        $km_from = $data['km_from'];
                        $km_to = $data['km_to'];
                        $direction = $data['direction'];
                        $type_of_work = $data['typeofwork_id'];
                        $treatment = $data['treatment_id'];
                        $lenght = $data['length'];
                        $location_from = $data['location_from'];
                        $location_to = $data['location_to'];
                        $disc = $data['details'];
                        $status = $data['status'];

                        // id, contract_id, km_from, "Km_to", direction,
                        // type_of_work, treatment,
                        // status, lenght, location_from, location_to, disc
                        if ($id) {

                            Yii::$app->db->createCommand()->update('m_contract_cub', [
                                "contract_id" => $contract_id,
                                'km_from' => $km_from,
                                'Km_to' => $km_to,
                                'direction' => $direction,
                                'type_of_work' => $type_of_work,
                                'treatment' => $treatment,
                                'lenght' => $lenght,
                                'location_from' => $location_from,
                                'location_to' => $location_to,
                                'disc' => $disc,
                                'status' => $status,
                            ], ['id' => $id])->execute();
                        } else {
                            Yii::$app->db->createCommand()->insert('m_contract_cub', [
                                "contract_id" => $contract_id,
                                'km_from' => $km_from,
                                'Km_to' => $km_to,
                                'direction' => $direction,
                                'type_of_work' => $type_of_work,
                                'treatment' => $treatment,
                                'lenght' => $lenght,
                                'location_from' => $location_from,
                                'location_to' => $location_to,
                                'disc' => $disc,
                                'status' => $status,
                            ])->execute();
                        }
                        $transaction->commit();
                        if (!isset($_REQUEST['referance']) && empty($_REQUEST['referance'])) {
                            Yii::$app->session->setFlash('toast', 'Unauthorized access.');
                            return $this->redirect(['contract/index']);
                        }
                        return $this->redirect(['contract/contractdetails', 'referance' => $_REQUEST['referance']]);
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        if (!isset($_REQUEST['referance']) && empty($_REQUEST['referance'])) {
                            Yii::$app->session->setFlash('toast', 'Unauthorized access.');
                            return $this->redirect(['contract/index']);
                        }
                        return $this->redirect(['contract/contractdetails', 'referance' => $_REQUEST['referance']]);
                    }
                }
            }
        }


        $type_list = Yii::$app->db->createCommand('SELECT * FROM public."m_type"')->queryAll();
        $treatment_list = Yii::$app->db->createCommand('	SELECT * FROM public."m_treatment" ORDER BY id ASC ')->queryAll();


        $contract_Q = 'SELECT cont.*, contr."company_name " as contractor_name, t.name AS type_name,ms.name AS scope_name,
                    r.name AS region_name,u.name AS unit_name,
                    rt.name AS route_name,d.name AS district_name
                    FROM public."m_contract" as cont
                    LEFT JOIN public."m_contractor" AS contr ON cont."contractor_id" = contr."id"
                    LEFT JOIN public."a_region" AS r ON cont."region_id" = r."ID"
                    LEFT JOIN public."m_scope" AS ms ON cont.scope = ms."id"
                    LEFT JOIN public."m_type" AS t ON cont.type_of_work = t."id"
                    LEFT JOIN public."u_unit" AS u ON cont.unit = u."ID"
                    LEFT JOIN public."a_route" AS rt ON cont.route_id = rt.id
                    LEFT JOIN public."a_district" AS d ON cont.district_id = d.id;';
        $contract_list = Yii::$app->db->createCommand($contract_Q)->queryAll();
        $contract_cub = 'SELECT cc.*, cont."contract_no", contr."company_name ",
                            t."name" as type_name, mt."name" as treatment_name
                            FROM public."m_contract_cub" cc
                            LEFT JOIN public."m_contract" cont ON cc."contract_id" = cont.id
                            LEFT JOIN public."m_contractor" AS contr ON cont."contractor_id" = contr."id"
                            LEFT JOIN public."m_type" AS t ON cc."type_of_work" = t."id"
                            LEFT JOIN public."m_treatment" AS mt ON cc."treatment" = mt."id"
                            ORDER BY id ASC ';
        $contract_cub_list = Yii::$app->db->createCommand($contract_cub)->queryAll();

        return $this->render('contract_cub', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'contract_cub_list' => $contract_cub_list,
            'contract_list' => $contract_list,
            'treatment_list' => $treatment_list,
            'type_list' => $type_list
        ]);
    }
    public function actionContract_payment()
    {
        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            // echo json_encode($data);
            // exit;

            if (isset($data['save_record'])) {

                $transaction = Yii::$app->db->beginTransaction();

                // {"save_record":"save_record","id":"","contract_id":"1","type_of_payment":"1",
                //  "dated":"2025-01-26","status":"1","voucher_no":"1001","amount":"2500",
                // "instrument_no":"12312","instrument_date":"2025-01-26"}

                if ($data['save_record'] == 'delete_record') {
                    $id = $data['id'];
                    Yii::$app->db->createCommand()->delete('m_contract_payments', ['id' => $id])->execute();
                    $transaction->commit();
                    Yii::$app->session->setFlash('toast', 'Record deleted successfully!');
                    if (!isset($_REQUEST['referance']) && empty($_REQUEST['referance'])) {
                        Yii::$app->session->setFlash('toast', 'Unauthorized access.');
                        return $this->redirect(['contract/index']);
                    }
                    return $this->redirect(['contract/contractdetails', 'referance' => $_REQUEST['referance']]);
                } else {
                    try {
                        $id = $data['id'];
                        $contract_id = $data['contract_id'];
                        $type_of_payment = $data['type_of_payment'];
                        $dated = $data['dated'];
                        $voucher_no = $data['voucher_no'];
                        $amount = $data['amount'];
                        $intrument_no = $data['instrument_no'];
                        $instrument_date = $data['instrument_date'];
                        $status = $data['status'];

                        // id, contract_id, type_of_payment, dated, voucher_no,
                        //  amount, intrument_no, instrument_date, status
                        if ($id) {

                            Yii::$app->db->createCommand()->update('m_contract_payments', [
                                "contract_id" => $contract_id,
                                'type_of_payment' => $type_of_payment,
                                'dated' => $dated,
                                'voucher_no' => $voucher_no,
                                'amount' => $amount,
                                'intrument_no' => $intrument_no,
                                'instrument_date' => $instrument_date,
                                'status' => $status,
                            ], ['id' => $id])->execute();
                        } else {
                            Yii::$app->db->createCommand()->insert('m_contract_payments', [
                                "contract_id" => $contract_id,
                                'type_of_payment' => $type_of_payment,
                                'dated' => $dated,
                                'voucher_no' => $voucher_no,
                                'amount' => $amount,
                                'intrument_no' => $intrument_no,
                                'instrument_date' => $instrument_date,
                                'status' => $status,
                            ])->execute();
                        }
                        $transaction->commit();
                        Yii::$app->session->setFlash('toast', 'Record saved successfully!');

                        if (!isset($_REQUEST['referance']) && empty($_REQUEST['referance'])) {
                            Yii::$app->session->setFlash('toast', 'Unauthorized access.');
                            return $this->redirect(['contract/index']);
                        }
                        return $this->redirect(['contract/contractdetails', 'referance' => $_REQUEST['referance']]);
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('toast', 'Internal Exception: ' . $e->getMessage());

                        if (!isset($_REQUEST['referance']) && empty($_REQUEST['referance'])) {
                            Yii::$app->session->setFlash('toast', 'Unauthorized access.');
                            return $this->redirect(['contract/index']);
                        }
                        return $this->redirect(['contract/contractdetails', 'referance' => $_REQUEST['referance']]);
                    }
                }
            }
        }

        $contract_Q = 'SELECT cont.*, contr."company_name " as contractor_name, t.name AS type_name,ms.name AS scope_name,
                    r.name AS region_name,u.name AS unit_name,
                    rt.name AS route_name,d.name AS district_name
                    FROM public."m_contract" as cont
                    LEFT JOIN public."m_contractor" AS contr ON cont."contractor_id" = contr."id"
                    LEFT JOIN public."a_region" AS r ON cont."region_id" = r."ID"
                    LEFT JOIN public."m_scope" AS ms ON cont.scope = ms."id"
                    LEFT JOIN public."m_type" AS t ON cont.type_of_work = t."id"
                    LEFT JOIN public."u_unit" AS u ON cont.unit = u."ID"
                    LEFT JOIN public."a_route" AS rt ON cont.route_id = rt.id
                    LEFT JOIN public."a_district" AS d ON cont.district_id = d.id;';
        $contract_list = Yii::$app->db->createCommand($contract_Q)->queryAll();
        $contract_pay = 'SELECT cp.*, cont."contract_no", contr."company_name "
                            FROM public."m_contract_payments" cp
                            LEFT JOIN public."m_contract" cont ON cp."contract_id" = cont.id
                            LEFT JOIN public."m_contractor" AS contr ON cont."contractor_id" = contr."id"
                            ORDER BY id ASC';
        $contract_pay_list = Yii::$app->db->createCommand($contract_pay)->queryAll();

        return $this->render('contract_payment', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'contract_pay_list' => $contract_pay_list,
            'contract_list' => $contract_list
        ]);
    }
}
