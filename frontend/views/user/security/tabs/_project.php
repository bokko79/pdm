<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
$building = $model->projectBuilding ? $model->projectBuilding : $model->projectExBuilding;
?>

<div class="card_container record-full grid-item no-margin no-shadow" id="card_container">
    <a href="<?= Url::to(['/user/security/projects', 'id'=>$model->id]) ?>">
        <div class="secondary-context" style="border-bottom:1px solid #ddd; ">
            <div class="row">
                <div class="col-sm-2">                
                    <?= $model->getAvatar(105,90) ?>
                </div>
            
                <div class="col-sm-10">     
                    <div class="subaction" style="">
                        <?= $model->code ?>
                    </div> 
                    <div class="subhead" style="">
                        <?= $model->client->name ?>
                    </div>              
                    <div class="head major">
                        <?= \yii\helpers\StringHelper::truncate($model->name, 80) ?><br>
                        <div class="label label-<?= $model->status=='active' ? 'success' : 'danger' ?> fs_11 thin"><?= $model->status=='active' ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' ?></div>
                        <div class="label label-<?= $model->visible ? 'success' : 'default' ?> fs_11 thin"><?= $model->visible ? '<i class="fa fa-eye"></i>' : '<i class="fa fa-eye-slash"></i>' ?></div>
                    </div>
                    <div class="subhead" style="margin-top:10px;">
                        <i class="fa fa-globe"></i>&nbsp;<?= $model->location->city->town ?>
                    </div>
                    
                </div>               
            </div>
            <div class="row muted" style="margin-top:10px;">
                <div class="col-sm-10 col-sm-offset-2">
                    <i class="fa fa-home"></i>&nbsp;<?= $model->projectBuilding ? $model->projectBuilding->name : $model->projectExBuilding->name ?>
                </div>
            </div>
                            
        </div>    
    </a>
</div>