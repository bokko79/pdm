<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<h4>Visinske kote</h4>
<hr>
	<?= $form->field($model, 'ground_level', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint('Apsolutna visinska kota terena, data lokacijskim uslovima ili drugim važećim dokumentom, geodetskim snimkom ili sl. Ukoliko je teren strm, odrediti repernu tačku ili prosečnu vrednost.') ?>

    <?= $form->field($model, 'road_level', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint('Apsolutna visinska kota nivelete, data lokacijskim uslovima.') ?>

    <?= $form->field($model, 'underwater_level', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint('Apsolutna visinska kota maksimalnih podzemnih voda.') ?>

    <?= $form->field($model, 'underwater_level_min', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint('Apsolutna visinska kota minimalnih podzemnih voda.') ?>