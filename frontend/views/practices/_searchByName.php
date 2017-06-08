<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

?>

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_VERTICAL,
    //'fullSpan' => 7,      
    //'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['style'=>'margin-top:0 !important;'],
    //'enableAjaxValidation' => true,
    'action' => ['index'],
    'method' => 'get',
    //'enableClientValidation' => true,
]); ?>

    <?= $form->field($model, 'name', [
    'addon' => [
        'append' => [
            'content' => Html::submitButton('<i class="fa fa-search"></i>', ['class'=>'btn btn-info']), 
            'asButton' => true
        ]
    ]])->textInput(['text', 'placeholder'=>'Pretražite pomoću naziva...'])->label(false)->hint('') ?>


    <?php ActiveForm::end(); ?>

