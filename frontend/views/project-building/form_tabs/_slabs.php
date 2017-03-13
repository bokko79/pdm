<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<h4>Ploče i linijski elementi</h4>
<hr>

<?php if($model->projectBuilding->project->work=='dogradnja' or $model->projectBuilding->project->work=='sanacija' or $model->projectBuilding->project->work=='rekonstrukcija'): ?>


<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]slab',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'slab', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]slab',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]columns',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'columns', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]columns',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]beam',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'beam', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]beam',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<?php else: ?>

	<?= $form->field($model, 'slab')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'columns')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'beam')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

<?php endif; ?>