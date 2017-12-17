<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\User */
/* @var $student app\models\Student */
/* @var $country integer */
/* @var $language string */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use kartik\file\FileInput;

$this->title = Yii::t('app', 'My data');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="site-signup">
       <div class="box box-default">
           <div class="box-body">
               <div class="row">
                   <?php $form = ActiveForm::begin(['id' => 'form-mydata', 'options' => ['enctype' => 'multipart/form-data']]); ?>

                   <div class="col-md-6">

                       <fieldset>
                           <legend><?=Html::label(Yii::t('app', 'Information for login')) ?></legend>

                           <?= $form->field($model, 'username')
                               ->textInput(['autofocus' => true, 'placeholder' => Yii::t('app', 'Nickname')])
                               ->label(false) ?>

                           <?= $form->field($model, 'email')
                               ->textInput(['type' => 'email', 'placeholder' => Yii::t('app', 'Email')])
                               ->label(false) ?>

                           <?= $form->field($model, 'password')
                               ->passwordInput(['placeholder' => Yii::t('app', 'Change Password')])
                               ->label(false) ?>
                       </fieldset>

                       <fieldset>
                           <legend><?=Html::label(Yii::t('app', 'Information about user')) ?></legend>

                           <?= $form->field($student, 'name')
                               ->textInput(['placeholder' => Yii::t('app', 'Name')])
                               ->label(false) ?>

                           <?= $form->field($student, 'surname')
                               ->textInput(['placeholder' => Yii::t('app', 'Surname')])
                               ->label(false) ?>

                           <?= $form->field($student, 'parent_name')
                               ->textInput(['placeholder' => Yii::t('app', 'Parent Name')])
                               ->label(false) ?>

                           <?= $form->field($student, 'birth_date')
                               ->textInput(['type' => 'date', 'placeholder' => Yii::t('app', 'Birth Date')])
                               ->label(false) ?>
                       </fieldset>

                       <fieldset>
                           <legend><?=Html::label(Yii::t('app', 'Information about education')) ?></legend>

                           <?= $form->field($student, 'department')
                               ->textInput(['placeholder' => Yii::t('app', 'Department')])
                               ->label(false) ?>

                           <?= $form->field($student, 'group')
                               ->textInput(['placeholder' => Yii::t('app', 'Group')])
                               ->label(false) ?>

                           <?= $form->field($student, 'faculty')
                               ->textInput(['placeholder' => Yii::t('app', 'Faculty')])
                               ->label(false) ?>

                           <?= $form->field($student, 'enter_year')
                               ->textInput(['placeholder' => Yii::t('app', 'Enter Year'), 'type' => 'number'])->label(false) ?>
                       </fieldset>

                       <div class="form-group">
                           <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
                       </div>

                   </div>
                   <div class="col-md-6 text-center">
                       <h4><?= Yii::t('app', 'Photo') ?></h4>

                       <div class="img" style="width:100px; margin:auto">
                           <?=Html::img('/web'.$model->photo,
                               ['class' => 'img-responsive','style' => 'width: auto; margin-bottom: 10px']) ?>
                       </div>

                       <div class="form-group">
                           <?php
                           Modal::begin([
                               'header' => 'File Input inside Modal',
                               'toggleButton' => [
                                   'label' => Yii::t('app', 'Load photo'), 'class' => 'btn btn-default'
                               ],
                           ]); ?>

                           <?=
                           FileInput::widget(
                               [
                                   'model' => $model,
                                   'attribute' => 'imageFile',
                               ]);
                           ?>
                           <?php Modal::end(); ?>
                           <?= Html::a(
                               Yii::t('app', 'Delete photo'),
                               ['/site/delete-photo'],
                               ['class'=>'btn btn-default']
                           ) ?>
                   </div>
               </div>
                   <?php ActiveForm::end(); ?>
           </div>
       </div>
    </div>

</div>
