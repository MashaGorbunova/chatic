<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Content */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Content',
]) . (Yii::$app->language == 'uk')?$model->title_uk:$model->title_en;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="content-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
