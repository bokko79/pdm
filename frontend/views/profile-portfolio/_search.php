<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProfilePortfolioSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-portfolio-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'profile_type') ?>

    <?= $form->field($model, 'profile_id') ?>

    <?= $form->field($model, 'portfolio_type') ?>

    <?= $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'company') ?>

    <?php // echo $form->field($model, 'start_month') ?>

    <?php // echo $form->field($model, 'start_year') ?>

    <?php // echo $form->field($model, 'current') ?>

    <?php // echo $form->field($model, 'end_month') ?>

    <?php // echo $form->field($model, 'end_year') ?>

    <?php // echo $form->field($model, 'summary') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
