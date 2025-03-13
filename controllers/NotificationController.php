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
        $contract_Q = 'SELECT cont.*, contr."company_name" as contractor_name,ms.name AS scope_name
                    FROM public."m_contract" as cont
                    LEFT JOIN public."m_contractor" AS contr ON cont."contractor_id" = contr."id"
                    LEFT JOIN public."a_region" AS r ON cont."region_id" = r."ID"
                    LEFT JOIN public."m_scope" AS ms ON cont.scope = ms."id"
                    WHERE cont.status=0 OR cont.status=4
                    ';
        $contract_list = Yii::$app->db->createCommand($contract_Q)->queryAll();
        $totalCount = count($contract_list);
        $pages = new Pagination(['totalCount' => $totalCount]);
        $pages->setPageSize(10);
        $contract_list = array_slice($contract_list, $pages->offset, $pages->limit);


        return $this->render('contractnotifications', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'contract_list' => $contract_list,
            'pages' => $pages,

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
        ]);
    }
    public function actionProgressnotifications()
    {

        $user_level = Yii::$app->session->get('user_array')['user_level'];
        $progress_status = '';
        switch ($user_level) {
            case 1: // "1"  "Admin Role"    "Admin"
                $progress_status = ''; //Show ALL
                break;
            case 2: // "2"  "RO Role"	    "RO"
                $progress_status = ' AND (cp.status = 2 OR cp.status = -2 OR cp.status = -3)';
                break;
            case 3: // "3"  "ZONE Role"	    "ZONE"
                $progress_status = ' AND (cp.status = 3 OR cp.status = -3 OR cp.status = -4)';
                break;
            case 4: // "4"  "RAMD Role"	    "RAMD"
                $progress_status = ' AND (cp.status = 4 OR cp.status = -4 OR cp.status = -5)';
                break;
            case 5: // "5"  "HO Role"	    "HO"
                $progress_status = ' AND (cp.status = 5 OR cp.status = -5 OR cp.status = -6)';
                break;
            default:
                $progress_status = '';
                break;
        }

        $countQuery = 'SELECT COUNT(*) 
                FROM public."m_contract" as cont
                LEFT JOIN public."m_contract_progress" AS cp ON cont.id = cp.contract_id
                WHERE cont.status = 1 AND cp.id > 0 ' . $progress_status;

        $totalCount = Yii::$app->db->createCommand($countQuery)->queryScalar();

        $pages = new Pagination(['totalCount' => $totalCount]);
        $pages->setPageSize(10);

        $contract_Q = 'SELECT cont.*, contr."company_name" as contractor_name,
                    cp.id as progress_id, cp.task, cp.details,
                    cp.progress, cp.start_date, cp.end_date, cp.status as progress_status,
                    cp.submission_date, emp.name as submitted_by
                FROM public."m_contract" as cont
                LEFT JOIN public."m_contractor" AS contr ON cont."contractor_id" = contr."id"
                LEFT JOIN public."m_contract_progress" AS cp ON cont.id = cp.contract_id
                LEFT JOIN public.employee AS emp ON emp.id = cp.submitted_by
                WHERE cont.status = 1 AND cp.id > 0 ' . $progress_status . '
                ORDER BY cont.id ASC
                LIMIT ' . $pages->limit . ' OFFSET ' . $pages->offset;

        $contract_list = Yii::$app->db->createCommand($contract_Q)->queryAll();


        return $this->render('progressnotifications', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'contract_list' => $contract_list,
            'pages' => $pages,

        ]);
    }
    public function actionProgressdetails()
    {
        if (!isset($_REQUEST['referance']) && empty($_REQUEST['referance'])) {
            Yii::$app->session->setFlash('toast', 'Unauthorized access.');
            return $this->redirect(['contract/index']);
        }

        $ref = $_REQUEST['referance'];

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            // echo json_encode($data);
            // exit;

            //{"progress_id":"2","status":"3","save_record":"save_record"}
            if (isset($data['save_record'])) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if (isset($data['progress_id']) && !empty($data['progress_id'])) {
                        if (isset($data['status']) && !empty($data['status'])) {
                            $id = $data['progress_id'];
                            $status = $data['status'];
                            Yii::$app->db->createCommand()->update('m_contract_progress', [
                                'status' => $status
                            ], ['id' => $id])->execute();
                            $transaction->commit();
                            Yii::$app->session->setFlash('toast', 'Record saved successfully!');
                            return $this->redirect(['notification/progressnotifications']);
                        }
                        if (!isset($_REQUEST['referance']) && empty($_REQUEST['referance'])) {
                            Yii::$app->session->setFlash('toast', 'Unauthorized access.');
                            return $this->redirect(['notification/progressnotifications']);
                        }
                        return $this->redirect(['notification/progressdetails', 'referance' => $_REQUEST['referance']]);
                    }
                    if (!isset($_REQUEST['referance']) && empty($_REQUEST['referance'])) {
                        Yii::$app->session->setFlash('toast', 'Unauthorized access.');
                        return $this->redirect(['notification/progressnotifications']);
                    }
                    return $this->redirect(['notification/progressdetails', 'referance' => $_REQUEST['referance']]);
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('toast', 'Internal Exception: ' . $e->getMessage());
                    if (!isset($_REQUEST['referance']) && empty($_REQUEST['referance'])) {
                        Yii::$app->session->setFlash('toast', 'Unauthorized access.');
                        return $this->redirect(['notification/progressnotifications']);
                    }
                    return $this->redirect(['notification/progressdetails', 'referance' => $_REQUEST['referance']]);
                }
            }
        }


        $progress_Q = 'SELECT cont.*, contr."company_name" as contractor_name,
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
                    WHERE cont.status=1  AND cp.id = ' . $ref . '
                    ORDER BY cont.id ASC';
        $progress = Yii::$app->db->createCommand($progress_Q)->queryOne();

        return $this->render('progressdetails', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'progress' => $progress,
        ]);
    }

    public function actionDemandnotifications()
    {

        $user_level = Yii::$app->session->get('user_array')['user_level'];
        $progress_status = '';
        switch ($user_level) {
            case 1: // "1"  "Admin Role"    "Admin"
                $progress_status = ''; //Show ALL
                break;
            case 2: // "2"  "RO Role"	    "RO"
                $progress_status = ' AND (cp.status = 2 OR cp.status = -2 OR cp.status = -3)';
                break;
            case 3: // "3"  "ZONE Role"	    "ZONE"
                $progress_status = ' AND (cp.status = 3 OR cp.status = -3 OR cp.status = -4)';
                break;
            case 4: // "4"  "RAMD Role"	    "RAMD"
                $progress_status = ' AND (cp.status = 4 OR cp.status = -4 OR cp.status = -5)';
                break;
            case 5: // "5"  "HO Role"	    "HO"
                $progress_status = ' AND (cp.status = 5 OR cp.status = -5 OR cp.status = -6)';
                break;
            default:
                $progress_status = '';
                break;
        }

        $countQuery = 'SELECT COUNT(*) 
                FROM public."m_contract_progress" as cont
                LEFT JOIN public."demand_of_bill" AS cp ON cont.id = cp.progress_id
                WHERE cont.status = 1 AND cp.id > 0 ' . $progress_status;

        $totalCount = Yii::$app->db->createCommand($countQuery)->queryScalar();

        $pages = new Pagination(['totalCount' => $totalCount]);
        $pages->setPageSize(10);
        $contract_Q = ' SELECT 
                    demB.id AS demand_id, 
                    demB.bill_amount, 
                    demB.comments, 
                    demB.date AS demand_date,
                    demB.file_path, 
                    demB.status AS demand_status, 
                    demB.title AS demand_title,
                    emp.name as submitted_by
                FROM public."m_contract_progress" as ascp
                LEFT JOIN public."demand_of_bill" AS demB ON demB.progress_id = ascp.id
                LEFT JOIN public.employee AS emp ON emp.id = ascp.submitted_by
                WHERE demB.status = 1 AND ascp.id > 0 ' . $progress_status . '
                ORDER BY demB.id ASC
                LIMIT ' . $pages->limit . ' OFFSET ' . $pages->offset;

        $demand_list = Yii::$app->db->createCommand($contract_Q)->queryAll();


        return $this->render('demandnotifications', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'demand_list' => $demand_list,
            'pages' => $pages,

        ]);
    }
    public function actionDemanddetails()
    {
        if (!isset($_REQUEST['referance']) && empty($_REQUEST['referance'])) {
            Yii::$app->session->setFlash('toast', 'Unauthorized access.');
            return $this->redirect(['notification/demandnotifications']);
        }

        $ref = $_REQUEST['referance'];

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            // echo json_encode($data);
            // exit;

            //{"progress_id":"2","status":"3","save_record":"save_record"}
            if (isset($data['save_record'])) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if (isset($data['demand_id']) && !empty($data['demand_id'])) {
                        if (isset($data['status']) && !empty($data['status'])) {
                            $id = $data['demand_id'];
                            $status = $data['status'];
                            Yii::$app->db->createCommand()->update('demand_of_bill', [
                                'status' => $status
                            ], ['id' => $id])->execute();
                            $transaction->commit();
                            Yii::$app->session->setFlash('toast', 'Record saved successfully!');
                            return $this->redirect(['notification/demandnotifications']);
                        }
                        if (!isset($_REQUEST['referance']) && empty($_REQUEST['referance'])) {
                            Yii::$app->session->setFlash('toast', 'Unauthorized access.');
                            return $this->redirect(['notification/demandnotifications']);
                        }
                        return $this->redirect(['notification/demanddetails', 'referance' => $_REQUEST['referance']]);
                    }
                    if (!isset($_REQUEST['referance']) && empty($_REQUEST['referance'])) {
                        Yii::$app->session->setFlash('toast', 'Unauthorized access.');
                        return $this->redirect(['notification/demandnotifications']);
                    }
                    return $this->redirect(['notification/demanddetails', 'referance' => $_REQUEST['referance']]);
                } catch (\Exception $e) {
                    echo 'Internal Exception: ' . $e->getMessage();
                    exit;
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('toast', 'Internal Exception: ' . $e->getMessage());
                    if (!isset($_REQUEST['referance']) && empty($_REQUEST['referance'])) {
                        Yii::$app->session->setFlash('toast', 'Unauthorized access.');
                        return $this->redirect(['notification/demandnotifications']);
                    }
                    return $this->redirect(['notification/demanddetails', 'referance' => $_REQUEST['referance']]);
                }
            }
        }


        $Q = 'SELECT cont.*, contr."company_name" as contractor_name, t.name AS type_name,ms.name AS scope_name,
                    r.name AS region_name,u.name AS unit_name,
                    rt.name AS route_name,d.name AS district_name,
                    cp.id as progress_id, cp.task,cp.details,
                    cp.progress, cp.start_date, cp.end_date, cp.status as progress_status, cp.submission_date,
                    demB.id as demand_id, demB.bill_amount, demB.comments, demB.date as demand_date,
                    demB.file_path, demB.status as demand_status, demB.title as demand_title, demB.comments,
                    emp.name as submitted_by
                    FROM public."m_contract" as cont
                    LEFT JOIN public."m_contractor" AS contr ON cont."contractor_id" = contr."id"
                    LEFT JOIN public."a_region" AS r ON cont."region_id" = r."ID"
                    LEFT JOIN public."m_scope" AS ms ON cont.scope = ms."id"
                    LEFT JOIN public."m_type" AS t ON cont.type_of_work = t."id"
                    LEFT JOIN public."u_unit" AS u ON cont.unit = u."ID"
                    LEFT JOIN public."a_route" AS rt ON cont.route_id = rt.id
                    LEFT JOIN public."a_district" AS d ON cont.district_id = d.id
                    LEFT JOIN public."m_contract_progress" AS cp ON cont.id = cp.contract_id
                    LEFT JOIN public."demand_of_bill" as demB ON cp.id = demB.progress_id
                    LEFT JOIN public.employee AS emp ON emp.id = demB.submitted_by
                    WHERE cp.id = ' . $ref . ' ORDER BY cp.status ASC';
        $demand = Yii::$app->db->createCommand($Q)->queryOne();

        return $this->render('demanddetails', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'demand' => $demand,
        ]);
    }
}