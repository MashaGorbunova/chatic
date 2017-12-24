<?php

use yii\widgets\ListView;

/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users for chat');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="list-user">
    <div class="row">
        <div class="col-md-10">
            <div class="box box-default">
                <div class="box-header with-border">

                </div>
                <div class="box-body">
                    <?=
                    ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemView' => '_user'
                    ])
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
