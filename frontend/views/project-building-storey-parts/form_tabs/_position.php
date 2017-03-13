<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<h4>Položaj i oblik</h4>
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
        <?= $form->field($model, '[existing]shape',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'shape', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]shape',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]position',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'position', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]position',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]adjacent',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'adjacent', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]adjacent',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]orientation',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'orientation', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]orientation',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>
