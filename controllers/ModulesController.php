<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\db\Exception;

class ModulesController extends Controller
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
    public function beforeAction($action)
    {
        if (Yii::$app->session->has('user_array') == NULL)
            $this->redirect(['site/index']);
        else {
            $this->enableCsrfValidation = false;
            return parent::beforeAction($action);
        }
    }
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
    public function actionIndex()
    {
        $role_id = Yii::$app->session->get('user_array')['id'];
        $role = Yii::$app->db->createCommand("SELECT * FROM `roles` WHERE id='" . $role_id . "'")->queryOne();
        if (empty($role)) {
            Yii::$app->session->setFlash('success', 'No Role found.');
            return $this->redirect(['config/']);
        }

        $modules = Yii::$app->db->createCommand("SELECT * FROM modules WHERE 1=1 ")->queryAll();

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
                    ->bindValue(':role_id', $role_id)
                    ->queryOne();

                if ($permissions && $permissions['can_view']) {
                    $submenus[] = [
                        'feature_id' => $feature['id'],
                        'link' => $feature['link'] ?? '#',
                        'icon' => $module['icon'],
                        'active' => false,
                        'title' => $feature['name'],
                        'permission_id' => $permissions['id'],
                        'can_view' => (int) $permissions['can_view'],
                        'can_add' => (int) $permissions['can_add'],
                        'can_edit' => (int)$permissions['can_edit'],
                        'can_delete' => (int)$permissions['can_delete'],
                    ];
                }
            }

            if (!empty($submenus)) {
                $moduleList[] = [
                    'module_id' => $module['id'],
                    'title' => $module['name'],
                    'is_active' => $module['active'],
                    'link' => '#',
                    'icon' => $module['icon'],
                    'active' => false,
                    'submenus' => $submenus,
                ];
            }
        }
        $returnList = [];
        if (empty($moduleList)) {
            Yii::$app->session->setFlash('success', 'You don\'t have any permissions');
            return $this->render('index', [
                'permissions' => $returnList,
            ]);
        }

        // $returnList['role_id'] = $id;
        // $returnList['role_name'] = $role['name'];
        $returnList["modules"] = $moduleList;


        return $this->render('index', [
            'permissions' => $returnList,
        ]);
    }
    public function actionRoles()
    {

        $roles = Yii::$app->Component->Roles();


        return $this->render('roles', [
            'roles' => $roles,
        ]);
    }

    public function actionUpdatepermission()
    {
        $role_id = Yii::$app->Component->CheckRole();

        if ($role_id != 1) {
            Yii::$app->session->setFlash('success', 'You do not have permissions for this action');
            return $this->redirect(['site/index']);
        }
        $name = $_POST["type"]; // active, add, view, update, delete
        $status = (int)$_POST["status"]; // 0 or 1
        $id = (int)$_POST["setting_id"]; // setting_id ID
        $role_id = (int)$_POST["role_id"]; // setting_id ID

        echo    $sql = "UPDATE `setting_permissions` SET  $name = $status WHERE `id` = $id";
        Yii::$app->db->createCommand($sql)->execute();
        return;
        // Yii::$app->session->setFlash('success', 'Permission updated.');
        // return $this->redirect(['modules/permissions', 'type' => 'settings', 'id' => $role_id]);
    }
}
