<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use kartik\affix\Affix;

$title = $model->code. ': '.\yii\helpers\StringHelper::truncate($model->name, 50);

$links = [
        ['label' => Yii::t('app', 'Moji projekti'), 'url' => ['/user/security/home']],
        ['label' => $title, 'url' => ['/projects/view', 'id' => $model->id]],
    ];

if(isset($this->params['breadcrumbs'])){
    $links = array_merge($links, $this->params['breadcrumbs']);
};
?>
    <div class="col-sm-12">
        <?= Breadcrumbs::widget([
                'homeLink' => ['label' => \Yii::$app->user->can('updateOwnProject', ['project'=>$model]) ? '@'.Yii::$app->user->username : 'Početna', 'url' => \Yii::$app->user->can('updateOwnProject', ['project'=>$model]) ? '/user/security/home' : Yii::$app->getHomeUrl()],
                
                'links' => $links, 
                //'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'encodeLabels' => false,
            ]) ?>
    </div>