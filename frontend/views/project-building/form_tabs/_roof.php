<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<h4>Ostale konstrukcije</h4>
<hr>

<?php if($model->projectBuilding->project->work=='dogradnja' or $model->projectBuilding->project->work=='sanacija' or $model->projectBuilding->project->work=='rekonstrukcija'): ?>


<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]roof',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'roof', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]roof',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]stair',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'stair', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]stair',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]truss',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'truss', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]truss',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]arch',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'arch', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]arch',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]chimney',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'chimney', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]chimney',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>



<?php else: ?>

	<?= $form->field($model, 'roof')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'stair')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'truss')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'arch')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'chimney')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

<?php endif; ?>