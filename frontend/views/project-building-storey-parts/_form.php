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
?>

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 7,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

<hr>
<h3>Osnovni podaci</h3>

    <?= $form->field($model, 'type')->dropDownList([ 'stan' => 'Stan', 'stamb' => 'Stambene prostorije', 'biz' => 'Poslovni prostor - lokal', 'posl' => 'Poslovne prostorije', 'tech' => 'Tehničke prostorije', 'common' => 'Zajedničke prostorije', 'garage' => 'Garažne i parking prostorije', 'external' => 'Spoljašnje prostorije', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mark')->textInput(['maxlength' => true]) ?>

<?php if($model->type=='stan'): ?>
    <?= $form->field($model, 'structure')->dropDownList([ 'garsonjera' => 'Garsonjera', 'jednosoban' => 'Jednosoban', 'jednoiposoban' => 'Jednoiposoban', 'dvosoban' => 'Dvosoban', 'dvoiposoban' => 'Dvoiposoban', 'trosoban' => 'Trosoban', 'troiposoban' => 'Troiposoban', 'četvorosoban' => 'četvorosoban', 'četvoroiposoban' => 'četvoroiposoban', 'petosoban' => 'Petosoban', 'visesoban' => 'Visesoban', ], ['prompt' => '']) ?>
<?php endif; ?>

    <?= $form->field($model, 'area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

<hr> 
<h3>Celine, prostorije i površine</h3>
<p>Jedinice/celine posmatrane etaže i prostorije u okviru njih.</p>
<?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.container-items',
        'widgetItem' => '.room-item',
        'limit' => 15,
        'min' => 1,
        'insertButton' => '.add-room',
        'deleteButton' => '.remove-room',
        'model' => $modelsRooms[0],
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
                <th colspan="3">Prostorije               
                    <button type="button" class="add-room btn btn-success btn-sm"><span class="fa fa-plus"></span> Dodaj prostoriju</button>
                </th>
            </tr>
        </thead>
        <tbody class="container-items">
        <?php foreach ($modelsRooms as $indexRoom => $modelsRoom): ?>
            <tr class="room-item">
                <td class="vcenter">
                    <?php
                        // necessary for update action.
                        if (! $modelsPart->isNewRecord) {
                            echo Html::activeHiddenInput($modelsRooms, "[{$indexRoom}]id");
                        }
                        echo Html::activeHiddenInput($modelsPart, "[{$indexHouse}]type", ['value'=>'stan']);
                    ?>

                    <div class="row">
                        <div class="col-sm-12">
                            <?= $form->field($modelsRoom, 'room_type_id')->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map(\common\models\RoomTypes::find()->all(), 'id', 'name', 'type'),
                                    'options' => ['placeholder' => 'Izaberite...'],
                                    'language' => 'sr-Latn',
                                    'changeOnReset' => false, 
                                    //'disabled' => $model->room_type_id ? true : false,         
                                ])->hint('') ?>
                            <?= $form->field($modelsRoom, "[{$indexHouse}]mark")->label('Oznaka jedinice')->textInput(['maxlength' => true]) ?>
                            
                            <?= $form->field($modelsRoom, 'flooring')->dropDownList([ 'parket' => 'Parket', 'keramika' => 'Keramika', 'estrih' => 'Estrih', 'tarkett' => 'Tarkett', 'beton' => 'Beton', 'opeka' => 'Opeka', 'kamen' => 'Kamen', 'teraco' => 'Teraco', 'zemlja' => 'Zemlja', 'tepih' => 'Tepih', 'drugo' => 'Drugo', ], ['prompt' => '']) ?>

                            <?= $form->field($modelsRoom, 'net_area', [
                                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['min'=>0, 'step'=>0.01, 'style'=>'width:40%']) ?>
                
                        </div>
                    </div><!-- end:row -->

                </td>
                <td class="text-center vcenter" style="width: 90px;">
                    <button type="button" class="remove-room btn btn-danger btn-xs" style="width:100%; height:100%;"><span class="fa fa-minus"></span></button>
                </td>
            </tr>
         <?php endforeach; ?>
        </tbody>
    </table>
    <?php DynamicFormWidget::end(); ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Izmeni', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
