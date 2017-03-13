<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingDoorwinSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-building-doorwin-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'pos_no') ?>

    <?= $form->field($model, 'pos_type') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'project_building_id') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'width') ?>

    <?php // echo $form->field($model, 'height') ?>

    <?php // echo $form->field($model, 'frame') ?>

    <?php // echo $form->field($model, 'sash') ?>

    <?php // echo $form->field($model, 'opening_type') ?>

    <?php // echo $form->field($model, 'material') ?>

    <?php // echo $form->field($model, 'metal') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'scale') ?>

    <?php // echo $form->field($model, 'file_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
