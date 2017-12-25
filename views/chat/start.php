<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

/* @var $user app\models\User */
/* @var $model app\models\Chat */
/* @var $chat [] app\models\Chat */
/* @var $form yii\widgets\ActiveForm */
/* @var $totalCount integer */

$this->title = Yii::t('app', 'Chat with {user}', ['user' => $user->username]);

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Chat'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="chat-start">
    <div class="row">
        <div class="col-md-9">
            <div class="box box-default direct-chat direct-chat-default">
                <div class="box-header with-border">
                    <h3 class="box-title"><?=Yii::t('app', 'Chat')?></h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <?=Html::a('<i class="fa fa-times"></i>', ['/chat/index'], ['class' => 'btn btn-box-tool'])?>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages" id="block">
                        <?php if(count($chat) > 0):?>
                            <?php if($totalCount != count($chat)): ?>
                                <div class="preloader">
                                    <span class="label label-info">
                                        <?=Html::button(Yii::t('app', 'See more...'),
                                            ['class' => 'btn btn-link', 'onClick' => 'preloader()'])?>
                                    </span>
                                </div>
                            <?php endif; ?>
                            <?php foreach(array_reverse($chat) as $elem): ?>
                                <?php if($elem->user_id == Yii::$app->user->id): ?>
                                    <!-- Message. Default to the left -->
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-left">
                                                <?=ArrayHelper::getValue($elem->user, 'username')?>
                                            </span>
                                            <span class="direct-chat-timestamp pull-right">
                                                <?=Yii::$app->formatter->asDatetime(strtotime($elem->create_date), 'dd-MM-Y HH:mm:s')?>
                                            </span>
                                        </div>
                                        <!-- /.direct-chat-info -->
                                        <img class="direct-chat-img" src="/web<?=$elem->user->getPhoto()?>" alt="message user image">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            <?=$elem->message?>
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->
                                <?php else: ?>
                                    <!-- Message to the right -->
                                    <div class="direct-chat-msg right">
                                        <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-right">
                                                <?=ArrayHelper::getValue($elem->user, 'username')?>
                                            </span>
                                            <span class="direct-chat-timestamp pull-left">
                                                <?=Yii::$app->formatter->asDatetime(strtotime($elem->create_date), 'dd-MM-Y HH:mm:s')?>
                                            </span>
                                        </div>
                                        <!-- /.direct-chat-info -->
                                        <img class="direct-chat-img" src="/web<?=$elem->user->getPhoto()?>" alt="message user image">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            <?=$elem->message?>
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                    <!-- /.direct-chat-msg -->
                                <?php endif; ?>
                            <?php endforeach;?>
                        <?php endif; ?>
                    </div>
                    <!--/.direct-chat-messages-->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <?php $form = ActiveForm::begin(); ?>
                    <?=$form->field($model, 'message')
                        ->textarea([
                            'placeholder' => Yii::t('app', 'Input text'),
                            'class' => 'form-control',
                            'style' => 'width: 100%',
                            'rows' => 3
                        ])
                        ->label(false)
                    ?>
                    <button type="button" class="btn btn-primary btn-flat" style="float:right" onClick="sendBtn()">
                        <?=Yii::t('app', 'Send')?>
                    </button>
                    <?php ActiveForm::end(); ?>
                </div>
                <!-- /.box-footer-->
            </div>
        </div>
    </div>
</div>

<script>

    function checkMsg(){
        var blockPrevHeight = $('#block').scrollTop();
        console.log(blockPrevHeight);

        $.ajax({
            url: '<?=\yii\helpers\Url::to(['/chat/start', 'id' => $user->id])?>',
            method: 'POST',
            data: {pos: pos},
            success: function(msg){
                $('.box-body').html($('.box-body', msg));
                $('#block').scrollTop(blockPrevHeight);
            }
        })
    }

    function sendBtn(){
        event.preventDefault();
        var msg = $('#chat-message').val();
        $.ajax({
            url: '<?=\yii\helpers\Url::to(['/chat/send-msg'])?>',
            method: 'POST',
            data: {'Chat[message]':msg, 'Chat[send_user_id]': <?=$user->id?>},
            success: function(msg){
                $('.chat-start').html(msg);
                var block = document.getElementById("block");
                block.scrollTop = block.scrollHeight;
            }
        });
    }

    var pos = 10; // limit of record

    function preloader(){
        event.preventDefault();
        var blockPrevHeight = document.getElementById("block").scrollHeight;

        $.ajax({
            url: '<?=\yii\helpers\Url::to(['/chat/start', 'id' => $user->id])?>',
            method: 'POST',
            data: {pos: pos},
            success: function(msg){
                pos = pos + 5;
                $('.box-body').html($('.box-body', msg));
                var block = document.getElementById("block");
                block.scrollTop = block.scrollHeight - blockPrevHeight;
            }
        })
    }

    $(document).ready(function(){
        var chat = <?=count($chat)?>;
        if(chat == 0){
            $('.box-body').hide();
        }
        else {
            $('.box-body').show();
            var block = document.getElementById("block");
            block.scrollTop = block.scrollHeight;
        }

        setInterval(function(){
            checkMsg();
        }, 7000);
    })
</script>