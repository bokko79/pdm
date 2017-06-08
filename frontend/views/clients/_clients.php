<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;

?>
<div class="card_container record-full grid-item no-margin no-padding no-shadow" id="existing">
    <div class="primary-context gray normal">
        <div class="head third">
            <div class="subaction"><?= Html::a('<i class="fa fa-plus fa-2x"></i>', Url::to(['/clients/create']), ['class' => 'btn btn-link']) ?></div>
            Investitori firme
        </div>
        <div class="subhead">Lista investitora moje firme.
        </div>
    </div>
    <div class="secondary-context no-padding">
        <ul class="index-menu">
        <?php if($clients = $model->clients){
            foreach($clients as $client){
                echo '<li>'.Html::a($client->name.'<div class="subtext">'.$client->location->city->town.'</div>', Url::to(['/clients/update', 'id'=>$client->id]), ['class' => '', 'style'=>'']).'</li>';
            }
        } else {
            echo '<li>Nije unet nijedan investitor firme.</li>';
            } ?>
        </ul>
    </div>
</div>