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

class ConfigController extends Controller
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


    public function actionIndex($id)
    {
        $module_features = Yii::$app->Permissions->getMenus($id);
        if (empty($module_features)) {
            $module_info = [];
            $feature_items = [];
        } else {
            $module_info = [];
            foreach ($module_features as $module) {
                $module_info[] = [
                    'module_id' => $module['module_id'],
                    'title' => $module['title'],
                    'link' => $module['link'],
                    'icon' => $module['icon'],
                    'is_active' => $module['is_active'],
                ];
                $feature_items = [];
                foreach ($module['submenus'] as $submenu) {
                    $feature_items[] = [
                        'id' => $submenu['id'],
                        'link' => $submenu['link'],
                        'title' => $submenu['title'],
                        'icon' => $submenu['icon'],
                        'can_view' => $submenu['can_view'],
                        'can_add' => $submenu['can_add'],
                        'can_edit' => $submenu['can_edit'],
                        'can_delete' => $submenu['can_delete'],
                    ];
                }
            }
        }

        // Return the data to the view
        return $this->render('index', [
            'module_info' => $module_info,
            'features_info' => $feature_items,
        ]);
    }

    public function actionTehsil()
    {

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();
            // echo json_encode($data);
            // exit;

            if (isset($data['save_record'])) {

                $transaction = Yii::$app->db->beginTransaction();

                // {"save_record":"save_record","id":"","title":"Murree","district_id":"2","code":"MURREE","status":"1","details":"Murree "}
                if ($data['save_record'] == 'delete_record') {
                    $id = $data['id'];
                    Yii::$app->db->createCommand()->delete('a_tehsil', ['id' => $id])->execute();
                    $transaction->commit();
                    Yii::$app->session->setFlash('toast', 'Record deleted successfully!');
                    return $this->redirect(['config/tehsil']);
                } else {
                    try {
                        $id = $data['id'];
                        $title = $data['title'];
                        $province_id = $data['district_id'];
                        $details = $data['details'];
                        $code = $data['code'];
                        $status = $data['status'];

                        if ($id) {
                            Yii::$app->db->createCommand()->update('a_tehsil', [
                                'district_id' => $province_id,
                                'name' => $title,
                                'code' => $code,
                                'details' => $details,
                                'status' => $status,
                            ], ['id' => $id])->execute();
                        } else {
                            Yii::$app->db->createCommand()->insert('a_tehsil', [
                                'district_id' => $province_id,
                                'name' => $title,
                                'code' => $code,
                                'details' => $details,
                                'status' => $status,
                            ])->execute();
                        }
                        $transaction->commit();
                        Yii::$app->session->setFlash('toast', 'Record saved successfully!');
                        return $this->redirect(['config/tehsil']);
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('toast', 'Internal Exception: ' . $e->getMessage());
                        return $this->redirect(['config/tehsil']);
                    }
                }
            }
        }

        $tehsil_list = Yii::$app->db->createCommand(
            'SELECT at.*, ad.name AS district_name
                    FROM public."a_tehsil" AS at
                    LEFT JOIN public."a_district" AS ad ON ad.id = at."district_id";'
        )->queryAll();

        $district_list = Yii::$app->db->createCommand('SELECT * FROM public."a_district"')->queryAll();



        return $this->render('tehsil', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'tehsil_list' => $tehsil_list,
            'district_list' => $district_list
        ]);
    }

    public function actionScope()
    {

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();


            if (isset($data['save_record'])) {

                $transaction = Yii::$app->db->beginTransaction();

                // {"save_record":"save_record","id":"","title":"Scope111","code":"SC1","details":"OKOK"}
                if ($data['save_record'] == 'delete_record') {
                    $id = $data['id'];
                    Yii::$app->db->createCommand()->delete('m_scope', ['id' => $id])->execute();
                    $transaction->commit();
                    Yii::$app->session->setFlash('toast', 'Record deleted successfully!');
                    return $this->redirect(['config/scope']);
                } else {
                    try {
                        $id = $data['id'];
                        $title = $data['title'];
                        $code = $data['code'];
                        $details = $data['details'];
                        if ($id) {
                            Yii::$app->db->createCommand()->update('m_scope', [
                                'name' => $title,
                                'code' => $code,
                                'details' => $details,
                            ], ['id' => $id])->execute();
                        } else {
                            Yii::$app->db->createCommand()->insert('m_scope', [
                                'name' => $title,
                                'code' => $code,
                                'details' => $details,
                            ])->execute();
                        }
                        $transaction->commit();
                        Yii::$app->session->setFlash('toast', 'Record saved successfully!');
                        return $this->redirect(['config/scope']);
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('toast', 'Internal Exception: ' . $e->getMessage());
                        return $this->redirect(['config/scope']);
                    }
                }
            }
        }

        $scope_list = Yii::$app->db->createCommand('SELECT * FROM public."m_scope"')->queryAll();



        return $this->render('scope', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'scope_list' => $scope_list
        ]);
    }

    public function actionType()
    {

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();


            if (isset($data['save_record'])) {

                $transaction = Yii::$app->db->beginTransaction();

                // {"save_record":"save_record","id":"","title":"Scope111","code":"SC1","details":"OKOK"}
                if ($data['save_record'] == 'delete_record') {
                    $id = $data['id'];
                    Yii::$app->db->createCommand()->delete('m_type', ['id' => $id])->execute();
                    $transaction->commit();
                    Yii::$app->session->setFlash('toast', 'Record deleted successfully!');
                    return $this->redirect(['config/type']);
                } else {
                    try {
                        $id = $data['id'];
                        $title = $data['title'];
                        $code = $data['code'];
                        $details = $data['details'];
                        if ($id) {
                            Yii::$app->db->createCommand()->update('m_type', [
                                'name' => $title,
                                'code' => $code,
                                'details' => $details,
                            ], ['id' => $id])->execute();
                        } else {
                            Yii::$app->db->createCommand()->insert('m_type', [
                                'name' => $title,
                                'code' => $code,
                                'details' => $details,
                            ])->execute();
                        }
                        $transaction->commit();
                        Yii::$app->session->setFlash('toast', 'Record saved successfully!');
                        return $this->redirect(['config/type']);
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('toast', 'Internal Exception: ' . $e->getMessage());
                        return $this->redirect(['config/type']);
                    }
                }
            }
        }

        $type_list = Yii::$app->db->createCommand('SELECT * FROM public."m_type"')->queryAll();



        return $this->render('type', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'type_list' => $type_list
        ]);
    }

    public function actionTreatment()
    {

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();


            if (isset($data['save_record'])) {

                $transaction = Yii::$app->db->beginTransaction();

                // {"save_record":"save_record","id":"","title":"Scope111","code":"SC1","details":"OKOK"}
                if ($data['save_record'] == 'delete_record') {
                    $id = $data['id'];
                    Yii::$app->db->createCommand()->delete('m_treatment', ['id' => $id])->execute();
                    $transaction->commit();
                    Yii::$app->session->setFlash('toast', 'Record deleted successfully!');
                    return $this->redirect(['config/treatment']);
                } else {
                    try {
                        $id = $data['id'];
                        $title = $data['title'];
                        $code = $data['code'];
                        $details = $data['details'];
                        if ($id) {
                            Yii::$app->db->createCommand()->update('m_treatment', [
                                'name' => $title,
                                'code' => $code,
                                'details' => $details,
                            ], ['id' => $id])->execute();
                        } else {
                            Yii::$app->db->createCommand()->insert('m_treatment', [
                                'name' => $title,
                                'code' => $code,
                                'details' => $details,
                            ])->execute();
                        }
                        $transaction->commit();
                        Yii::$app->session->setFlash('toast', 'Record saved successfully!');
                        return $this->redirect(['config/treatment']);
                    } catch (\Exception $e) {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('toast', 'Internal Exception: ' . $e->getMessage());
                        return $this->redirect(['config/treatment']);
                    }
                }
            }
        }

        $treatment_list = Yii::$app->db->createCommand(
            '	SELECT * FROM public."m_treatment"
	ORDER BY id ASC '
        )->queryAll();



        return $this->render('treatment', [
            'can' => [
                'can_add'    => 1,
                'can_view'   => 1,
                'can_edit'   => 1,
                'can_delete' => 1,
            ],
            'treatment_list' => $treatment_list
        ]);
    }
}