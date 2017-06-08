<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;

$this->title = Yii::t('user', 'Registracija inženjera: Podaci o firmi');

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
                        ])  */?>

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->hint('Pun poslovni naziv Vaše firme. Npr: Preduzeće d.o.o. Beograd') ?>

                <hr> 
                <h6 style="margin:10px 0;">Adresa firme</h6>
                    <?= $form->field($location, 'street')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($location, 'number')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($location, 'city_id')->widget(Select2::classname(), [
                            'data' => ArrayHelper::map(\common\models\Cities::find()->all(), 'id', 'town'),
                            'options' => ['placeholder' => 'Izaberite...'],
                            'language' => 'sr-Latn',
                            'changeOnReset' => false,           
                        ]) ?>
                <hr>
                <?= $form->field($model, 'avatarFile')->widget(FileInput::classname(), [
                            'options' => [/*'multiple' => true,*/ 'accept' => 'image/*'],
                            'pluginOptions' => [
                                'previewFileType' => 'any',
                                'showCaption' => false,
                                'showUpload' => false,
                                'browseClass' => 'btn btn-info btn-block shadow',
                                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                                'browseLabel' =>  Yii::t('app', 'Prikačite logo firme'),
                                'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                                'resizeImage'=> true,
                                'maxImageWidth'=> 60,
                                'maxImageHeight'=> 60,
                                'resizePreference'=> 'width',
                            ],
                        ])->hint('Opciono. Logo (avatar) u .jpg ili .png formatu, dimenzija 200x200px.') ?>
                <hr>
                    <?= $form->field($model, 'stampFile')->widget(FileInput::classname(), [
                            'options' => [/*'multiple' => true,*/ 'accept' => 'image/*'],
                            'pluginOptions' => [
                                'previewFileType' => 'any',
                                'showCaption' => false,
                                'showUpload' => false,
                                'browseClass' => 'btn btn-info btn-block shadow',
                                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                                'browseLabel' =>  Yii::t('app', 'Prikačite pečat firme'),
                                'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                                'resizeImage'=> true,
                                'maxImageWidth'=> 60,
                                'maxImageHeight'=> 60,
                                'resizePreference'=> 'width',
                            ],
                        ])->hint('Pečat firme u .jpg ili .png formatu, minimalnih dimenzija 200x200px.') ?>
                <hr>
                   <?= Html::submitButton('Snimi firmu i završi registraciju', ['class' => 'btn btn-success btn-block shadow']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>