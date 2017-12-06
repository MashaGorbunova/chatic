<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
                'only' => ['logout', 'cabinet'],
                'rules' => [
                    [
                        'actions' => ['logout', 'cabinet'],
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
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['cabinet']);
        }
        return $this->render('login', [
            'model' => $model,
        ]);
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
        $model = new SignupForm();
        $model->scenario = User::SCENARIO_SIGNUP;

        $language = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);
        $geo = new \jisoft\sypexgeo\Sypexgeo();
        $ip = \Yii::$app->request->userIP;
        $data = $geo->get($ip);

        if($countryModel = Country::find()->where(['code' => ArrayHelper::getValue($data['country'], 'iso')])->one()){
            $country = ArrayHelper::getValue($countryModel, 'id');
        }
        else {
            $countryModel = Country::find()->where(['code' => 'UA'])->one();
            $country = ArrayHelper::getValue($countryModel, 'id');
        }

        if(!$enumModel = Enum::find()->where(['type' => Enum::LANGUAGE, 'code' => strtoupper($language)])->one()){
            $language = 'UK';
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect(['done-signup']);
                }
            }
        }

        return $this->render('registration', [
            'model'    => $model,
            'country'  => $country,
            'language' => strtoupper($language)
        ]);
    }

    public function actionCabinet(){
        $this->layout = '/admin';
        return $this->render('cabinet');
    }

    public function actionLaba4(){
        return $this->render('airport');
    }

    public function actionChlang($lang)
    {
        Yii::$app->session->set('Language', $lang);
        $this->redirect(Yii::$app->request->referrer);
    }
}
