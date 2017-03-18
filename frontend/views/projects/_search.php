<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="projects-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'client_id') ?>

    <?= $form->field($model, 'building_id') ?>

    <?php // echo $form->field($model, 'location_id') ?>

    <?php // echo $form->field($model, 'work') ?>

    <?php // echo $form->field($model, 'phase') ?>

    <?php // echo $form->field($model, 'practice_id') ?>

    <?php // echo $form->field($model, 'engineer_id') ?>

    <?php // echo $form->field($model, 'location_access_id') ?>

    <?php // echo $form->field($model, 'location_services_id') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary shadow']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default shadow']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
