<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\PhaseVolumes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phase-volumes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'phase')->dropDownList([ 'gnp' => 'Gnp', 'idr' => 'Idr', 'idp' => 'Idp', 'pgd' => 'Pgd', 'pzi' => 'Pzi', 'pio' => 'Pio', 'tkp' => 'Tkp', 'ozk' => 'Ozk', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'volume_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'info')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'file_id')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
