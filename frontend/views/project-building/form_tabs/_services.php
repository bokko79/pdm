<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<h4>Osnovni podaci</h4>
<hr>

<?php if($model->projectBuilding->project->work=='dogradnja' or $model->projectBuilding->project->work=='sanacija' or $model->projectBuilding->project->work=='rekonstrukcija'): ?>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]water',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'water', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]water',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]sewage',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'sewage', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]sewage',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]electricity',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'electricity', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]electricity',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]phone',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'phone', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]phone',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]tv',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'tv', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]tv',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]catv',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'catv', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]catv',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]internet',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'internet', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]internet',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]heating',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'heating', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]heating',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]gas',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'gas', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]gas',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]geotech',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'geotech', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]geotech',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]ac',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'ac', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]ac',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
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
        <?= $form->field($model, '[existing]sprinkler',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'sprinkler', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]sprinkler',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]lift',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'lift', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]lift',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]fire',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'fire', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]fire',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]pool',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'pool', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]pool',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]traffic',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'traffic', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]traffic',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]special',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'special', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]special',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>




<?php else: ?>

    <hr>
<h5>Hidrotehničke instalacije</h5>
    <?= $form->field($model, 'water')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'sewage')->textarea(['rows' => 6, 'placeholder'=>'']) ?>  
<hr>
<h5>Električne i elektronske instalacije</h5>
    <?= $form->field($model, 'electricity')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'phone')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'tv')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'catv')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'internet')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
<hr>
<h5>Termomašinske instalacije</h5>
    <?= $form->field($model, 'heating')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'gas')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'geotech')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'ac')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'ventilation')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'sprinkler')->textarea(['rows' => 6, 'placeholder'=>'']) ?>    
    <?= $form->field($model, 'lift')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
<hr>
<h5>Ostale instalacije</h5>
    <?= $form->field($model, 'fire')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'pool')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'traffic')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'special')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

<?php endif; ?>