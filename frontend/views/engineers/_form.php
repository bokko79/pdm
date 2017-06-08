<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
use dosamigos\tinymce\TinyMce;
?>

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 9,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'expertees_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(\common\models\Expertees::find()->all(), 'id', 'name'),
                        'options' => ['placeholder' => 'Izaberite...'],
                        'language' => 'sr-Latn',
                        'changeOnReset' => false,           
                    ])->hint('Stečeno stručno zvanje inženjera.') ?>
<hr>
    <?= $model->signFile ? '<div class="col-md-offset-3"> Vaš skenirani potpis:<br><br>'.$model->engSignature.'</div><br>' : null ?>
    <?= $form->field($model, 'signatureFile')->widget(FileInput::classname(), [
            'options' => [/*'multiple' => true,*/ 'accept' => 'image/*'],
            'pluginOptions' => [
                'previewFileType' => 'any',
                'showCaption' => false,
                'showUpload' => false,
                'browseClass' => 'btn btn-info btn-block shadow',
                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                'browseLabel' =>  Yii::t('app', 'Prikačite svoj potpis'),
                'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                'resizeImage'=> true,
                'maxImageWidth'=> 60,
                'maxImageHeight'=> 60,
                'resizePreference'=> 'width',
            ],
        ])->hint('Prikačite svoj skenirani potpis u .jpg ili .png formatu.') ?>
<hr>
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true])->hint('Kontakt telefon inženjera.') ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true])->hint('Kontakt email adresa.') ?>

    <?= $form->field($model, 'about')->widget(TinyMce::className(), [
        'options' => ['rows' => 12],
        'language' => 'sr',
        'clientOptions' => [
            'plugins' => [
            ],
            'convert_fonts_to_spans' => true,
            'paste_as_text' => true,
            //'menubar' => true,
            'statusbar' => true,
            //'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent"
        ]
    ]) ?>
<hr>
        <?php /*
    <?= $model->aFile ? '<div class="col-md-offset-3"> Vaša trenutna profilna slika:<br><br>'.Html::img('/images/profiles/'.$model->aFile->name, ['style'=>'width:150px; margin:0 0 20px;']).'</div>' : null ?>
    <?= $form->field($model, 'avatarFile')->widget(FileInput::classname(), [
            'options' => ['multiple' => true, 'accept' => 'image/*'],
            'pluginOptions' => [
                'previewFileType' => 'any',
                'showCaption' => false,
                'showUpload' => false,
                'browseClass' => 'btn btn-info shadow btn-block',
                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                'browseLabel' =>  Yii::t('app', 'Prikačite profilnu sliku'),
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
            'options' => ['multiple' => true, 'accept' => 'image/*'],
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
        ]) */ ?>

    <div class="form-group">
        <div class="col-lg-offset-3 col-lg-6">
            <?= Html::submitButton(Yii::t('user', 'Sačuvaj izmene'), ['class' => 'btn btn-block btn-success']) ?><br>
        </div>
    </div>
<?php ActiveForm::end(); ?>
