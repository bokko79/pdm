<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
use dosamigos\tinymce\TinyMce;

($model->isNewRecord) ? $model->percent = 100-$model->projectBuilding->getClassPercentageTotal() : null;
?>

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 10,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

    <?php /* $form->field($model, 'project_building_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\ProjectBuilding::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false, 
            'disabled' => true,         
        ]) */ ?>

    <?= $form->field($model, 'building_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Buildings::find()->all(), 'id', 'fullname'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,         
        ]) ?>

    <?= $form->field($model, 'percent', [
                'addon' => ['prepend' => ['content'=>'%']]])->input('number', ['min'=>0, 'max'=>100, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['min'=>0, 'step'=>0.01, 'style'=>'width:40%']) ?>

    <div class="row" style="margin:20px 0;">
        <div class="col-md-offset-3 col-md-7">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Sačuvaj izmene', ['class' => !$model->isNewRecord ? 'btn btn-success shadow' : 'btn btn-primary shadow btn-block']) ?>
            <?= (!$model->isNewRecord) ? Html::a(Yii::t('app', 'Ukloni'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Da li želite da uklonite klasu objekta?'),
                    'method' => 'post',
                ],
            ]) : null ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
