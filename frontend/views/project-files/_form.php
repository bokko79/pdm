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
    'fullSpan' => 11,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>


    <?= $form->field($model, 'type')->dropdownList([ 
            'prostorniplan' => 'Prostorni plan (GUP, PDR ili sl.)', 
            'informacija' => 'Informacija o lokaciji', 
            'svojina' => 'List nepokretnosti', 
            'geodetski' => 'Geodetski snimak',   
            'preparcelacija' => 'Projekat parcelacije i preparcelacije', 
            'formparcele' => 'Potvrda o formiranju parcele',
            'obelparcele' => 'Rešenje o obeležavanju parcele',        
            'plana' => 'Kopija plana', 
            'vodovi' => 'Izvod iz katastra vodova',
            'katplan' => 'Katastarsko-topografski plan',
            'uslovi' => 'Lokacijski uslovi', 
            'saglasnost' => 'Saglasnost', 
            'energetska' => 'Energetska dozvola',
            'vlasnici' => 'Saglasnost ostalih vlasnika',           
            'punomoc' => 'Punomoc', 
            'dozvola' => 'Građevinska dozvola', 
            'prijava' => 'Prijava radova',              
            'odobrenje' => 'Rešenje o odobrenju radova',             
            'uplatnica' => 'Uplatnica',              
            'upotrebna' => 'Upotrebna dozvola',
            'ugovor' => 'Ugovor', 
            'zalba' => 'Žalba', 
            'resenje' => 'Rešenje',
            //'drugo' => 'Drugo',            
        ], ['prompt' => '']) ?>

    <?= $form->field($model, 'name')->textArea(['maxlength' => true, 'placeholder'=>'npr. Rešenje o lokacijskim uslovima']) ?>

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

    <hr>

    <?= $model->file ? '<div class="col-md-offset-3" style="margin-bottom:20px">'.(($model->file->type!='pdf') ? Html::img('/images/projects/'.$model->project->year.'/'.$model->project_id.'/'.$model->file->name, ['style'=>'max-height:200px;']) : 'Trenutni dokument:<br>'.Html::a($model->name, ['/site/download', 'path'=>'/images/projects/'.$model->project->year.'/'.$model->project_id.'/'.$model->file->name])).'</div>' : null ?>

    <?= $form->field($model, 'docFile')->widget(FileInput::classname(), [
            'options' => [/*'multiple' => true, 'accept' => 'image/*'*/],
            'pluginOptions' => [
                'previewFileType' => 'any',
                'showCaption' => false,
                'showUpload' => false,
                'browseClass' => 'btn btn-info shadow btn-block',
                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                'browseLabel' =>  Yii::t('app', 'Prikačite dokument'),
                'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                'resizeImage'=> true,
                'maxImageWidth'=> 60,
                'maxImageHeight'=> 60,
                'resizePreference'=> 'width',
            ],
        ])->hint('Možete dodati skenirani dokument u formatu .PDF, .JPG, .PNG, .GIF.') ?>

    <div class="row" style="margin:20px 0;">
        <div class="col-md-offset-3 col-md-8">
            <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus-circle"></i> Dodaj dokument' : '<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => !$model->isNewRecord ? 'btn btn-success shadow' : 'btn btn-primary btn-block shadow']) ?>
            <?= (!$model->isNewRecord) ? Html::a(Yii::t('app', '<i class="fa fa-times"></i> Ukloni'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Da li ste sigurni da želite da uklonite ovaj dokument iz projekta? Postupak ne može biti vraćen.'),
                    'method' => 'post',
                ],
            ]) : null ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>

    <?php if($project->setup_status=='docs'): ?>
        <?php $form = kartik\widgets\ActiveForm::begin([
            'id' => 'step-form-docs',
            'type' => ActiveForm::TYPE_HORIZONTAL,
            'fullSpan' => 10,      
            'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
            'options' => ['enctype' => 'multipart/form-data'],
        ]); ?>
            <div class="row" style="margin:50px 0 0;">                
                <div class="col-md-offset-6 col-md-6">
                    <p>Kada završite unos dokumenata projekta, pređite na sledeći korak.</p>
                    <?= Html::submitButton('Sledeći korak <i class="fa fa-arrow-circle-right"></i>', ['class' => 'btn btn-success shadow btn-block btn-lg', 'name' => 'step_form', 'value' => 'next_step']) ?>
                </div>            
            </div>
        <?php ActiveForm::end(); ?>
    <?php endif; ?>