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

    <?= $form->field($model, 'conditions')->textInput() ?>

    <?= $form->field($model, 'width')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'length')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'disposition')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'gradjevinska' => 'Gradjevinska', 'javna' => 'Javna', 'poljoprivredna' => 'Poljoprivredna', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ground_level')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'road_level')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'underwater_level')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ground')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'access')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ownership')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'adjacent_border')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'services')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'legal')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'green_area_reg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'green_area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'occupancy_reg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'built_index_reg')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parking')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'parking_spaces')->textInput() ?>

    <?= $form->field($model, 'parking_disabled')->textInput() ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Izmeni', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
