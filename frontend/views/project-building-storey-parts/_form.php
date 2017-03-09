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

    <?= $form->field($model, 'type')->dropDownList([ 'stan' => 'Stan', 'stamb' => 'Stambene prostorije', 'biz' => 'Poslovni prostor - lokal', 'posl' => 'Poslovne prostorije', 'tech' => 'Tehničke prostorije', 'common' => 'Zajedničke prostorije', 'garage' => 'Garažne i parking prostorije', 'external' => 'Spoljašnje prostorije', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mark')->textInput(['maxlength' => true]) ?>

<?php if($model->type=='stan'): ?>
    <?= $form->field($model, 'structure')->dropDownList([ 'garsonjera' => 'Garsonjera', 'jednosoban' => 'Jednosoban', 'jednoiposoban' => 'Jednoiposoban', 'dvosoban' => 'Dvosoban', 'dvoiposoban' => 'Dvoiposoban', 'trosoban' => 'Trosoban', 'troiposoban' => 'Troiposoban', 'četvorosoban' => 'četvorosoban', 'četvoroiposoban' => 'četvoroiposoban', 'petosoban' => 'Petosoban', 'visesoban' => 'Visesoban', ], ['prompt' => '']) ?>
<?php endif; ?>

    <?= $form->field($model, 'area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Izmeni', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
