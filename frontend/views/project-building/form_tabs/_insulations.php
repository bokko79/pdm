<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<h4>Izolacije objekta</h4>
<hr>

<?php if($model->projectBuilding->project->work=='dogradnja' or $model->projectBuilding->project->work=='sanacija' or $model->projectBuilding->project->work=='rekonstrukcija'): ?>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]thermal',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'thermal', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]thermal',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]sound',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'sound', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]sound',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]hidro',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'hidro', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]hidro',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]fireproof',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'fireproof', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]fireproof',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>



<?php else: ?>

	<?= $form->field($model, 'thermal')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'sound')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'hidro')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'fireproof')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

<?php endif; ?>