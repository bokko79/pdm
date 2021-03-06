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

if($model->flooring==null){
  $model->flooring='parket';  
}


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

    <?= $form->field($model, 'project_building_storey_part_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\ProjectBuildingStoreyParts::find()->all(), 'id', 'fullType'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,    
            'disabled' => true,     
        ])->hint('') ?>

    <?= $form->field($model, 'room_type_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\RoomTypes::find()->all(), 'id', 'name', 'type'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false, 
            'disabled' => $model->room_type_id ? true : false,         
        ])->hint('') ?>    

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mark')->input('number', ['min'=>0, 'style'=>'width:40%']) ?>   

    <?= $form->field($model, 'flooring')->dropDownList([ 'parket' => 'Parket', 'keramika' => 'Keramika', 'estrih' => 'Estrih', 'tarkett' => 'Tarkett', 'beton' => 'Beton', 'opeka' => 'Opeka', 'kamen' => 'Kamen', 'teraco' => 'Teraco', 'zemlja' => 'Zemlja', 'tepih' => 'Tepih', 'drugo' => 'Drugo', ], ['prompt' => '']) ?>

<hr>
<h3>Površina prostorije</h3>

    <?= $form->field($model, 'net_area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['min'=>0, 'step'=>0.01, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'sub_net_area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['min'=>0, 'step'=>0.01, 'style'=>'width:40%']) ?>
<hr>
<h3>Dimenzije prostorije</h3>
    <?= $form->field($model, 'circumference', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['min'=>0, 'step'=>0.01, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'length', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['min'=>0, 'step'=>0.01, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'width', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['min'=>0, 'step'=>0.01, 'style'=>'width:40%']) ?>    

    <?= $form->field($model, 'height', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['min'=>0, 'step'=>0.01, 'style'=>'width:40%']) ?>    

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
