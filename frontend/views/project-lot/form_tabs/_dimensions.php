<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
use dosamigos\tinymce\TinyMce;
use kartik\checkbox\CheckboxX;
?>

<h4>Dimenzije parcele</h4>
<hr>
    <?= $form->field($model, 'area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'width', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%', 'placeholder'=>'npr.14.50'])->hint('Širina parcele u metrima. Ukoliko je parcela nepravilnog oblika, uneti prosečnu, okvirnu vrednost.') ?>

    <?= $form->field($model, 'length', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%'])->hint('Dužina parcele u metrima. Ukoliko je parcela nepravilnog oblika, uneti prosečnu, okvirnu vrednost.') ?> 