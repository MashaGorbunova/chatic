<?php

use app\models\Content;
use yii\helpers\Html;

/*@var $model app\models\Content */
/*@var $view string */

?>

<div class="content-view">
    <?php if($view == Content::CONTENT_SHORT): ?>
        <div class="row">
            <div class="col-md-12">
                <h3><?=(Yii::$app->language == 'uk')?$model->title_uk:$model->title_en;?></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class=" short-content" style="height: 150px; overflow:hidden; ">
                    <?=(Yii::$app->language == 'uk')?$model->text_short_uk:$model->text_short_en;?>
                </div>

                <p><?=Html::a(Yii::t('app', 'Read more...'),
                        ['/site/news', 'id' => $model->id],
                        ['class' => 'btn btn-default'])?></p>
            </div>
        </div>
    <?php endif; ?>

    <?php if($view == Content::CONTENT_FULL): ?>
        <div class="row">
            <div class="col-md-12">
                <h1><?=(Yii::$app->language == 'uk')?$model->title_uk:$model->title_en;?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?=(Yii::$app->language == 'uk')?$model->text_full_uk:$model->text_full_en;?>
            </div>
        </div>
    <?php endif; ?>
</div>
