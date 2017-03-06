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
        <div class="">
            <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-success']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
