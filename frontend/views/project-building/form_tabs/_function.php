<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<h4>Dispozicija i funkcija objekta</h4>
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