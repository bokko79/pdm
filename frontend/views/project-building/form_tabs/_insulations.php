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
        Izolacije</div>
    <div class="subhead">Izolacije objekta.</div>
</div>
<div class="primary-context gray" style="display: none;">

    <?php if($model->projectBuilding->project->work=='dogradnja' or $model->projectBuilding->project->work=='sanacija' or $model->projectBuilding->project->work=='rekonstrukcija'): ?>

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



    <?php else: ?>
        <?= $form->field($model, 'general')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderGeneral])->hint($model->hintGeneral) ?>
        <hr>
    	<?= $form->field($model, 'thermal')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderThermal])->hint($model->hintThermal) ?>
        <?= $form->field($model, 'sound')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderSound])->hint($model->hintSound) ?>
        <?= $form->field($model, 'hidro')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderHidro])->hint($model->hintHidro) ?>
        <?= $form->field($model, 'fireproof')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderFireproof])->hint($model->hintFireproof) ?>

    <?php endif; ?>

    <div class="row" style="margin:20px 0;">
        <div class="col-md-offset-4 col-md-<?= ($model->projectBuilding->project->setup_status=='building' ? '8' : '4') ?>">
            <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-'.($model->projectBuilding->project->setup_status=='building' ? 'default' : 'success').' '.($model->projectBuilding->project->setup_status=='building' ? '' : 'btn-block').' shadow']) ?>
            <?php if($model->projectBuilding->project->setup_status=='building'): ?>
            <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj i pređi na sledeći korak <i class="fa fa-arrow-right fa-lg"></i>', ['class' => 'btn btn-success shadow', 'name' => 'step_form', 'value' => 'next_step']) ?>    
        <?php endif; ?>
        </div>        
    </div>
</div>