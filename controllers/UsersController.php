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

class UsersController extends Controller
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
        $actions = 'users/' . $action->id;
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
        $module_features = Yii::$app->Permissions->getModuleFeatures(31); // Asset Management Module id 23
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
    public function actionRoles()
    {

        $roles = Yii::$app->Component->Roles();


        return $this->render('roles', [
            'roles' => $roles,
        ]);
    }
    public function actionPermissions($id)
    {

        $role_id = Yii::$app->Component->CheckRole();

        if ($role_id != 1) {
            Yii::$app->session->setFlash('success', 'You do not have permissions');
            return $this->redirect(['site/index']);
        }

        $role = Yii::$app->db->createCommand("SELECT * FROM public.role_types WHERE role_id='" . $id . "'")->queryOne();
        if (empty($role)) {
            Yii::$app->session->setFlash('success', 'No Role found.');
            return $this->redirect(['users/index']);
        }
        $modules = Yii::$app->db->createCommand('SELECT * FROM modules')->queryAll();

        $moduleList = [];
        foreach ($modules as $module) {
            $submenus = [];
            $moduleFeatures = Yii::$app->db->createCommand("SELECT * FROM modules_features WHERE module_id = :module_id")
                ->bindValue(':module_id', $module['id'])->queryAll();

            foreach ($moduleFeatures as $feature) {

                $permissions = Yii::$app->db->createCommand("
                        SELECT * FROM permissions
                        WHERE module_id = :module_id
                        AND feature_id = :feature_id
                        AND role_id = :role_id")
                    ->bindValue(':module_id', $module['id'])
                    ->bindValue(':feature_id', $feature['id'])
                    ->bindValue(':role_id', $id)
                    ->queryOne();

                if ($permissions) {
                    $submenus[] = [
                        'feature_id' => $feature['id'],
                        'link' => '#',
                        'icon' => $module['icon'],
                        'active' => false,
                        'title' => $feature['name'],
                        'permission_id' => $permissions['id'],
                        'can_view' => (int) $permissions['can_view'],
                        'can_add' => (int) $permissions['can_add'],
                        'can_edit' => (int) $permissions['can_edit'],
                        'can_delete' => (int) $permissions['can_delete'],
                    ];
                }
            }

            if (!empty($submenus)) {
                $moduleList[] = [
                    'module_id' => $module['id'],
                    'title' => $module['name'],
                    'link' => '#',
                    'icon' => $module['icon'],
                    'is_active' => (int) $module['active'],
                    'active' => false,
                    'submenus' => $submenus,
                ];
            }
        }

        $returnList = [];
        if (empty($moduleList)) {
            Yii::$app->session->setFlash('success', 'No defaults Permissions set for this Role.');
            return $this->redirect(['users/index']);
        }

        $returnList['role_id'] = $id;
        $returnList['role_name'] = $role['role_name'];
        $returnList["modules"] = $moduleList;


        return $this->render('permissions', [
            'permissions' => $returnList,
        ]);
    }
    public function actionUpdate()
    {
        $name = $_POST["name"]; // active, add, view, update, delete
        $status = (int)$_POST["status"]; // 0 or 1
        if ($status === 1) {
            $status = 'true';
        } else {
            $status = 'false';
        }
        $id = (int)$_POST["id"]; // module ID or modules_features ID
        $type = (int)$_POST["type"]; // 1 for module, 2 for modules_features

        if ($type == 1) {
            // Direct SQL query for updating module status
            $sql = "UPDATE modules SET active = $status WHERE id = $id";
            Yii::$app->db->createCommand($sql)->execute();
            Yii::$app->session->setFlash('success', 'Module status updated.');
        } elseif ($type == 2) {
            // Direct SQL query for updating permission in permissions table
            $sql = "UPDATE permissions SET $name = $status WHERE id = $id";
            Yii::$app->db->createCommand($sql)->execute();
            Yii::$app->session->setFlash('success', 'Permission updated.');
        } else {
            Yii::$app->session->setFlash('error', 'Invalid update requested.');
        }

        return "TRUE";
    }


    public function actionUserslist()
    {


        $employeeQuery = "SELECT * FROM public.employee";
        $employees = Yii::$app->db->createCommand($employeeQuery)->queryAll();

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();

            if (isset($data['save_record'])) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($data['save_record'] == 'delete_record') {
                        $id = $data['id'];
                        Yii::$app->db->createCommand()->delete('employee', ['id' => $id])->execute();
                        $transaction->commit();
                        Yii::$app->session->setFlash('toast', 'Record deleted successfully!');
                        return $this->redirect(['users/userslist']);
                    } else {
                        $employeeData = [
                            'name' => $data['name'] ?? null,
                            'sodowo' => $data['sodowo'] ?? null,
                            'cnic' => $data['cnic'] ?? null,
                            'email' => $data['email'] ?? null,
                            'mobile' => $data['mobile'] ?? null,
                            'zip' => $data['zip'] ?? null,
                            'department' => $data['department'] ?? null,
                            'designation' => $data['designation'] ?? null,
                            'gender' => $data['gender'] ?? null,
                            'dob' => $data['dob'] ?? null,
                            'religion' => $data['religion'] ?? null,
                            'address' => $data['address'] ?? null,
                            'city' => $data['city'] ?? null,
                            'country' => $data['country'] ?? null,
                            'b_group' => $data['bloodgroup'] ?? null,
                            'username' => $data['username'] ?? null,
                            'password' => $data['password'] ?? null,
                            'user_level' => $data['user_level'] ?? 1,
                            'passport_no' => $data['passport'] ?? null,
                            'job_discription' => $data['discription'] ?? null,
                            'permenant_address' => $data['permenant_address'] ?? null,
                            'log_status' => $data['log_status'] ?? null,
                            'topadmin' => $data['type'] ?? null,
                            'status' => $data['status'] ?? null,
                            'eobi' => $data['eobi'] ?? null,
                            'social' => $data['social'] ?? null,
                            'usertype' => $data['type'] ?? null,
                            'salecenter' => $data['salecenter'] ?? null,
                            'emis_id' => $data['emis_id'] ?? null,
                            'resign' => $data['resign'] ?? null,
                            'resign_remarks' => $data['resign_remarks'] ?? null,
                            'resign_date' => $data['resign_date'] ?? null,
                            'resign_attachment' => $data['resign_attachment'] ?? null,
                            'cadre' => $data['cadre'] ?? null,
                            'scnic' => $data['scnic'] ?? null,
                            'doj' => $data['doj'] ?? null,
                            'emp_code' => $data['emp_code'] ?? null,
                            'emg_no1' => $data['emg_no1'] ?? null,
                            'emg_no2' => $data['emg_no2'] ?? null,
                            'm_status' => $data['merital_status'] ?? null,
                            'nok_name' => $data['nok_name'] ?? null,
                            'nok_relation' => $data['nok_relation'] ?? null,
                            'nok_phone' => $data['nok_phone'] ?? null,
                            'service_no' => $data['service_no'] ?? null,
                            'prob_start' => $data['prob_start'] ?? null,
                            'prob_end' => $data['prob_end'] ?? null,
                            'expiry_of_contract' => $data['expiry_of_contract'] ?? null,
                            'bank_name' => $data['bank_name'] ?? null,
                            'account_title' => $data['account_title'] ?? null,
                            'account_number' => $data['account_number'] ?? null,
                            'branch' => $data['branch'] ?? null,
                            'whatsapp_no' => $data['whatsapp_no'] ?? null,
                            'desk_id' => $data['desk_id'] ?? null,
                            'create_date' => date('Y-m-d H:i:s'),
                        ];

                        if (!empty($data['id'])) {
                            Yii::$app->db->createCommand()->update('employee', $employeeData, ['id' => $data['id']])->execute();
                        } else {
                            Yii::$app->db->createCommand()->insert('employee', $employeeData)->execute();
                        }

                        $transaction->commit();
                        Yii::$app->session->setFlash('toast', 'Record saved successfully!');
                        return $this->redirect(['users/userslist']);
                    }
                } catch (\Exception $e) {
                    echo 'Internal Exception: ' . $e->getMessage();
                    exit;
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('toast', 'Internal Exception: ' . $e->getMessage());
                    return $this->redirect(['users/userslist']);
                }
            }
        }

        $roles = Yii::$app->db->createCommand("SELECT role_id, role_name, is_active FROM public.role_types;")->queryAll();


        return $this->render('user_list', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'employees' => $employees,
            'roles' => $roles,
        ]);
    }
}
