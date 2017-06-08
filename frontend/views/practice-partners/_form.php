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

    <?php /* $form->field($model, 'practice_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Practices::find()->all(), 'engineer_id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,   
            'disabled' => true,        
        ]) */ ?>

    <?= $form->field($model, 'partner_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Practices::find()->andWhere(['!=','engineer_id', Yii::$app->user->id])->all(), 'engineer_id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false, 
            'disabled' => $model->partner_id ? true : false,
        ]) ?>


    <div class="row" style="margin:20px 0;">
        <div class="col-md-offset-4 col-md-6">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Sačuvaj izmene', ['class' => !$model->isNewRecord ? 'btn btn-success btn-block shadow' : 'btn btn-primary btn-block shadow']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>