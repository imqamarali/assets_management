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
            Yii::$app->session->setFlash('error', 'Unauthorized access... Please contact support team.');
            $this->redirect(['site/index']);
        }
    }
    public function actionConditiondata()
    {
        $conn = Yii::$app->db;
        if (Yii::$app->request->isPost) {
            $postData = Yii::$app->request->post();
            if (isset($postData['save_record']) && ($postData['save_record'] == 'delete_record')) {
                $id = $postData['id'];
                $transaction = $conn->beginTransaction();

                try {
                    $conn->createCommand()->delete('road_roughness_survey', ['parent_id' => $id])->execute();
                    $conn->createCommand()->delete('remaining_service_life', ['parent_id' => $id])->execute();
                    $conn->createCommand()->delete('pavement_condition_survey', ['parent_id' => $id])->execute();
                    $conn->createCommand()->delete('condition_data', ['id' => $id])->execute();

                    $transaction->commit();
                    Yii::$app->session->setFlash('info', 'Record deleted successfully!');
                    return $this->redirect(['conditiondata']);
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('error', 'Failed to delete record: ' . $e->getMessage());
                    return $this->redirect(['conditiondata']);
                }
            } else {
                $file = UploadedFile::getInstanceByName('fileUpload');
                if ($file) {
                    try {

                        $spreadsheet = IOFactory::load($file->tempName);
                        $sheet = $spreadsheet->getActiveSheet();
                        $data = [];
                        $index_count = 0;
                        foreach ($sheet->getRowIterator() as $row) {
                            $index_count++;
                            if ($index_count <= 4) {

                                continue;
                            }

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

                        $table1 = array();
                        $table2 = array();
                        $table3 = array();

                        foreach ($data as $row) {
                            $r1 = [];
                            $r2 = [];
                            $r3 = [];
                            $flag = 0;
                            foreach ($row as $index) {
                                if ($index != "|") {
                                    if ($flag == 0) {
                                        $r1[] = $index;
                                    }
                                    if ($flag == 1) {
                                        $r2[] = $index;
                                    }
                                    if ($flag == 2) {
                                        $r3[] = $index;
                                    }
                                } else {
                                    $flag++;
                                }
                            }
                            $table1[] = $r1;
                            $table2[] = $r2;
                            $table3[] = $r3;
                        }

                        $title = $postData['batchName'];
                        $date = $postData['date'];
                        $transaction = $conn->beginTransaction();
                        $conn->createCommand()->insert('condition_data', [
                            'batch_name' => $title,
                            'date' => $date
                        ])->execute();

                        $parent_id = $conn->getLastInsertID();
                        // PAVEMENT CONDITION SURVEY
                        foreach ($table1 as $row) {
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
                                'date' => $formattedDate,
                                'parent_id' => $parent_id
                            ])->execute();
                        }
                        // ROAD ROUGHNESS SURVEY
                        foreach ($table2 as $row) {
                            if ($row[4]) {
                                $parts = explode('/', $row[4]);
                                $formattedDate = (count($parts) === 3) ? "{$parts[2]}-{$parts[1]}-{$parts[0]}" : null;
                            } else {
                                $formattedDate = date('Y-m-d');
                            }
                            $conn->createCommand()->insert('road_roughness_survey', [
                                'route' => $row[0] ?? null,
                                'direction' => $row[1] ?? null,
                                'km' => $row[2] ?? null,
                                'remarks' => $row[3] ?? null,
                                'date' => $formattedDate,
                                'roughness_m_per_km' => $row[5] ?? null,
                                'roughness_index' => $row[6] ?? null,
                                'parent_id' => $parent_id
                            ])->execute();
                        }
                        // REMAINING SERVICE LIFE
                        foreach ($table3 as $row) {
                            $conn->createCommand()->insert('remaining_service_life', [
                                'route' => $row[0] ?? null,
                                'direction' => $row[1] ?? null,
                                'km' => $row[2] ?? null,
                                'rutting' => $row[3] ?? null,
                                'cracking_structural' => $row[4] ?? null,
                                'cracking_thermal' => $row[5] ?? null,
                                'ravelling' => $row[6] ?? null,
                                'roughness' => $row[7] ?? null,
                                'pavement' => $row[8] ?? null,
                                'parent_id' => $parent_id
                            ])->execute();
                        }
                        $transaction->commit(); // All good, commit changes
                        Yii::$app->session->setFlash('info', 'File successfully imported!');
                        return $this->redirect(['conditiondata']);
                    } catch (\Exception $e) {
                        $transaction->rollBack(); // Something failed, roll back all
                        echo 'Error processing file: ' . $e->getMessage();
                        exit;
                    }
                } else {
                    echo 'No file uploaded!';
                    exit;
                }
            }
        }
        $condition_data = $conn->createCommand(
            "SELECT id, batch_name, date, create_time FROM public.condition_data;"
        )->queryAll();
        return $this->render('conditiondata', ['can' => [
            'can_add'    => 1,
            'can_view'   => 1,
            'can_edit'   => 1,
            'can_delete' => 1,
        ], 'condition_data' => $condition_data]);
    }
    public function actionDetails()
    {

        if (isset($_REQUEST['referance']) && !empty($_REQUEST['referance'])) {
            $id = $_REQUEST['referance'];
            $conn = Yii::$app->db;

            $condition_data = $conn->createCommand("SELECT id, batch_name, date, create_time FROM public.condition_data WHERE id = $id;")->queryOne();

            if ($condition_data) {
                $pavement_condition_survey = $conn->createCommand(
                    "SELECT id, route, direction, km, surface,
                    road_width, shoulder_width_left, shoulder_width_right,
                    rutting_severity, rutting_extent, rutting_index,
                    cracking_structural_severity, cracking_structural_extent,
                    cracking_structural_index, cracking_thermal_severity,
                    cracking_thermal_extent, cracking_thermal_index, potholes_severity,
                    potholes_extent, potholes_index, patching_severity, patching_extent,
                    patching_index, ravelling_severity, ravelling_extent, ravelling_index,
                    edge_erosion_severity, edge_erosion_extent, edge_erosion_index,
                    drainage_severity, drainage_extent, drainage_index, remarks, date, parent_id
                    FROM public.pavement_condition_survey;"
                )->queryAll();
                $road_roughness_survey = $conn->createCommand(
                    "SELECT id, route, direction, km, remarks, date, roughness_m_per_km,
                roughness_index, parent_id
                FROM public.road_roughness_survey WHERE parent_id = $id;"
                )->queryAll();
                $remaining_service_life = $conn->createCommand(
                    "SELECT id, route, direction, km, rutting, cracking_structural, cracking_thermal,
                ravelling, roughness, pavement, parent_id
                FROM public.remaining_service_life WHERE parent_id = $id;"
                )->queryAll();

                $condition_data['pavement_condition_survey'] = $pavement_condition_survey;
                $condition_data['road_roughness_survey'] = $road_roughness_survey;
                $condition_data['remaining_service_life'] = $remaining_service_life;
                return $this->render('details', ['condition_data' => $condition_data]);
            }
            return $this->redirect(['conditiondata']);
        }
        return $this->redirect(['conditiondata']);
    }
}
