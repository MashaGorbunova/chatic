<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\SignupForm */
/* @var $country integer */
/* @var $language string */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


$this->title = Yii::t('app', 'Registration User');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="site-signup">
        <h1><?= Html::encode($this->title) ?></h1>

        <p><?=Yii::t('app', 'Please fill out the following fields to signup')?>:</p>

        <div class="row">
            <div class="col-md-6">
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <fieldset>
                    <legend><?=Html::label(Yii::t('app', 'Information for login')) ?></legend>

                    <?= $form->field($model, 'username')
                        ->textInput(['autofocus' => true, 'placeholder' => Yii::t('app', 'Nickname')])
                        ->label(false) ?>

                    <?= $form->field($model, 'email')
                        ->textInput(['type' => 'email', 'placeholder' => Yii::t('app', 'Email')])
                        ->label(false) ?>

                    <?= $form->field($model, 'password')
                        ->passwordInput(['placeholder' => Yii::t('app', 'Password')])
                        ->label(false) ?>
                </fieldset>

                <fieldset>
                    <legend><?=Html::label(Yii::t('app', 'Information about user')) ?></legend>

                    <?= $form->field($model, 'name')
                        ->textInput(['placeholder' => Yii::t('app', 'Name')])
                        ->label(false) ?>

                    <?= $form->field($model, 'surname')
                        ->textInput(['placeholder' => Yii::t('app', 'Surname')])
                        ->label(false) ?>

                    <?= $form->field($model, 'parent_name')
                        ->textInput(['placeholder' => Yii::t('app', 'Parent Name')])
                        ->label(false) ?>

                    <?= $form->field($model, 'birth_date')
                        ->textInput(['type' => 'date', 'placeholder' => Yii::t('app', 'Birth Date')])
                        ->label(false) ?>
                </fieldset>

                <fieldset>
                    <legend><?=Html::label(Yii::t('app', 'Information about education')) ?></legend>

                    <?= $form->field($model, 'department')
                        ->textInput(['placeholder' => Yii::t('app', 'Department')])
                        ->label(false) ?>

                    <?= $form->field($model, 'group')
                        ->textInput(['placeholder' => Yii::t('app', 'Group')])
                        ->label(false) ?>

                    <?= $form->field($model, 'faculty')
                        ->textInput(['placeholder' => Yii::t('app', 'Faculty')])
                        ->label(false) ?>

                    <?= $form->field($model, 'enter_year')
                        ->textInput(['placeholder' => Yii::t('app', 'Enter Year'), 'type' => 'number'])->label(false) ?>
                </fieldset>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

</div>
