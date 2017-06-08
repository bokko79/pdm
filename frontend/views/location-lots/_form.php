<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
?>

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 10,      
    'formConfig' => ['labelSpan' => 4, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data', 'style'=>'margin-top:0px !important;'],
]); ?>

    <?php /* $form->field($model, 'location_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Locations::find()->all(), 'id', 'county0.name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,   
            'disabled'=>true        
        ]) */ ?>

    <?= $form->field($model, 'type')->dropDownList([ 'object' => 'Građevinska parcela', 'service' => 'Parcela instalacija', 'access' => 'Parcela pristupa'], ['prompt' => '', 'disabled'=>true]) ?>

    <?= $form->field($model, 'lot')->textInput(['maxlength' => true]) ?>

    <div class="row" style="margin:20px 0;">
        <div class="col-md-offset-4">
            <?= Html::submitButton($model->isNewRecord ? 'Dodaj' : 'Sačuvaj izmene', ['class' => !$model->isNewRecord ? 'btn btn-success shadow' : 'btn btn-primary shadow']) ?>
            <?php if(!$model->isNewRecord and (($model->type=='object' and count($model->location->locationLots)>1) or $model->type=='service' or $model->type=='access')){
                echo Html::a(Yii::t('app', 'Obriši'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger shadow',
                    'data' => [
                        'confirm' => Yii::t('app', 'Da li ste sigurni da želite da obrišete parcelu? Proces ne može biti vraćen.'),
                        'method' => 'post',
                    ],
                ]);
            } ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
