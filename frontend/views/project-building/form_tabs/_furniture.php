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
        Nameštaj i sanitarije</div>
    <div class="subhead">Nameštaj i sanitarije objekta.</div>
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
            <?= $form->field($model, '[existing]furniture',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderFurniture])->hint($model->hintFurniture) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'furniture', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]furniture',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderFurniture])->hint($model->hintFurniture) ?>
        </div>
    </div>

    <div class="form-group">   	
        <div class="col-sm-5">
            <?= $form->field($model, '[existing]kitchen',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderKitchen])->hint($model->hintKitchen) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'kitchen', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]kitchen',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderKitchen])->hint($model->hintKitchen) ?>
        </div>
    </div>

    <div class="form-group">   	
        <div class="col-sm-5">
            <?= $form->field($model, '[existing]sanitary',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderSanitary])->hint($model->hintSanitary) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'sanitary', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]sanitary',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderSanitary])->hint($model->hintSanitary) ?>
        </div>
    </div>


    <?php else: ?>

    	<?= $form->field($model, 'furniture')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderFurniture])->hint($model->hintFurniture) ?>
        <?= $form->field($model, 'kitchen')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderKitchen])->hint($model->hintKitchen) ?>
        <?= $form->field($model, 'sanitary')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderSanitary])->hint($model->hintSanitary) ?>

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