<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<h4>Numerički podaci</h4>
<hr>

<?php if($model->project->work=='dogradnja' or $model->project->work=='sanacija' or $model->project->work=='rekonstrukcija'): ?>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]width',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:100%'])->hint('') ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'width', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]width',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:100%'])->hint('') ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]length',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:100%'])->hint('') ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'length', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]length',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:100%'])->hint('') ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]ground_floor_level',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:100%'])->hint('Apsolutna visinska kota gotovog poda prizemlja objekta, npr. 81.60. Ova kota se koristi kao referentna kota za sve ostale visinke kote objekta.') ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'ground_floor_level', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]ground_floor_level',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:100%'])->hint('Apsolutna visinska kota gotovog poda prizemlja objekta, npr. 81.60. Ova kota se koristi kao referentna kota za sve ostale visinke kote objekta.') ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]building_line_dist',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.1, 'style'=>'width:100%'])->hint('Osovinsko rastojanje između građevinske i regulacione linije parcele.')?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'building_line_dist', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]building_line_dist',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.1, 'style'=>'width:100%'])->hint('Osovinsko rastojanje između građevinske i regulacione linije parcele.') ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]gross_area_part',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'style'=>'width:100%'])->hint('Samo u slučaju objekata iz člana 145. Pravilnika.') ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'gross_area_part', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]gross_area_part',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'style'=>'width:100%'])->hint('Samo u slučaju objekata iz člana 145. Pravilnika.') ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]storey_height',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:100%']) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'storey_height', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]storey_height',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:100%']) ?>
    </div>
</div>


<?php else: ?>


    <?= $form->field($model, 'width', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint('') ?>

    <?= $form->field($model, 'length', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint('') ?>

    <?= $form->field($model, 'ground_floor_level', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint('Apsolutna visinska kota gotovog poda prizemlja objekta, npr. 81.60. Ova kota se koristi kao referentna kota za sve ostale visinke kote objekta.') ?>

    <?= $form->field($model, 'building_line_dist', [
                'addon' => ['prepend' => ['content'=>'m']],
            ])->input('number', ['step'=>0.1, 'style'=>'width:40%'])->hint('Osovinsko rastojanje između građevinske i regulacione linije parcele.') ?>


    <?= $form->field($model, 'gross_area_part', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint('Samo u slučaju objekata iz člana 145. Pravilnika.') ?>


    <?= $form->field($model, 'storey_height', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%']) ?>

<?php endif; ?>