<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\tabs\TabsX;

//if(!$model->building_line_dist) $model->building_line_dist = 0;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuilding */

$this->title = $modelCheck->project->code.': Podešavanje objekta';

$this->params['page_title'] = 'Objekat';
$this->params['page_title_2'] = 'Podešavanje';

$this->params['breadcrumbs'][] = ['label' => '<i class="fa fa-home"></i> '.$modelCheck->name, 'url' => ['view', 'id' => $modelCheck->id]];
$this->params['breadcrumbs'][] = 'Podešavanje objekta';

$this->params['project'] = $modelCheck->project;
?>

<div class="card_container record-full grid-item fadeInUp no-shadow no-margin animated-not" id="">
    <div class="primary-context normal aliceblue bottom-bordered">
        <div class="head colos">
            <div class="subaction">
                <?= Html::a('<i class="fa fa-life-saver fa-2x"></i>', null, ['class' => 'btn btn-link button_to_show_secondary']) ?>
            </div>
            <i class="fa fa-home"></i> Objekat
        </div>
        <div class="subhead">Upravljanje podacima predmetnog objekta.</div>
    </div>  
    <div class="primary-context aliceblue bottom-bordered" style="display: none;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5 text">
                    <h5>Upravljanje dokumentima projekta</h5>
                    <h6>Dodavanje dokumenta projekta.</h6>
                    <p>Novi dokument projekta.</p>
                    <h6>Podešavanje dokumenta projekta.</h6>
                    <p>Podešavanje dokumenta projekta.</p>
                    <h6>Uklanjanje dokumenta projekta.</h6>
                    <p>Uklanjanje dokumenta projekta.</p>
                </div>
                <div class="col-sm-7">
                    <p><iframe src="//www.youtube.com/embed/sDYVYgiGW3c" width="100%" height="314" allowfullscreen="allowfullscreen"></iframe></p>
                </div>
            </div>
        </div>          
    </div>
