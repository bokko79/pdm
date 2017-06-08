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
        Ploče i linijski elementi</div>
    <div class="subhead">Ploče i linijski elementi objekta.</div>
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
            <?= $form->field($model, '[existing]slab',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderSlab])->hint($model->hintSlab) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'slab', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]slab',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderSlab])->hint($model->hintSlab) ?>
        </div>
    </div>

    <div class="form-group">   	
        <div class="col-sm-5">
            <?= $form->field($model, '[existing]columns',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderColumns])->hint($model->hintColumns) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'columns', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]columns',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderColumns])->hint($model->hintColumns) ?>
        </div>
    </div>

    <div class="form-group">   	
        <div class="col-sm-5">
            <?= $form->field($model, '[existing]beam',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderBeam])->hint($model->hintBeam) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'beam', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]beam',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderBeam])->hint($model->hintBeam) ?>
        </div>
    </div>

    <?php else: ?>

    	<?= $form->field($model, 'slab')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderSlab])->hint($model->hintSlab) ?>
        <?= $form->field($model, 'columns')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderColumns])->hint($model->hintColumns) ?>
        <?= $form->field($model, 'beam')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderBeam])->hint($model->hintBeam) ?>

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