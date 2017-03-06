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
<h3>Izolacije objekta</h3>        
    <?= $form->field($model, 'thermal')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <?= $form->field($model, 'sound')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <?= $form->field($model, 'hidro')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <?= $form->field($model, 'fireproof')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <?= $form->field($model, 'chemical')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'sr',
        'clientOptions' => [
            'plugins' => [
               "insertdatetime media table contextmenu paste" 
            ],
            'convert_fonts_to_spans' => true,
            'paste_as_text' => true,
            'menubar' => false,
            'statusbar' => false,
            'toolbar' => "undo redo | bold italic | bullist numlist outdent indent"
        ]
    ]) ?>

    <div class="row" style="margin:20px;">
        <div class="">
            <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-success']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
