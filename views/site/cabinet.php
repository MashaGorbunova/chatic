<?php

use yii\helpers\Html;

$this->title = Yii::t('app', 'Cabinet');
?>

<div class="cabinet">
    <div class="row">
        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-id-card"></i></span>

                <div class="info-box-content">
                    <?= Html::a('<span class="info-box-number">'.Yii::t('app', 'My data'), ['/site/my-data'])?>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>

        <div class="col-md-4">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-wechat"></i></span>

                <div class="info-box-content">
                    <?= Html::a('<span class="info-box-number">'.Yii::t('app', 'Chat'), ['/chat/index'])?>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>

        <?php if(Yii::$app->user->identity->isAdmin): ?>
            <div class="col-md-4">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-newspaper-o"></i></span>

                    <div class="info-box-content">
                        <?= Html::a('<span class="info-box-number">'.Yii::t('app', 'Content'), ['/content/index'])?>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
