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
    'fullSpan' => 10,      
    'formConfig' => ['labelSpan' => 4, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

    <?php /* $form->field($model, 'engineer_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Engineers::find()->all(), 'user_id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false, 
            'disabled' => true,          
        ]) */ ?>

    <?= $form->field($model, 'licence_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(\common\models\Licences::find()->all(), 'id', 'fullname'),
                        'options' => ['placeholder' => 'Izaberite...'],
                        'language' => 'sr-Latn',
                        'changeOnReset' => false,           
                    ]) ?>

    <?= $form->field($model, 'no')->textInput() ?>

<hr>
<?= $model->stamp ? '<div class="col-md-offset-4"> Trenutni dokument:<br>'.Html::img('/images/legal_files/licences/'.$model->stamp->name, ['style'=>'width:150px; margin:0 0 20px;']).'</div>' : null ?>

    <?= $form->field($model, 'stampFile')->widget(FileInput::classname(), [
            'options' => [/*'multiple' => true,*/ 'accept' => 'image/*'],
            'pluginOptions' => [
                'previewFileType' => 'any',
                'showCaption' => false,
                'showUpload' => false,
                'browseClass' => 'btn btn-info shadow btn-block',
                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                'browseLabel' =>  Yii::t('app', 'Prikačite pečat'),
                'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                'resizeImage'=> true,
                'maxImageWidth'=> 60,
                'maxImageHeight'=> 60,
                'resizePreference'=> 'width',
            ],
        ])->hint('Prikačite Vaš licencni pečat (šestougaoni, izdat od strane Inženjerske komore Srbije), u .jpg, .jpeg ili .png formatu.') ?>
<?php /*
<hr>
<?= $model->copy ? '<div class="col-md-offset-3"> Trenutni dokument:<br>'.Html::img('/images/legal_files/licences/'.$model->copy->name, ['style'=>'width:150px; margin:0 0 20px;']).'</div>' : null ?>


    <?= $form->field($model, 'copyFile')->widget(FileInput::classname(), [
            'options' => ['multiple' => true, 'accept' => 'image/*'],
            'pluginOptions' => [
                'previewFileType' => 'any',
                'showCaption' => false,
                'showUpload' => false,
                'browseClass' => 'btn btn-info shadow btn-block',
                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                'browseLabel' =>  Yii::t('app', 'Izaberite dokument'),
                'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                'resizeImage'=> true,
                'maxImageWidth'=> 60,
                'maxImageHeight'=> 60,
                'resizePreference'=> 'width',
            ],
        ])->hint('Opciono.') ?>
<hr>

<?= $model->conf ? '<div class="col-md-offset-3"> Trenutni dokument:<br>'.Html::img('/images/legal_files/licences/'.$model->conf->name, ['style'=>'width:150px; margin:0 0 20px;']).'</div>' : null ?>

    <?= $form->field($model, 'confFile')->widget(FileInput::classname(), [
            'options' => ['multiple' => true, 'accept' => 'image/*'],
            'pluginOptions' => [
                'previewFileType' => 'any',
                'showCaption' => false,
                'showUpload' => false,
                'browseClass' => 'btn btn-info shadow btn-block',
                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                'browseLabel' =>  Yii::t('app', 'Izaberite dokument'),
                'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                'resizeImage'=> true,
                'maxImageWidth'=> 60,
                'maxImageHeight'=> 60,
                'resizePreference'=> 'width',
            ],
        ])->hint('Opciono.') */ ?>



    <div class="row" style="margin:20px 0;">
        <div class="col-md-offset-4 col-md-6">
            <?= Html::submitButton($model->isNewRecord ? 'Dodaj licencu' : 'Sačuvaj izmene', ['class' => !$model->isNewRecord ? 'btn btn-success shadow' : 'btn btn-primary btn-block shadow']) ?>
            <?= (!$model->isNewRecord) ? Html::a(Yii::t('app', 'Ukloni'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Da li zaista želite da obrišete ovaj licencni paket? Proces ne može biti vraćen.'),
                    'method' => 'post',
                ],
            ]) : null ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
