<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectLotSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-lot-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'project_id') ?>

    <?= $form->field($model, 'conditions') ?>

    <?= $form->field($model, 'width') ?>

    <?= $form->field($model, 'length') ?>

    <?= $form->field($model, 'disposition') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'area') ?>

    <?php // echo $form->field($model, 'ground_level') ?>

    <?php // echo $form->field($model, 'road_level') ?>

    <?php // echo $form->field($model, 'underwater_level') ?>

    <?php // echo $form->field($model, 'ground') ?>

    <?php // echo $form->field($model, 'access') ?>

    <?php // echo $form->field($model, 'ownership') ?>

    <?php // echo $form->field($model, 'adjacent_border') ?>

    <?php // echo $form->field($model, 'services') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'legal') ?>

    <?php // echo $form->field($model, 'green_area_reg') ?>

    <?php // echo $form->field($model, 'green_area') ?>

    <?php // echo $form->field($model, 'occupancy_reg') ?>

    <?php // echo $form->field($model, 'built_index_reg') ?>

    <?php // echo $form->field($model, 'parking') ?>

    <?php // echo $form->field($model, 'parking_spaces') ?>

    <?php // echo $form->field($model, 'parking_disabled') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
