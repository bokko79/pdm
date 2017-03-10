<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;
use kartik\tabs\TabsX;


/* @var $this yii\web\View */
/* @var $model common\models\Projects */

$this->title = $model->code. ': '.$model->name. ' ('.$model->projectBuilding->spratnost.')';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projekti'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['project'] = $model;

$items = [
    [
        'label'=>'Opšti podaci',
        'content'=>$this->render('tabs/_general', ['model'=>$model]),
        'active'=>true
    ],
    /*[
        'label'=>'Tehnička dokumentacija',
        'content'=>$this->render('tabs/_volumes', ['model'=>$model]),
    ],*/
    [
        'label'=>'Investitori',
        'content'=>$this->render('tabs/_clients', ['model'=>$model]),
    ],
    [
        'label'=>'Dokumenti',
        'content'=>$this->render('tabs/_docs', ['model'=>$model]),
    ],
    ];
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <?php
                echo kartik\tabs\TabsX::widget([
                    'items'=>$items,
                    'position'=>TabsX::POS_LEFT,
                    'encodeLabels'=>false,
                ]);
            ?>
        </div>  
    </div>
</div>