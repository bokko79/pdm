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
        <div class="subaction"><i class="fa fa-caret-right fa-2x this-one"></i></div>
        Numerički podaci</div>
    <div class="subhead">Numerički podaci objekta.</div>
</div>
<div class="primary-context gray" style="display: none;">

    <?php if($model->project->work=='dogradnja' or $model->project->work=='sanacija' or $model->project->work=='rekonstrukcija'): ?>

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
            <?= $form->field($model, '[existing]width',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:100%'])->hint($model->hintWidth) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'width', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]width',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:100%'])->hint($model->hintWidth) ?>
        </div>
    </div>

    <div class="form-group">    
        <div class="col-sm-5">
            <?= $form->field($model, '[existing]length',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:100%'])->hint($model->hintLength) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'length', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]length',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:100%'])->hint($model->hintLength) ?>
        </div>
    </div>

    <div class="form-group">    
        <div class="col-sm-5">
            <?= $form->field($model, '[existing]building_line_dist',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.1, 'style'=>'width:100%'])->hint($model->hintBuildingLineDist) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'building_line_dist', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]building_line_dist',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.1, 'style'=>'width:100%'])->hint($model->hintBuildingLineDist) ?>
        </div>
    </div>
    <?php if($model->project->work=='adaptacija'): ?>
    <div class="form-group">    
        <div class="col-sm-5">
            <?= $form->field($model, '[existing]gross_area_part',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'style'=>'width:100%'])->hint($model->hintGrossAreaPart) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'gross_area_part', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]gross_area_part',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'style'=>'width:100%'])->hint($model->hintGrossAreaPart) ?>
        </div>
    </div>    
    <?php endif; ?>
    


    <?php else: ?>

    <?php if($model->project->work!='adaptacija'): ?> 
        <?= $form->field($model, 'width', [
                    'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint($model->hintWidth) ?>

        <?= $form->field($model, 'length', [
                    'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint($model->hintLength) ?>

        <?= $form->field($model, 'building_line_dist', [
                    'addon' => ['prepend' => ['content'=>'m']],
                ])->input('number', ['step'=>0.1, 'style'=>'width:40%'])->hint($model->hintBuildingLineDist) ?>
    <?php endif; ?>
    <?php if($model->project->work=='adaptacija'): ?>
        <?= $form->field($model, 'gross_area_part', [
                    'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint($model->hintGrossAreaPart) ?>

    <?php endif; ?>
        

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