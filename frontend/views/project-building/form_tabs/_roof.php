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
        <?= $form->field($model, '[existing]roof',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderRoof])->hint($model->hintRoof) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'roof', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]roof',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderRoof])->hint($model->hintRoof) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]stair',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderStair])->hint($model->hintStair) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'stair', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]stair',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderStair])->hint($model->hintStair) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]truss',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderTruss])->hint($model->hintTruss) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'truss', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]truss',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderTruss])->hint($model->hintTruss) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]arch',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderArch])->hint($model->hintArch) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'arch', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]arch',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderArch])->hint($model->hintArch) ?>
    </div>
</div>

<div class="form-group">   	
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]chimney',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderChimney])->hint($model->hintChimney) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'chimney', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]chimney',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderChimney])->hint($model->hintChimney) ?>
    </div>
</div>



<?php else: ?>

	<?= $form->field($model, 'roof')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderRoof])->hint($model->hintRoof) ?>
    <?= $form->field($model, 'stair')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderStair])->hint($model->hintStair) ?>
    <?= $form->field($model, 'truss')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderTruss])->hint($model->hintTruss) ?>
    <?= $form->field($model, 'arch')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderArch])->hint($model->hintArch) ?>
    <?= $form->field($model, 'chimney')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderChimney])->hint($model->hintChimney) ?>

<?php endif; ?>