<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">Ch</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <?=Yii::$app->language?><span class="caret"></span></a>
                    <ul id="w4" class="dropdown-menu">
                        <li><a href="<?=\yii\helpers\Url::to(['/site/chlang', 'lang' => 'en'])?>" tabindex="-1">en</a></li>
                        <li><a href="<?=\yii\helpers\Url::to(['/site/chlang', 'lang' => 'uk'])?>" tabindex="-1">uk</a></li>
                    </ul>
                </li>

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="/web<?= Yii::$app->user->identity->photo ?>" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?=Yii::$app->user->identity->student->name?> <?=Yii::$app->user->identity->student->surname?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle"
                                 alt="User Image"/>

                            <p>
                               <?=Yii::$app->user->identity->student->name?> <?=Yii::$app->user->identity->student->surname?>
                                <small>
                                    <?=Yii::t('app', 'Member since {data}',
                                        ['data' => Yii::$app->formatter->asDate(Yii::$app->user->identity->created_at)])?>
                                </small>
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?=\yii\helpers\Url::to(['/site/my-data'])?>" class="btn btn-default btn-flat">
                                    <?=Yii::t('app', 'My-data')?>
                                </a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    Yii::t('app', 'Sign out'),
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
