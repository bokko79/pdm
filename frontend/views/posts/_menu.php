<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Nav;

$items = [];
$items[] = ['label' => 'Info Home', 'url' =>['/posts/index']];
$items[] = '<li class="divider"></li>';
    foreach(\common\models\PostCategories::find()->all() as $pc){

        $subitems = [];
        if($pc->parent == 'root'){
            /*$subitems[] = ['label' => ($volume->number ? $volume->number. '. ' : ''). c($volume->name), 'url' =>['/project-volumes/view', 'id'=>$volume->id]];
            $subitems[] = ['label' => '<i class="fa fa-cog"></i> Podešavanje', 'url' =>['/project-volumes/update', 'id'=>$volume->id]];
           
            $subitems[] = '<li class="divider"></li>';
            $subitems[] = $volume->volume_id!=18 ? ['label' => '<i class="fa fa-print"></i> PDF sveske', 'url' =>['/site/'.$sveska, 'id'=>$model->id, 'volume'=>$volume->id], 'linkOptions'=>['target'=>'_blank']] : '';*/

            $items[] = ['label' => c($pc->category), /*'items'=>$subitems,*/ 'url' =>['/posts/index', 'PostsSearch[category_id]'=>$pc->id]];   
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