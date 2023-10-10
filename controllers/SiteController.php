<?php

namespace app\controllers;

use app\models\Analysis;
use app\models\AuthItem;
use app\models\Department;
use app\models\ForgotPasswordForm;
use app\models\ResetPasswordForm;
use app\models\SignupForm;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\helpers\Html;
use yii\web\ForbiddenHttpException;

class SiteController extends Controller
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
    
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['/dashboard/admin']);
        }
    
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }


    public function actionSignup(){
        if(Yii::$app->user->can('admin'))
        {
        $department =Department::find()->all();
        $model = new  SignupForm();
        $authItems = AuthItem::find()->all();
        if ($model->load(Yii::$app->request->post()) && $model->signUp()){

            if ($model && !empty($model->email)) {

                $department=Department::findOne($model->department);

                /** @var MailerInterface $mailer */
                $mailer = Yii::$app->mailer;
                $message = $mailer->compose()
                    ->setFrom('nicholaussomi5@gmail.com')
                    ->setTo($model->email)
                    // ->setCc($tender_assigned->email) // Add CC recipient(s) here
                    ->setSubject('Now you have account in BPM-Teratech Management System ')
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
                                <p>Dear ' . Html::encode($model->username) . ',</p>
                                <p>Your account details as below:</p>
                                <ul>
                                    <li>Username: ' . Html::encode($model->username) . '</li>                                                
                                    <li>Department ' . Html::encode($department->name) . '</li> 
                                </ul>
                                <p>If you have any questions or need further assistance, feel free to ask to email:nicholaussomi5@gmail.com.</p>
                                                             </html>
                    ');
                    

            // Attach the document file to the email
// foreach ($attachments as $attachment) {
//     $message->attach($attachment);
// }

                // $message->send();
                $mailer->send($message);
            }
            return $this->redirect(['/user']);
        }
        return $this->render('signup',[
            'model'=>$model,
            'authItems' => $authItems,
            'department'=> $department,
        ]);
    }else
    {
        throw new ForbiddenHttpException;
    }
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        
        return $this->redirect(['site/login']);

    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionDownloadBoq($id)
{
    // Find the details record based on the provided $id
    $details = Analysis::findOne($id);

    if (!$details) {
        throw new NotFoundHttpException('The requested details record does not exist.');
    }

    // Get the path to the BOQ file
    $boqFilePath = Yii::getAlias('@webroot/upload/') . $details->boq;

    // Check if the BOQ file exists
    if (!file_exists($boqFilePath)) {
        throw new NotFoundHttpException('The BOQ file does not exist.');
    }

    // Set the response headers for downloading the file
    Yii::$app->response->sendFile($boqFilePath, $details->boq, ['inline' => false]);

    // Return the response to end the action
    return Yii::$app->response;
}


public function actionForgotPassword()
{
    $model = new ForgotPasswordForm();

    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        // Find the user by email
        $user = User::findOne(['email' => $model->email]);

        if ($user) {
            // Generate a password reset token and save it in the user's record
            $user->generatePasswordResetToken();

            if ($user->save(false)) {
                // Send the password reset email to the user
                Yii::$app->mailer->compose('passwordResetToken', ['user' => $user])
                    ->setFrom('nicholaussomi5@gmail.com')
                    ->setTo($user->email)
                    ->setSubject('Password Reset')
                    ->send();

                Yii::$app->session->setFlash('success', 'A password reset link has been sent to your email.');
                return $this->refresh();
            }
        }

        Yii::$app->session->setFlash('error', 'Email address not found.');
    }

    return $this->render('forgotPassword', [
        'model' => $model,
    ]);
}


public function actionResetPassword($token)
{
  // Find the user by password reset token
    $user = User::findOne(['access_token' => $token]);

    if (!$user) {
        throw new NotFoundHttpException('Invalid password reset token.');
    }

    $model = new ResetPasswordForm();
    $model->token = $token;

    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        // Reset the user's password
        $user->setPassword($model->password);
        $user->removePasswordResetToken();
        if ($user->save(false)) {
            Yii::$app->session->setFlash('success', 'Your password has been reset successfully.');
            return $this->redirect(['site/login']);
        }
    }

    return $this->render('resertPassword', [
        'model' => $model,
    ]);
}

}