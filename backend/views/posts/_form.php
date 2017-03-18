<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
use kartik\widgets\DepDrop;
use dosamigos\tinymce\TinyMce;

?>

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 12,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
    //'enableAjaxValidation' => true,
    'enableClientValidation' => true,
]); ?>

    <?= $form->field($model, 'category_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\PostCategories::find()->all(), 'id', 'category'),
            'options' => ['placeholder' => ''],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subtitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(TinyMce::className(), [
        'options' => ['rows' => 12],
        'language' => 'sr',
        'clientOptions' => [
            'plugins' => [
               "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste image"
            ],
            'convert_fonts_to_spans' => true,
            'paste_as_text' => true,
            'menubar' => true,
            'statusbar' => true,
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        ]
    ]) ?>

    <?= $form->field($model, 'excerpt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'core' => 'Core', 'news' => 'News', 'info' => 'Info', 'edu' => 'Edu', 'promo' => 'Promo', 'article' => 'Article', 'help' => 'Help', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'active' => 'Active', 'draft' => 'Draft', 'expired' => 'Expired', 'deleted' => 'Deleted', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'next_post')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'docFile')->widget(FileInput::classname(), [
            'options' => [/*'multiple' => true,*/ 'accept' => 'image/*'],
            'pluginOptions' => [
                'previewFileType' => 'any',
                'showCaption' => false,
                'showUpload' => false,
                'browseClass' => 'btn btn-info shadow',
                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                'browseLabel' =>  Yii::t('app', 'Izaberi naslovnu sliku'),
                'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                'resizeImage'=> true,
                'maxImageWidth'=> 60,
                'maxImageHeight'=> 60,
                'resizePreference'=> 'width',
            ],
        ]) ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Izmeni', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
