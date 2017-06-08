<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Nav;

$items = [];
$items[] = ['label' => 'Sve sveske', 'url' =>['/project-volumes/index', 'ProjectVolumes[project_id]'=>$model->id], 'linkOptions'=>['style'=>'font-size:15px;']];
$items[] = '<li class="divider"></li>';
if($volumes = $model->projectVolumes){
    foreach($volumes as $volume){
        /*if($volume->volume_id==1) { 
            $sveska = 'glavna-sveska'; 
        } elseif($volume->volume_id==17) { 
            $sveska = 'izvod'; 
        } elseif($volume->volume_id==19) { 
            $sveska =  'ozakonjenje'; 
        } else { 
            $sveska = 'projekat'; 
        }*/

        $subitems = [];
        /*$subitems[] = ['label' => ($volume->number ? $volume->number. '. ' : ''). c($volume->name), 'url' =>['/project-volumes/view', 'id'=>$volume->id]];
        $subitems[] = ['label' => '<i class="fa fa-cog"></i> Podešavanje', 'url' =>['/project-volumes/update', 'id'=>$volume->id]];
        /*$subitems[] = '<li class="divider"></li>';
        $subitems[] = ['label' => '<i class="fa fa-image"></i> Crteži', 'url' =>['/project-volumes/view', 'id'=>$volume->id, '#'=>'w2-tab1']];*/
        /*$subitems[] = '<li class="divider"></li>';
        $subitems[] = $volume->volume_id!=18 ? ['label' => '<i class="fa fa-print"></i> PDF sveske', 'url' =>['/site/'.$sveska, 'id'=>$model->id, 'volume'=>$volume->id], 'linkOptions'=>['target'=>'_blank']] : '';*/

        $items[] = ['label' => (!$volume->dataRequirement($volume->dataReqs()) ? '<i class="fa fa-warning red"></i> ' : '').($volume->number ? $volume->number. '. ' : '').c($volume->name), 'items'=>$subitems, 'url' =>['/project-volumes/view', 'id'=>$volume->id]];                            
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