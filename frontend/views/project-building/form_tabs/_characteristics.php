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

<div class="primary-context normal bottom-bordered">
    <div class="head lower button_to_show_secondary">
        <div class="subaction"><i class="fa fa-caret-right fa-2x this-one"></i></div>
        Karakteristike</div>
    <div class="subhead">Karakteristike objekta.</div>
</div>
<div class="primary-context gray" style="display: none;">

    <?php if($model->project->work=='dogradnja' or $model->project->work=='sanacija' or $model->project->work=='rekonstrukcija'): ?>
    <div class="form-group" style="margin:40px; 0">
        
        <div class="col-sm-5 center">
            <h4>Postojeće stanje</h4>
        </div>
        <div class="col-sm-2">
            
        </div>
        <div class="col-sm-5 center">
            <h4>Predviđeno stanje stanje</h4>
        </div>
    </div>

    <div class="form-group">    
        <div class="col-sm-5">
            <?= $form->field($model, '[existing]ridge_orientation',['showLabels'=>false])->textInput(['maxlength' => true, 'placeholder'=>$model->placeholderRidgeOrientation])->hint($model->hintRidgeOrientation) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'ridge_orientation', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]ridge_orientation',['showLabels'=>false])->textInput(['maxlength' => true, 'placeholder'=>$model->placeholderRidgeOrientation])->hint($model->hintRidgeOrientation) ?>
        </div>
    </div>

    <div class="form-group">    
        <div class="col-sm-5">
            <?= $form->field($model, '[existing]roof_pitch',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'<sup>o</sup>']]])->input('number', ['style'=>'width:100%'])->hint($model->hintRoofPitch) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'roof_pitch', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]roof_pitch',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'<sup>o</sup>']]])->input('number', ['style'=>'width:100%'])->hint($model->hintRoofPitch) ?>
        </div>
    </div>

    <div class="form-group">    
        <div class="col-sm-5">
            <?= $form->field($model, '[existing]characteristics',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderCharacteristics])->hint($model->hintCharacteristics) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'characteristics', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]characteristics',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderCharacteristics])->hint($model->hintCharacteristics) ?>
        </div>
    </div>
<?php /*
    <div class="form-group">    
        <div class="col-sm-5">
            <?= $form->field($model, '[existing]buildFile',['showLabels'=>false])->widget(FileInput::classname(), [
                'options' => ['multiple' => true, 'accept' => 'image/*'],
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
            ])->hint($model->hintBuildFile) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'buildFile', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]buildFile',['showLabels'=>false])->widget(FileInput::classname(), [
                'options' => ['multiple' => true, 'accept' => 'image/*'],
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
            ])->hint($model->hintBuildFile) ?>
        </div>
    </div>

*/ ?>



    <?php else: ?>

        <?= $form->field($model, 'ridge_orientation')->textInput(['maxlength' => true, 'placeholder'=>$model->placeholderRidgeOrientation])->hint($model->hintRidgeOrientation) ?>

        <?= $form->field($model, 'roof_pitch', [
                    'addon' => ['prepend' => ['content'=>'<sup>o</sup>']]])->input('number', ['style'=>'width:30%'])->hint($model->hintRoofPitch) ?>

        <?= $form->field($model, 'characteristics')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderCharacteristics])->hint($model->hintCharacteristics) ?>

        
<?php /*
        <?= $form->field($model, 'buildFile')->widget(FileInput::classname(), [
                'options' => ['multiple' => true, 'accept' => 'image/*'],
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
            ])->hint($model->hintBuildFile) ?> */ ?>

    <?php endif; ?>

    <div class="row" style="margin:20px 0;">
        <div class="col-md-offset-4 col-md-<?= ($model->project->setup_status=='building' ? '8' : '4') ?>">
            <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-'.($model->project->setup_status=='building' ? 'default' : 'success').' '.($model->project->setup_status=='building' ? '' : 'btn-block').' shadow']) ?>
            <?php if($model->project->setup_status=='building'): ?>
            <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj i pređi na sledeći korak <i class="fa fa-arrow-right fa-lg"></i>', ['class' => 'btn btn-success shadow', 'name' => 'step_form', 'value' => 'next_step']) ?>    
        <?php endif; ?>
        </div>        
    </div>
</div>