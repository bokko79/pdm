<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<h4>Unutrašnja obrada</h4>
<hr>

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
        <?= $form->field($model, '[existing]wall_internal',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderWallInternal])->hint($model->hintWallInternal) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'wall_internal', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]wall_internal',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderWallInternal])->hint($model->hintWallInternal) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]flooring',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderFlooring])->hint($model->hintFlooring) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'flooring', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]flooring',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderFlooring])->hint($model->hintFlooring) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]ceiling',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderCeiling])->hint($model->hintCeiling) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'ceiling', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]ceiling',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderCeiling])->hint($model->hintCeiling) ?>
    </div>
</div>
