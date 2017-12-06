<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<span> Chatic <img src="' . Yii::$app->urlManager->baseUrl . '/images/chat.png" id=logo width="50px"></span>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if(Yii::$app->user->isGuest){
        $registration = ['label' => '<i class="fa fa-user"></i> '.Yii::t('app','Registration'), 'url' => ['/site/registration']];
    }
    else $registration = '';
    $items = [
        ['label' => Yii::t('app', 'Department of Applied Physics'), 'url' => 'http://apd.ipt.kpi.ua/home.php'],
        ['label' => Yii::t('app', 'Department of Physics of Power Systems'), 'url' => 'http://phes.ipt.kpi.ua/'],
        ['label' => Yii::t('app', 'Department of Information Security'), 'url' => 'http://is.ipt.kpi.ua/'],
        ['label' => Yii::t('app', 'Department of Mathematical Methods of Information Protection'), 'url' => 'http://mmis.ipt.kpi.ua/'],
        ['label' => Yii::t('app', 'Department of physical and technical means of information protection'), 'url' => 'http://ptmip.ipt.kpi.ua/'],

    ];
    $lang = [
        ['label' => 'en', 'url' => ['/site/chlang', 'lang' => 'en']],
        ['label' => 'uk', 'url' => ['/site/chlang', 'lang' => 'uk']],
    ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => [
            ['label' => Yii::t('app','History'), 'url' => ['/site/history']],
            ['label' => Yii::t('app','Departments'), 'url' => ['#'], 'items' => $items],
            ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/contact']],
            $registration,
            Yii::$app->user->isGuest ? (
                ['label' => '<i class="fa fa-sign-in"></i> '.Yii::t('app', 'Login'), 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    Yii::t('app', 'Logout').' (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            ),
            ['label' => Yii::$app->language, 'url' => ['#'], 'items' => $lang],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="wrap-content">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
        </div>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Site is made by Maria Gorbunova <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
