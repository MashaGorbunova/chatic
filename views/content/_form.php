<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Content */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="box box-primary">
        <div class="box-header">
            <div class="row">
                <div class="col-md-2">
                    <?= $form->field($model, 'order')->textInput(['type' => 'number']) ?>

                    <?= $form->field($model, 'is_published')->checkbox() ?>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <fieldset>
                        <legend><?=Yii::t('app', 'Language UK')?></legend>
                        <?= $form->field($model, 'title_uk')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'text_short_uk')->widget(\yii\redactor\widgets\Redactor::className()) ?>

                        <?= $form->field($model, 'text_full_uk')->widget(\yii\redactor\widgets\Redactor::className()) ?>
                    </fieldset>
                </div>
                <div class="col-md-6">
                    <fieldset>
                        <legend><?=Yii::t('app', 'Language EN')?></legend>
                        <?= $form->field($model, 'title_en')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'text_short_en')->widget(\yii\redactor\widgets\Redactor::className()) ?>

                        <?= $form->field($model, 'text_full_en')->widget(\yii\redactor\widgets\Redactor::className()) ?>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="box-footer">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