</div>
<div class="container-fluid">
    <div class="row">

        <?php
        $form = kartik\widgets\ActiveForm::begin([
            'id' => 'form-horizontal-project-building',
            'type' => ActiveForm::TYPE_HORIZONTAL,
            'fullSpan' => 12,      
           	'formConfig' => ['labelSpan' => 4, 'deviceSize' => ActiveForm::SIZE_SMALL],
            'options' => ['enctype' => 'multipart/form-data', 'style'=>'margin-top:0 !important;'],
        ]); ?>

        <div class="card_container record-full grid-item fadeInUp animated-not no-shadow no-margin" id="general">

        <?php
            if($modelCheck->project->work=='dogradnja' or $modelCheck->project->work=='sanacija' or $modelCheck->project->work=='rekonstrukcija'){

                echo $this->render('form_tabs/_required', ['modelCheck'=>$modelCheck, 'model'=>$building['existing'], 'model_new'=>$building['new'], 'form'=>$form]);
                echo $this->render('form_tabs/_general', ['modelCheck'=>$modelCheck, 'model'=>$building['existing'], 'model_new'=>$building['new'], 'form'=>$form]);
                echo $this->render('form_tabs/_numeric', ['modelCheck'=>$modelCheck, 'model'=>$building['existing'], 'model_new'=>$building['new'], 'form'=>$form]);
                echo $this->render('form_tabs/_characteristics', ['modelCheck'=>$modelCheck, 'model'=>$building['existing'], 'model_new'=>$building['new'], 'form'=>$form]);
                echo $this->render('form_tabs/_function', ['modelCheck'=>$modelCheck->projectBuildingCharacteristics, 'model'=>$architecture['existing'], 'model_new'=>$architecture['new'], 'form'=>$form]);
                echo $this->render('form_tabs/_position', ['modelCheck'=>$modelCheck->projectBuildingCharacteristics, 'model'=>$architecture['existing'], 'model_new'=>$architecture['new'], 'form'=>$form]);
                echo $this->render('form_tabs/_architecture', ['modelCheck'=>$modelCheck->projectBuildingCharacteristics, 'model'=>$architecture['existing'], 'model_new'=>$architecture['new'], 'form'=>$form]);
                echo $this->render('form_tabs/_structure', ['modelCheck'=>$modelCheck->projectBuildingStructure, 'model'=>$structure['existing'], 'model_new'=>$structure['new'], 'form'=>$form]);
                echo $this->render('form_tabs/_walls', ['modelCheck'=>$modelCheck->projectBuildingStructure, 'model'=>$structure['existing'], 'model_new'=>$structure['new'], 'form'=>$form]);
                echo $this->render('form_tabs/_slabs', ['modelCheck'=>$modelCheck->projectBuildingStructure, 'model'=>$structure['existing'], 'model_new'=>$structure['new'], 'form'=>$form]);
                echo $this->render('form_tabs/_roof', ['modelCheck'=>$modelCheck->projectBuildingStructure, 'model'=>$structure['existing'], 'model_new'=>$structure['new'], 'form'=>$form]);
                echo $this->render('form_tabs/_external', ['modelCheck'=>$modelCheck->projectBuildingMaterials, 'model'=>$materials['existing'], 'model_new'=>$materials['new'], 'form'=>$form]);
                echo $this->render('form_tabs/_interior', ['modelCheck'=>$modelCheck->projectBuildingMaterials, 'model'=>$materials['existing'], 'model_new'=>$materials['new'], 'form'=>$form]);
                echo $this->render('form_tabs/_doorwin', ['modelCheck'=>$modelCheck->projectBuildingMaterials, 'model'=>$materials['existing'], 'model_new'=>$materials['new'], 'form'=>$form]);
                echo $this->render('form_tabs/_furniture', ['modelCheck'=>$modelCheck->projectBuildingMaterials, 'model'=>$materials['existing'], 'model_new'=>$materials['new'], 'form'=>$form]);
                echo $this->render('form_tabs/_insulations', ['modelCheck'=>$modelCheck->projectBuildingInsulations, 'model'=>$insulations['existing'], 'model_new'=>$insulations['new'], 'form'=>$form]);
                echo $this->render('form_tabs/_services', ['modelCheck'=>$modelCheck->projectBuildingServices, 'model'=>$services['existing'], 'model_new'=>$services['new'], 'form'=>$form]);

            } else if($modelCheck->project->work=='adaptacija') {

                echo $this->render('form_tabs/_general', ['modelCheck'=>$modelCheck, 'model'=>$building, 'form'=>$form]);
                echo $this->render('form_tabs/_numeric', ['modelCheck'=>$modelCheck,  'model'=>$building, 'form'=>$form]);
                echo $this->render('form_tabs/_function', ['modelCheck'=>$modelCheck->projectBuildingCharacteristics, 'model'=>$architecture, 'form'=>$form]);
                echo $this->render('form_tabs/_architecture', ['modelCheck'=>$modelCheck->projectBuildingCharacteristics, 'model'=>$architecture, 'form'=>$form]);
                echo $this->render('form_tabs/_position', ['modelCheck'=>$modelCheck->projectBuildingCharacteristics, 'model'=>$architecture, 'form'=>$form]);

            } else {

                echo $this->render('form_tabs/_required', ['modelCheck'=>$modelCheck, 'model'=>$building, 'form'=>$form]);
                echo $this->render('form_tabs/_general', ['modelCheck'=>$modelCheck, 'model'=>$building, 'form'=>$form]);
                echo $this->render('form_tabs/_numeric', ['modelCheck'=>$modelCheck,  'model'=>$building, 'form'=>$form]);
                echo $this->render('form_tabs/_characteristics', ['modelCheck'=>$modelCheck, 'model'=>$building, 'form'=>$form]);
                echo $this->render('form_tabs/_function', ['modelCheck'=>$modelCheck->projectBuildingCharacteristics, 'model'=>$architecture, 'form'=>$form]);
                echo $this->render('form_tabs/_position', ['modelCheck'=>$modelCheck->projectBuildingCharacteristics, 'model'=>$architecture, 'form'=>$form]);
                echo $this->render('form_tabs/_architecture', ['modelCheck'=>$modelCheck->projectBuildingCharacteristics, 'model'=>$architecture, 'form'=>$form]);
                echo $this->render('form_tabs/_structure', ['modelCheck'=>$modelCheck->projectBuildingStructure, 'model'=>$structure, 'form'=>$form]);
                echo $this->render('form_tabs/_walls', ['modelCheck'=>$modelCheck->projectBuildingStructure, 'model'=>$structure, 'form'=>$form]);
                echo $this->render('form_tabs/_slabs', ['modelCheck'=>$modelCheck->projectBuildingStructure, 'model'=>$structure, 'form'=>$form]);
                echo $this->render('form_tabs/_roof', ['modelCheck'=>$modelCheck->projectBuildingStructure, 'model'=>$structure, 'form'=>$form]);
                echo $this->render('form_tabs/_external', ['modelCheck'=>$modelCheck->projectBuildingMaterials, 'model'=>$materials, 'form'=>$form]);
                echo $this->render('form_tabs/_interior', ['modelCheck'=>$modelCheck->projectBuildingMaterials, 'model'=>$materials, 'form'=>$form]);
                echo $this->render('form_tabs/_doorwin', ['modelCheck'=>$modelCheck->projectBuildingMaterials, 'model'=>$materials, 'form'=>$form]);
                echo $this->render('form_tabs/_furniture', ['modelCheck'=>$modelCheck->projectBuildingMaterials, 'model'=>$materials, 'form'=>$form]);
                echo $this->render('form_tabs/_insulations', ['modelCheck'=>$modelCheck->projectBuildingInsulations, 'model'=>$insulations, 'form'=>$form]);
                echo $this->render('form_tabs/_services', ['modelCheck'=>$modelCheck->projectBuildingServices, 'model'=>$services, 'form'=>$form]);
            }
        ?>

        </div>
<?php ActiveForm::end(); ?>


    </div>
</div>


