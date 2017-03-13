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



<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]construction',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'construction', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]construction',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]foundation',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'foundation', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]foundation',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<?php else: ?>

	<?= $form->field($model, 'construction')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'foundation')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

<?php endif; ?>