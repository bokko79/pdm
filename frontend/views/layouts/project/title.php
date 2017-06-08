<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\affix\Affix;

$title = $model->code. ': '.\yii\helpers\StringHelper::truncate($model->name, 50);
?>

<div class="title-row" style="margin-bottom: 0;">
    <div class="main-switch profile" style=""><ul><li></li></ul></div>
    <div class="main-title" style="">
        <div class="head-title" style=""><a href="/user/security/projects" style="color:black">Moji projekti</a></div>
        <div class="right ">
        	<ul>
        		<li><?= Html::a('<span class="glyphicon glyphicon-plus fs_20" aria-hidden="true"></span><span class="hidden-md" style="display:none;"> Novi projekat</span>', ['/projects/create'], ['class'=>' fs_9 bold', 'style'=>'']) ?></li>
        		<li><?= Html::a('<span class="glyphicon glyphicon-search fs_20" aria-hidden="true"></span><span class="hidden-md" style="display:none;"> Pretraga</span>', null, ['class'=>' fs_9 bold', 'style'=>'']) ?></li>
        	</ul>            
        </div>
    </div>
</div>