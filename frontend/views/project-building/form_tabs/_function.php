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


<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]function',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'function', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]function',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]access',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'access', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]access',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]entrance',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'entrance', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]entrance',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<?php else: ?>

	<?= $form->field($model, 'function')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
	<?= $form->field($model, 'access')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
	<?= $form->field($model, 'entrance')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

<?php endif; ?>