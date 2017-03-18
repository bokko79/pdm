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

    <?= $form->field($model, 'type')->dropDownList([ 
            /*'licence_no' => 'Broj licence', 
            'licence_copy' => 'Kopija licence', 
            'licence_conf' => 'Potvrda licence', */
            'apr' => 'APR', 
            'signature' => 'Potpis', 
            /*'licence_stamp' => 'Pečat licencni', */
            'company_stamp' => 'Pečat preduzeća', 
            'stamp' => 'Pečat',
            'memo-header' => 'Memorandum zaglavlje', 
            //'memo-footer' => 'Memorandum podnožje', 
            'logo' => 'Logo',  
            'other' => 'Drugo', 
        ], ['prompt' => '', 'disabled'=>(!$model->type) ? false:true]) ?>

    <?= $form->field($model, 'entity')->dropDownList([ 'client' => 'Investitor', 'engineer' => 'Inženjer', 'practice' => 'Firma', 'authority' => 'Nadležni organ', ], ['prompt' => '', 'disabled'=>true]) ?>

    <?php // $form->field($model, 'entity_id')->textInput(['maxlength' => true]) ?>

    <?php if($model->type!='licence_no'): ?>

        <?= $model->file ? '<div class="col-md-offset-3"> Trenutni dokument:<br>'.Html::img('/images/legal_files/'.$model->folder.'/'.$model->file->name, ['style'=>'width:150px; margin:0 0 20px;']).'</div>' : null ?>
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
        ]) ?>
    <?php else: ?>
    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>
    <?php endif; ?>
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
