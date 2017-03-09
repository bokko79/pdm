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
use kartik\checkbox\CheckboxX;

$model->number = ($model->number) ?: 1;
$model->scale = ($model->scale) ?: 100;
$model->print_title = ($model->print_title) ?: 1;
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

    <?= $form->field($model, 'project_volume_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\ProjectVolumes::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false, 
            'disabled' => true,         
        ]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 
                
                'osnova' => 'Osnova', 
                'etaza' => 'Osnova etaže', 
                'temelj' => 'Osnova temelja', 
                'krovna' => 'Osnova krovne konstrukcije', 
                'presek' => 'Presek', 
                'izgled' => 'Izgled', 
                'detalj' => 'Detalj', 
                'situacija' => 'Situacija', 
                'izv1' => 'Situacioni plan sa osnovom krova',
                'izv2' => 'Situaciono nivelacioni plan sa osnovom prizemlja', 
                'izv3' => 'Situaciono nivelacioni plan sa prikazom saobraćajnog rešenja', 
                'izv4' => 'Situacioni plan sa prikazom sinhron-plana instalacija', 
                'izv5' => 'Osnova etaže pristup svetlarniku',
                '3d' => '3D prikaz, perspektiva, izometrija', 
                'sema' => 'Šema', ], ['prompt' => '']) ?>
    <?= $form->field($model, 'project_building_storey_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map($storeys, 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false, 
            //'disabled' => true,         
        ])->hint('Ukoliko je osnova etaže izabrana iznad, mora se izabrati i etaža.') ?>

    <?= $form->field($model, 'number')->input('number', ['step'=>1, 'min'=>0, 'style'=>'width:40%'])->hint('') ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'print_title')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'md']])->hint('Da li da se ispiše pun naslov iznad tablice?') ?>

    <?= $form->field($model, 'scale', [
                'addon' => ['prepend' => ['content'=>'1 :']]])->input('number', ['step'=>25, 'min'=>0, 'style'=>'width:40%'])->hint('') ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Izmeni', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
