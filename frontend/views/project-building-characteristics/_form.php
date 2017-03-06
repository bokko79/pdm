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
    'type' => ActiveForm::TYPE_VERTICAL,
]); ?>



    <?= $form->field($model, 'project_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Projects::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false, 
            'disabled' => true,          
        ]) ?>
    <div class="row" style="margin:20px;">
        <div class="">
            <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-success']) ?>
        </div>        
    </div>
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
        <div class="">
            <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-success']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
