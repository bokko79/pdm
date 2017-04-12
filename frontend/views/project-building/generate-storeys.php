<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 7,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>
    <?= $form->field($model, 'podrum')->input('number', ['style'=>'width:40%']) ?>
    <?= $form->field($model, 'suteren')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'sm']]) ?>
    <?= $form->field($model, 'visokoprizemlje')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'sm']]) ?>
    <?= $form->field($model, 'galerija')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'sm']]) ?>
    <?= $form->field($model, 'mezanin')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'sm']]) ?>
    <?= $form->field($model, 'sprat')->input('number', ['style'=>'width:40%']) ?>
    <?= $form->field($model, 'povucenisprat')->input('number', ['style'=>'width:40%']) ?>
    <?= $form->field($model, 'potkrovlje')->input('number', ['style'=>'width:40%']) ?>
    <?= $form->field($model, 'mansarda')->input('number', ['style'=>'width:40%']) ?>
    <?= $form->field($model, 'tavan')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'sm']]) ?>
    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton('Generiši spratove objekta', ['class' => 'btn btn-success']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
