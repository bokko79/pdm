<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;

$location->lot = ($model->location) ? $model->location->locationLots[0]->lot : null;
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

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->hint('Unesite naziv objekta') ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'client_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Clients::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint($model->hintClient) ?>

    <?= $form->field($model, 'building_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Buildings::find()->all(), 'id', 'fullname'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint($model->hintBuilding) ?>

    <?= $form->field($model, 'phase')->dropDownList([ 'gnp' => 'Generalni plan (GNP)', 'idr' => 'Idejno rešenje (IDR)', 'idp' => 'Idejni projekat (IDP)', 'pgd' => 'Projekat za građevinsku dozvolu (PGD)', 'pzi' => 'Projekat za izvođenje PZI', 'pio' => 'Projekat izvedenog objekta (PIO)', 'tkp' => 'Tehnička kontrola (TK)', ], ['prompt' => ''])->hint($model->hintPhase) ?>

    <?= $form->field($model, 'work')->dropDownList([ 'nova_gradnja' => 'Nova gradnja', 'rekonstrukcija' => 'Rekonstrukcija', 'adaptacija' => 'Adaptacija', 'sanacija' => 'Sanacija', 'promena_namene' => 'Promena namene', 'dogradnja' => 'Dogradnja', 'ozakonjenje' => 'Ozakonjenje', 'odrzavanje' => 'Održavanje', 'ostalo' => 'Ostalo', ], ['prompt' => ''])->hint($model->hintWork) ?>

<hr>
<h3>Adresa</h3>
    <?= $form->field($location, 'street')->textInput(['maxlength' => true]) ?>
    <?= $form->field($location, 'number')->textInput(['maxlength' => true]) ?>
    <?= $form->field($location, 'city_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Cities::find()->all(), 'id', 'town', 'city'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>
    <?= $form->field($location, 'lot')->textInput(['maxlength' => true]) ?>
    <?= $form->field($location, 'county_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Counties::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>    

<hr>
<h3>Projektanti</h3>

    <?= $form->field($model, 'practice_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Practices::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint($model->hintPractice) ?>

    <?= $form->field($model, 'engineer_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Engineers::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint($model->hintEngineer) ?>

    

<hr>
<h3>Tehnička kontrola</h3>
    <?= $form->field($model, 'control_practice_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Practices::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint($model->hintControlPractice) ?>

    <?= $form->field($model, 'control_engineer_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Engineers::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint($model->hintControlEngineer) ?>

<hr>
<h3>Izvođač radova</h3>
    <?= $form->field($model, 'builder_practice_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Practices::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint($model->hintControlPractice) ?>

    <?= $form->field($model, 'builder_engineer_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Engineers::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint($model->hintControlEngineer) ?>

<hr>
<h3>Stručni nadzor</h3>
    <?= $form->field($model, 'supervision_practice_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Practices::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint($model->hintControlPractice) ?>

    <?= $form->field($model, 'supervision_engineer_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Engineers::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint($model->hintControlEngineer) ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Izmeni', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
