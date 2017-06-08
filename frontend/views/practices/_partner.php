<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

$partner = $model->practice_id!=$practice->engineer_id ? $model->practice : $model->partner;
?>

<div class="card_container record-full grid-item no-margin top-bordered" id="card_container">
        <div class="secondary-context">
            <div class="row">
                <div class="col-sm-2">                
                    <?= $partner->aFile ? Html::img('/images/profiles/'.$partner->aFile->name,['style'=>'border-radius: 30px; height:60px; width:60px;']) : Html::img('@web/images/no_pic_image.png', ['style'=>'border-radius: 30px; height:60px; width:60px;']) ?>
                </div>
            
                <div class="col-sm-10">
                    <div class="subaction" style="">
                        <?= Html::a(Yii::t('app', 'Profil firme'). '&nbsp;<i class="fa fa-arrow-circle-right"></i>', Url::to(['/practices/view?id='.$partner->engineer_id]), ['class'=>'btn btn-default btn-sm shadow', 'style'=>'']) ?>
                    </div>               
                    <div class="head major">
                        <?= Html::a(\yii\helpers\StringHelper::truncate($partner->name, 32), Url::to(['/practices/view?id='.$partner->engineer_id]), ['class'=>'', 'style'=>'color:#555;']) ?>
                     
                    </div>
                    <div class="subhead" style="">
                        <?= HtmlPurifier::process($partner->location->city->town) ?>
                    </div>
                </div>               
            </div>

            <div class="row muted">
                <div class="col-sm-10 col-sm-offset-2">
                    <?= \yii\helpers\StringHelper::truncate($partner->about, 120) ?>
                </div>
            </div>                             
        </div>
</div>