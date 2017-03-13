<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
use kartik\widgets\FileInput;
?>

<h4>Karakteristike</h4>
<hr>

<?php if($model->project->work=='dogradnja' or $model->project->work=='sanacija' or $model->project->work=='rekonstrukcija'): ?>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]ridge_orientation',['showLabels'=>false])->textInput(['maxlength' => true, 'placeholder'=>'npr. S-J ili JZ-SI'])->hint('Uneti orijenataciju slemena krova, ukoliko je krov objekta u nagibu. Uneti samo oznake strana sveta, npr. S za sever, J za jug, itd.') ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'ridge_orientation', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]ridge_orientation',['showLabels'=>false])->textInput(['maxlength' => true, 'placeholder'=>'npr. S-J ili JZ-SI'])->hint('Uneti orijenataciju slemena krova, ukoliko je krov objekta u nagibu. Uneti samo oznake strana sveta, npr. S za sever, J za jug, itd.') ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]roof_pitch',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'<sup>o</sup>']]])->input('number', ['style'=>'width:100%'])->hint('Nagib krovnih ravni u stepenima. Npr. 30<sup>o</sup>') ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'roof_pitch', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]roof_pitch',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'<sup>o</sup>']]])->input('number', ['style'=>'width:100%'])->hint('Nagib krovnih ravni u stepenima. Npr. 30<sup>o</sup>') ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]characteristics',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>''])->hint('Tekst koji će se pojaviti u glavnoj svesci, u prilogu 0.7: Ostale karakteristike objekta. Ukoliko postoje neke dodatne, specifične karakteristike objekta, uneti tekstualni opis.') ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'characteristics', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]characteristics',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>''])->hint('Tekst koji će se pojaviti u glavnoj svesci, u prilogu 0.7: Ostale karakteristike objekta. Ukoliko postoje neke dodatne, specifične karakteristike objekta, uneti tekstualni opis.') ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]buildFile',['showLabels'=>false])->widget(FileInput::classname(), [
            'options' => [/*'multiple' => true,*/ 'accept' => 'image/*'],
            'pluginOptions' => [
                'previewFileType' => 'any',
                'showCaption' => false,
                'showUpload' => false,
                'browseClass' => 'btn btn-info shadow',
                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                'browseLabel' =>  Yii::t('app', 'Izaberi sliku objekta'),
                'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                'resizeImage'=> true,
                'maxImageWidth'=> 60,
                'maxImageHeight'=> 60,
                'resizePreference'=> 'width',
            ],
        ])->hint('Nije obavezno.') ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'buildFile', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]buildFile',['showLabels'=>false])->widget(FileInput::classname(), [
            'options' => [/*'multiple' => true,*/ 'accept' => 'image/*'],
            'pluginOptions' => [
                'previewFileType' => 'any',
                'showCaption' => false,
                'showUpload' => false,
                'browseClass' => 'btn btn-info shadow',
                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                'browseLabel' =>  Yii::t('app', 'Izaberi sliku objekta'),
                'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                'resizeImage'=> true,
                'maxImageWidth'=> 60,
                'maxImageHeight'=> 60,
                'resizePreference'=> 'width',
            ],
        ])->hint('Nije obavezno.') ?>
    </div>
</div>





<?php else: ?>

    <?= $form->field($model, 'ridge_orientation')->textInput(['maxlength' => true, 'placeholder'=>'npr. S-J ili JZ-SI'])->hint('Uneti orijenataciju slemena krova, ukoliko je krov objekta u nagibu. Uneti samo oznake strana sveta, npr. S za sever, J za jug, itd.') ?>

    <?= $form->field($model, 'roof_pitch', [
                'addon' => ['prepend' => ['content'=>'<sup>o</sup>']]])->input('number', ['style'=>'width:30%'])->hint('Nagib krovnih ravni u stepenima. Npr. 30<sup>o</sup>') ?>

    <?= $form->field($model, 'characteristics')->textarea(['rows' => 6, 'placeholder'=>''])->hint('Tekst koji će se pojaviti u glavnoj svesci, u prilogu 0.7: Ostale karakteristike objekta. Ukoliko postoje neke dodatne, specifične karakteristike objekta, uneti tekstualni opis.') ?>

    

    <?= $form->field($model, 'buildFile')->widget(FileInput::classname(), [
            'options' => [/*'multiple' => true,*/ 'accept' => 'image/*'],
            'pluginOptions' => [
                'previewFileType' => 'any',
                'showCaption' => false,
                'showUpload' => false,
                'browseClass' => 'btn btn-info shadow',
                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                'browseLabel' =>  Yii::t('app', 'Izaberi sliku objekta'),
                'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                'resizeImage'=> true,
                'maxImageWidth'=> 60,
                'maxImageHeight'=> 60,
                'resizePreference'=> 'width',
            ],
        ])->hint('Nije obavezno.') ?>

<?php endif; ?>