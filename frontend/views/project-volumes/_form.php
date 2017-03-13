<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;

$model->code = $model->code ?: $model->project->code;
$model->practice_id = $model->practice_id ?: $model->project->practice_id;
$model->engineer_id = $model->engineer_id ?: $model->project->engineer_id;
$model->control_practice_id = $model->control_practice_id ?: $model->project->control_practice_id;
$model->control_engineer_id = $model->control_engineer_id ?: $model->project->control_engineer_id;
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

    <?= $form->field($model, 'volume_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Volumes::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

<hr>
<h3>Projektant</h3>

    <?= $form->field($model, 'practice_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Practices::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint($model->hintPractice) ?>

    <?php /* $form->field($model, 'engineer_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Engineers::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint($model->hintEngineer) */ ?>

    <?= $form->field($model, 'engineer_licence_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\EngineerLicences::find()->all(), 'id', 'fullname'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint($model->hintEngineer) ?>
<?php 
    if($model->volume){
        if ($model->volume->type=='projekat' and $model->volume_id!=1) { ?>
<hr>
<h3>Tehnička kontrola</h3>

    <?= $form->field($model, 'control_practice_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Practices::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint($model->hintControlPractice) ?>

    <?php /* $form->field($model, 'control_engineer_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Engineers::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint($model->hintControlEngineer) */ ?>  

    <?= $form->field($model, 'control_engineer_licence_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\EngineerLicences::find()->all(), 'id', 'fullname'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint($model->hintEngineer) ?>  

    <?php // $form->field($model, 'control_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'control_text')->textArea(['rows' => 6])->hint('Rezime izveštaja o tehničkoj kontroli, izrađen od strane vršioca tehničke kontrole ') ?>
<?php }
} ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Izmeni', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
