<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectFiles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-files-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'informacija' => 'Informacija', 'uslovi' => 'Uslovi', 'plan' => 'Plan', 'saglasnost' => 'Saglasnost', 'svojina' => 'Svojina', 'geodetski' => 'Geodetski', 'punomoc' => 'Punomoc', 'ugovor' => 'Ugovor', 'zalba' => 'Zalba', 'resenje' => 'Resenje', 'odobrenje' => 'Odobrenje', 'dozvola' => 'Dozvola', 'uplatnica' => 'Uplatnica', 'drugo' => 'Drugo', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'file_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
