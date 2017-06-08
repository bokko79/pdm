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

$model->storeys = 'P';
?>

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 10,      
    'formConfig' => ['labelSpan' => 4, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

<h5>Osnovni podaci</h5>

    <?= $form->field($model, 'project_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Projects::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false, 
            'disabled' => true,         
        ]) ?>

    <?= $form->field($model, 'building_type_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\BuildingTypes::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>

    <?= $form->field($model, 'storeys')->textInput(['maxlength' => true, 'placeholder'=>'Npr: Su+P+4+Pk']) ?>

    <?= $form->field($model, 'mark')->textInput(['maxlength' => true, 'placeholder'=>'Npr: 1. ili A']) ?>

    <?= $form->field($model, 'gross_area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'removal')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'sm']]) ?>

<hr>
<h5>Opis</h5>    

    <?= $form->field($model, 'conditions')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'file_id')->textInput(['maxlength' => true]) ?>

    <div class="row" style="margin:20px 0;">
        <div class="col-md-offset-4">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Sačuvaj izmene', ['class' => !$model->isNewRecord ? 'btn btn-success shadow' : 'btn btn-block btn-primary shadow']) ?>
            <?= (!$model->isNewRecord) ? Html::a(Yii::t('app', 'Ukloni'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Da li želite da ukonite postojeći objekat na parceli?'),
                    'method' => 'post',
                ],
            ]) : null ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>

<?php if($project->setup_status=='existing_buildings'): ?>

    <?php $form = kartik\widgets\ActiveForm::begin([
        'id' => 'step-form',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'fullSpan' => 10,      
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

        <div class="row" style="margin:50px 0 0;">
            
            <div class="col-md-offset-6 col-md-6">
                <p>Kada završite unos postojećih objekata na parceli, ukoliko ih ima, pređite na sledeći korak. Ukoliko ih nema, odmah pređite na sledeći korak.</p>
                <?= Html::submitButton('Sledeći korak <i class="fa fa-arrow-right fa-lg"></i>', ['class' => 'btn btn-success shadow btn-block btn-lg', 'name' => 'step_form', 'value' => 'next_step']) ?>
            </div>            
        </div>
    <?php ActiveForm::end(); ?>
<?php endif; ?>