<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

?>

<div class="card_container record-full transparent list-item no-border" id="card_container" style="float:none;">
    <a href="<?= Url::to(['/posts/view?id='.$model->id]) ?>">
        <div class="header-context" style="padding: 16px 0">                
            <div class="avatar round" style="width:20%">
                <?= $model->file ? Html::img('/images/posts/'.$model->file->name,['style'=>'height:51px; width:51px; border-radius:26px;']) : Html::img('@web/images/no_pic_image.png', ['style'=>'height:51px; width:51px; border-radius:26px;']) ?>
            </div>
            <div class="title" style="width:80%">
                <div class="head second" style="color:#555;"><?= \yii\helpers\StringHelper::truncate($model->title, 60) ?></div>
                <div class="subhead hint"><?= HtmlPurifier::process($model->subtitle) ?></div> 
            </div>
        </div>
    </a>
</div>