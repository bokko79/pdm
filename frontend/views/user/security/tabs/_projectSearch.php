<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

?>

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_VERTICAL,
    //'fullSpan' => 7,      
    //'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data', 'style'=>'margin-top:0 !important;'],
    //'enableAjaxValidation' => true,
    //'action' => ['index'],
    'method' => 'get',
    //'enableClientValidation' => true,
]); ?>

    <?php // echo $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'code') ?>

    <?php // echo $form->field($model, 'client_id') ?>

    <?php /* $form->field($model, 'building_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Buildings::find()->all(), 'id', 'fullname'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,
        ])->hint($model->hintBuilding) */ ?>

    <?php // echo $form->field($model, 'location_id') ?>

    <?php // echo $form->field($model, 'work') ?>

    <?php // echo $form->field($model, 'phase') ?>

    <?php // echo $form->field($model, 'practice_id') ?>
    <?= $form->field($model, 'client_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Clients::find()->where('practice_id='.Yii::$app->user->id)->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...', 'id'=>'catcont-id'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,
            'pluginOptions'=>['allowClear'=>true],
        ])->hint('') ?>

    <?php // echo $form->field($model, 'engineer_id') ?>

    <?php // echo $form->field($model, 'location_access_id') ?>

    <?php // echo $form->field($model, 'location_services_id') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Traži'), ['class' => 'btn btn-primary shadow']) ?>
        <?= Html::a('Reset', [''], ['class' => 'btn btn-default shadow']) ?>
    </div>

    <?php ActiveForm::end(); ?>


