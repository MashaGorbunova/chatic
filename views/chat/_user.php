<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $model app\models\User */
?>

<div class="media user-list-view">
    <div class="media-left media-middle">
        <img src="/web<?= $model->photo ?>" class="user-image" alt="User Image" width="80px"/>
    </div>
    <div class="media-body">
        <div class="row">
            <div class="col-md-8">
                <h4 class="media-heading"><?=$model->username?></h4>
                <p>
                    <small><?=Html::label(Yii::t('app', 'Name'))?>:</small>
                    <?=ArrayHelper::getValue($model->student, 'name')?>
                </p>
                <p>
                    <small><?=Html::label(Yii::t('app', 'Surname'))?>:</small>
                    <?=ArrayHelper::getValue($model->student, 'surname')?>
                </p>
                <p>
                    <small><?=Html::label(Yii::t('app', 'Last visit'))?>:</small>
                    <?=Yii::$app->formatter->asDatetime($model->last_login_at, 'dd-MM-Y HH:mm:s')?>
                </p>
            </div>
            <div class="col-md-4 mgt-25 text-right">

                <?php if($model->isHasHistory()){
                    echo Html::a('<i class="fa fa-history"></i> '.Yii::t('app', 'History'),
                        ['/chat/history', 'id' => $model->id], ['class' => 'btn btn-info', 'style' => 'margin-bottom: 3px']);
                }?>

                <?=Html::a('<i class="fa fa-wechat"></i> '.Yii::t('app', 'Start chat'),
                    ['/chat/start', 'id' => $model->id], ['class' => 'btn btn-success', 'style' => 'margin-bottom: 3px'])?>

            </div>
        </div>
    </div>
</div>

