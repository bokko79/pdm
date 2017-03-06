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

<hr>
<h3>Osnovni podaci</h3>

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
<h3>Hidrotehničke instalacije</h3>
    <?= $form->field($model, 'water')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'sewage')->textarea(['rows' => 6, 'placeholder'=>'']) ?>  
<hr>
<h3>Električne i elektronske instalacije</h3>
    <?= $form->field($model, 'electricity')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'phone')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'tv')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'catv')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'internet')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
<hr>
<h3>Termomašinske instalacije</h3>
    <?= $form->field($model, 'heating')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'gas')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'geotech')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'ac')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'ventilation')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'sprinkler')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    
    <?= $form->field($model, 'lift')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
<hr>
<h3>Ostale instalacije</h3>
    <?= $form->field($model, 'fire')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'pool')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'traffic')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'special')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <div class="row" style="margin:20px;">
        <div class="">
            <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-success']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
