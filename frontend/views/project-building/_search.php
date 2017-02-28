<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-building-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


    <?= $form->field($model, 'project_id') ?>

    <?= $form->field($model, 'building_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'building_line_dist') ?>

    <?php // echo $form->field($model, 'lot_area') ?>

    <?php // echo $form->field($model, 'green_area_reg') ?>

    <?php // echo $form->field($model, 'green_area') ?>

    <?php // echo $form->field($model, 'gross_area_part') ?>

    <?php // echo $form->field($model, 'gross_area') ?>

    <?php // echo $form->field($model, 'gross_area_above') ?>

    <?php // echo $form->field($model, 'gross_area_below') ?>

    <?php // echo $form->field($model, 'gross_built_area') ?>

    <?php // echo $form->field($model, 'net_area') ?>

    <?php // echo $form->field($model, 'ground_floor_area') ?>

    <?php // echo $form->field($model, 'occupancy_area') ?>

    <?php // echo $form->field($model, 'occupancy_reg') ?>

    <?php // echo $form->field($model, 'occupancy') ?>

    <?php // echo $form->field($model, 'built_index_reg') ?>

    <?php // echo $form->field($model, 'built_index') ?>

    <?php // echo $form->field($model, 'storey') ?>

    <?php // echo $form->field($model, 'storey_height') ?>

    <?php // echo $form->field($model, 'units_total') ?>

    <?php // echo $form->field($model, 'parking_total') ?>

    <?php // echo $form->field($model, 'facade_material') ?>

    <?php // echo $form->field($model, 'ridge_orientation') ?>

    <?php // echo $form->field($model, 'roof_pitch') ?>

    <?php // echo $form->field($model, 'roof_material') ?>

    <?php // echo $form->field($model, 'characteristics') ?>

    <?php // echo $form->field($model, 'cost') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
