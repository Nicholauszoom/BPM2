<?php

namespace app\controllers;

use app\models\Office;
use app\models\Tdetails;
use app\models\TdetailSearch;
use app\models\Tender;
use app\models\User;
use app\models\UserAssignment;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;

/**
 * TdetailController implements the CRUD actions for Tdetails model.
 */
class TdetailController extends Controller
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
     * Lists all Tdetails models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TdetailSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tdetails model.
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
     * Creates a new Tdetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($tenderId)
    {
        $model = new Tdetails();
        $model->tender_id = $tenderId;

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {



                if($model->save()){
                        
                    $tender=Tender::findOne($tenderId);
                    $tender_supervisor=User::findOne($tender->supervisor);
             
                  

                    $tender_assigned=User::findOne($tender->assigned_to);
                   

                    

                    $office =Office::findOne($model->office);
           

                    // functions for status
function getStatusLabel($status)
{
    $statusLabels = [
      1 => 'Security Declaration',
      2 => 'Bid/Tender Security',
     
    ];

    return isset($statusLabels[$status]) ? $statusLabels[$status] : '';
}

function getSiteVisitLabel($status)
{
    $statusLabels = [
      1 => 'YES',
      2 => 'NO',
     
    ];

    return isset($statusLabels[$status]) ? $statusLabels[$status] : '';
}


                     

                    if ($tender_supervisor && !empty($tender_supervisor->email)) {
                        /** @var MailerInterface $mailer */
                        $mailer = Yii::$app->mailer;
                        $message = $mailer->compose()
                            ->setFrom('nicholaussomi5@gmail.com')
                            ->setTo($tender_supervisor->email)
                            // ->setCc($tender_assigned->email) // Add CC recipient(s) here
                            ->setSubject('tera tech company is confortably assign you a tender to work on')
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
                                    </style>
                                </head>
                                <body>
                                    <div class="container">
                                        <div class="logo">
                                            <img src="http://teratech.co.tz/local/images/uploads/logo/163277576061522e507c527.webp" alt="teralogo">
                                        </div>
                                        <p>Dear ' . Html::encode($tender_supervisor->username) . ',</p>
                                        <p>Your project has been assigned to you. Please find the details below:</p>
                                        <ul>
                                            <li>Tender Title: ' . Html::encode($tender->title) . '</li>
                                            <li> Message: ' . Html::encode($tender->description) . '</li>
                                            <li> Site Visit: ' . Html::encode(getSiteVisitLabel($model->site_visit)) . '</li>
                                            <li>Site Visit Date: ' . Html::encode(date('Y-m-d', $model->site_visit_date)). '</li>    
                                            <li> End Clarification Date: ' . Html::encode(date('Y-m-d',$model->end_clarificatiion)). '</li>
                                            <li> Bid Meeting Date: ' . Html::encode(date('Y-m-d',$model->bidmeet)) . '</li>
                                            <li>Tender Security: ' . Html::encode(getStatusLabel($model->tender_security)) . '</li>
                                            <li>Submission Date: ' . Html::encode(date('Y-m-d',$tender->expired_at)) . '</li>
                                            <li> Security Amount: ' . Html::encode($model->amount) . '</li>
                                            <li>Security %: ' . Html::encode($model->percentage) . '</li>
                                            <li>Office: ' . Html::encode($office->location) . '</li>
                                        </ul>
                                        <p>If you have any questions or need further assistance, feel free to contact us.</p>
                                        <a href="' . Yii::$app->request->getHostInfo() . '/upload/' . $tender->document . '">View Attachment</a>                                </html>
                            ');

                            $user_assignments = UserAssignment::find()
                            ->where(['tender_id' => $tenderId])
                            ->all();
                        
                        $assignedUserIds = [];
                        foreach ($user_assignments as $user_assignment) {
                            $assignedUserIds[] = $user_assignment->user_id;
                        }
                        
                        $assignedUsers = User::find()
                            ->where(['id' => $assignedUserIds])
                            ->all();
                        
                        // Add CC recipients
                        foreach ($assignedUsers as $assignedUser) {
                            $message->setCc($assignedUser->email);
                        }
                            

                    // Attach the document file to the email
    // foreach ($attachments as $attachment) {
    //     $message->attach($attachment);
    // }

                        // $message->send();
                        $mailer->send($message);
                    }
                }
               
                return $this->redirect(['adetail/create', 'tenderId' => $tenderId]);



            }
        } else {
            $model->loadDefaultValues();
        }

        $office=Office::find()->all();

        return $this->render('create', [
            'model' => $model,
            'tenderId'=> $tenderId,
            'office'=>$office,
        ]);
    }

    /**
     * Updates an existing Tdetails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $office=Office::find()->all();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['tender/view', 'id' => $model->tender_id]);
        }


        return $this->render('update', [
            'model' => $model,
            'office'=>$office,
        ]);
    }

    /**
     * Deletes an existing Tdetails model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $model = Tdetails::findOne($id);
if ($model) {
    $tenderId = $model->tender_id;
    $model->delete();
    return $this->redirect(['tender/']);
} 

    }

    /**
     * Finds the Tdetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Tdetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tdetails::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}


