<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

?>

<div class="media">
    <div class="media-left media-middle">
        <img src="/web<?= $model->photo ?>" class="user-image" alt="User Image" width="60px"/>
    </div>
    <div class="media-body">
        <div class="row">
            <div class="col-md-8">
                <h4 class="media-heading"><?=$model->username?></h4>
                <?=\yii\helpers\ArrayHelper::getValue($model->student, 'name')?>
                <?=\yii\helpers\ArrayHelper::getValue($model->student, 'surname')?>
                <?=Yii::$app->formatter->asDatetime($model->last_login_at, 'dd-MM-Y HH:mm:i')?>
            </div>
            <div class="col-md-4">
                <?=Html::a(Yii::t('app', 'Start chat'),
                    ['/chat/start', 'id' => $model->id], ['class' => 'btn btn-success'])?>
            </div>
        </div>
    </div>
</div>

