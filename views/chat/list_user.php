<?php

use yii\widgets\ListView;

?>

<div class="list-user">
    <div class="box box-default">
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
