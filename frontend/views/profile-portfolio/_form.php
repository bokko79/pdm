<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
use kartik\checkbox\CheckboxX;

$model->current = $model->current ?: 0;
?>
<hr>
<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 10,      
    'formConfig' => ['labelSpan' => 4, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>


    <?= $form->field($model, 'portfolio_type')->dropDownList([ 'certificate' => 'Sertifikat', 'education' => 'Obrazovanje', 'course' => 'Kurs/radionica', 'experience' => 'Radno mesto', 'patent' => 'Patent', 'publication' => 'Publikacija/izdanje', 'reference' => 'Referenca', 'licence' => 'Licenca', 'project' => 'Projekat', ], ['prompt' => '', 'disabled' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->hint('Naziv portfolia. Naziv radnog mesta, sertifikata, diplome, kursa, referene, licence, patenta, publikacije/izdanja, stručnog stečenog zvanja ili slično.') ?>

    <?= $form->field($model, 'company')->textInput(['maxlength' => true])->hint('Naziv kompanije, preduzeća ili ustavnove.') ?>

    <?= $form->field($model, 'start_month')->dropDownList([ 
                'jan' => 'Januar',
                'feb' => 'Februar',
                'mar' => 'Mart',
                'apr' => 'April',
                'maj' => 'Maj',
                'jun' => 'Jun',
                'jul' => 'Jul',
                'avg' => 'Avgust',
                'sep' => 'Septembar',
                'okt' => 'Oktobar',
                'nov' => 'Novembar',
                'dec' => 'Decembar',
            ], ['prompt' => '']) ?>

    <?= $form->field($model, 'start_year')->input('number', ['min'=>1950, 'max'=>date('Y'), 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'current')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'md']])->hint('Da li je aktivno trenutno?') ?>

    <?= $form->field($model, 'end_month')->dropDownList([ 
                'jan' => 'Januar',
                'feb' => 'Februar',
                'mar' => 'Mart',
                'apr' => 'April',
                'maj' => 'Maj',
                'jun' => 'Jun',
                'jul' => 'Jul',
                'avg' => 'Avgust',
                'sep' => 'Septembar',
                'okt' => 'Oktobar',
                'nov' => 'Novembar',
                'dec' => 'Decembar',
            ], ['prompt' => '']) ?>

    <?= $form->field($model, 'end_year')->input('number', ['min'=>1950, 'max'=>date('Y'), 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'summary')->textarea(['rows' => 6]) ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-4">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Izmeni', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
