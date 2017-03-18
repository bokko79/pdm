<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
?>

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 7,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->hint('Stečeno stručno zvanje, npr. dipl.ing.građ. ili master arhitekture. Titula se pojavljuje u tehničkoj dokumentaciji, uz ime inženjera.') ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true])->hint('Kontakt telefon inženjera.') ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true])->hint('Kontakt email adresa.') ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Dodaj' : 'Izmeni', ['class' => $model->isNewRecord ? 'btn btn-success shadow' : 'btn btn-primary shadow']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
