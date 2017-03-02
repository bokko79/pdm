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

<hr>
<h3>Osnovni podaci</h3>

    <?= $form->field($model, 'project_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Projects::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false, 
            'disabled' => true,          
        ]) ?>
        
    <?= $form->field($model, 'thermal')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'sound')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'hidro')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'fireproof')->widget(TinyMce::className(), [
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
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Izmeni', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
