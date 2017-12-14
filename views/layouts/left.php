<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?=Yii::$app->user->identity->username?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    [
                        'label' => Yii::t('app','Content'),
                        'icon' => 'newspaper-o',
                        'url' => ['/content'],
                        'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin
                    ],
                    [
                        'label' => Yii::t('app','Chat'),
                        'icon' => 'handshake-o ',
                        'url' => ['/chat'],
                        'visible' => !Yii::$app->user->isGuest
                    ],
                    [
                        'label' => Yii::t('app','My-data'),
                        'icon' => 'vcard-o',
                        'url' => ['/site/my-data'],
                        'visible' => !Yii::$app->user->isGuest
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
