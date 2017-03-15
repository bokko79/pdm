<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<h4>Konstrukcija i temelji</h4>
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
        <?= $form->field($model, '[existing]construction',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderConstruction])->hint($model->hintConstruction) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'construction', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]construction',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderConstruction])->hint($model->hintConstruction) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]foundation',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderFoundation])->hint($model->hintFoundation) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'foundation', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]foundation',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderFoundation])->hint($model->hintFoundation) ?>
    </div>
</div>

<?php else: ?>

	<?= $form->field($model, 'construction')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderConstruction])->hint($model->hintConstruction) ?>
    <?= $form->field($model, 'foundation')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderFoundation])->hint($model->hintFoundation) ?>

<?php endif; ?>