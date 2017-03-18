<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectQsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-qs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'project_id') ?>

    <?= $form->field($model, 'subwork_id') ?>

    <?= $form->field($model, 'position_id') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'action') ?>

    <?php // echo $form->field($model, 'qty') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
