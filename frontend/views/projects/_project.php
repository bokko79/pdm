<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

?>

<div class="card_container record-33 grid-item fadeInUp animated" id="card_container">
    <a href="<?= Url::to(['/projects/view', 'id'=>$model->id]) ?>">
        <div class="media-area">                
            <div class="image">
                <?= $model->getAvatar(312,176) ?>                    
            </div>
        </div>
        <div class="primary-context">
            <div class="subhead"><?= $model->client->name ?></div>
            <div class="head major"><?= \yii\helpers\StringHelper::truncate($model->name, 32) ?></div>
            <div class="subhead"><?= $model->projectBuilding ? $model->projectBuilding->name : $model->projectExBuilding->name ?></div>
        </div>
        <div class="secondary-context cont">
            <div><i class="fa fa-globe"></i>&nbsp;<?= $model->location->city->town ?></div>            
        </div>
    </a>
</div>