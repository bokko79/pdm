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
use kartik\datecontrol\DateControl;
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

    <?= $form->field($model, 'type')->dropDownList([ 'informacija' => 'Informacija o lokaciji', 'uslovi' => 'Lokacijski uslovi', 'plan' => 'Kopija plana ili KT plan', 'saglasnost' => 'Saglasnost', 'svojina' => 'Izvod iz lista nepokretnosti', 'geodetski' => 'Geodetski snimak', 'punomoc' => 'Punomoc', 'ugovor' => 'Ugovor', 'zalba' => 'Žalba', 'resenje' => 'Rešenje', 'odobrenje' => 'Odobrenje', 'dozvola' => 'Dozvola', 'uplatnica' => 'Uplatnica', 'drugo' => 'Drugo', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder'=>'npr. Rešenje o lokacijskim uslovima']) ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true, 'placeholder'=>'npr. 9031/2016']) ?>

    <?= $form->field($model, 'date')->widget(DateControl::classname(), [
                            'language' => 'rs-latin',
                            'type' => 'date',
                            'options'=> [
                                'type'=>2,
                                'size' => 'lg',
                                'pickerButton'=>['title'=>'Izaberite datum'],
                                'pluginOptions' => [                        
                                    'autoclose' => true,
                                    'todayHighlight' => true,
                                    //'startDate'=>date('Y-m-d'),                      
                                ],
                            ],                                
                    ]) ?>

    <?= $form->field($model, 'authority_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Authorities::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,       
        ]) ?>

    <?= $form->field($model, 'docFile')->widget(FileInput::classname(), [
            'options' => [/*'multiple' => true,*/ 'accept' => 'image/*'],
            'pluginOptions' => [
                'previewFileType' => 'any',
                'showCaption' => false,
                'showUpload' => false,
                'browseClass' => 'btn btn-info shadow',
                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                'browseLabel' =>  Yii::t('app', 'Izaberite dokument'),
                'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                'resizeImage'=> true,
                'maxImageWidth'=> 60,
                'maxImageHeight'=> 60,
                'resizePreference'=> 'width',
            ],
        ])->hint(($model->file) ? Html::img('/images/projects/files/'.$model->file->name, ['style'=>'max-height:100px;']) : 'Možete dodati skenirani dokument u formatu .PDF, .JPG, .PNG, .GIF.') ?>

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
