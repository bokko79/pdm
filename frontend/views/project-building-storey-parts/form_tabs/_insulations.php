<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<h4>Izolacije jedinice</h4>
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
        <?= $form->field($model, '[existing]general',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderGeneral])->hint($model->hintGeneral) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'general', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]general',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderGeneral])->hint($model->hintGeneral) ?>
    </div>
</div>
<hr>
<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]thermal',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderThermal])->hint($model->hintThermal) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'thermal', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]thermal',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderThermal])->hint($model->hintThermal) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]sound',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderSound])->hint($model->hintSound) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'sound', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]sound',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderSound])->hint($model->hintSound) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]hidro',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderHidro])->hint($model->hintHidro) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'hidro', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]hidro',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderHidro])->hint($model->hintHidro) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]fireproof',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderFireproof])->hint($model->hintFireproof) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'fireproof', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]fireproof',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderFireproof])->hint($model->hintFireproof) ?>
    </div>
</div>