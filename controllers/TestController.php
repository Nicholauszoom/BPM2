<?php

namespace app\controllers;

use app\models\Test;
use app\models\TestSearch;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * TestController implements the CRUD actions for Test model.
 */
class TestController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Test models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TestSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Test model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    

    /**
     * Creates a new Test model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Test();
        $data = []; // Define the $data variable
        $rowData = [];
    
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->document = UploadedFile::getInstance($model, 'document');
                if ($model->validate()) {
                    if ($model->document) {
                        $filePath = 'upload/' . $model->document->baseName . '.' . $model->document->extension;
                        if ($model->document->saveAs($filePath)) {
                            $model->document = $filePath;
    
                            // Import CSV data into the database
                            $handle = fopen($filePath, 'r');
                            while (($data = fgetcsv($handle)) !== false) {
                                $rowData[] = $data;
                            }
                            fclose($handle);
    
                            // Import data into the database
                            foreach ($rowData as $row) {
                                $modelRow = new Test(); // Create a new model instance for each row of data
                                $modelRow->Sno = $row[0];
                                $modelRow->Regno = $row[1];
                                $modelRow->quiz1 = $row[2];
                                $modelRow->assign2 = $row[3];
                                $modelRow->quiz = $row[4];
                                $modelRow->termpaper = $row[5];
                                $modelRow->quizassign = $row[6];
                                $modelRow->quizassgn2 = $row[7];
                                $modelRow->test1 = $row[8];
                                // Assign other fields as needed
                                $modelRow->document = $filePath;
                                $modelRow->save();
                            }
    
                            // Redirect after importing
                            return $this->redirect(['create']);
                        }
                    }
                }
            }
        } else {
            $model->loadDefaultValues();
        }
    
        return $this->render('create', [
            'model' => $model,
            'data' => $data,
        ]);
    }
    /**
     * Updates an existing Test model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Test model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Test model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Test the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Test::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
