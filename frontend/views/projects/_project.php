<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
$practice = $model->practice;
?>

<div class="card_container record-33 grid-item" id="card_container">
    
        <div class="header-context">                
            <div class="avatar round">
                <?= ($practice->aFile) ? Html::img('/images/profiles/'.$practice->aFile->name, ['style'=>'']) : Html::img('/images/no_pic_image.png', ['style'=>'']) ?>       
            </div>
            <div class="subaction">
                <div class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-link" style="color:#999"><i class="fa fa-ellipsis-v"></i></a>
                        <?php
                            echo \yii\bootstrap\Dropdown::widget([
                                'encodeLabels' => false,
                                'items' => [
                                    ['label' => '<i class="fa fa-shield"></i> '.Yii::t('user', 'Poseti profil firme'), 'url' => ['/practices/view', 'id'=>$model->practice_id]],
                                    ['label' => '<i class="fa fa-sign-out"></i> '.Yii::t('user', 'Detalji projekta'), 'url' => ['/projects/view', 'id'=>$model->id]],                                        
                                ],
                                'options' => [
                                    'class' => 'dropdown-menu-right',
                                ],
                            ]);
                        ?>
                    </div>
            </div>
            <div class="title" style="float:none; margin-left: 32px; ">
                <div class="head second"><?= \yii\helpers\StringHelper::truncate($practice->name, 18) ?></div>
                <div class="subhead"><?= $practice->location->city->town ?></div> 
            </div>
            
        </div>
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