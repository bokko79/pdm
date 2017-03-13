<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<h4>Arhitektonsko oblikovanje</h4>
<hr>

<?php if($modelCheck->projectBuilding->project->work=='dogradnja' or $modelCheck->projectBuilding->project->work=='sanacija' or $modelCheck->projectBuilding->project->work=='rekonstrukcija'): ?>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]context',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'context', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]context',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]architecture',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'architecture', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]architecture',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]style',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'style', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]style',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]ventilation',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'ventilation', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]ventilation',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]lights',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'lights', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]lights',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]environment',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'environment', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]environment',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<?php else: ?>

	<?= $form->field($model, 'context')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <?= $form->field($model, 'architecture')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    
    <?= $form->field($model, 'style')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
   
    <?= $form->field($model, 'ventilation')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    
    <?= $form->field($model, 'lights')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    
    <?= $form->field($model, 'environment')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

<?php endif; ?>