<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<h4>Opšti podaci parcele</h4>
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

    <?= $form->field($model, 'climate')->input('number', ['min'=>2, 'max'=>3, 'style'=>'width:40%'])->hint('Klimatska zona') ?>

    <?= $form->field($model, 'seismic')->input('number', ['min'=>5, 'max'=>9, 'style'=>'width:40%'])->hint('Seizmička zona') ?>
