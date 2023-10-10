<?php

namespace app\controllers;

use app\models\Activity;
use app\models\Adetail;
use app\models\AdetailSearch;
use app\models\User;
use app\models\UserActivity;
use app\models\UserAssignment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdetailController implements the CRUD actions for Adetail model.
 */
class AdetailController extends Controller
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
     * Lists all Adetail models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AdetailSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Adetail model.
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
     * Creates a new Adetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($tenderId)
    {
        $model = new Adetail();

       
        $model->tender_id= $tenderId;

        $assign = UserAssignment::find()
        ->where(['tender_id' => $tenderId])
        ->all();
    
    $users = [];
    foreach ($assign as $assignment) {
        $user = User::findOne($assignment->user_id);
        if ($user !== null) {
            $users[] = $user;
        }
    }

    $activity=Activity::find()->all();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                

                       // Save the assigned users
                       if (is_array($model->activity_id) && !empty($model->activity_id)) {
                        foreach ($model->activity_id as $activityId) {
                            $assignment = new UserActivity();
                            $assignment->tender_id = $model->tender_id;
                            $assignment->user_id = $model->user_id;
                            $assignment->activity_id = $activityId;
                            $assignment->save();
                        }
                    }
                    return $this->redirect(['tender/view', 'id' => $tenderId]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'users'=>$users,
            'tenderId'=>$tenderId,
            'activity'=>$activity,
        ]);
    }

    /**
     * Updates an existing Adetail model.
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
     * Deletes an existing Adetail model.
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
     * Finds the Adetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Adetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Adetail::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
