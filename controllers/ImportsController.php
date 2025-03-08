<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportsController extends Controller
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
        $actions = 'imports/' . $action->id;
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


    public function actionImportconditiondata()
    {
        if (Yii::$app->request->isPost) {
            $file = UploadedFile::getInstanceByName('fileUpload');
            if ($file) {
                try {
                    $spreadsheet = IOFactory::load($file->tempName);
                    $sheet = $spreadsheet->getActiveSheet();
                    $data = [];
                    foreach ($sheet->getRowIterator() as $row) {
                        $rowData = [];
                        $add = false;
                        foreach ($row->getCellIterator() as $cell) {
                            $value = $cell->getCalculatedValue();
                            if ($value != null) {
                                $add = true;
                            }
                            $rowData[] = $value;
                        }
                        if ($add)
                            $data[] = $rowData;
                    }
                    Yii::$app->db->createCommand("TRUNCATE TABLE pavement_condition_survey")->execute();
                    // Now, insert each row into the 'pavement_condition_survey' table
                    foreach ($data as $row) {
                        $dateString = $row[32];
                        // $dateString = '15/07/2021';
                        $dateParts = explode('/', $dateString);
                        if (count($dateParts) == 3) {
                            $formattedDate = $dateParts[2] . '-' . $dateParts[1] . '-' . $dateParts[0];
                        } else {
                            $formattedDate = '2021-07-15';
                        }

                        Yii::$app->db->createCommand()->insert('pavement_condition_survey', [
                            'route' => $row[0],
                            'direction' => $row[1],
                            'km' => $row[2],
                            'surface' => $row[3],
                            'road_width' => $row[4],
                            'shoulder_width_left' => $row[5],
                            'shoulder_width_right' => $row[6],
                            'rutting_severity' => $row[7],
                            'rutting_extent' => $row[8],
                            'rutting_index' => $row[9],
                            'cracking_structural_severity' => $row[10],
                            'cracking_structural_extent' => $row[11],
                            'cracking_structural_index' => $row[12],
                            'cracking_thermal_severity' => $row[13],
                            'cracking_thermal_extent' => $row[14],
                            'cracking_thermal_index' => $row[15],
                            'potholes_severity' => $row[16],
                            'potholes_extent' => $row[17],
                            'potholes_index' => $row[18],
                            'patching_severity' => $row[19],
                            'patching_extent' => $row[20],
                            'patching_index' => $row[21],
                            'ravelling_severity' => $row[22],
                            'ravelling_extent' => $row[23],
                            'ravelling_index' => $row[24],
                            'edge_erosion_severity' => $row[25],
                            'edge_erosion_extent' => $row[26],
                            'edge_erosion_index' => $row[27],
                            'drainage_severity' => $row[28],
                            'drainage_extent' => $row[29],
                            'drainage_index' => $row[30],
                            'remarks' => $row[31],
                            'date' => $formattedDate
                        ])->execute();
                    }
                    Yii::$app->session->setFlash('success', 'Data successfully imported!');
                    return $this->redirect(['importconditiondata']);
                } catch (\Exception $e) {
                    echo 'Error processing file: ' . $e->getMessage();
                    exit;
                }
            } else {
                echo 'No file uploaded!';
                exit;
            }
        }
        $pavement_condition_survey = Yii::$app->db->createCommand(
            "SELECT id, route, direction, km, surface,
                    road_width, shoulder_width_left, shoulder_width_right,
                    rutting_severity, rutting_extent, rutting_index,
                    cracking_structural_severity, cracking_structural_extent,
                    cracking_structural_index, cracking_thermal_severity,
                    cracking_thermal_extent, cracking_thermal_index, potholes_severity,
                    potholes_extent, potholes_index, patching_severity, patching_extent,
                    patching_index, ravelling_severity, ravelling_extent, ravelling_index,
                    edge_erosion_severity, edge_erosion_extent, edge_erosion_index,
                    drainage_severity, drainage_extent, drainage_index, remarks, date
                    FROM public.pavement_condition_survey;"
        )->queryAll();
        return $this->render('importconditiondata', ['pavement_condition_survey' => $pavement_condition_survey]);
    }
}
