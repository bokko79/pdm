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
        Dispozicija i funkcija</div>
    <div class="subhead">Dispozicija i funkcija objekta.</div>
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
            <?= $form->field($model, '[existing]function',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderFunction])->hint($model->hintFunction) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'function', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]function',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderFunction])->hint($model->hintFunction) ?>
        </div>
    </div>

    <div class="form-group">   	
        <div class="col-sm-5">
            <?= $form->field($model, '[existing]access',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderAccess])->hint($model->hintAccess) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'access', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]access',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderAccess])->hint($model->hintAccess) ?>
        </div>
    </div>

    <div class="form-group">   	
        <div class="col-sm-5">
            <?= $form->field($model, '[existing]entrance',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderEntrance])->hint($model->hintEntrance) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'entrance', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]entrance',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderEntrance])->hint($model->hintEntrance) ?>
        </div>
    </div>

    <?php else: ?>

    	<?= $form->field($model, 'function')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderFunction])->hint($model->hintFunction) ?>
        <?php if($modelCheck->projectBuilding->project->work!='adaptacija'): ?>
    	<?= $form->field($model, 'access')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderAccess])->hint($model->hintAccess) ?>
    	<?= $form->field($model, 'entrance')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderEntrance])->hint($model->hintEntrance) ?>
        <?php endif; ?>
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