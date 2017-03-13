<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<h4>Osnovni podaci</h4>
<hr>

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
        <?= $form->field($model, '[existing]type',['showLabels'=>false])->dropDownList([ 'stan' => 'Stan', 'stamb' => 'Stambene prostorije', 'biz' => 'Poslovni prostor - lokal', 'posl' => 'Poslovne prostorije', 'tech' => 'Tehničke prostorije', 'common' => 'Zajedničke prostorije', 'garage' => 'Garažne i parking prostorije', 'external' => 'Spoljašnje prostorije', ], ['prompt' => '']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'type', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]type',['showLabels'=>false])->dropDownList([ 'stan' => 'Stan', 'stamb' => 'Stambene prostorije', 'biz' => 'Poslovni prostor - lokal', 'posl' => 'Poslovne prostorije', 'tech' => 'Tehničke prostorije', 'common' => 'Zajedničke prostorije', 'garage' => 'Garažne i parking prostorije', 'external' => 'Spoljašnje prostorije', ], ['prompt' => '']) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]name',['showLabels'=>false])->textInput(['maxlength' => true])?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'name', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]name',['showLabels'=>false])->textInput(['maxlength' => true]) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]mark',['showLabels'=>false])->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'mark', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]mark',['showLabels'=>false])->textInput(['maxlength' => true]) ?>
    </div>
</div>
<?php if($model->type=='stan'): ?>
<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]structure',['showLabels'=>false])->dropDownList([ 'garsonjera' => 'Garsonjera', 'jednosoban' => 'Jednosoban', 'jednoiposoban' => 'Jednoiposoban', 'dvosoban' => 'Dvosoban', 'dvoiposoban' => 'Dvoiposoban', 'trosoban' => 'Trosoban', 'troiposoban' => 'Troiposoban', 'četvorosoban' => 'četvorosoban', 'četvoroiposoban' => 'četvoroiposoban', 'petosoban' => 'Petosoban', 'visesoban' => 'Visesoban', ], ['prompt' => '']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'structure', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]structure',['showLabels'=>false])->dropDownList([ 'garsonjera' => 'Garsonjera', 'jednosoban' => 'Jednosoban', 'jednoiposoban' => 'Jednoiposoban', 'dvosoban' => 'Dvosoban', 'dvoiposoban' => 'Dvoiposoban', 'trosoban' => 'Trosoban', 'troiposoban' => 'Troiposoban', 'četvorosoban' => 'četvorosoban', 'četvoroiposoban' => 'četvoroiposoban', 'petosoban' => 'Petosoban', 'visesoban' => 'Visesoban', ], ['prompt' => '']) ?>
    </div>
</div>
<?php endif; ?>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]description',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'description', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]description',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    </div>
</div>
