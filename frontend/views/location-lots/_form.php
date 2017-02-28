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
    'fullSpan' => 7,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

    <?= $form->field($model, 'location_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Locations::find()->all(), 'id', 'county0.name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,   
            'disabled'=>true        
        ]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'object' => 'Objekat', 'service' => 'Infrastruktura', 'access' => 'Pristup'], ['prompt' => '', 'disabled'=>true]) ?>

    <?= $form->field($model, 'lot')->textInput(['maxlength' => true]) ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Dodaj' : 'Izmeni', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?php if(!$model->isNewRecord){
                echo Html::a(Yii::t('app', 'Obriši'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]);
            } ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
