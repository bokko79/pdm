<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Nav;

$items = [];
$items[] = ['label' => 'Sve pozicije', 'url' =>['/project-qs/index', 'ProjectQs[project_id]'=>$model->id]];
$items[] = '<li class="divider"></li>';
if($works = \common\models\QsWorks::find()->all()){
    foreach($works as $work){
        $subitems = [];
        $items[] = ['label' => count($work->posOfProject($model->id))>0 ? c($work->name). ' ('.count($work->posOfProject($model->id)).')' : '<span class="hint"><i>'.c($work->name).'</i></span>', 'url' =>['/project-qs/works', 'p'=>$model->id, 'w'=>$work->id]];

                                    
    }
}
?>
<?php
    echo Nav::widget([
        'options'=>['class'=>'nav nav-pills nav-stacked', 'style'=>'z-index:10000; width:100%; text-align: right; text-transform: uppercase'],
        'encodeLabels' => false,
        'items' => $items,
    ]);
?>