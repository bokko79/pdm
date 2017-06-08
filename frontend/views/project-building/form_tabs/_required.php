<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<div class="primary-context normal bottom-bordered">
    <div class="head lower button_to_show_secondary">
        <div class="subaction"><i class="fa fa-caret-down fa-2x this-one"></i></div>
        Osnovni podaci</div>
    <div class="subhead">Osnovni podaci objekta.</div>
</div>
<div class="primary-context gray" style="display: ;">


    <?php if($modelCheck->project->work=='dogradnja' or $modelCheck->project->work=='sanacija' or $modelCheck->project->work=='rekonstrukcija'): ?>

    <div class="form-group" style="margin:40px; 0">
        
        <div class="col-sm-5 center">
            <h4>Postojeće stanje</h4>
        </div>
        <div class="col-sm-2">
            
        </div>
        <div class="col-sm-5 center">
            <h4>Predviđeno stanje stanje</h4>
        </div>
    </div>

    <div class="form-group">    
        <div class="col-sm-5">
            <?= $form->field($model, '[existing]name',['showLabels'=>false])->textInput(['maxlength' => true, 'placeholder'=>$model->placeholderName])->hint($model->hintName) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'name', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]name',['showLabels'=>false])->textInput(['maxlength' => true, 'placeholder'=>$model->placeholderName])->hint($model->hintName) ?>
        </div>
    </div>

    <div class="form-group">    
        <div class="col-sm-5">
            <?= $form->field($model, '[existing]building_type_id',['showLabels'=>false])->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\common\models\BuildingTypes::find()->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Izaberite...', 'id'=>'existingbt'],
                'language' => 'sr-Latn',
                'changeOnReset' => false,           
            ])->hint($model->hintBuildingType) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'building_type_id', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]building_type_id',['showLabels'=>false])->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\common\models\BuildingTypes::find()->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Izaberite...', 'id'=>'newbt'],
                'language' => 'sr-Latn',
                'changeOnReset' => false,           
            ])->hint($model->hintBuildingType) ?>
        </div>
    </div>

    <div class="form-group">    
        <div class="col-sm-5">
            <?= $form->field($model, '[existing]storey',['showLabels'=>false])->textInput(['maxlength' => true, 'placeholder'=>'npr. Po+Su+P+4+Pk'])->hint($model->hintStorey) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'storey', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]storey',['showLabels'=>false])->textInput(['maxlength' => true, 'placeholder'=>$model->placeholderStorey])->hint($model->hintStorey) ?>
        </div>
    </div>

    <div class="form-group">    
        <div class="col-sm-5">
            <?= $form->field($model, '[existing]storey_height',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:100%'])->hint($model->hintStoreyHeight) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'storey_height', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]storey_height',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:100%'])->hint($model->hintStoreyHeight) ?>
        </div>
    </div>

    <div class="form-group">    
        <div class="col-sm-5">
            <?= $form->field($model, '[existing]gross_area_average',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:100%'])->hint($model->hintGrossAreaPart) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'gross_area_average', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]gross_area_average',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:100%'])->hint($model->hintGrossAreaPart) ?>
        </div>
    </div>

    <div class="form-group">    
        <div class="col-sm-5">
            <?= $form->field($model, '[existing]ground_floor_level',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:100%'])->hint($model->hintGroundFloorLevel) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'ground_floor_level', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]ground_floor_level',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:100%'])->hint($model->hintGroundFloorLevel) ?>
        </div>
    </div>

    <?php else: ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder'=>$model->placeholderName])->hint($model->hintName) ?>

        <?= $form->field($model, 'building_type_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\common\models\BuildingTypes::find()->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Izaberite...'],
                'language' => 'sr-Latn',
                'changeOnReset' => false,           
            ])->hint($model->hintBuildingType) ?>      

        <?= $form->field($model, 'storey')->textInput(['maxlength' => true, 'placeholder'=>$model->placeholderStorey])->hint($model->hintStorey) ?> 

        <?= $form->field($model, 'storey_height', [
                    'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint($model->hintStoreyHeight) ?>

        <?= $form->field($model, 'gross_area_average', [
                    'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint($model->hintGrossAreaPart) ?>

        <?= $form->field($model, 'ground_floor_level', [
                    'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint($model->hintGroundFloorLevel) ?>

    <?php endif; ?>


    <div class="row" style="margin:20px 0;">
        <div class="col-md-offset-4 col-md-<?= ($model->project->setup_status=='building' ? '8' : '4') ?>">
            <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-'.($model->project->setup_status=='building' ? 'default' : 'success').' '.($model->project->setup_status=='building' ? '' : 'btn-block').' shadow']) ?>
            <?php if($model->project->setup_status=='building'): ?>
            <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj i pređi na sledeći korak <i class="fa fa-arrow-right fa-lg"></i>', ['class' => 'btn btn-success shadow', 'name' => 'step_form', 'value' => 'next_step']) ?>    
        <?php endif; ?>
        </div>        
    </div>
</div>