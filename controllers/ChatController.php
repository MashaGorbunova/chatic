<?php

namespace app\controllers;

use app\models\User;
use dektrium\user\models\UserSearch;
use Yii;
use app\models\Chat;
use app\models\ChatSearch;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ChatController implements the CRUD actions for Chat model.
 */
class ChatController extends Controller
{
    public $layout = '/admin';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'send-msg' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'start', 'send-msg', 'history'],
                        'allow' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Chat models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->id){
            $searchModel = new \app\models\UserSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->andWhere(['<>', 'id', Yii::$app->user->id]);

            return $this->render('list_user', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        else return $this->redirect(['/user/login']);
    }

    public function actionStart($id){
        if(!Yii::$app->user->id){
            return $this->redirect(['/user/login']);
        }

        $user = User::findOne(['id' => $id]);

        Chat::updateAll(['is_read' => 1], ['user_id' => $user->id, 'send_user_id' => Yii::$app->user->id]);

        $pos = Yii::$app->request->post('pos', 5);
        $chat = Chat::find()
            ->where(['user_id' => Yii::$app->user->id, 'send_user_id' => $user->id])
            ->orWhere(['user_id' => $user->id, 'send_user_id' => Yii::$app->user->id])
            ->limit($pos)
            ->orderBy(['create_date' => SORT_DESC])
            ->all();

        $totalCount = Chat::find()
            ->where(['user_id' => Yii::$app->user->id, 'send_user_id' => $user->id])
            ->orWhere(['user_id' => $user->id, 'send_user_id' => Yii::$app->user->id])
            ->count();

        $model = new Chat();

        if($id == 9){
            $this->makeChat(Chat::find()
                ->where(['user_id' => Yii::$app->user->id, 'send_user_id' => $user->id])
                ->limit($pos)
                ->orderBy(['create_date' => SORT_DESC])
                ->all());
        }

        if(Yii::$app->request->isAjax){
            return $this->renderAjax('start',
                [
                    'user' => $user,
                    'model' => $model,
                    'chat'  => $chat,
                    'totalCount' => $totalCount
                ]
            );
        }

        return $this->render('start',
            [
                'user' => $user,
                'model' => $model,
                'chat'  => $chat,
                'totalCount' => $totalCount
            ]
        );
    }

    public function actionSendMsg(){
        if(Yii::$app->request->isAjax){
            $model = new Chat();
            $model->user_id = Yii::$app->user->id;
            $model->create_date = new Expression('Now()');
            $model->load(Yii::$app->request->post());
            $model->save();

            $chat = Chat::find()
                ->where(['user_id' => Yii::$app->user->id, 'send_user_id' => $model->send_user_id])
                ->orWhere(['user_id' => $model->send_user_id, 'send_user_id' => Yii::$app->user->id])
                ->limit(5)
                ->orderBy(['create_date' => SORT_DESC])
                ->all();

            $totalCount = Chat::find()
                ->where(['user_id' => Yii::$app->user->id, 'send_user_id' => $model->send_user_id])
                ->orWhere(['user_id' => $model->send_user_id, 'send_user_id' => Yii::$app->user->id])
                ->count();

            return $this->renderAjax('start',
                [
                    'user' => $model->sendUser,
                    'model' => new Chat(),
                    'chat'  => $chat,
                    'totalCount' => $totalCount
                ]
            );
        }

        return false;
    }

    public function actionHistory($id){
        return $this->redirect(['start', 'id' => $id]);
    }

    /**
     * Displays a single Chat model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Chat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Chat();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Chat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Chat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Chat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Chat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Chat::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function makeChat($models){
        foreach ($models as $row){

            if($row->message == 'Hello' and $row->is_read == 0){
                $model = new Chat();
                $model->send_user_id = Yii::$app->user->id;
                $model->user_id = $row->send_user_id;
                $model->create_date = new Expression('Now()');
                $model->message = 'Hi';
                $model->save();

                $row->is_read = 1;
                $row->save(false);
            }
            if($row->message == 'How are you?' and $row->is_read == 0){
                $model = new Chat();
                $model->send_user_id = Yii::$app->user->id;
                $model->user_id = $row->send_user_id;
                $model->create_date = new Expression('Now()');
                $model->message = 'Fine. Thanks. And you?';
                $model->save();

                $row->is_read = 1;
                $row->save(false);
            }
            if ($row->is_read == 0) {
                $model = new Chat();
                $model->send_user_id = Yii::$app->user->id;
                $model->user_id = $row->send_user_id;
                $model->create_date = new Expression('Now()');
                $model->message = ':)';
                $model->save();

                $row->is_read = 1;
                $row->save(false);
            }
        }
    }
}
