<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PhaseVolumeInsets */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phase-volume-insets-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'phase_volume_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'inset_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'file_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'requirement')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
