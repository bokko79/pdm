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

    <?= $form->field($model, 'project_building_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\ProjectBuilding::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false, 
            'disabled' => true,         
        ]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'building_type_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\BuildingTypes::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>

    <?= $form->field($model, 'gross_area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'net_area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'height', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'storeys')->textInput(['maxlength' => true, 'placeholder'=>'Npr: Su+P+4+Pk']) ?>

    <?= $form->field($model, 'description')->widget(TinyMce::className(), [
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
            <?= (!$model->isNewRecord) ? Html::a(Yii::t('app', 'Ukloni'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) : null ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
