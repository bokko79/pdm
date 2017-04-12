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


?>

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 7,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
    //'enableAjaxValidation' => true,
    'enableClientValidation' => true,
]); ?>

    
    <?= $form->field($model, 'building_id')->radioList(ArrayHelper::map(\common\models\BuildingTypes::find()->all(), 'id', 'name'))->hint($model->hintBuilding) ?>

    <?= $form->field($model, 'work')->dropDownList([ 'nova_gradnja' => 'Izgradnja', 'rekonstrukcija' => 'Rekonstrukcija', 'adaptacija' => 'Adaptacija', 'sanacija' => 'Sanacija', 'promena_namene' => 'Promena namene', 'dogradnja' => 'Dogradnja', 'ozakonjenje' => 'Ozakonjenje', 'odrzavanje' => 'Održavanje', 'ostalo' => 'Ostalo', ], ['prompt'=>'Izaberite vrstu radova...', 'disabled' => $model->isNewRecord ? false : true, 'id'=>'work-id'])->hint($model->hintWork) ?>

<?php if($model->isNewRecord): ?>
    <?= $form->field($model, 'phase')->widget(DepDrop::classname(), [                 
                'options'=>['id'=>'phase-id'],
                'pluginOptions'=>[
                    'depends'=>['work-id'],
                    'placeholder'=>'Izaberite vrstu projekta...',
                    'url'=>Url::to(['/projects/phases'])
                ]
            ])->hint($model->hintPhase) ?>
<?php else: ?>
    <?= $form->field($model, 'phase')->dropDownList(ArrayHelper::map(common\models\Projects::phases($model->work), 'id', 'name'), [])->hint($model->hintPhase) ?>
<?php endif; ?>
            <div class="adaptacija_part" style="display:none">
                <?= $form->field($model, 'object_type')->dropDownList([ 'stan' => 'Stan', 'biz' => 'Poslovni prostor - lokal', ], ['prompt' => ''])->hint('Vrsta jedinice koja se adaptira.') ?>
            </div>
<hr>
<h3>Adresa</h3>
    <?= $form->field($location, 'street')->textInput(['maxlength' => true]) ?>
    <?= $form->field($location, 'number')->textInput(['maxlength' => true]) ?>
    <?= $form->field($location, 'city_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Cities::find()->all(), 'id', 'town', 'city'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>
    <?= $form->field($location, 'lot')->textInput(['maxlength' => true])->hint('Opciono.') ?>
    <?= $form->field($location, 'county_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Counties::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,   
            ])->hint('Opciono.') ?>    

<hr>
<h3>Površine</h3>
    <?= $form->field($model, 'object_area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%']) ?>


    <?= $form->field($model, 'lot_area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%'])->hint('Opciono, okvirna površina parcele, gde se nalazi predmetni objekat.') ?>
<hr>
<h3>Vaš opis</h3>
    <?= $form->field($model, 'description')->textarea(['rows' => 6, 'placeholder'=>'Opciono, možete dodati Vašim rečima bliži opis radova/problema koji želite da obavite.'])->hint('Vaš opis radova/problema koji želite da obavite/rešite.') ?>

    <?= $form->field($model, 'docFile')->widget(FileInput::classname(), [
            'options' => ['multiple' => true, 'accept' => 'image/*'],
            'pluginOptions' => [
                'previewFileType' => 'any',
                'showCaption' => false,
                'showUpload' => false,
                'browseClass' => 'btn btn-info shadow',
                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                'browseLabel' =>  Yii::t('app', 'Izaberite dokument'),
                'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                'resizeImage'=> true,
                'maxImageWidth'=> 60,
                'maxImageHeight'=> 60,
                'resizePreference'=> 'width',
            ],
        ]) ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Izmeni', ['class' => $model->isNewRecord ? 'btn btn-success shadow' : 'btn btn-primary shadow']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
