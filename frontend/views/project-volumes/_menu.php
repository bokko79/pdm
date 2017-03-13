<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Nav;

$items = [];
$items[] = '<li class="dropdown-header">Sveske</li>';
if($volumes = $model->projectVolumes){
    foreach($volumes as $volume){
        if($volume->volume_id==1) { 
            $sveska = 'glavna-sveska'; 
          } elseif($volume->volume_id==17) { 
            $sveska = 'izvod'; 
          } elseif($volume->volume_id==19) { 
            $sveska =  'ozakonjenje'; 
          } else { 
            $sveska = 'projekat'; 
          }

        $subitems = [];
            $subitems[] = ['label' => '<i class="fa fa-warning red"></i> '.$volume->number. '. '. c($volume->volume->name), 'url' =>['/project-volumes/view', 'id'=>$volume->id]];
            $subitems[] = '<li class="divider"></li>';
            $subitems[] = $volume->volume_id!=18 ? ['label' => '<i class="fa fa-print"></i> PDF sveske', 'url' =>['/site/'.$sveska, 'id'=>$model->id, 'volume'=>$volume->id]] : '';
            $subitems[] = ['label' => 'Crteži i tablice', 'url' =>['/project-volumes/view', 'id'=>$volume->id, '#'=>'w2-tab1']];
            $items[] = ['label' => '<i class="fa fa-warning red"></i> '.$volume->number. '. '. c($volume->volume->name), 'items'=>$subitems, 'url' =>['/project-volumes/view', 'id'=>$volume->id]];        
                            
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