<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingStoreyParts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-building-storey-parts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_building_storey_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'stan' => 'Stan', 'apartman' => 'Apartman', 'poslovni prostor' => 'Poslovni prostor', 'tehničke prostoije' => 'Tehničke prostoije', 'zajedničke prostorije' => 'Zajedničke prostorije', 'garaža' => 'Garaža', 'spoljašnje prostorije' => 'Spoljašnje prostorije', 'sprat' => 'Sprat', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mark')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
