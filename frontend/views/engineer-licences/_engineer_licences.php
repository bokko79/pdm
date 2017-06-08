<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;

$model = \common\models\Engineers::findOne(Yii::$app->user->id);
?>
<div class="card_container record-full grid-item no-margin no-padding no-shadow" id="existing">
    <div class="primary-context gray normal">
        <div class="head third">
            <div class="subaction"><?= Html::a('<i class="fa fa-plus fa-2x"></i>', Url::to(['/engineer-licences/create', 'EngineerLicencesSearch[engineer_id]'=>$model->user_id]), ['class' => 'btn btn-link']) ?></div>
            Licencni paketi
        </div>
        <div class="subhead">Licencni paketi inženjera.
        </div>
    </div>
    <div class="secondary-context no-padding">
        <ul class="index-menu">
        <?php if($engineerLicences = $model->engineerLicences){
            foreach($engineerLicences as $engineerLicence){
                echo '<li>'.Html::a($engineerLicence->no.'<div class="subtext">'.$engineerLicence->licence->name.'</div>', Url::to(['/engineer-licences/update', 'id'=>$engineerLicence->id]), ['class' => '', 'style'=>'']).'</li>';
            }
        } else {
            echo '<li>Nije unet nijedan licencni paket.</li>';
            } ?>
        </ul>
    </div>
</div>