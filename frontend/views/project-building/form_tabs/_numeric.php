<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<h4>Numerički podaci</h4>
<hr>

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
        <?= $form->field($model, '[existing]ground_floor_level',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:100%'])->hint($model->hintGroundFloorLevel) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'ground_floor_level', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]ground_floor_level',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:100%'])->hint($model->hintGroundFloorLevel) ?>
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
<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]storey',['showLabels'=>false])->textInput(['maxlength' => true, 'placeholder'=>'npr. Po+P+4+Pk'])->hint($model->hintStorey) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'storey', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]storey',['showLabels'=>false])->textInput(['maxlength' => true, 'placeholder'=>'npr. Po+P+4+Pk'])->hint($model->hintStorey) ?>
    </div>
</div>
<?php endif; ?>
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


<?php else: ?>

<?php if($model->project->work!='adaptacija'): ?> 
    <?= $form->field($model, 'width', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint($model->hintWidth) ?>

    <?= $form->field($model, 'length', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint($model->hintLength) ?>

    <?= $form->field($model, 'ground_floor_level', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint($model->hintGroundFloorLevel) ?>

    <?= $form->field($model, 'building_line_dist', [
                'addon' => ['prepend' => ['content'=>'m']],
            ])->input('number', ['step'=>0.1, 'style'=>'width:40%'])->hint($model->hintBuildingLineDist) ?>
<?php endif; ?>
<?php if($model->project->work=='adaptacija'): ?>
    <?= $form->field($model, 'gross_area_part', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint($model->hintGrossAreaPart) ?>

    <?= $form->field($model, 'storey')->textInput(['maxlength' => true, 'placeholder'=>'npr. Po+P+4+Pk'])->hint($model->hintStorey) ?>
<?php endif; ?>

    <?= $form->field($model, 'storey_height', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint($model->hintStoreyHeight) ?>

<?php endif; ?>