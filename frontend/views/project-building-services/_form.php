<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingServices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-building-services-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'grejanje' => 'Grejanje', 'hladjenje' => 'Hladjenje', 'ventilacija' => 'Ventilacija', 'sprinkleri' => 'Sprinkleri', 'vodovod' => 'Vodovod', 'hidrant' => 'Hidrant', 'kanalizacija' => 'Kanalizacija', 'gas' => 'Gas', 'telefon' => 'Telefon', 'tv' => 'Tv', 'struja' => 'Struja', 'video' => 'Video', 'internet' => 'Internet', 'toplovod' => 'Toplovod', 'lift' => 'Lift', 'bazen' => 'Bazen', 'geotehnika' => 'Geotehnika', 'konstrukcija' => 'Konstrukcija', 'saobracaj' => 'Saobracaj', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
