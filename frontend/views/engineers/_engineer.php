<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

?>

<div class="card_container record-33 grid-item fadeInUp animated" id="card_container" style="float:none;">
    <a href="<?= Url::to(['/engineers/view', 'id'=>$model->user_id]) ?>">
        <div class="media-area" style="height:255px !important;">                
            <div class="image">
                <?= $model->aFile ? Html::img('@web/images/profiles/'.$model->aFile->name,['style'=>'max-height:255px;']) : Html::img('@web/images/no_pic_image.png', ['style'=>'max-height:255px;']) ?>                    
            </div>
        </div>
        <div class="primary-context normal">
            <div class="head major"><?= \yii\helpers\StringHelper::truncate($model->name, 40) ?></div>
            <div class="subhead"><?= $model->expertees->name ?></div>
        </div>
    </a>
</div>