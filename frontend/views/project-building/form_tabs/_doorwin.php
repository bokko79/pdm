<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<h4>Stolarija, bravarija i limarija</h4>
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
        <?= $form->field($model, '[existing]door',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderDoor])->hint($model->hintDoor) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'door', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]door',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderDoor])->hint($model->hintDoor) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]window',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderWindow])->hint($model->hintWindow) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'window', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]window',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderWindow])->hint($model->hintWindow) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]woodwork',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderWoodwork])->hint($model->hintWoodwork) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'woodwork', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]woodwork',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderWoodwork])->hint($model->hintWoodwork) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]steelwork',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderSteelwork])->hint($model->hintSteelwork) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'steelwork', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]steelwork',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderSteelwork])->hint($model->hintSteelwork) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]tinwork',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderTinwork])->hint($model->hintTinwork) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'tinwork', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]tinwork',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderTinwork])->hint($model->hintTinwork) ?>
    </div>
</div>

<?php else: ?>

	<?= $form->field($model, 'door')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderDoor])->hint($model->hintDoor) ?>
    <?= $form->field($model, 'window')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderWindow])->hint($model->hintWindow) ?>
    <?= $form->field($model, 'woodwork')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderWoodwork])->hint($model->hintWoodwork) ?>
    <?= $form->field($model, 'steelwork')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderSteelwork])->hint($model->hintSteelwork) ?>
    <?= $form->field($model, 'tinwork')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderTinwork])->hint($model->hintTinwork) ?>

<?php endif; ?>