<?php

namespace app\controllers;

use app\models\Tattachmentss;
use app\models\TattachmentssSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * TattachmentssController implements the CRUD actions for Tattachmentss model.
 */
class TattachmentssController extends Controller
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
     * Lists all Tattachmentss models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TattachmentssSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tattachmentss model.
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
     * Creates a new Tattachmentss model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($tenderId)
    {
        $model = new Tattachmentss();

        $model->tender_id=$tenderId;

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) ) {

              
                    $model->document = UploadedFile::getInstance($model, 'document');
                    $model->evaluation = UploadedFile::getInstance($model, 'evaluation');
                    $model->negotiation = UploadedFile::getInstance($model, 'negotiation');
                    $model->award = UploadedFile::getInstance($model, 'award');
                    $model->intention = UploadedFile::getInstance($model, 'intention');
                    $model->arithmetic = UploadedFile::getInstance($model, 'arithmetic');
                    $model->audit = UploadedFile::getInstance($model, 'audit');
                    $model->cancellation = UploadedFile::getInstance($model, 'cancellation');
                    
                    // Perform additional validation or other operations here
                    
                    if ($model->validate()) {
                        $uploadPath = Yii::getAlias('@webroot/upload/');
                
                        if ($model->document) {
                            $documentFileName = $model->document->baseName . '.' . $model->document->extension;
                            $documentFilePath = $uploadPath . $documentFileName;
                            
                            if ($model->document->saveAs($documentFilePath)) {
                                $model->document = $documentFileName;
                            }
                        }

                        if ($model->evaluation) {
                            $documentFileName = $model->evaluation->baseName . '.' . $model->evaluation->extension;
                            $documentFilePath = $uploadPath . $documentFileName;
                            
                            if ($model->evaluation->saveAs($documentFilePath)) {
                                $model->evaluation = $documentFileName;
                            }
                        }

                        if ($model->negotiation) {
                            $documentFileName = $model->negotiation->baseName . '.' . $model->negotiation->extension;
                            $documentFilePath = $uploadPath . $documentFileName;
                            
                            if ($model->negotiation->saveAs($documentFilePath)) {
                                $model->negotiation = $documentFileName;
                            }
                        }


                        if ($model->award) {
                            $documentFileName = $model->award->baseName . '.' . $model->award->extension;
                            $documentFilePath = $uploadPath . $documentFileName;
                            
                            if ($model->award->saveAs($documentFilePath)) {
                                $model->award = $documentFileName;
                            }
                        }


                        if ($model->intention) {
                            $documentFileName = $model->intention->baseName . '.' . $model->intention->extension;
                            $documentFilePath = $uploadPath . $documentFileName;
                            
                            if ($model->intention->saveAs($documentFilePath)) {
                                $model->intention = $documentFileName;
                            }
                        }

                        if ($model->arithmetic) {
                            $documentFileName = $model->arithmetic->baseName . '.' . $model->arithmetic->extension;
                            $documentFilePath = $uploadPath . $documentFileName;
                            
                            if ($model->arithmetic->saveAs($documentFilePath)) {
                                $model->arithmetic = $documentFileName;
                            }
                        }

                        if ($model->audit) {
                            $documentFileName = $model->audit->baseName . '.' . $model->audit->extension;
                            $documentFilePath = $uploadPath . $documentFileName;
                            
                            if ($model->audit->saveAs($documentFilePath)) {
                                $model->audit = $documentFileName;
                            }
                        }

                        if ($model->cancellation) {
                            $documentFileName = $model->cancellation->baseName . '.' . $model->cancellation->extension;
                            $documentFilePath = $uploadPath . $documentFileName;
                            
                            if ($model->cancellation->saveAs($documentFilePath)) {
                                $model->cancellation = $documentFileName;
                            }
                        }
                
                }
                if($model->save()){
                    
                }

                return $this->redirect(['tender/view', 'id' => $tenderId]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'tenderId'=>$tenderId,
        ]);
    }

    /**
     * Updates an existing Tattachmentss model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {


            $model->document = UploadedFile::getInstance($model, 'document');
   
                
            if ($model->document) {
              $uploadPath = Yii::getAlias('@webroot/upload/');
              $fileName = $model->document->baseName . '.' . $model->document->extension;
              $filePath = $uploadPath . $fileName;


              if ($model->document->saveAs($filePath)) {
                $model->document = '' . $fileName;
            }
            
            }
            if($model->save()){
                
            }

            return $this->redirect(['tender/view', 'id' => $model->tender_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Tattachmentss model.
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
     * Finds the Tattachmentss model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Tattachmentss the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tattachmentss::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
