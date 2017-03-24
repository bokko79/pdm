<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
?>

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 7,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->hint('Stečeno stručno zvanje, npr. dipl.ing.građ. ili master arhitekture. Titula se pojavljuje u tehničkoj dokumentaciji, uz ime inženjera.') ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true])->hint('Kontakt telefon inženjera.') ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true])->hint('Kontakt email adresa.') ?>

    <?= $form->field($model, 'about')->textarea(['rows' => 6]) ?>
<hr>
    <?= $model->aFile ? '<div class="col-md-offset-3"> Trenutni avatar:<br>'.Html::img('/images/profiles/'.$model->aFile->name, ['style'=>'width:150px; margin:0 0 20px;']).'</div>' : null ?>
    <?= $form->field($model, 'avatarFile')->widget(FileInput::classname(), [
            'options' => [/*'multiple' => true,*/ 'accept' => 'image/*'],
            'pluginOptions' => [
                'previewFileType' => 'any',
                'showCaption' => false,
                'showUpload' => false,
                'browseClass' => 'btn btn-info shadow',
                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                'browseLabel' =>  Yii::t('app', 'Izaberite profilnu sliku'),
                'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                'resizeImage'=> true,
                'maxImageWidth'=> 60,
                'maxImageHeight'=> 60,
                'resizePreference'=> 'width',
            ],
        ]) ?>
        <hr>
    <?= $model->cFile ? '<div class="col-md-offset-3"> Trenutni baner:<br>'.Html::img('/images/profiles/'.$model->cFile->name, ['style'=>'width:150px; margin:0 0 20px;']).'</div>' : null ?>
    <?= $form->field($model, 'coverFile')->widget(FileInput::classname(), [
            'options' => [/*'multiple' => true,*/ 'accept' => 'image/*'],
            'pluginOptions' => [
                'previewFileType' => 'any',
                'showCaption' => false,
                'showUpload' => false,
                'browseClass' => 'btn btn-info shadow',
                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                'browseLabel' =>  Yii::t('app', 'Izaberite svoj baner'),
                'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                'resizeImage'=> true,
                'maxImageWidth'=> 60,
                'maxImageHeight'=> 60,
                'resizePreference'=> 'width',
            ],
        ]) ?>
<hr>
    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Dodaj' : 'Izmeni', ['class' => $model->isNewRecord ? 'btn btn-success shadow' : 'btn btn-primary shadow']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
