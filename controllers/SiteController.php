<?php

namespace app\controllers;

use app\models\Student;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ContactForm;
use yii\web\UploadedFile;


class SiteController extends Controller
{
    public $layout = '/main';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'cabinet', 'registration-student', 'my-data'],
                'rules' => [
                    [
                        'actions' => ['logout', 'cabinet', 'registration-student', 'my-data'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
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
        return $this->redirect(['user/security/login']);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
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

    public function actionHistory(){
        return $this->render('history');
    }

    public function actionRegistration(){
        return $this->redirect(['user/registration/register']);
    }

    public function actionRegistrationStudent()
    {
        $model = new Student();
        $model->user_id = Yii::$app->user->id;

        if($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect('cabinet');
        }
        return $this->render('registration', ['model' => $model]);
    }

    public function actionCabinet(){
        $this->layout = '/admin';
        if(Yii::$app->user->identity->student){
            return $this->render('cabinet');
        }
        else return $this->redirect('registration-student');
    }

    public function actionMyData(){

        $this->layout = '/admin';

        if(!$model = User::findOne(['id' => Yii::$app->user->id])){
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        if(!$student = $model->student){
            $student = new Student();
        }

        if(Yii::$app->request->isPost){
            $userData = Yii::$app->request->post('User');
            $email = $model->email;
            $username = $model->username;

            $model->username = ($userData['username'] == null)?$username:$userData['username'];
            $model->email = ($userData['email'] == null)?$email:$userData['email'];
            if (empty($userData['password'])) {
                $model->save(false);
            }
            else {
                $model->password = $userData['password'];
                $model->save(false, ['password_hash']);
            }

            $student->load(Yii::$app->request->post());
            $student->save();

            if($model->imageFile = UploadedFile::getInstance($model, 'imageFile')){
                $model->saveImage();
            }

            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->render('my-data',
            [
                'model' => $model,
                'student' => $student
            ]);
    }

    public function actionDeletePhoto(){

        if($model = User::findOne(['id' => Yii::$app->user->id])){
            $model->deleteImage();
        }
        else throw new NotFoundHttpException('The requested page does not exist.');

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionChlang($lang)
    {
        Yii::$app->session->set('Language', $lang);
        $this->redirect(Yii::$app->request->referrer);
    }

    public function actionLaba4(){
        return $this->render('airport');
    }
}
