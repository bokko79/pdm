<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;

?>
<div class="card_container record-full grid-item no-margin no-padding no-shadow" id="future">
    <div class="secondary-context no-padding">
        <ul class="index-menu">
        <?php if($developments = $model->project->projectLotFutureDevelopments){
            foreach($developments as $development){
                echo '<li>'.Html::a(c($development->buildingType->name.' '.$development->name), Url::to(['/project-lot-future-developments/update', 'id'=>$development->id]), ['class' => '', 'style'=>'']).'</li>';
            }
        } else {
            echo '<li>Nije unet nijedan predviđeni objekat.</li>';
            }
         ?>
        </ul>
    </div>
</div>