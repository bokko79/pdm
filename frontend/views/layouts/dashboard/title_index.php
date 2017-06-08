<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="title-row" style="">
    <div class="main-switch profile" style=""><ul><li><?= Html::a(Yii::$app->user->avatar, ['/home'], ['class'=>'img-round', 'style'=>'']) ?></li></ul></div>
    <div class="main-title" style="">
        <div class="card_container no-margin transparent no-shadow" style="padding-top:10px; text-transform: lowercase;">
            <div class="primary-context no-margin  no-padding">
                <div class="head third">                          

                    <a href="/home" class=""><?= Yii::$app->user->username ?></a>
                    <div class="subhead">
                        <?= '<div class="fs_9 regular label label-info">'.Yii::$app->user->role.'</div>' ?> @ <?= Yii::$app->user->email ?>
                    </div>
                </div>                            
            </div>
        </div>
        <div class="right">
            <ul>
                <li><?= Html::a('<span class="fa fa-cog fa-2x"></span><span class="hidden-md" style="display:none;"> Podešavanje</span>', ['/user/settings/account'], ['class'=>' fs_9 bold', 'style'=>'']) ?></li>
                <li><?= Html::a('<span class="fa fa-power-off fa-2x"</span><span class="hidden-md" style="display:none;"> Odjava</span>', ['/site/logout'], ['class'=>' fs_9 bold', 'style'=>'', 'data'=>['method'=>'post']]) ?></li>
            </ul>             
        </div>
    </div>
</div>