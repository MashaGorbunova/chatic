<?php

use yii\helpers\Html;

?>

<div class="container">
    <div class="row" style="margin-top: 30px">
        <div class="col-md-12">
            <?=Html::label(Yii::t('app', 'Введите n-й член ряда Фибоначчи'))?>:
            <?=Html::textInput('text-number', '', ['type' => 'number'])?>
            <div id="result"></div>
        </div>
    </div>
</div>


<script>

    $('input[type=number]').change(function(){
        var n = $(this).val();
        fibonacchiRow(n);
    });

    var n = prompt('n');
    if(n != null){
        fibonacchiRow(n);
    }

    function fibonacchiRow(n){
        var n0 = 0;
        var n1 = 1;
        var result;

        if(n == 0) {
            result = 0;
        }
        else if (n == 1){
            result = 1;
        }
        else {
            for (i=2; i<=n; i++){
                result = n0+n1;
                n0 = n1;
                n1 = result;
            }
        }

        $('#result').html(result);
    }


</script>
