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
use wbraganca\dynamicform\DynamicFormWidget;
use yii\bootstrap\Dropdown;


if(!$model->name){$model->name = $model->storey;}
?>

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'dynamic-form',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 12,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

<hr>
<h3>Osnovni podaci</h3>

    <?= $form->field($model, 'project_building_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\ProjectBuilding::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false, 
            'disabled' => true,         
        ]) ?>    

    <?= $form->field($model, 'storey')->dropDownList([ 'podrum' => 'Podrum', 'suteren' => 'Suteren', 'galerija' => 'Galerija', 'prizemlje' => 'Prizemlje', 'sprat' => 'Sprat', 'povucenisprat' => 'Povucenisprat', 'potkrovlje' => 'Potkrovlje', 'mansarda' => 'Mansarda', 'tavan' => 'Tavan', 'krov' => 'Krov', ], ['prompt' => '', 'disabled' => true,]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?php if(!$model->sameAs): ?>
<hr>
<h3>Dimenzije</h3>

    <?= $form->field($model, 'gross_area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'height', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%']) ?>
<?php endif; ?>
    <?= $form->field($model, 'level', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%', 'disabled' => $model->storey=='prizemlje' ? true : false]) ?>

<?php if($model->projectBuilding->canHaveUnits()): ?>
<hr> 
<h3>Celine, prostorije i površine</h3>
<p>Jedinice/celine posmatrane etaže i prostorije u okviru njih.</p>
<?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.container-items',
        'widgetItem' => '.house-item',
        'limit' => 15,
        'min' => 0,
        'insertButton' => '.add-house',
        'deleteButton' => '.remove-house',
        'model' => $modelsParts[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'name',
            'type',
            'mark',
        ],
    ]); ?>

    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th colspan="2">
                    Jedinice/Celine 
                    <div class="right">
                        <button type="button" class="add-house btn btn-success" value="stan"><span class="fa fa-plus"></span> Stan</button>
                        <button type="button" class="add-house btn btn-success" value="biz"><span class="fa fa-plus"></span> Lokal</button>
                        <button type="button" class="add-house btn btn-success" value="stamb"><span class="fa fa-plus"></span> Stambene pr.</button>
                        <button type="button" class="add-house btn btn-success" value="posl"><span class="fa fa-plus"></span> Poslovne pr.</button>
                        <button type="button" class="add-house btn btn-success" value="common"><span class="fa fa-plus"></span> Zajedničke pr.</button>
                        <button type="button" class="add-house btn btn-success" value="tech"><span class="fa fa-plus"></span> Tehničke pr.</button>
                        <button type="button" class="add-house btn btn-success" value="garage"><span class="fa fa-plus"></span> Garažne pr.</button>
                    </div>
                </th>
                
            </tr>
        </thead>
        <tbody class="container-items">
        <?php foreach ($modelsParts as $indexHouse => $modelsPart): ?>
            <tr class="house-item">
                <td class="vcenter hereitis">
                    <?php
                        // necessary for update action.
                        if (! $modelsPart->isNewRecord) {
                            echo Html::activeHiddenInput($modelsPart, "[{$indexHouse}]id");
                        }
                        echo Html::activeHiddenInput($modelsPart, "[{$indexHouse}]type");
                    ?>

                    <div class="row">
                        <div class="col-sm-12">                            
                            <?php // $form->field($modelsPart, '['.$indexHouse.']type')->label('Vrsta jedinice')->radioButtonGroup([ 'stan' => 'Stan', 'stamb' => 'Stambene pr.', 'biz' => 'Lokal', 'posl' => 'Poslovne pr.', 'tech' => 'Tehničke pr.', 'common' => 'Zajedničke pr.', 'garage' => 'Garaže'/*, 'external' => 'Spoljašnje prostorije',*/ ], ['prompt' => '', 'class' => 'btn-group-sm',]) ?>
                            <?= $form->field($modelsPart, '['.$indexHouse.']mark')->label('Oznaka jedinice')->textInput(['maxlength' => true, 'style'=>'width:30%;']) ?>
                            <?php // $form->field($modelsPart, '['.$indexHouse.']name')->label('Naziv')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div><!-- end:row -->

                </td>
                <td class="text-center vcenter" style="width: 90px; verti">
                    <button type="button" class="remove-house btn btn-danger btn-xs" style="width:100%; height:100%;"><span class="fa fa-minus"></span> Ukloni</button>
                </td>
            </tr>
         <?php endforeach; ?>
        </tbody>
    </table>
    <?php DynamicFormWidget::end(); ?>
<?php endif; ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-12">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Sačuvaj izmene', ['class' => $model->isNewRecord ? 'btn btn-primary btn-block' : 'btn btn-success']) ?>
            <?= (!$model->isNewRecord and !$model->copies and $model->storey!='prizemlje' and $model->projectBuilding->project->work!='adaptacija') ? Html::a(Yii::t('app', 'Ukloni'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Da li ste sigurni da želite da obrišete celu etažu, sa svim prostorijama?'),
                    'method' => 'post',
                ],
            ]) : null ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
