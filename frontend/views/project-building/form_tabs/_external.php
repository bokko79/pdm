<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<h4>Spoljašnja obrada objekta</h4>
<hr>

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
        <?= $form->field($model, '[existing]facade',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderFacade])->hint($model->hintFacade) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'facade', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]facade',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderFacade])->hint($model->hintFacade) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]roofing',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderRoofing])->hint($model->hintRoofing) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'roofing', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]roofing',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderRoofing])->hint($model->hintRoofing) ?>
    </div>
</div>

<?php else: ?>

	<?= $form->field($model, 'access')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderAccess])->hint($model->hintAccess) ?>
    <?= $form->field($model, 'facade')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderFacade])->hint($model->hintFacade) ?>
    <?= $form->field($model, 'roofing')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderRoofing])->hint($model->hintRoofing) ?>

<?php endif; ?>