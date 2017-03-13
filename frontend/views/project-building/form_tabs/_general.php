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

<?php if($modelCheck->project->work=='dogradnja' or $modelCheck->project->work=='sanacija' or $modelCheck->project->work=='rekonstrukcija'): ?>

<div class="form-group">    
    <div class="col-sm-12">
        <?= $form->field($model, '[existing]project_id',['showLabels'=>false])->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Projects::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,    
            'disabled' => true,       
        ]) ?>    
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]name',['showLabels'=>false])->textInput(['maxlength' => true, 'placeholder'=>'npr. Stambeno-poslovni objekat'])->hint('Pun naziv objekta.') ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'name', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]name',['showLabels'=>false])->textInput(['maxlength' => true, 'placeholder'=>'npr. Stambeno-poslovni objekat'])->hint('Pun naziv objekta.') ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]building_id',['showLabels'=>false])->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Buildings::find()->all(), 'id', 'fullClass'),
            'options' => ['placeholder' => 'Izaberite...', 'id'=>'existing'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint('Pretežna klasa objekta prema važećem Pravilniku o klasifikaciji objekata.') ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'building_id', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]building_id',['showLabels'=>false])->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Buildings::find()->all(), 'id', 'fullClass'),
            'options' => ['placeholder' => 'Izaberite...', 'id'=>'new'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint('Pretežna klasa objekta prema važećem Pravilniku o klasifikaciji objekata.') ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]building_type_id',['showLabels'=>false])->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\BuildingTypes::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...', 'id'=>'existingbt'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'building_type_id', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]building_type_id',['showLabels'=>false])->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\BuildingTypes::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...', 'id'=>'newbt'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]type',['showLabels'=>false])->dropDownList([ 'slobodno' => 'Slobodnostojeći objekat', 'niz' => 'Objekat u nizu', 'dvojna' => 'Dvojni objekat', 'ugaona' => 'Ugaoni objekat', 'drugo' => 'Drugo', ], ['prompt' => '']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'type', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]type',['showLabels'=>false])->dropDownList([ 'slobodno' => 'Slobodnostojeći objekat', 'niz' => 'Objekat u nizu', 'dvojna' => 'Dvojni objekat', 'ugaona' => 'Ugaoni objekat', 'drugo' => 'Drugo', ], ['prompt' => '']) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]cost',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'RSD']]])->input('number', ['style'=>'width:100%'])->hint('Ukupna predviđena građevinska investiciona vrednost objekta/radova na izgradnji objekta u RSD.') ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'cost', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]cost',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'RSD']]])->input('number', ['style'=>'width:100%'])->hint('Ukupna predviđena građevinska investiciona vrednost objekta/radova na izgradnji objekta u RSD.') ?>
    </div>
</div>

<?php else: ?>

    <?= $form->field($model, 'project_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Projects::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,    
            'disabled' => true,       
        ]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder'=>'npr. Stambeno-poslovni objekat'])->hint('Pun naziv objekta.') ?>

    <?= $form->field($model, '[existing]building_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Buildings::find()->all(), 'id', 'fullClass'),
            'options' => ['placeholder' => 'Izaberite...', 'id'=>'existing'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint('Pretežna klasa objekta prema važećem Pravilniku o klasifikaciji objekata.') ?>

     <?= $form->field($model, 'building_type_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\BuildingTypes::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>       

    <?= $form->field($model, 'type')->dropDownList([ 'slobodno' => 'Slobodnostojeći objekat', 'niz' => 'Objekat u nizu', 'dvojna' => 'Dvojni objekat', 'ugaona' => 'Ugaoni objekat', 'drugo' => 'Drugo', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'cost', [
                'addon' => ['prepend' => ['content'=>'RSD']]])->input('number', ['style'=>'width:50%'])->hint('Ukupna predviđena građevinska investiciona vrednost objekta/radova na izgradnji objekta u RSD.') ?>

<?php endif; ?>