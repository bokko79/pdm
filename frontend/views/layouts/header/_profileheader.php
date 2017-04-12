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
<div class="header-wrapper profile" style="<?= $model->cFile ? 'background: url(\'/images/profiles/'.$model->cFile->name.'\');' : 'background: url(\'/images/profiles/back.jpg\');' ?> background-size: cover;">
<div style="background: rgba(0,0,0,.3);">
    

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'options' => ['class'=>'transparent breadcrumb']
                ]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card_container record-full transparent no-shadow fadeInUp animated" id="card_container" style="">
                    <div class="primary-context overflow-hidden low-margin">
                        <div class="avatar60 round">
                            <?= ($model->aFile) ? Html::img('/images/profiles/'.$model->aFile->name, ['style'=>'max-height:180px;']) : Html::img('/images/profiles/back.jpg', ['style'=>'max-height:180px;']) ?>
                        </div>
                        <div class="title">
                            <div class="head colos regular" style="line-height: 22px; color: white; text-shadow: 1px 1px 3px #000">
                                <?= c($model->name) ?>
                                <span class="fs_11 muted">[<?= $model->email ?>]</span> 
                            </div>
                            <div class="subhead" style="line-height: 22px; color: #eee; text-shadow: 1px 1px 3px #000">
                                
                                <?= (1==1) ? '<div class="label label-success fs_11 thin"><i class="fa fa-check"></i> '.$model->expertees->name.'</div>' : null ?>
                            </div>
                        </div>
                        <div class="subaction">
                            <?= (\Yii::$app->user->can('updateOwnEngineerProfile', ['engineer'=>$model])) ? Html::a(Yii::t('app', '<i class="fa fa-cogs"></i> Podesi profil'), ['update', 'id' => $model->user_id], ['class' => 'btn btn-default btn-sm ' ]) : null ?>           
                        </div>          
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>
</div>