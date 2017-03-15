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
        <?= $form->field($model, '[existing]context',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderContext])->hint($model->hintContext) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'context', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]context',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderContext])->hint($model->hintContext) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]architecture',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderArchitecture])->hint($model->hintArchitecture) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'architecture', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]architecture',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderArchitecture])->hint($model->hintArchitecture) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]style',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderStyle])->hint($model->hintStyle) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'style', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]style',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderStyle])->hint($model->hintStyle) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]ventilation',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderVentilation])->hint($model->hintVentilation) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'ventilation', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]ventilation',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderVentilation])->hint($model->hintVentilation) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]lights',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderLights])->hint($model->hintLights) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'lights', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]lights',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderLights])->hint($model->hintLights) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]environment',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderEnvironment])->hint($model->hintEnvironment) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'environment', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]environment',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderEnvironment])->hint($model->hintEnvironment) ?>
    </div>
</div>

<?php else: ?>

	<?= $form->field($model, 'context')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderContext])->hint($model->hintContext) ?>

    <?= $form->field($model, 'architecture')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderArchitecture])->hint($model->hintArchitecture) ?>
    <?php if($modelCheck->projectBuilding->project->work!='adaptacija'): ?>    
    <?= $form->field($model, 'style')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderStyle])->hint($model->hintStyle) ?>
   
    <?= $form->field($model, 'ventilation')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderVentilation])->hint($model->hintVentilation) ?>
    
    <?= $form->field($model, 'lights')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderLights])->hint($model->hintLights) ?>
    
    <?= $form->field($model, 'environment')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderEnvironment])->hint($model->hintEnvironment) ?>
    <?php endif; ?>
<?php endif; ?>