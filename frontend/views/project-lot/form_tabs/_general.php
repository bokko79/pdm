<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<h4>Osnovni podaci</h4>
<hr>
    <?= $form->field($model, 'project_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Projects::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false, 
            'disabled' => true,         
        ]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'gradjevinska' => 'Gradjevinska', 'javna' => 'Javna', 'poljoprivredna' => 'Poljoprivredna', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'conditions')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'md']])->hint('Katastarska parcela ispunjava uslov za građevinsku parcelu prema važećem prostornom planu?') ?>
