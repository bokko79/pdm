<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingStoreyPartRoomsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-building-storey-part-rooms-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'project_building_storey_part_id') ?>


    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'mark') ?>

    <?php // echo $form->field($model, 'circumference') ?>

    <?php // echo $form->field($model, 'flooring') ?>

    <?php // echo $form->field($model, 'length') ?>

    <?php // echo $form->field($model, 'width') ?>

    <?php // echo $form->field($model, 'height') ?>

    <?php // echo $form->field($model, 'sub_net_area') ?>

    <?php // echo $form->field($model, 'net_area') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
