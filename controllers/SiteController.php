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

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
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


    public function actionIndex()
    {

        // echo "OK";
        // exit;
        // $user_ip = getenv('REMOTE_ADDR');
        // $geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip"));
        // $lat = $geo["geoplugin_latitude"];
        // $long = $geo["geoplugin_longitude"];
        // $ip = $geo["geoplugin_request"];

        /*        if (!\Yii::$app->user->isGuest) {
          return $this->goHome();
          }
         */
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $sql = "select * from employee where id = " . Yii::$app->user->id;
            $connection = Yii::$app->getDb();

            $cmdrow = $connection->createCommand($sql);
            $rows = $cmdrow->queryOne();


            $session = Yii::$app->session;
            // open a session
            $session->open();
            $_SESSION["user_array"] = $rows;
            $session->close();
            return $this->render('index', [
                'model' => $model,
            ]);
        }
        if (Yii::$app->user->id != null) {
            return $this->render('index', [
                'model' => $model,
            ]);
        }

        unset(Yii::$app->session['user_array']);

        $this->layout = false;

        return $this->render('login', [
            'model' => $model,
        ]);
        //        return $this->render('index');
    }
    public function actionAmp()
    {
        return $this->render('amp');
    }
    public function actionIndexpart()
    {
        $this->layout = false;
        return $this->render('indexpart');
    }
    public function actionAsset()
    {
        return $this->render('asset');
    }
    public function actionAssetpart()
    {
        $this->layout = false;
        return $this->render('assetpart');
    }
    public function actionAmppart()
    {
        $this->layout = false;
        return $this->render('amppart');
    }
    public function actionRegion($id)
    {
        $region_list = Yii::$app->db->createCommand('SELECT * FROM public."a_region" where zone_id=' . $id . '')->queryAll();
        foreach ($region_list as $str) {
            $region[] = $str;
        }
        echo json_encode($region);
    }
    public function actionUnit($id)
    {
        $region = array();
        $region_list = Yii::$app->db->createCommand('SELECT * FROM public."u_unit" where region_id=' . $id . '')->queryAll();
        foreach ($region_list as $str) {
            $region[] = $str;
        }
        echo json_encode($region);
    }
    public function actionDistrict($id)
    {
        $region = array();
        $region_list = Yii::$app->db->createCommand('SELECT * FROM public."a_district" where province_id=' . $id . '')->queryAll();
        foreach ($region_list as $str) {
            $region[] = $str;
        }
        echo json_encode($region);
    }

    public function actionIndex11()
    {

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user = Yii::$app->user->identity;

            $sql = "select * from employee where id = " . Yii::$app->user->id;


            $connection = Yii::$app->getDb();

            $cmdrow = $connection->createCommand($sql);
            $rows = $cmdrow->queryOne();

            $sql1 = "select * from userpermission where userid = " . Yii::$app->user->id;
            $cmdrow1 = $connection->createCommand($sql1);
            $rows1 = $cmdrow1->queryAll();

            $sql11 = "select * from role_module_permission where role_id = " . $rows['user_level'];
            $cmdrow11 = $connection->createCommand($sql11);
            $rows11 = $cmdrow11->queryAll();

            // $sql12 = "select * from project_permissions where user_id = " . Yii::$app->user->id;
            // $cmdrow12 = $connection->createCommand($sql12);
            // $rows12 = $cmdrow12->queryAll();

            $session = Yii::$app->session;
            $session->open();


            $session["user_array"] = $rows;
            $session["user_perm_array"] = $rows11;
            $session["user_per_array"] = $rows1;
            // $session["user_pro_array"] = $rows12;

            return $this->redirect(['site/index']);
        }


        if (Yii::$app->session->has('user_array') && Yii::$app->user->id != null) {
            return $this->render('index');
        }
        $this->layout = false;
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLinks()
    {
        $role_id = Yii::$app->session->get('user_array')['id'];
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


                if ($permissions && $permissions['can_view'] == '1') {
                    $submenus[] = [
                        'id' => $feature['id'],
                        'link' => $feature['link'],
                        'icon' => $module['icon'],
                        'active' => false,
                        'title' => $feature['name'],
                        'can_view' => $permissions['can_view'],
                        'can_add' => $permissions['can_add'],
                        'can_edit' => $permissions['can_edit'],
                        'can_delete' => $permissions['can_delete'],
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
        return $this->render('links', [
            'modules' => $moduleList
        ]);
    }

    public function actionSignout()
    {
        Yii::$app->user->logout();
        Yii::$app->session->remove('user_array');
        return $this->redirect(['site/index']);
    }


    public function actionLogout1()
    {

        Yii::$app->session->remove('user_array');
        Yii::$app->user->logout();
        Yii::$app->session->destroy();
        Yii::$app->user->identity = null;
        Yii::$app->response->cookies->remove(Yii::$app->user->identityCookie['name']);
        return $this->redirect(['site/index']);
    }

    public function actionLogin()
    {
        $this->layout = false;
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['site/index']);
        }

        $model->password = '';
        $this->layout = false;
        return $this->render('login', [
            'model' => $model,
        ]);
    }
}
