<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectVolumesSearch */
/* @var $form yii\widgets\ActiveForm */
$model->project_id = $project->id;
?>

<div class="project-volumes-search">

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_VERTICAL,
    //'fullSpan' => 7,      
    //'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['style'=>'margin-top:0 !important;'],
    //'enableAjaxValidation' => true,
    'action' => ['index'],
    'method' => 'get',
    //'enableClientValidation' => true,
]); ?>

    <?php /* $form->field($model, 'id')  */ ?>

    <?= $form->field($model, 'project_id')->input('hidden')->label(false) ?>

    <?= $form->field($model, 'volume_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Volumes::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,
            'pluginOptions'=>['allowClear'=>true],
        ])->hint('') ?>

    <?php /* $form->field($model, 'practice_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Practices::find()->all(), 'engineer_id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,
            'pluginOptions'=>['allowClear'=>true],
        ])->hint('') ?>

    <?= $form->field($model, 'engineer_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Engineers::find()->all(), 'user_id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,
            'pluginOptions'=>['allowClear'=>true],
        ])->hint('') */ ?>

    <?php // echo $form->field($model, 'number') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Traži'), ['class' => 'btn btn-primary btn-block']) ?>
        <?php // Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
