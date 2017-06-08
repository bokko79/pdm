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
        Položaj i oblik</div>
    <div class="subhead">Položaj i oblik objekta.</div>
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
            <?= $form->field($model, '[existing]position',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderPosition])->hint($model->hintPosition) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'position', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]position',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderPosition])->hint($model->hintPosition) ?>
        </div>
    </div>

    <div class="form-group">    
        <div class="col-sm-5">
            <?= $form->field($model, '[existing]shape',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderShape])->hint($model->hintShape) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'shape', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]shape',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderShape])->hint($model->hintShape) ?>
        </div>
    </div>

    <div class="form-group">   	
        <div class="col-sm-5">
            <?= $form->field($model, '[existing]adjacent',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderAdjacent])->hint($model->hintAdjacent) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'adjacent', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]adjacent',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderAdjacent])->hint($model->hintAdjacent) ?>
        </div>
    </div>

    <div class="form-group">   	
        <div class="col-sm-5">
            <?= $form->field($model, '[existing]orientation',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderOrientation])->hint($model->hintOrientation) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'orientation', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]orientation',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderOrientation])->hint($model->hintOrientation) ?>
        </div>
    </div>


    <?php else: ?>	
    	<?= $form->field($model, 'position')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderPosition])->hint($model->hintPosition) ?>
        <?= $form->field($model, 'shape')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderShape])->hint($model->hintShape) ?>
        <?php if($modelCheck->projectBuilding->project->work!='adaptacija'): ?> 
        	<?= $form->field($model, 'adjacent')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderAdjacent])->hint($model->hintAdjacent) ?>
        	<?= $form->field($model, 'orientation')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderOrientation])->hint($model->hintOrientation) ?>
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