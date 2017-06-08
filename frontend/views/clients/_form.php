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
    'fullSpan' => 10,      
    'formConfig' => ['labelSpan' => 4, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data', 'style'=>'margin-top:0px !important;'],
]); ?>


<h5 class="col-md-offset-3 margin-20">Opšti podaci<hr></h5>
    <?= $form->field($model, 'type')->radioList([ 'individual' => 'Fizičko lice', 'company' => 'Pravno lice/Preduzeće', ], []) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_person')->textInput(['maxlength' => true])->hint('Ukoliko je investitor pravno lice, navesti ime odgovornog lica.') ?>

<h5 class="col-md-offset-3 margin-20">Adresa<hr></h5>
    <?= $form->field($location, 'street')->textInput(['maxlength' => true]) ?>
    <?= $form->field($location, 'number')->textInput(['maxlength' => true]) ?>
    <?= $form->field($location, 'city_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Cities::find()->all(), 'id', 'town'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>
        
<h5 class="col-md-offset-3 margin-20">Kontakt podaci<hr></h5>
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

<h5 class="col-md-offset-3 margin-20">Poslovni podaci<hr></h5>

    <?= $form->field($model, 'tax_no')->input(['number']) ?>

    <?= $form->field($model, 'company_no')->input(['number']) ?>

    <?= $form->field($model, 'account_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank')->textInput(['maxlength' => true]) ?>       

    <div class="row" style="margin:20px 0;">
        <div class="col-md-offset-3 col-md-4">
            <?= Html::submitButton($model->isNewRecord ? 'Dodaj' : 'Sačuvaj izmene', ['class' => !$model->isNewRecord ? 'btn btn-success btn-block shadow' : 'btn btn-primary btn-block shadow']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>

