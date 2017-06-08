<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<h4>Priključci na infrastrukturu</h4> 
<hr>


    <?= $form->field($model, 'conn_water')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'conn_electric')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'conn_telecom')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'conn_heating')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    <?= $form->field($model, 'conn_gas')->textarea(['rows' => 6, 'placeholder'=>'']) ?>