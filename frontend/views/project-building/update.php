<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\tabs\TabsX;

//if(!$model->building_line_dist) $model->building_line_dist = 0;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuilding */

$this->title = Yii::t('app', 'Izmeni {modelClass}: ', [
    'modelClass' => 'predmetni objekat',
]) . $modelCheck->name;
$this->params['breadcrumbs'][] = ['label' => $modelCheck->project->name, 'url' => ['projects/view', 'id' => $modelCheck->project_id]];
$this->params['breadcrumbs'][] = ['label' => $modelCheck->building->class, 'url' => ['view', 'id' => $modelCheck->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Izmeni');

$this->params['project'] = $modelCheck->project;
?>
<?php /*
    <h1><?= Html::encode($this->title) ?></h1> */ ?>

    <?php /* $this->render('_form', [
        'model' => $model,
        'model_new' => $model_new,
    ]) */ ?>
<?php
$form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal-project-building',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 12,      
   	'formConfig' => ['labelSpan' => 4, 'deviceSize' => ActiveForm::SIZE_SMALL],
    'options' => ['enctype' => 'multipart/form-data'],
]);
if($modelCheck->project->work=='dogradnja' or $modelCheck->project->work=='sanacija' or $modelCheck->project->work=='rekonstrukcija'){
$items = [
    [
        'label'=>'Opšti podaci',
        'content'=>$this->render('form_tabs/_general', ['modelCheck'=>$modelCheck, 'model'=>$building['existing'], 'model_new'=>$building['new'], 'form'=>$form]),
        'active'=>true
    ],
    [
        'label'=>'Numerički podaci',
        'content'=>$this->render('form_tabs/_numeric', ['modelCheck'=>$modelCheck, 'model'=>$building['existing'], 'model_new'=>$building['new'], 'form'=>$form]),
    ],
    [
        'label'=>'Klase',
        'content'=>$this->render('tabs/_classes', ['modelCheck'=>$modelCheck, 'model'=>$model, 'model_new'=>$building['new'], 'projectBuildingClasses'=>$projectBuildingClasses, 'projectBuildingClasses_new'=>$projectBuildingClasses_new]),
    ],
    [
        'label'=>'Visine',
        'content'=>$this->render('tabs/_heights', ['modelCheck'=>$modelCheck, 'model'=>$model, 'model_new'=>$building['new'], 'projectBuildingHeights'=>$projectBuildingHeights, 'projectBuildingHeights_new'=>$projectBuildingHeights_new]),
    ],
    [
        'label'=>'Karakteristike',
        'content'=>$this->render('form_tabs/_characteristics', ['modelCheck'=>$modelCheck, 'model'=>$building['existing'], 'model_new'=>$building['new'], 'form'=>$form]),
    ],
    [
        'label'=>'Dispozija i funkcija',
        'content'=>$this->render('form_tabs/_function', ['modelCheck'=>$modelCheck->projectBuildingCharacteristics, 'model'=>$architecture['existing'], 'model_new'=>$architecture['new'], 'form'=>$form]),
    ],
    [
        'label'=>'Položaj i oblik',
        'content'=>$this->render('form_tabs/_position', ['modelCheck'=>$modelCheck->projectBuildingCharacteristics, 'model'=>$architecture['existing'], 'model_new'=>$architecture['new'], 'form'=>$form]),
    ],
    [
        'label'=>'Arhitektonsko rešenje',
        'content'=>$this->render('form_tabs/_architecture', ['modelCheck'=>$modelCheck->projectBuildingCharacteristics, 'model'=>$architecture['existing'], 'model_new'=>$architecture['new'], 'form'=>$form]),
    ], 
    [
        'label'=>'Konstrukcija i temelji',
        'content'=>$this->render('form_tabs/_structure', ['modelCheck'=>$modelCheck->projectBuildingStructure, 'model'=>$structure['existing'], 'model_new'=>$structure['new'], 'form'=>$form]),
    ],
    [
        'label'=>'Zidovi i platna',
        'content'=>$this->render('form_tabs/_walls', ['modelCheck'=>$modelCheck->projectBuildingStructure, 'model'=>$structure['existing'], 'model_new'=>$structure['new'], 'form'=>$form]),
    ],
    [
        'label'=>'Ploče i međuspratne konstrukcije',
        'content'=>$this->render('form_tabs/_slabs', ['modelCheck'=>$modelCheck->projectBuildingStructure, 'model'=>$structure['existing'], 'model_new'=>$structure['new'], 'form'=>$form]),
    ],
    [
        'label'=>'Krov, stepenište i ostalo',
        'content'=>$this->render('form_tabs/_roof', ['modelCheck'=>$modelCheck->projectBuildingStructure, 'model'=>$structure['existing'], 'model_new'=>$structure['new'], 'form'=>$form]),
    ],
    [
        'label'=>'Spoljašnja obrada',
        'content'=>$this->render('form_tabs/_external', ['modelCheck'=>$modelCheck->projectBuildingMaterials, 'model'=>$materials['existing'], 'model_new'=>$materials['new'], 'form'=>$form]),
    ],
    [
        'label'=>'Unutrašnja obrada',
        'content'=>$this->render('form_tabs/_interior', ['modelCheck'=>$modelCheck->projectBuildingMaterials, 'model'=>$materials['existing'], 'model_new'=>$materials['new'], 'form'=>$form]),
    ],
    [
        'label'=>'Stolarija, bravarija i limarija',
        'content'=>$this->render('form_tabs/_doorwin', ['modelCheck'=>$modelCheck->projectBuildingMaterials, 'model'=>$materials['existing'], 'model_new'=>$materials['new'], 'form'=>$form]),
    ],
    [
        'label'=>'Nameštaj i sanitarije',
        'content'=>$this->render('form_tabs/_furniture', ['modelCheck'=>$modelCheck->projectBuildingMaterials, 'model'=>$materials['existing'], 'model_new'=>$materials['new'], 'form'=>$form]),
    ],
    [
        'label'=>'Izolacije',
        'content'=>$this->render('form_tabs/_insulations', ['modelCheck'=>$modelCheck->projectBuildingInsulations, 'model'=>$insulations['existing'], 'model_new'=>$insulations['new'], 'form'=>$form]),
    ],
    [
        'label'=>'Instalacije',
        'content'=>$this->render('form_tabs/_services', ['modelCheck'=>$modelCheck->projectBuildingServices, 'model'=>$services['existing'], 'model_new'=>$services['new'], 'form'=>$form]),
    ],
    ];
} else if($modelCheck->project->work=='adaptacija') {
$items = [
    [
        'label'=>'Opšti podaci',
        'content'=>$this->render('form_tabs/_general', ['modelCheck'=>$modelCheck, 'model'=>$building, 'form'=>$form]),
        'active'=>true
    ],
    [
        'label'=>'Numerički podaci',
        'content'=>$this->render('form_tabs/_numeric', ['modelCheck'=>$modelCheck,  'model'=>$building, 'form'=>$form]),
    ],
    [
        'label'=>'Funkcija',
        'content'=>$this->render('form_tabs/_function', ['modelCheck'=>$modelCheck->projectBuildingCharacteristics, 'model'=>$architecture, 'form'=>$form]),
    ],
    [
        'label'=>'Arhitektonsko rešenje',
        'content'=>$this->render('form_tabs/_architecture', ['modelCheck'=>$modelCheck->projectBuildingCharacteristics, 'model'=>$architecture, 'form'=>$form]),
    ],
    [
        'label'=>'Položaj i oblik',
        'content'=>$this->render('form_tabs/_position', ['modelCheck'=>$modelCheck->projectBuildingCharacteristics, 'model'=>$architecture, 'form'=>$form]),
    ],     
    ];
} else {
    $items = [
    [
        'label'=>'Opšti podaci',
        'content'=>$this->render('form_tabs/_general', ['modelCheck'=>$modelCheck, 'model'=>$building, 'form'=>$form]),
        'active'=>true
    ],
    [
        'label'=>'Numerički podaci',
        'content'=>$this->render('form_tabs/_numeric', ['modelCheck'=>$modelCheck,  'model'=>$building, 'form'=>$form]),
    ],
    [
        'label'=>'Klase',
        'content'=>$this->render('tabs/_classes', ['modelCheck'=>$modelCheck, 'model'=>$modelCheck, 'projectBuildingClasses'=>$projectBuildingClasses]),
    ],
    [
        'label'=>'Visine',
        'content'=>$this->render('tabs/_heights', ['modelCheck'=>$modelCheck, 'model'=>$modelCheck, 'projectBuildingHeights'=>$projectBuildingHeights]),
    ],
    [
        'label'=>'Karakteristike',
        'content'=>$this->render('form_tabs/_characteristics', ['modelCheck'=>$modelCheck, 'model'=>$building, 'form'=>$form]),
    ],
    [
        'label'=>'Dispozija i funkcija',
        'content'=>$this->render('form_tabs/_function', ['modelCheck'=>$modelCheck->projectBuildingCharacteristics, 'model'=>$architecture, 'form'=>$form]),
    ],
    [
        'label'=>'Položaj i oblik',
        'content'=>$this->render('form_tabs/_position', ['modelCheck'=>$modelCheck->projectBuildingCharacteristics, 'model'=>$architecture, 'form'=>$form]),
    ],
    [
        'label'=>'Arhitektonsko rešenje',
        'content'=>$this->render('form_tabs/_architecture', ['modelCheck'=>$modelCheck->projectBuildingCharacteristics, 'model'=>$architecture, 'form'=>$form]),
    ], 
    [
        'label'=>'Konstrukcija i temelji',
        'content'=>$this->render('form_tabs/_structure', ['modelCheck'=>$modelCheck->projectBuildingStructure, 'model'=>$structure, 'form'=>$form]),
    ],
    [
        'label'=>'Zidovi i platna',
        'content'=>$this->render('form_tabs/_walls', ['modelCheck'=>$modelCheck->projectBuildingStructure, 'model'=>$structure, 'form'=>$form]),
    ],
    [
        'label'=>'Ploče i međuspratne konstrukcije',
        'content'=>$this->render('form_tabs/_slabs', ['modelCheck'=>$modelCheck->projectBuildingStructure, 'model'=>$structure, 'form'=>$form]),
    ],
    [
        'label'=>'Krov, stepenište i ostalo',
        'content'=>$this->render('form_tabs/_roof', ['modelCheck'=>$modelCheck->projectBuildingStructure, 'model'=>$structure, 'form'=>$form]),
    ],
    [
        'label'=>'Spoljašnja obrada',
        'content'=>$this->render('form_tabs/_external', ['modelCheck'=>$modelCheck->projectBuildingMaterials, 'model'=>$materials, 'form'=>$form]),
    ],
    [
        'label'=>'Unutrašnja obrada',
        'content'=>$this->render('form_tabs/_interior', ['modelCheck'=>$modelCheck->projectBuildingMaterials, 'model'=>$materials, 'form'=>$form]),
    ],
    [
        'label'=>'Stolarija, bravarija i limarija',
        'content'=>$this->render('form_tabs/_doorwin', ['modelCheck'=>$modelCheck->projectBuildingMaterials, 'model'=>$materials, 'form'=>$form]),
    ],
    [
        'label'=>'Nameštaj i sanitarije',
        'content'=>$this->render('form_tabs/_furniture', ['modelCheck'=>$modelCheck->projectBuildingMaterials, 'model'=>$materials, 'form'=>$form]),
    ],
    [
        'label'=>'Izolacije',
        'content'=>$this->render('form_tabs/_insulations', ['modelCheck'=>$modelCheck->projectBuildingInsulations, 'model'=>$insulations, 'form'=>$form]),
    ],
    [
        'label'=>'Instalacije',
        'content'=>$this->render('form_tabs/_services', ['modelCheck'=>$modelCheck->projectBuildingServices, 'model'=>$services, 'form'=>$form]),
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
                        'style' => 'width:100%;min-height:570px;',
                    ],
                ]);
            ?>
        </div>  
    </div>
    <div class="row"">

        <div class="col-md-offset-6">
        	<hr>
            <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj', ['class' => 'btn btn-success btn-lg']) ?>
        </div>        
    </div>
</div>


<?php ActiveForm::end(); ?>