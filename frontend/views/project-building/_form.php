<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;

if(!$model->building_line_dist) $model->building_line_dist = 0;
?>

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 7,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>
<hr>
<h3>Opšti podaci</h3>
    <?= $form->field($model, 'project_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Projects::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder'=>'npr. Stambeno-poslovni objekat'])->hint('Pun naziv objekta.') ?>

    <?= $form->field($model, 'building_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Buildings::find()->all(), 'id', 'fullClass'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint('Pretežna klasa objekta prema važećem Pravilniku o klasifikaciji objekata.') ?>

    <?= $form->field($model, 'building_type_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\BuildingTypes::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>       

    <?= $form->field($model, 'type')->dropDownList([ 'slobodno' => 'Slobodnostojeći objekat', 'niz' => 'Objekat u nizu', 'dvojna' => 'Dvojni objekat', 'ugaona' => 'Ugaoni objekat', 'drugo' => 'Drugo', ], ['prompt' => '']) ?>

    <?php // $form->field($model, 'storey')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cost', [
                'addon' => ['prepend' => ['content'=>'RSD']]])->input('number', ['style'=>'width:50%'])->hint('Ukupna predviđena građevinska investiciona vrednost objekta/radova na izgradnji objekta u RSD.') ?>
<hr>
<h3>Numerički pokazatelji</h3>

    <?= $form->field($model, 'ground_floor_level', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint('Apsolutna visinska kota gotovog poda prizemlja objekta, npr. 81.60. Ova kota se koristi kao referentna kota za sve ostale visinke kote objekta.') ?>

    <?= $form->field($model, 'building_line_dist', [
                'addon' => ['prepend' => ['content'=>'m']],
            ])->input('number', ['step'=>0.1, 'style'=>'width:40%'])->hint('Osovinsko rastojanje između građevinske i regulacione linije parcele.') ?>


    <?= $form->field($model, 'gross_area_part', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint('Samo u slučaju objekata iz člana 145. Pravilnika.') ?>

    <?php /* $form->field($model, 'gross_area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint('BRGP - bruto razvijena građevinska površina. Ukupna bruto površina svih podzemnih i nadzemnih etaža objekta. Izračunata vrednost je: m<sup>2</sup>. Ažuriraj vrednost u bazi podataka?') ?>

    <?php // $form->field($model, 'gross_area_above', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'style'=>'width:40%']) ?>

    <?php // $form->field($model, 'gross_area_below', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'style'=>'width:40%']) ?>

    <?php // $form->field($model, 'net_area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'style'=>'width:40%']) ?>

    <?php // $form->field($model, 'ground_floor_area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'style'=>'width:40%']) ?>

    <?php // $form->field($model, 'occupancy_area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])*/ ?>    

    <?= $form->field($model, 'storey_height', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%']) ?>

    <?php // $form->field($model, 'units_total')->input('number', ['style'=>'width:40%']) ?>

    <?= $form->field($model, 'ridge_orientation')->textInput(['maxlength' => true, 'placeholder'=>'npr. S-J ili JZ-SI'])->hint('Uneti orijenataciju slemena krova, ukoliko je krov objekta u nagibu. Uneti samo oznake strana sveta, npr. S za sever, J za jug, itd.') ?>

    <?= $form->field($model, 'roof_pitch', [
                'addon' => ['prepend' => ['content'=>'<sup>o</sup>']]])->input('number', ['style'=>'width:30%'])->hint('Nagib krovnih ravni u stepenima. Npr. 30<sup>o</sup>') ?>

    <?= $form->field($model, 'characteristics')->textarea(['rows' => 6, 'placeholder'=>''])->hint('Tekst koji će se pojaviti u glavnoj svesci, u prilogu 0.7: Ostale karakteristike objekta. Ukoliko postoje neke dodatne, specifične karakteristike objekta, uneti tekstualni opis.') ?>

    

    <?= $form->field($model, 'buildFile')->widget(FileInput::classname(), [
            'options' => [/*'multiple' => true,*/ 'accept' => 'image/*'],
            'pluginOptions' => [
                'previewFileType' => 'any',
                'showCaption' => false,
                'showUpload' => false,
                'browseClass' => 'btn btn-info shadow',
                'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                'browseLabel' =>  Yii::t('app', 'Izaberi sliku objekta'),
                'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                'resizeImage'=> true,
                'maxImageWidth'=> 60,
                'maxImageHeight'=> 60,
                'resizePreference'=> 'width',
            ],
        ])->hint('Nije obavezno.') ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Izmeni', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
