<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingStoreyDoorwin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-building-storey-doorwin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_building_storey_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_building_doorwin_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lefts')->textInput() ?>

    <?= $form->field($model, 'rights')->textInput() ?>

    <?= $form->field($model, 'total')->textInput() ?>

    <?= $form->field($model, 'length')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'length_horizontal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'length_slanted')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'length_vertical')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
