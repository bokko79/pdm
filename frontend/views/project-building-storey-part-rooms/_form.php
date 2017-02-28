<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingStoreyPartRooms */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-building-storey-part-rooms-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_building_storey_part_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'soba' => 'Soba', 'terasa' => 'Terasa', 'kupatilo' => 'Kupatilo', 'sanitarni' => 'Sanitarni', 'kuhinja' => 'Kuhinja', 'trpezarija' => 'Trpezarija', 'dnevna' => 'Dnevna', 'radna' => 'Radna', 'spavaca' => 'Spavaca', 'tehnicka' => 'Tehnicka', 'balkon' => 'Balkon', 'hodnik' => 'Hodnik', 'predprostor' => 'Predprostor', 'degazman' => 'Degazman', 'ulaz' => 'Ulaz', 'trem' => 'Trem', 'laboratorija' => 'Laboratorija', 'studio' => 'Studio', 'igraonica' => 'Igraonica', 'radionica' => 'Radionica', 'stepeniste' => 'Stepeniste', 'vesernica' => 'Vesernica', 'kotlarnica' => 'Kotlarnica', 'lift' => 'Lift', 'dnevna_kuhinja' => 'Dnevna kuhinja', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'circumference')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'flooring')->dropDownList([ 'parket' => 'Parket', 'keramika' => 'Keramika', 'estrih' => 'Estrih', 'tarkett' => 'Tarkett', 'beton' => 'Beton', 'opeka' => 'Opeka', 'kamen' => 'Kamen', 'teraco' => 'Teraco', 'zemlja' => 'Zemlja', 'tepih' => 'Tepih', 'drugo' => 'Drugo', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'length')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'width')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'height')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sub_net_area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'net_area')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
