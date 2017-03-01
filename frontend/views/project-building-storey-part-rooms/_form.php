<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
use dosamigos\tinymce\TinyMce;
?>

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 7,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

<hr>
<h3>Osnovni podaci</h3>

    <?= $form->field($model, 'project_building_storey_part_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'soba' => 'Soba', 'terasa' => 'Terasa', 'kupatilo' => 'Kupatilo', 'sanitarni' => 'Sanitarni', 'kuhinja' => 'Kuhinja', 'trpezarija' => 'Trpezarija', 'dnevna' => 'Dnevna', 'radna' => 'Radna', 'spavaca' => 'Spavaca', 'tehnicka' => 'Tehnicka', 'balkon' => 'Balkon', 'hodnik' => 'Hodnik', 'predprostor' => 'Predprostor', 'degazman' => 'Degazman', 'ulaz' => 'Ulaz', 'trem' => 'Trem', 'laboratorija' => 'Laboratorija', 'studio' => 'Studio', 'igraonica' => 'Igraonica', 'radionica' => 'Radionica', 'stepeniste' => 'Stepeniste', 'vesernica' => 'Vesernica', 'kotlarnica' => 'Kotlarnica', 'lift' => 'Lift', 'dnevna_kuhinja' => 'Dnevna kuhinja', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'circumference')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'flooring')->dropDownList([ 'parket' => 'Parket', 'keramika' => 'Keramika', 'estrih' => 'Estrih', 'tarkett' => 'Tarkett', 'beton' => 'Beton', 'opeka' => 'Opeka', 'kamen' => 'Kamen', 'teraco' => 'Teraco', 'zemlja' => 'Zemlja', 'tepih' => 'Tepih', 'drugo' => 'Drugo', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'length')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'width')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'height')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sub_net_area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'net_area')->textInput(['maxlength' => true]) ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Izmeni', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
