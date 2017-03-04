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
    'fullSpan' => 12,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>



    <?= $form->field($model, 'project_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Projects::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false, 
            'disabled' => true,          
        ]) ?>

<hr>
<h3>Osnovni podaci</h3>

    <?= $form->field($model, 'function')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <?= $form->field($model, 'access')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <?= $form->field($model, 'entrance')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <?= $form->field($model, 'position')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <?= $form->field($model, 'orientation')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <?= $form->field($model, 'shape')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <?= $form->field($model, 'context')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <?= $form->field($model, 'architecture')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <?= $form->field($model, 'style')->textarea(['rows' => 6, 'placeholder'=>'']) ?>       

    <?= $form->field($model, 'adjacent')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'ventilation')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <?= $form->field($model, 'lights')->textarea(['rows' => 6, 'placeholder'=>'']) ?> 

    <?= $form->field($model, 'environment')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Izmeni', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
