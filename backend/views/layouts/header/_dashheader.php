<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

?>
<div class="header-wrapper dash" style="">
    

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?= Breadcrumbs::widget([
                    'homeLink' => ['label' => 'Početna', 'url' => '/user/security/home'],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'encodeLabels' => false,
                ]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
               <div class="card_container record-full grid-item transparent no-shadow no-margin fadeInUp animated" id="">
                    <div class="primary-context ">
                        <div class="head grand"><i class="fa fa-shield"></i> <?= c($model->engineer->name) ?>
                            <div class="subaction">
                            <?php if($model->engineer): ?>
                                <?= (\Yii::$app->user->can('updateOwnEngineerProfile', ['engineer'=>$model->engineer])) ? Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Podesi'), ['/engineers/update', 'id' => $model->engineer->user_id], ['class' => 'btn btn-success btn-sm shadow' ]) : null ?>
                            <?php elseif($model->client): ?>
                                <?= (\Yii::$app->user->can('updateOwnClient', ['client'=>$model->client])) ? Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Podesi'), ['update', 'id' => $model->client->user_id], ['class' => 'btn btn-success btn-sm shadow' ]) : null ?>
                            <?php endif; ?>
                            </div>
                        </div>
                        <div class="subhead">@<?= $model->username ?>: 
                            <?= \Yii::$app->user->engineer ? '<div class="label label-success fs_12 regular"><i class="fa fa-check"></i> inženjer</div>' : null ?>
                            <?= \Yii::$app->user->client ? '<div class="label label-primary fs_12 regular"><i class="fa fa-check"></i> investitor</div>' : null ?>                               
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>