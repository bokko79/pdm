<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\QsPositionsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="qs-positions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'subwork_id') ?>

    <?= $form->field($model, 'action_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'unit') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'subtext') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
