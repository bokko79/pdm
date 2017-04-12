<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectLot */

$this->title = 'Parcela projekta';
$this->params['breadcrumbs'][] = ['label' => $model->project->code. ': Projekat', 'url' => ['/projects/view', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['project'] = $model->project;

$items = [
    [
        'label'=>'Adresa i lokacija projekta',
        'content'=>$this->render('tabs/_location', ['model'=>$model]),
        'active'=>true
    ],
    [
        'label'=>'Opšti podaci parcele',
        'content'=>$this->render('tabs/_general', ['model'=>$model]),
    ],
    [
        'label'=>'Katastarske parcele',
        'content'=>$this->render('tabs/_lots', ['model'=>$model]),
    ],
    [
        'label'=>'Postojeći objekti',
        'content'=>$this->render('tabs/_existing', ['model'=>$model]),
    ],
    [
        'label'=>'Predviđeni objekti',
        'content'=>$this->render('tabs/_future', ['model'=>$model]),
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
                    'containerOptions'=>[
                        'style' => 'width:100%;',
                    ],
                ]);
            ?>
        </div>  
    </div>
</div>
