<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;

$this->title = Yii::t('user', 'Registracija inženjera: Licencni paket');

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

    <?php /* $form->field($model, 'engineer_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Engineers::find()->all(), 'user_id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false, 
            'disabled' => true,          
        ]) */ ?>

    <?php // $form->field($model, 'type')->textInput() ?>
    <?= $form->field($model, 'licence_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(\common\models\Licences::find()->all(), 'id', 'fullname'),
                        'options' => ['placeholder' => 'Izaberite...'],
                        'language' => 'sr-Latn',
                        'changeOnReset' => false,           
                    ]) ?>

    <?= $form->field($model, 'no')->textInput()->hint('Broj licence.') ?>

<hr>

    <?= $form->field($model, 'stampFile')->widget(FileInput::classname(), [
            'options' => [/*'multiple' => true,*/ 'accept' => 'image/*'],
            'pluginOptions' => [
                'previewFileType' => 'any',
                'showCaption' => false,
                'showUpload' => false,
                'browseClass' => 'btn btn-info btn-block shadow',
                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                'browseLabel' =>  Yii::t('app', 'Izaberite skenirani pećat'),
                'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                'resizeImage'=> true,
                'maxImageWidth'=> 60,
                'maxImageHeight'=> 60,
                'resizePreference'=> 'width',
            ],
        ])->hint('Prikačite skenirani licencni pečat inženjera u .jpg ili .png formatu.') ?>

<hr>
 
            <?= Html::submitButton('Snimi licencni paket i nastavi', ['class' => 'btn btn-success btn-block shadow']) ?>
            


<?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>