<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PracticesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="practices-search" style="margin:20px;">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'layout' => 'inline',
    ]); ?>


    <?= $form->field($model, 'name') ?>

    <?php /* $form->field($model, 'location_id') ?>

    <?= $form->field($model, 'phone') ?>

    <?= $form->field($model, 'email')*/ ?>

    <?php // echo $form->field($model, 'engineer_id') ?>

    <?php // echo $form->field($model, 'fax') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Traži'), ['class' => 'btn btn-primary btn-sm shadow']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default btn-sm shadow']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
