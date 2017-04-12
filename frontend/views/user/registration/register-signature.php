<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;

$this->title = Yii::t('user', 'Registracija inženjera: Potpis inženjera');
?>

<?= $this->render('_steps') ?>

<div class="row">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_VERTICAL,
    //'fullSpan' => 7,      
    //'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

    <?php /* $form->field($model, 'type')->dropDownList([ 
            'signature' => 'Potpis',
        ], ['prompt' => '', 'disabled'=>(!$model->type) ? false:true]) ?>

    <?= $form->field($model, 'entity')->dropDownList([ 'client' => 'Investitor', 'engineer' => 'Inženjer', 'practice' => 'Firma', 'authority' => 'Nadležni organ', ], ['prompt' => '', 'disabled'=>true])*/ ?>


   <?= $form->field($model, 'docFile')->widget(FileInput::classname(), [
            'options' => [/*'multiple' => true,*/ 'accept' => 'image/*'],
            'pluginOptions' => [
                'previewFileType' => 'any',
                'showCaption' => false,
                'showUpload' => false,
                'browseClass' => 'btn btn-info shadow btn-block',
                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                'browseLabel' =>  Yii::t('app', 'Izaberite skenirani potpis'),
                'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                'resizeImage'=> true,
                'maxImageWidth'=> 60,
                'maxImageHeight'=> 60,
                'resizePreference'=> 'width',
            ],
        ]) ?>
    <?= Html::submitButton('Snimi potpis i nastavi', ['class' => 'btn btn-success btn-block shadow']) ?>

<?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>