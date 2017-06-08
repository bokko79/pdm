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
        Arhitektonsko oblikovanje</div>
    <div class="subhead">Arhitektonsko oblikovanje objekta.</div>
</div>
<div class="primary-context gray" style="display: none;">

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

    <div class="row" style="margin:20px 0;">
        <div class="col-md-offset-4 col-md-<?= ($modelCheck->projectBuilding->project->setup_status=='building' ? '8' : '4') ?>">
            <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-'.($modelCheck->projectBuilding->project->setup_status=='building' ? 'default' : 'success').' '.($modelCheck->projectBuilding->project->setup_status=='building' ? '' : 'btn-block').' shadow']) ?>
            <?php if($modelCheck->projectBuilding->project->setup_status=='building'): ?>
            <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj i pređi na sledeći korak <i class="fa fa-arrow-right fa-lg"></i>', ['class' => 'btn btn-success shadow', 'name' => 'step_form', 'value' => 'next_step']) ?>    
        <?php endif; ?>
        </div>        
    </div>
</div>