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
<hr>
<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 7,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>
    
    <?= $form->field($model, 'engineer_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Engineers::find()->all(), 'user_id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,
            'disabled' => true,           
        ]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->hint('Pun poslovni naziv preduzeća. Npr: Preduzeće d.o.o. Beograd') ?>

<hr> 
<h4>Adresa preduzeća</h4>
    <?= $form->field($location, 'street')->textInput(['maxlength' => true]) ?>
    <?= $form->field($location, 'number')->textInput(['maxlength' => true]) ?>
    <?= $form->field($location, 'city_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Cities::find()->all(), 'id', 'town'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>

<hr> 
<h4>Kontakt podaci</h4>
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>    
<hr> 
<h4>Poslovni podaci</h4>   

    <?= $form->field($model, 'tax_no')->input(['number']) ?>

    <?= $form->field($model, 'company_no')->input(['number']) ?>

    <?= $form->field($model, 'account_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank')->textInput(['maxlength' => true]) ?>
<hr>
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
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Izmeni', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
