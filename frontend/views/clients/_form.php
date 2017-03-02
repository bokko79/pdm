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

<hr>
<h4>Opšti podaci</h4>
    <?= $form->field($model, 'type')->dropDownList([ 'individual' => 'Fizičko lice', 'company' => 'Pravno lice/Preduzeće', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_person')->textInput(['maxlength' => true])->hint('Ukoliko je investitor pravno lice, navesti ime odgovornog lica.') ?>
<hr>
<h4>Adresa</h4>
    <?= $form->field($location, 'street')->textInput(['maxlength' => true]) ?>
    <?= $form->field($location, 'number')->textInput(['maxlength' => true]) ?>
    <?= $form->field($location, 'city_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Cities::find()->all(), 'id', 'town'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>
<hr>
<h4>Kontakt podaci</h4>
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

<hr> 
<h4>Poslovni podaci</h4>   

    <?= $form->field($model, 'tax_no')->input(['number']) ?>

    <?= $form->field($model, 'company_no')->input(['number']) ?>

    <?= $form->field($model, 'account_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank')->textInput(['maxlength' => true]) ?>       

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>

