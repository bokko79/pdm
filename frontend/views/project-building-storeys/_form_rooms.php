<?php

use yii\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

?>

<?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_inner',
    'widgetBody' => '.container-rooms',
    'widgetItem' => '.room-item',
    'limit' => 20,
    'min' => 1,
    'insertButton' => '.add-room',
    'deleteButton' => '.remove-room',
    'model' => $modelsRooms[0],
    'formId' => 'dynamic-form',
    'formFields' => [
        'name',
        'mark',
        'net_area',
    ],
]); ?>
<table class="table table-striped">
    <thead>
        <tr>
            <th colspan="2">Prostorije jedinice/celine <?= $indexHouse+1 ?></th>
            <th class="text-center">
                <button type="button" class="add-room btn btn-success btn-xs"><span class="glyphicon glyphicon-plus"></span> Dodaj prostoriju</button>
            </th>
        </tr>
        <tr>
            <th class="">Naziv</th>
            <th class="">
                Površina [neto m<sup>2</sup>]
            </th>
            <th class=""></th>
        </tr>
    </thead>

    <tbody class="container-rooms">
    <?php foreach ($modelsRooms as $indexRoom => $modelRoom): ?>
        <tr class="room-item">
            <td class="vcenter text-center" style="padding:3px 8px 0px;">
                 <?php
                    // necessary for update action.
                    if (! $modelRoom->isNewRecord) {
                        echo Html::activeHiddenInput($modelRoom, "[{$indexHouse}][{$indexRoom}]id");
                    }
                ?>

                <?php // $form->field($modelRoom, "[{$indexHouse}]name")->label(false)->textInput(['maxlength' => true]) ?>
                <?= $form->field($modelRoom, '['.$indexHouse.']['.$indexRoom.']room_type_id')->dropDownList(ArrayHelper::map(\common\models\RoomTypes::find()->all(), 'id', 'name'), ['prompt' => ''])->hint('')->label(false) ?>
            </td>
            <td class="vcenter text-center" style="padding:3px 8px 0px;">

                <?= $form->field($modelRoom, "[{$indexHouse}][{$indexRoom}]net_area", [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['min'=>0, 'step'=>0.01, 'style'=>''])->label(false) ?>
                    </div>

            </td>
            <td class="text-center vcenter" style="width: 90px;">
                <button type="button" class="remove-room btn btn-danger btn-xs"><span class="glyphicon glyphicon-minus"></span></button>
            </td>
        </tr>
     <?php endforeach; ?>
    </tbody>
</table>
<?php DynamicFormWidget::end(); ?>