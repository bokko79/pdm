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



    <?= $form->field($model, 'project_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Projects::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false, 
            'disabled' => true,         
        ]) ?>

<hr>
<h3>Konstrukcija i temelji</h3>

    <?= $form->field($model, 'construction')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <?= $form->field($model, 'foundation')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

<hr>
<h3>Zidovi i platna</h3>

    <?= $form->field($model, 'wall_external')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <?= $form->field($model, 'wall_internal')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

<hr>
<h3>Ploče i linijski elementi</h3>

    <?= $form->field($model, 'slab')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <?= $form->field($model, 'columns')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <?= $form->field($model, 'beam')->textarea(['rows' => 6, 'placeholder'=>'']) ?>   

<hr>
<h3>Ostale konstrukcije</h3>

    <?= $form->field($model, 'roof')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <?= $form->field($model, 'stair')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <?= $form->field($model, 'truss')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <?= $form->field($model, 'arch')->textarea(['rows' => 6, 'placeholder'=>'']) ?>    

    <?= $form->field($model, 'chimney')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Izmeni', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
