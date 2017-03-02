<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PhaseVolumeInsetsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phase-volume-insets-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'phase_volume_id') ?>

    <?= $form->field($model, 'inset_id') ?>

    <?= $form->field($model, 'info') ?>

    <?= $form->field($model, 'file_id') ?>

    <?php // echo $form->field($model, 'requirement') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
