<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Content */

$this->title = (Yii::$app->language == 'uk')?$model->title_uk:$model->title_en;
if(!Yii::$app->user->isGuest and Yii::$app->user->identity->isAdmin){
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contents'), 'url' => ['index']];
}
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">
    <div class="content-view">
        <?=\app\components\ContentWidget::widget(['order' => $model->order, 'view' => \app\models\Content::CONTENT_FULL])?>
    </div>
</div>
