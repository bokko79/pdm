<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
?>

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 7,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

    <?= $form->field($model, 'project_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Projects::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>

    <?= $form->field($model, 'building_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Buildings::find()->all(), 'id', 'class'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'slobodno' => 'Slobodnostojeći objekat', 'niz' => 'Objekat u nizu', 'dvojna' => 'Dvojni objekat', 'ugaona' => 'Ugaoni objekat', 'drugo' => 'Drugo', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'building_line_dist', [
                'addon' => ['prepend' => ['content'=>'m']],
            ])->input('number', ['step'=>0.1, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'lot_area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'green_area_reg', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'green_area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'gross_area_part', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'gross_area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint('BRGP - bruto razvijena građevinska površina. Ukupna bruto površina svih podzemnih i nadzemnih etaža objekta. Izračunata vrednost je: m<sup>2</sup>. Ažuriraj vrednost u bazi podataka?') ?>

    <?= $form->field($model, 'gross_area_above', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'gross_area_below', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'gross_built_area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'net_area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'ground_floor_area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'occupancy_area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'occupancy_reg', [
                'addon' => ['prepend' => ['content'=>'%']]])->input('number', ['step'=>0.01, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'occupancy', [
                'addon' => ['prepend' => ['content'=>'%']]])->input(['number', 'step'=>0.01, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'built_index_reg')->input('number', ['step'=>0.01, 'min'=>0, 'max'=>1, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'built_index')->input('number', ['step'=>0.01, 'min'=>0, 'max'=>1, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'storey')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'storey_height')->input('number', ['step'=>0.01, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'units_total')->input('number', ['style'=>'width:40%']) ?>

    <?= $form->field($model, 'parking_total')->input('number', ['style'=>'width:40%']) ?>

    <?= $form->field($model, 'facade_material')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ridge_orientation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'roof_pitch', [
                'addon' => ['prepend' => ['content'=>'<sup>o</sup>']]])->input('number', ['style'=>'width:40%']) ?>

    <?= $form->field($model, 'roof_material')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'characteristics')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cost', [
                'addon' => ['prepend' => ['content'=>'RSD']]])->input('number', ['style'=>'width:40%']) ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
