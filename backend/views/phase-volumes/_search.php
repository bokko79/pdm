<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PhaseVolumesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phase-volumes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'phase') ?>

    <?= $form->field($model, 'volume_id') ?>

    <?= $form->field($model, 'no') ?>

    <?= $form->field($model, 'info') ?>

    <?php // echo $form->field($model, 'file_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
