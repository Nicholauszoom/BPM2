<?php

namespace app\controllers;

use app\models\Analysis;
use app\models\AuthItem;
use app\models\Department;
use app\models\SignupForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
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

}