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
use kartik\checkbox\CheckboxX;
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

    <?= $form->field($model, 'project_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Projects::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false, 
            'disabled' => true,         
        ]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'gradjevinska' => 'Gradjevinska', 'javna' => 'Javna', 'poljoprivredna' => 'Poljoprivredna', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'conditions')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'md']])->hint('Katastarska parcela ispunjava uslov za građevinsku parcelu prema važećem prostornom planu?') ?>

<hr>
<h4>Dimenzije parcele</h4>
    <?= $form->field($model, 'area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'width', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%', 'placeholder'=>'npr.14.50'])->hint('Širina parcele u metrima. Ukoliko je parcela nepravilnog oblika, uneti prosečnu, okvirnu vrednost.') ?>

    <?= $form->field($model, 'length', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%'])->hint('Dužina parcele u metrima. Ukoliko je parcela nepravilnog oblika, uneti prosečnu, okvirnu vrednost.') ?>    

<hr>
<h4>Urbanistički parametri</h4>
    <?= $form->field($model, 'green_area_reg', [
                'addon' => ['prepend' => ['content'=>'%']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%'])->hint('Uneti vrednost predviđene površine zelenih površina date u važećem prostornom planu ili dato na osnovu rešenja o lokacijskim uslovima ili sl.') ?>
    <?= $form->field($model, 'green_area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%'])->hint('Isprojektovana površina zelenih površina.') ?>

    <?= $form->field($model, 'occupancy_reg', [
                'addon' => ['prepend' => ['content'=>'%']]])->input('number', ['max'=>100, 'min'=>0, 'step'=>0.01, 'style'=>'width:40%'])->hint('Zahtevana zauzetost parcele. <br>Zauzetost je odnos površina parcele pod objektom u odnosu na površinu same parcele, date u procentima.') ?>

    <?= $form->field($model, 'built_index_reg')->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%'])->hint('Zahtevani indeks zauzetosti za datu parelu, na osnovu važećeg prostornog plana. <br>Indeks zauzetosi je odnos ukupne BRGP objekta u odnosu na površinu parcele.') ?>    

    <?= $form->field($model, 'parking_spaces')->input('number', ['min'=>0, 'style'=>'width:40%'])->hint('Ukupan broj isprojektovanih parking mesta na parceli.') ?>

    <?= $form->field($model, 'parking_disabled')->input('number', ['min'=>0, 'style'=>'width:40%'])->hint('Ukupan broj isprojektovanih parking mesta na parceli predviđenih za osobe sa invaliditetom.') ?>

<hr>
<h4>Visinske kote</h4>    

    <?= $form->field($model, 'ground_level', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint('Apsolutna visinska kota terena, data lokacijskim uslovima ili drugim važećim dokumentom, geodetskim snimkom ili sl. Ukoliko je teren strm, odrediti repernu tačku ili prosečnu vrednost.') ?>

    <?= $form->field($model, 'road_level', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint('Apsolutna visinska kota nivelete, data lokacijskim uslovima.') ?>

    <?= $form->field($model, 'underwater_level', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint('Apsolutna visinska kota maksimalnih podzemnih voda.') ?>

<hr>
<h4>Opis parcele</h4> 
    
    <?= $form->field($model, 'ground')->radioList([ 'ravan' => 'Ravan', 'pretezno' => 'Pretežno ravan', 'blago' => 'U blagom nagibu', 'strm' => 'Strm', 'nepristupacan' => 'Nepristupačan'], ['prompt' => '']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
    
    <?= $form->field($model, 'disposition')->textarea(['rows' => 6, 'placeholder'=>''])->hint('Položaj parcele u prostoru, ulici, bloku ili naselju na osnovu važećeg plana detaljne regulacije, informacije o lokaciji, generalnog urbanističkog plana ili sličnog dokumenta.<br> Udaljenost građevinske linije od regulacione linije parcele: da li se poklapaju ili se građevinska linija uvlači? Prema kojoj ulici?') ?>

      

    <?= $form->field($model, 'access')->textarea(['rows' => 6, 'placeholder'=>''])->hint('Kolski i pešački pristupi/prilazi parceli. Iz koje ulice se prilazi parceli?') ?>

    <?= $form->field($model, 'parking')->textarea(['rows' => 6, 'placeholder'=>''])->hint('Opis parkinga na parceli i objektu. Da li je predviđen parking prostor? Da li je predviđena garaža u okviru parcele ili objekta? Na kojoj etaži i kako se pristupa garaži, a kako parking mestima? Da li postoje rampe ili pasaži? Da li posoje auto-liftovi ili slične dizalice? Veza između garažnog prostora, parking mesta i ulaza u objekat, stepenišnim jezgrom sa liftom, koje je snabdeveno tampon zonom dimenzionisanom i projektovanom u skladu sa propisima? Da li je parking prostor otkriven ili natkriven? Da li se postavlja upušteni ivičnjak na kontaktu kolovoza i trotoara, kao i izvođenje ojačanog trotoara u zoni ulaska vozila sa ulice na parcelu? Broj i dimenzije parking mesta.') ?>  

    <?= $form->field($model, 'adjacent_border')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

    <?= $form->field($model, 'services')->textarea(['rows' => 6, 'placeholder'=>''])->hint('Opremljenost lokacije komunalnom i instalacionom infrstrukturom: instalacijama centralnog grejanja, gasnih instalacija, vodovoda, kanalizacije, eletroenergetskim instalacijama, telefonskim i telekomunikacionim instalacijama i dr.') ?>    

    <?= $form->field($model, 'note')->textarea(['rows' => 6, 'placeholder'=>''])->hint('Ostale napomene i specifične karakteristike katastarske parcele, koje nisu pokrivene opisom.') ?>

    <?= $form->field($model, 'ownership')->textarea(['rows' => 6, 'placeholder'=>''])->hint('Vlasnička struktura katastarske parcele.') ?>

    <?= $form->field($model, 'legal')->textarea(['rows' => 6, 'placeholder'=>'']) ?>    

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Izmeni', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
