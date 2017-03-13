<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<h4>Nameštaj i sanitarije</h4>
<hr>

<?php if($model->projectBuilding->project->work=='dogradnja' or $model->projectBuilding->project->work=='sanacija' or $model->projectBuilding->project->work=='rekonstrukcija'): ?>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]furniture',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'furniture', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]furniture',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]kitchen',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'kitchen', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]kitchen',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]sanitary',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'sanitary', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]sanitary',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>


<?php else: ?>

	<?= $form->field($model, 'furniture')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'kitchen')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'sanitary')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

<?php endif; ?>