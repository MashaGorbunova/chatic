<?php
require_once(\Yii::getAlias('@app/components/phpQuery.php'));

$this->title = Yii::t('app', 'History');
$this->params['breadcrumbs'][] = $this->title;

if(Yii::$app->language == 'en'){
    $document = \phpQuery::newDocument(file_get_contents('http://ipt.kpi.ua/en/history'));
}
else $document = \phpQuery::newDocument(file_get_contents('http://ipt.kpi.ua/istoriya'));

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            foreach($document->find('.content-wrapper') as $key=> $div){
                if($key==2){
                    echo pq($div)->html();
                }
            }?>
        </div>
    </div>
</div>



