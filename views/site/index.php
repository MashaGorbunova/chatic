<?php

use app\components\ContentWidget;
use app\models\Content;

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Chatic');
$images =  [
    '<img src="../web/images/1.jpg" width="100%">',
    '<img src="../web/images/2.jpg" width="100%">',
    '<img src="../web/images/3.jpg" width="100%">',
    '<img src="../web/images/4.jpg" width="100%">'
];
?>
<div class="site-index">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="padding:0">
                <?=yii\bootstrap\Carousel::widget(
                    [
                        'items'=>$images,
                        'showIndicators' => false,
                        'options' => [
                            'class' => 'carousel fade',
                            'data-interval' => 5000,
                            'data-rider' => 'carousel',
                            'style' => [
                                'width: 100%; height: 500px; overflow: hidden',
                            ],
                        ],
                        'controls' => [
                            '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>',
                            '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>',
                        ]
                    ]
                );?>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="body-content">

            <div class="row">
                <div class="col-lg-4">
                    <?=ContentWidget::widget(['order' => 1, 'view' => Content::CONTENT_SHORT])?>
                </div>
                <div class="col-lg-4">
                    <?=ContentWidget::widget(['order' => 2, 'view' => Content::CONTENT_SHORT])?>
                </div>
                <div class="col-lg-4">
                    <?=ContentWidget::widget(['order' => 3, 'view' => Content::CONTENT_SHORT])?>
                </div>
            </div>

        </div>
    </div>
</div>
