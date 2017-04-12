<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\editable\Editable;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuilding */

$this->title = c($modelCheck->name) . ': ' . $modelCheck->state;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projekat'), 'url' => ['/projects/view', 'id'=>$modelCheck->project_id]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['project'] = $modelCheck->project;


if($modelCheck->project->work=='dogradnja' or $modelCheck->project->work=='sanacija' or $modelCheck->project->work=='rekonstrukcija'){
    $items = [
        [
            'label'=>'Opšti podaci',
            'content'=>$this->render('tabs/_general', ['modelCheck'=>$modelCheck, 'model'=>$model, 'model_new'=>$model_new]),
            'active'=>true
        ],
       /* [
            'label'=>'Etaže i prostorije',
            'content'=>$this->render('tabs/_storeys', ['modelCheck'=>$modelCheck, 'model'=>$model, 'projectBuildingStoreys'=>$projectBuildingStoreys]),
        ],*/
        [
            'label'=>'Klase',
            'content'=>$this->render('tabs/_classes', ['modelCheck'=>$modelCheck, 'model'=>$model, 'model_new'=>$model_new, 'projectBuildingClasses'=>$projectBuildingClasses, 'projectBuildingClasses_new'=>$projectBuildingClasses_new]),
        ],
        [
            'label'=>'Visine',
            'content'=>$this->render('tabs/_heights', ['modelCheck'=>$modelCheck, 'model'=>$model, 'model_new'=>$model_new, 'projectBuildingHeights'=>$projectBuildingHeights, 'projectBuildingHeights_new'=>$projectBuildingHeights_new]),
        ],
       /* [
            'label'=>'Delovi',
            'content'=>$this->render('tabs/_parts', ['modelCheck'=>$modelCheck, 'model'=>$model, 'projectBuildingParts'=>$projectBuildingParts]),
        ],*/
        [
            'label'=>'Arhitektura',
            'content'=>$this->render('tabs/_characteristics', ['modelCheck'=>$modelCheck, 'model'=>$model, 'model_new'=>$model_new]),
        ],
        [
            'label'=>'Konstrukcija',
            'content'=>$this->render('tabs/_structure', ['modelCheck'=>$modelCheck, 'model'=>$model, 'model_new'=>$model_new]),
        ],
        [
            'label'=>'Materijali',
            'content'=>$this->render('tabs/_materials', ['modelCheck'=>$modelCheck, 'model'=>$model, 'model_new'=>$model_new]),
        ],
        [
            'label'=>'Izolacije',
            'content'=>$this->render('tabs/_insulations', ['modelCheck'=>$modelCheck, 'model'=>$model, 'model_new'=>$model_new]),
        ],
        [
            'label'=>'Instalacije',
            'content'=>$this->render('tabs/_services', ['modelCheck'=>$modelCheck, 'model'=>$model, 'model_new'=>$model_new]),
        ],
    ];
} else if($modelCheck->project->work=='adaptacija') {
    $items = [
        [
            'label'=>'Opšti podaci',
            'content'=>$this->render('tabs/_general', ['modelCheck'=>$modelCheck, 'model'=>$model]),
            'active'=>true
        ],       
        [
            'label'=>'Arhitektura',
            'content'=>$this->render('tabs/_characteristics', ['modelCheck'=>$modelCheck, 'model'=>$model]),
        ],     
    ];
} else {
    $items = [
        [
            'label'=>'Opšti podaci',
            'content'=>$this->render('tabs/_general', ['modelCheck'=>$modelCheck, 'model'=>$model]),
            'active'=>true
        ],
       /* [
            'label'=>'Etaže i prostorije',
            'content'=>$this->render('tabs/_storeys', ['modelCheck'=>$modelCheck, 'model'=>$model, 'projectBuildingStoreys'=>$projectBuildingStoreys]),
        ],*/
        [
            'label'=>'Klase',
            'content'=>$this->render('tabs/_classes', ['modelCheck'=>$modelCheck, 'model'=>$model, 'projectBuildingClasses'=>$projectBuildingClasses]),
        ],
        [
            'label'=>'Visine',
            'content'=>$this->render('tabs/_heights', ['modelCheck'=>$modelCheck, 'model'=>$model, 'projectBuildingHeights'=>$projectBuildingHeights]),
        ],
       /* [
            'label'=>'Delovi',
            'content'=>$this->render('tabs/_parts', ['modelCheck'=>$modelCheck, 'model'=>$model, 'projectBuildingParts'=>$projectBuildingParts]),
        ],*/
        [
            'label'=>'Arhitektura',
            'content'=>$this->render('tabs/_characteristics', ['modelCheck'=>$modelCheck, 'model'=>$model]),
        ],
        [
            'label'=>'Konstrukcija',
            'content'=>$this->render('tabs/_structure', ['modelCheck'=>$modelCheck, 'model'=>$model]),
        ],
        [
            'label'=>'Materijali',
            'content'=>$this->render('tabs/_materials', ['modelCheck'=>$modelCheck, 'model'=>$model]),
        ],
        [
            'label'=>'Izolacije',
            'content'=>$this->render('tabs/_insulations', ['modelCheck'=>$modelCheck, 'model'=>$model]),
        ],
        [
            'label'=>'Instalacije',
            'content'=>$this->render('tabs/_services', ['modelCheck'=>$modelCheck, 'model'=>$model]),
        ],
        
    ];
}
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
                        'style' => 'width:100%;min-height:390px;',
                    ],
                ]);
            ?>
        </div>  
    </div>
</div>