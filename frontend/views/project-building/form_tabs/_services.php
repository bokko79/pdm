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

<?php if($model->projectBuilding->project->work=='dogradnja' or $model->projectBuilding->project->work=='sanacija' or $model->projectBuilding->project->work=='rekonstrukcija'): ?>

<div class="form-group" style="margin:40px; 0">
    
    <div class="col-sm-5 center">
        <h4>Postojeće stanje</h4>
    </div>
    <div class="col-sm-2">
        
    </div>
    <div class="col-sm-5 center">
        <h4>Predviđeno stanje stanje</h4>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]general',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderGeneral])->hint($model->hintGeneral) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'general', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]general',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderGeneral])->hint($model->hintGeneral) ?>
    </div>
</div>

<hr>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]water',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderWater])->hint($model->hintWater) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'water', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]water',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderWater])->hint($model->hintWater) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]sewage',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderSewage])->hint($model->hintSewage) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'sewage', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]sewage',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderSewage])->hint($model->hintSewage) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]electricity',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderElectricity])->hint($model->hintElectricity) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'electricity', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]electricity',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderElectricity])->hint($model->hintElectricity) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]phone',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderPhone])->hint($model->hintPhone) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'phone', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]phone',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderPhone])->hint($model->hintPhone) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]tv',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderTv])->hint($model->hintTv) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'tv', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]tv',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderTv])->hint($model->hintTv) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]catv',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderCatv])->hint($model->hintCatv) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'catv', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]catv',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderCatv])->hint($model->hintCatv) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]internet',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderInternet])->hint($model->hintInternet) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'internet', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]internet',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderInternet])->hint($model->hintInternet) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]heating',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderHeating])->hint($model->hintHeating) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'heating', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]heating',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderHeating])->hint($model->hintHeating) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]gas',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderGas])->hint($model->hintGas) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'gas', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]gas',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderGas])->hint($model->hintGas) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]geotech',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderGeotech])->hint($model->hintGeotech) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'geotech', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]geotech',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderGeotech])->hint($model->hintGeotech) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]ac',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderAc])->hint($model->hintAc) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'ac', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]ac',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderAc])->hint($model->hintAc) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]ventilation',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderVentilation])->hint($model->hintVentilation) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'ventilation', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]ventilation',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderVentilation])->hint($model->hintVentilation) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]sprinkler',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderSprinkler])->hint($model->hintSprinkler) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'sprinkler', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]sprinkler',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderSprinkler])->hint($model->hintSprinkler) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]lift',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderLift])->hint($model->hintLift) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'lift', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]lift',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderLift])->hint($model->hintLift) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]fire',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderFire])->hint($model->hintFire) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'fire', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]fire',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderFire])->hint($model->hintFire) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]pool',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderPool])->hint($model->hintPool) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'pool', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]pool',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderPool])->hint($model->hintPool) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]traffic',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderTraffic])->hint($model->hintTraffic) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'traffic', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]traffic',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderTraffic])->hint($model->hintTraffic) ?>
    </div>
</div>

<div class="form-group">    
    <div class="col-sm-5">
        <?= $form->field($model, '[existing]special',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderSpecial])->hint($model->hintSpecial) ?>
    </div>
    <div class="col-sm-2 center">
        <?= Html::activeLabel($model, 'special', []) ?>
    </div>
    <div class="col-sm-5">
        <?= $form->field($model_new, '[new]special',['showLabels'=>false])->textarea(['rows' => 6, 'placeholder'=>$model->placeholderSpecial])->hint($model->hintSpecial) ?>
    </div>
</div>




<?php else: ?>
    <?= $form->field($model, 'general')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderGeneral])->hint($model->hintGeneral) ?>
    <hr>
<h5>Hidrotehničke instalacije</h5>
    <?= $form->field($model, 'water')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderWater])->hint($model->hintWater) ?>
    <?= $form->field($model, 'sewage')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderSewage])->hint($model->hintSewage) ?>  
<hr>
<h5>Električne i elektronske instalacije</h5>
    <?= $form->field($model, 'electricity')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderElectricity])->hint($model->hintElectricity) ?>
    <?= $form->field($model, 'phone')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderPhone])->hint($model->hintPhone) ?>
    <?= $form->field($model, 'tv')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderTv])->hint($model->hintTv) ?>
    <?= $form->field($model, 'catv')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderCatv])->hint($model->hintCatv) ?>
    <?= $form->field($model, 'internet')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderInternet])->hint($model->hintInternet) ?>
<hr>
<h5>Termomašinske instalacije</h5>
    <?= $form->field($model, 'heating')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderHeating])->hint($model->hintHeating) ?>
    <?= $form->field($model, 'gas')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderGas])->hint($model->hintGas) ?>
    <?= $form->field($model, 'geotech')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderGeotech])->hint($model->hintGeotech) ?>
    <?= $form->field($model, 'ac')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderAc])->hint($model->hintAc) ?>
    <?= $form->field($model, 'ventilation')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderVentilation])->hint($model->hintVentilation) ?>
    <?= $form->field($model, 'sprinkler')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderSprinkler])->hint($model->hintSprinkler) ?>    
    <?= $form->field($model, 'lift')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderLift])->hint($model->hintLift) ?>
<hr>
<h5>Ostale instalacije</h5>
    <?= $form->field($model, 'fire')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderFire])->hint($model->hintFire) ?>
    <?= $form->field($model, 'pool')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderPool])->hint($model->hintPool) ?>
    <?= $form->field($model, 'traffic')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderTraffic])->hint($model->hintTraffic) ?>
    <?= $form->field($model, 'special')->textarea(['rows' => 6, 'placeholder'=>$model->placeholderSpecial])->hint($model->hintSpecial) ?>

<?php endif; ?>