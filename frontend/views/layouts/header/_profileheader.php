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
<div class="header-wrapper profile" style="">
    

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
               <div class="card_container record-full grid-item transparent no-shadow no-margin fadeInUp animated" id="">
                    <div class="primary-context normal">
                        <div class="head grand thin"><i class="fa fa-file-powerpoint-o"></i> <?= c($model->name) ?>
                            <div class="action-area normal-case"><?= Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Podesi'), ['update', 'id' => $model->id], ['class' => 'btn btn-success btn-sm shadow' ]) ?>
                            </div>
                        </div>
                        <div class="subhead">Profil inženjera.</div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>