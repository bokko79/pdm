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

    <?= $form->field($model, 'project_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Projects::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false, 
            'disabled' => true,         
        ]) ?>

<hr>
<h3>Spoljašnja obrada</h3>
    <?= $form->field($model, 'access')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'facade')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'roofing')->textarea(['rows' => 6, 'placeholder'=>'']) ?>    
<hr>
<h3>Stolarija, bravarija i limarija</h3>
    <?= $form->field($model, 'door')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'window')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'woodwork')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'steelwork')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'tinwork')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
<hr>
<h3>Unutrašnja obrada</h3>
    <?= $form->field($model, 'wall_internal')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'flooring')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'ceiling')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
<hr>
<h3>Nameštaj i sanitarije</h3>  

    <?= $form->field($model, 'furniture')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'kitchen')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'sanitary')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Izmeni', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
