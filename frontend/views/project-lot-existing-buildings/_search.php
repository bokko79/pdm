<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectLotExistingBuildingsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-lot-existing-buildings-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'project_id') ?>

    <?= $form->field($model, 'building_type_id') ?>

    <?= $form->field($model, 'conditions') ?>

    <?= $form->field($model, 'gross_area') ?>

    <?php // echo $form->field($model, 'removal') ?>

    <?php // echo $form->field($model, 'file_id') ?>

    <?php // echo $form->field($model, 'storeys') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
