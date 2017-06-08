<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

?>

<div class="card_container record-full grid-item no-margin top-bordered" id="card_container">
    <a href="<?= Url::to(['/engineers/view', 'id'=>$model->engineer->user_id]) ?>">
        <div class="secondary-context">
            <div class="row">
                <div class="col-sm-2">                
                    <?= $model->engineer->user->aFile ? Html::img('@web/images/profiles/'.$model->engineer->user->aFile->name,['style'=>'border-radius: 50%; width:60px; height:60px;']) : Html::img('@web/images/no_pic_image.png', ['style'=>'border-radius: 30px; height:60px; width:60px;']) ?>
                </div>
            
                <div class="col-sm-10">     
                    <div class="subaction" style="">
                        @<?= $model->position ?>
                        
                    </div>               
                    <div class="head major">
                        <?= \yii\helpers\StringHelper::truncate($model->engineer->name, 40) ?> <?= ($model->status=='joined') ? '<div class="label label-success fs_11 thin"><i class="fa fa-check"></i></div>' : null ?>
                    </div>
                    <div class="subhead" style="">
                        <?= $model->engineer->expertees->name ?>
                    </div>
                </div>               
            </div>

            <div class="row muted" style="">
                <div class="col-sm-10 col-sm-offset-2">
                    <?= \yii\helpers\StringHelper::truncate($model->engineer->about, 240) ?>
                </div>
            </div>                             
        </div>    
    </a>
</div>