<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

?>

<div class="card_container record-full transparent list-item no-border" id="card_container" style="float:none;">
    <a href="<?= Url::to(['/projects/view?id='.$model->id]) ?>">
        <div class="header-context" style="padding: 16px 0">                
            <div class="avatar" style="width:20%">
                <?= $model->getAvatar(51,51) ?> 
            </div>
            <div class="title" style="width:80%">
                <div class="head second" style="color:#555;"><?= \yii\helpers\StringHelper::truncate($model->name, 60) ?></div>
                <div class="subhead hint"><?= $model->client->name ?></div> 
            </div>
        </div>
    </a>
</div>