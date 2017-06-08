<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\widgets\FileInput;
?>

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 10,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

    <?php // $form->field($model, 'number')->textInput(['maxlength' => true, 'placeholder'=>'npr. 9031/2016']) ?>

    <?= $model->file ? '<div class="col-md-offset-3" style="margin-bottom:20px">'.Html::img('/images/projects/'.$model->project->year.'/'.$model->project_id.'/'.$model->file->name, ['style'=>'max-height:200px;']).'</div>' : null ?>

    <?= $form->field($model, 'docFile')->widget(FileInput::classname(), [
            'options' => [/*'multiple' => true, */'accept' => 'image/*'],
            'pluginOptions' => [
                'previewFileType' => 'any',
                'showCaption' => false,
                'showUpload' => false,
                'browseClass' => 'btn btn-info shadow btn-block',
                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                'browseLabel' =>  Yii::t('app', 'Prikačite slike'),
                'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                'resizeImage'=> true,
                'maxImageWidth'=> 60,
                'maxImageHeight'=> 60,
                'resizePreference'=> 'width',
            ],
        ])->hint('Možete dodati slike/fotografije u formatu .JPG, .PNG, .GIF.') ?>

    <div class="row" style="margin:20px 0;">
        <div class="col-md-offset-3 col-md-7">
            <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj', ['class' => $model->isNewRecord ? 'btn btn-primary btn-block shadow' : 'btn btn-primary shadow']) ?>
            <?= (!$model->isNewRecord) ? Html::a(Yii::t('app', '<i class="fa fa-times"></i> Ukloni'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Da li ste sigurni da želite da uklonite ovu sliku iz projekta? Postupak ne može biti vraćen.'),
                    'method' => 'post',
                ],
            ]) : null ?>
        </div>        
    </div>
<?php ActiveForm::end(); ?>

<?php if($project->setup_status=='pics' and $project->projectImages): ?>
    <?php $form = kartik\widgets\ActiveForm::begin([
        'id' => 'step-form-pics',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'fullSpan' => 10,      
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>
        <div class="row" style="margin:50px 0 0;">        
            <div class="col-md-offset-6 col-md-6">
                <p>Kada završite unos slika projekta, pređite na sledeći korak.</p>
                <?= Html::submitButton('Sledeći korak <i class="fa fa-arrow-circle-right"></i>', ['class' => 'btn btn-success shadow btn-block btn-lg', 'name' => 'step_form', 'value' => 'next_step']) ?>
            </div>            
        </div>
    <?php ActiveForm::end(); ?>
<?php endif; ?>

