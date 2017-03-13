<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<h4>Zidovi i platna</h4>
<hr>

<?php if($model->projectBuilding->project->work=='dogradnja' or $model->projectBuilding->project->work=='sanacija' or $model->projectBuilding->project->work=='rekonstrukcija'): ?>


<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]wall_external',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'wall_external', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]wall_external',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]wall_internal',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'wall_internal', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]wall_internal',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<?php else: ?>

	<?= $form->field($model, 'wall_external')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'wall_internal')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

<?php endif; ?>