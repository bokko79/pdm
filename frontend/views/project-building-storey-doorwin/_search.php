<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingStoreyDoorwinSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-building-storey-doorwin-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'project_building_storey_id') ?>

    <?= $form->field($model, 'project_building_doorwin_id') ?>

    <?= $form->field($model, 'lefts') ?>

    <?= $form->field($model, 'rights') ?>

    <?php // echo $form->field($model, 'total') ?>

    <?php // echo $form->field($model, 'length') ?>

    <?php // echo $form->field($model, 'length_horizontal') ?>

    <?php // echo $form->field($model, 'length_slanted') ?>

    <?php // echo $form->field($model, 'length_vertical') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
