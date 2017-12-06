<?php

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
                            'class' => 'carousel slide',
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
                    <h2>Heading</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
                </div>
                <div class="col-lg-4">
                    <h2>Heading</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
                </div>
                <div class="col-lg-4">
                    <h2>Heading</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
                </div>
            </div>

        </div>
    </div>
</div>
