<?php

namespace app\components;

use yii\base\Widget;

class ContentWidget extends Widget
{
    public $order;
    public $view;

    function run(){
        $model = \app\models\Content::find()
            ->where(['is_published' => 1])
            ->andWhere(['order' => $this->order])
            ->one();

        return $this->render('_content_view', ['model' => $model, 'view' => $this->view]);
    }


}