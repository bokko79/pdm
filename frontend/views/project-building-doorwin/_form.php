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

if(!$model->note){$model->note='Sve mere proveriti na licu mesta.';}
if(!$model->material){$model->material='Boja po izboru projektanta.';}
if(!$model->scale){$model->scale=50;}
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

    <?= $form->field($model, 'pos_no')->input('number', ['min'=>1, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'pos_type')->dropDownList([ 'wood_int' => 'Unutrašnja stolarija', 'wood_ext' => 'Spoljašnja/fasadna stolarija', 'metal_int' => 'Unutrašnja bravarija', 'metal_ext' => 'Spoljašnja/fasadna bravarija', 'metal' => 'Bravarija'], ['prompt' => '']) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'prozor' => 'Prozor', 'vrata' => 'Vrata', 'portal' => 'Portal', 'balkonska' => 'Balkonska vrata', 'rukohvat' => 'Rukohvat', 'ograda' => 'Ograda', 'ostalo' => 'Ostalo', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'width', [
                'addon' => ['prepend' => ['content'=>'cm']]])->input('number', ['step'=>1, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'height', [
                'addon' => ['prepend' => ['content'=>'cm']]])->input('number', ['step'=>1, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'length', [
                'addon' => ['prepend' => ['content'=>'cm']]])->input('number', ['step'=>1, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'length_slanted', [
                'addon' => ['prepend' => ['content'=>'cm']]])->input('number', ['step'=>1, 'style'=>'width:40%']) ?>


    <?= $form->field($model, 'frame')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'opening_type')->dropDownList([ 'vertical' => 'Vertical', 'horizontal' => 'Horizontal', 'vert_hor' => 'Vert hor', 'scheme' => 'Scheme', 'none' => 'None', 'slide' => 'Slide', 'slide_up' => 'Slide up', 'other' => 'Other', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'material')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'metal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'scale', [
                'addon' => ['prepend' => ['content'=>'1:']]])->input('number', ['step'=>25, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'file_id')->textInput(['maxlength' => true]) ?>

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

