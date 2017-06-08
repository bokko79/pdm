<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<div class="primary-context normal bottom-bordered">
    <div class="head lower button_to_show_secondary">
        <div class="subaction"><i class="fa fa-caret-right fa-2x this-one"></i></div>
        Opšti podaci</div>
    <div class="subhead">Opšti podaci objekta.</div>
</div>
<div class="primary-context gray" style="display: none;">


    <?php if($modelCheck->project->work=='dogradnja' or $modelCheck->project->work=='sanacija' or $modelCheck->project->work=='rekonstrukcija'): ?>

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
            <?= $form->field($model, '[existing]building_id',['showLabels'=>false])->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\common\models\Buildings::find()->all(), 'id', 'fullClass'),
                'options' => ['placeholder' => 'Izaberite...', 'id'=>'existing'],
                'language' => 'sr-Latn',
                'changeOnReset' => false,           
            ])->hint($model->hintBuilding) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'building_id', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]building_id',['showLabels'=>false])->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\common\models\Buildings::find()->all(), 'id', 'fullClass'),
                'options' => ['placeholder' => 'Izaberite...', 'id'=>'new'],
                'language' => 'sr-Latn',
                'changeOnReset' => false,           
            ])->hint($model->hintBuilding) ?>
        </div>
    </div>

    <div class="form-group">    
        <div class="col-sm-5">
            <?= $form->field($model, '[existing]type',['showLabels'=>false])->dropDownList([ 'slobodno' => 'Slobodnostojeći objekat', 'niz' => 'Objekat u nizu', 'dvojna' => 'Dvojni objekat', 'ugaona' => 'Ugaoni objekat', 'drugo' => 'Drugo', ], ['prompt' => ''])->hint($model->hintType) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'type', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]type',['showLabels'=>false])->dropDownList([ 'slobodno' => 'Slobodnostojeći objekat', 'niz' => 'Objekat u nizu', 'dvojna' => 'Dvojni objekat', 'ugaona' => 'Ugaoni objekat', 'drugo' => 'Drugo', ], ['prompt' => ''])->hint($model->hintType) ?>
        </div>
    </div>

    <div class="form-group">    
        <div class="col-sm-5">
            <?= $form->field($model, '[existing]cost',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'RSD']]])->input('number', ['style'=>'width:100%'])->hint($model->hintCost) ?>
        </div>
        <div class="col-sm-2 center">
            <?= Html::activeLabel($model, 'cost', []) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model_new, '[new]cost',['showLabels'=>false, 'addon' => ['prepend' => ['content'=>'RSD']]])->input('number', ['style'=>'width:100%'])->hint($model->hintCost) ?>
        </div>
    </div>

    <?php else: ?>

        <?= $form->field($model, '[existing]building_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\common\models\Buildings::find()->all(), 'id', 'fullClass'),
                'options' => ['placeholder' => 'Izaberite...', 'id'=>'existing'],
                'language' => 'sr-Latn',
                'changeOnReset' => false,           
            ])->hint($model->hintBuilding) ?>      

        <?= $form->field($model, 'type')->dropDownList([ 'slobodno' => 'Slobodnostojeći objekat', 'niz' => 'Objekat u nizu', 'dvojna' => 'Dvojni objekat', 'ugaona' => 'Ugaoni objekat', 'drugo' => 'Drugo', ], ['prompt' => ''])->hint($model->hintType) ?>

        <?= $form->field($model, 'cost', [
                    'addon' => ['prepend' => ['content'=>'RSD']]])->input('number', ['style'=>'width:50%'])->hint($model->hintCost) ?>

    <?php endif; ?>


    <div class="row" style="margin:20px 0;">
        <div class="col-md-offset-4 col-md-<?= ($modelCheck->project->setup_status=='building' ? '8' : '4') ?>">
            <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-'.($modelCheck->project->setup_status=='building' ? 'default' : 'success').' '.($modelCheck->project->setup_status=='building' ? '' : 'btn-block').' shadow']) ?>
            <?php if($modelCheck->project->setup_status=='building'): ?>
            <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj i pređi na sledeći korak <i class="fa fa-arrow-right fa-lg"></i>', ['class' => 'btn btn-success shadow', 'name' => 'step_form', 'value' => 'next_step']) ?>    
        <?php endif; ?>
        </div>        
    </div>
</div>