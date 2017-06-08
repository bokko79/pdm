<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\EngineersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="engineers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php /* $form->field($model, 'user_id') */ ?>

    <?= $form->field($model, 'phone') ?>
    <?= $form->field($model, 'email') ?>

    <?php /* $form->field($model, 'title') ?>

    <?= $form->field($model, 'phone') ?>

    <?= $form->field($model, 'email')*/ ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Traži'), ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default btn-sm']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
