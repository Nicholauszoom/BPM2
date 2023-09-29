<?php

namespace app\controllers;

use app\models\Analysis;
use app\models\Department;
use app\models\Project;
use app\models\Request;
use app\models\RequestSearch;
use app\models\Task;
use app\models\Tender;
use app\models\User;
use yii\mail\MessageInterface;
use Yii;
use yii\base\InvalidConfigException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;

/**
 * RequestController implements the CRUD actions for Request model.
 */
class RequestController extends Controller
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
     * Lists all Request models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Request model.
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
     * Creates a new Request model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($analysisId)
    {
        $model = new Request();
        $model->analysis_id = $analysisId;
    
        $department = Department::find()->all();
    
        // Find items of analysis of a specific project
        $analysis = Analysis::findOne($analysisId);
    
        $project = Project::findOne($analysis->project);
    
        // Find tender title by project id
        $tender = Tender::findOne($project->tender_id);
    
        $request = Request::find()
        ->where(['analysis_id' => $analysisId])
        ->all();
    
    $existingQuantity = 0;
    foreach ($request as $requestItem) {
        $existingQuantity += $requestItem->ref;
    }
        

    $model->project_id = $project->id;

    
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
    
                try {
                    $user = User::findOne($model->created_by);
                    $userName = $user->username;
    
                    // Analysis Item name used down there for email notification
                    $anallyssById = Analysis::findOne($model->item);
                    $itemName = $anallyssById->item;
    
                    $departmentById = Department::findOne($model->department);
                    $departmentName = $departmentById->name;
    
                    // Send email to project manager
                    $project_manager = User::findOne($project->user_id);
    
                    // Get the email message instance from the mailer component
                    $message = Yii::$app->mailer->compose()
                        ->setFrom('nicholaussomi5@gmail.com')
                        ->setTo($project_manager->email)
                        ->setSubject('Request / payment voucher')
                        ->setHtmlBody('
                        <html>
                        <head>
                            <style>
                                /* CSS styles for the email body */
                                body {
                                    font-family: Arial, sans-serif;
                                    background-color: #f4f4f4;
                                }
                                .container {
                                    max-width: 600px;
                                    margin: 0 auto;
                                    padding: 20px;
                                    background-color: #ffffff;
                                    border: 1px solid #dddddd;
                                    border-radius: 4px;
                                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                                }
                                h1 {
                                    color: blue;
                                    text-align: center;
                                }
                                p {
                                    color: #666666;
                                }
                                .logo {
                                    text-align: center;
                                    margin-bottom: 20px;
                                }
                                .logo img {
                                    max-width: 200px;
                                }
                                .assigned-by {
                                    font-weight: bold;
                                }
                                .button {
                                    display: inline-block;
                                    padding: 10px 20px;
                                    background-color: #3366cc;
                                    color: white;
                                    text-decoration: none;
                                    border-radius: 4px;
                                    margin-top: 20px;
                                }
                                .button:hover {
                                    background-color: #235daa;
                                }
                                .status-label {
                                    display: inline-block;
                                    padding: 5px 10px;
                                    color: #ffffff;
                                    border-radius: 4px;
                                }
                                .status-pending {
                                    background-color: #ffc107;
                                }
                                .status-approved {
                                    background-color: #28a745;
                                }
                                .status-rejected {
                                    background-color: #dc3545;
                                }
                            </style>
                        </head>
                        <body>
                            <div class="container">
                                <div class="logo">
                                    <img src="https://teratechcomponents.com/wp-content/uploads/2011/06/Tera_14_screen-234x60.png" alt="teralogo">
                                </div>
                                <h1>TERATECH</h1>
                                <p>Dear ' . Html::encode('CEO') . ',</p>
                                <p>You have been sent a project request, as detailed below:</p>
                                <ul>
                                    <li>Project Name: ' . Html::encode($tender->title) . '</li>
                                    <li>Item name: ' . Html::encode($itemName) . '</li>
                                    <li>Amount: ' . Html::encode($model->amount) . '</li>
                                    <li>REF NO: ' . Html::encode($model->ref) . '</li>
                                    <li>Department: ' . Html::encode($departmentName) . '</li>
                                    <li>Requested By: ' . Html::encode($userName) . '</li>
                                </ul>
                                <a href="http://localhost:8080/" class="button">View Project</a>
                            </div>
                        </body>
                        </html>
                    ');
    
                    // Send the email
                    if ($message instanceof MessageInterface && $message->send()) {
                        // Display a success message
                        Yii::$app->session->setFlash('success', 'Email sentsuccessfully.');
                    } else {
                        // Display an error message if email failed to send
                        Yii::$app->session->setFlash('error', 'Failed to send the email.');
                    }
                } catch (\Exception $e) {
                    // Log the exception or handle it as needed
                    Yii::error($e->getMessage());
                    // Display an error message if an exception occurred
                    Yii::$app->session->setFlash('error', 'An error occurred while sending the email.');
                }
    
                return $this->redirect(['request/create', 'analysisId' => $analysisId]);
            } else {
                // Display an error message if model fails to save
                Yii::$app->session->setFlash('error', 'Failed to save the model.');
            }
        }
    
        return $this->render('create', [
            'model' => $model,
            'department' => $department,
            'analysis' => $analysis,
            'project' => $project,
            'analysisId'=>$analysisId,
            'request' => $request,
            'existingQuantity' => $existingQuantity,
        ]);
    }

    /**
     * Updates an existing Request model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $department = Department::find()->all();
    
        $task = Task::findOne($model->task_id);
        $project = Project::findOne($task->project_id);
        $analysis = Analysis::find()
            ->where(['project' => $project->id])
            ->all();
    
        $tender = Tender::findOne($project->tender_id);
    
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
              //Analysis Item name used down there for email notification
              $anallyssById=Analysis::findOne($model->item);
              $itemName=$anallyssById->item;

              //loged in user
              $userId = Yii::$app->user->id;
              $sentId=User::findOne($userId);
              $sentName=$sentId->username;

              $statusLabel = '';
              if ($model->status == 1) {
                  $statusLabel = 'Accepted';
              } elseif ($model->status == 2) {
                  $statusLabel = 'Rejected';
              } else {
                  $statusLabel = 'Pending..';
              }

            // Send email
            
            $user = User::findOne($model->created_by);
            $userName= $user->username;
            $mailer = Yii::$app->mailer;
            $mailer->compose()
                ->setFrom('nicholaussomi5@gmail.com')
                ->setTo($user->email)
                ->setSubject('Approval for request')
                ->setHtmlBody('
                        <html>
                        <head>
                            <style>
                                /* CSS styles for the email body */
                                body {
                                    font-family: Arial, sans-serif;
                                    background-color: #f4f4f4;
                                }
                                .container {
                                    max-width: 600px;
                                    margin: 0 auto;
                                    padding: 20px;
                                    background-color: #ffffff;
                                    border: 1px solid #dddddd;
                                    border-radius: 4px;
                                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                                }
                                h1 {
                                    color: blue;
                                    text-align: center;
                                }
                                p {
                                    color: #666666;
                                }
                                .logo {
                                    text-align: center;
                                    margin-bottom: 20px;
                                }
                                .logo img {
                                    max-width: 200px;
                                }
                                .assigned-by {
                                    font-weight: bold;
                                }
                                .button {
                                    display: inline-block;
                                    padding: 10px 20px;
                                    background-color: #3366cc;
                                    color: white;
                                    text-decoration: none;
                                    border-radius: 4px;
                                    margin-top: 20px;
                                }
                                .button:hover {
                                    background-color: #235daa;
                                }
                                .status-label {
                                    display: inline-block;
                                    padding: 5px 10px;
                                    color: #ffffff;
                                    border-radius: 4px;
                                }
                                .status-pending {
                                    background-color: #ffc107;
                                }
                                .status-approved {
                                    background-color: #28a745;
                                }
                                .status-rejected {
                                    background-color: #dc3545;
                                }
                            </style>
                    
                            <script>
                                function getStatusLabel($model->status) {
                                    switch (status) {
                                        case 0:
                                            return {
                                                name: "Pending",
                                                labelClass: "badge badge-secondary"
                                            };
                                        case 1:
                                            return {
                                                name: "Approved",
                                                labelClass: "badge badge-success"
                                            };
                                        case 2:
                                            return {
                                                name: "Rejected",
                                                labelClass: "badge badge-warning"
                                            };
                                        default:
                                            return {
                                                name: "",
                                                labelClass: ""
                                            };
                                    }
                                }
                            </script>
                        </head>
                        <body>
                            <div class="container">
                                <div class="logo">
                                    <img src="https://teratechcomponents.com/wp-content/uploads/2011/06/Tera_14_screen-234x60.png" alt="teralogo">
                                </div>
                                <h1>TERATECH</h1>
                                <p>Dear ' . Html::encode($userName) . ',</p>
                                <p>You have been sent a comment of a project request , as detailed below :</p>
                                <ul>
                                    <li>Project Name: ' . Html::encode($tender->title) . '</li>
                                    <li>Item name : ' . Html::encode($itemName) . '</li>
                                    
                                    <li>Comment : ' . Html::encode($model->description) . '</li>

                                    <li>Approval  : ' . Html::encode($statusLabel) . '</li>
            
                                    <li>Sent By: ' . Html::encode($sentName) . '</li>
                                </ul>
                                <a href="http://localhost:8080/" class="button">View Project</a>
                            </div>
                            
                        </body>
                        </html>
                    ')

            
                ->send();
                Yii::$app->session->setFlash('success', 'Email sent successfully.');
            return $this->redirect(['view', 'id' => $model->id]);
        }
    
        return $this->render('update', [
            'model' => $model,
            'department' => $department,
        ]);
    }
    

    /**
     * Deletes an existing Request model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

       

        return $this->redirect(['/pm']);
    }

    /**
     * Finds the Request model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Request::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
