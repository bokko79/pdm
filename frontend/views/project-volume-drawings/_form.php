<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectVolumeDrawings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-volume-drawings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'project_volume_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_building_storey_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 
                 
                'osnova' => 'Osnova', 
                'etaza' => 'Osnova etaže', 
                'temelj' => 'Osnova temelja', 
                'krovna' => 'Osnova krovne konstrukcije', 
                'presek' => 'Presek', 
                'izgled' => 'Izgled', 
                'detalj' => 'Detalj', 
                'situacija' => 'Situacija', 
                'izv1' => 'Situacioni plan sa osnovom krova', 
                'izv2' => 'Situaciono nivelacioni plan sa osnovom prizemlja', 
                'izv3' => 'Situaciono nivelacioni plan sa prikazom saobraćajnog rešenja', 
                'izv4' => 'Situacioni plan sa prikazom sinhron-plana instalacija', 
                'izv5' => 'Osnova etaže pristup svetlarniku',
                '3d' => '3D prikaz, perspektiva, izometrija', 
                'sema' => 'Šema', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'scale')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
