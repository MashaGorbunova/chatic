<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */
/* @var $country integer */
/* @var $language string */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\catalog\Enum;

$this->title = Yii::t('app', 'Signup User');
$this->params['breadcrumbs'][] = $this->title;

$model->country  = $country;
$model->language = $language;

?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?=Yii::t('app', 'Please fill out the following fields to signup')?>:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?= $form->field($model, 'username')
                ->textInput(['autofocus' => true])
                ->label(Yii::t('app', 'Username')) ?>

            <?= $form->field($model, 'login')->label(Yii::t('app', 'Email')) ?>

            <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '+99(999)999-99-99',
                'name' => 'phone',
            ])->textInput()->label(Yii::t('app', 'Phone')); ?>

            <?= $form->field($model, 'country')->widget(
                Select2::className(),
                [
                    'data' => ArrayHelper::map(\common\models\catalog\Country::find()->orderBy('name_original')->all(), 'id', 'name_original')
                ]
            )->label(Yii::t('app', 'Country')) ?>

            <?= $form->field($model, 'language')->widget(
                Select2::className(),
                [
                    'data' => ArrayHelper::map(Enum::find()->where(['type' => Enum::LANGUAGE])->orderBy('code')->all(), 'code', 'code')
                ]
            )->label(Yii::t('app', 'Language')) ?>

            <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('app', 'Password')) ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
