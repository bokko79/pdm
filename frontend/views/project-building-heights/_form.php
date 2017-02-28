<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingHeights */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-building-heights-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_building_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'part')->dropDownList([ 'venac' => 'Venac', 'sleme' => 'Sleme', 'psprat' => 'Psprat', 'drugo' => 'Drugo', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'height' => 'Height', 'level' => 'Level', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
