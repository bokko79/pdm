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
<div class="container-fluid">
    <div class="row">

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 10,      
    'formConfig' => ['labelSpan' => 4, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data', 'style'=>'margin-top:0 !important;'],
]); ?>

<div class="card_container record-full grid-item fadeInUp animated-not no-shadow no-margin" id="general">
    
    <div class="primary-context normal bottom-bordered">
        <div class="head lower button_to_show_secondary">
            <div class="subaction"><i class="fa fa-caret-down fa-2x this-one"></i></div>
            Osnovni podaci</div>
        <div class="subhead">Osnovni podaci projekta.</div>
    </div>
    <div class="primary-context gray">

        <?= $form->field($model, 'conditions')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'md']])->hint('Katastarska parcela ispunjava uslov za građevinsku parcelu prema važećem prostornom planu?') ?>

        <?= $form->field($model, 'area', [
                    'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%']) ?>

        <?= $form->field($model, 'ground_level', [
                    'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint('Apsolutna visinska kota terena, data lokacijskim uslovima ili drugim važećim dokumentom, geodetskim snimkom ili sl. Ukoliko je teren strm, odrediti repernu tačku ili prosečnu vrednost.') ?>

        <div class="row" style="margin:20px 0;">
            <div class="col-md-offset-4 col-md-8">
                <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-'.($model->project->setup_status=='project_lot' ? 'default' : 'success').' '.($model->project->setup_status=='project_lot' ? '' : 'btn-block').' shadow']) ?>
                <?php if($model->project->setup_status=='project_lot'): ?>
                <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj i pređi na sledeći korak <i class="fa fa-arrow-right fa-lg"></i>', ['class' => 'btn btn-success shadow', 'name' => 'step_form', 'value' => 'next_step']) ?>    
            <?php endif; ?>
            </div>        
        </div>
    </div>

    <div class="primary-context normal bottom-bordered">
        <div class="head lower button_to_show_secondary">
            <div class="subaction"><i class="fa fa-caret-down fa-2x this-one"></i></div>
            Opšti podaci</div>
        <div class="subhead">Osnovni podaci projekta.</div>
    </div>
    <div class="primary-context gray" style="display: none;">

        <?= $form->field($model, 'type')->dropDownList([ 'gradjevinska' => 'Gradjevinska', 'javna' => 'Javna', 'poljoprivredna' => 'Poljoprivredna', ], ['prompt' => '']) ?>

        <?= $form->field($model, 'climate')->input('number', ['min'=>2, 'max'=>3, 'style'=>'width:30%'])->hint('Klimatska zona') ?>

        <?= $form->field($model, 'seismic')->input('number', ['min'=>5, 'max'=>9, 'style'=>'width:30%'])->hint('Seizmička zona') ?>

        <div class="row" style="margin:20px 0;">
            <div class="col-md-offset-4 col-md-8">
                <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-'.($model->project->setup_status=='project_lot' ? 'default' : 'success').' '.($model->project->setup_status=='project_lot' ? '' : 'btn-block').' shadow']) ?>
                <?php if($model->project->setup_status=='project_lot'): ?>
                <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj i pređi na sledeći korak <i class="fa fa-arrow-right fa-lg"></i>', ['class' => 'btn btn-success shadow', 'name' => 'step_form', 'value' => 'next_step']) ?>    
            <?php endif; ?>
            </div>        
        </div>
    </div>

    <div class="primary-context normal bottom-bordered">
        <div class="head lower button_to_show_secondary">
            <div class="subaction"><i class="fa fa-caret-right fa-2x this-one"></i></div>
            Dimenzije parcele</div>
        <div class="subhead">Klasa i namena objekta.</div>
    </div>
    <div class="primary-context gray" style="display: none;">

        <?= $form->field($model, 'width', [
                    'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%', 'placeholder'=>'npr.14.50'])->hint('Širina parcele u metrima. Ukoliko je parcela nepravilnog oblika, uneti prosečnu, okvirnu vrednost.') ?>

        <?= $form->field($model, 'length', [
                    'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%'])->hint('Dužina parcele u metrima. Ukoliko je parcela nepravilnog oblika, uneti prosečnu, okvirnu vrednost.') ?>    

        <div class="row" style="margin:20px 0;">
            <div class="col-md-offset-4 col-md-8">
                <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-'.($model->project->setup_status=='project_lot' ? 'default' : 'success').' '.($model->project->setup_status=='project_lot' ? '' : 'btn-block').' shadow']) ?>
                <?php if($model->project->setup_status=='project_lot'): ?>
                <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj i pređi na sledeći korak <i class="fa fa-arrow-right fa-lg"></i>', ['class' => 'btn btn-success shadow', 'name' => 'step_form', 'value' => 'next_step']) ?>    
            <?php endif; ?>
            </div>        
        </div>
    </div>

    <div class="primary-context normal bottom-bordered">
        <div class="head lower button_to_show_secondary">
            <div class="subaction"><i class="fa fa-caret-right fa-2x this-one"></i></div>
            Urbanistički parametri</div>
        <div class="subhead">Klasa i namena objekta.</div>
    </div>
    <div class="primary-context gray" style="display: none;">
        <?= $form->field($model, 'green_area_reg', [
                    'addon' => ['prepend' => ['content'=>'%']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%'])->hint('Uneti vrednost predviđene površine zelenih površina date u važećem prostornom planu ili dato na osnovu rešenja o lokacijskim uslovima ili sl.') ?>
        <?= $form->field($model, 'green_area', [
                    'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%'])->hint('Isprojektovana površina zelenih površina.') ?>

        <?= $form->field($model, 'occupancy_reg', [
                    'addon' => ['prepend' => ['content'=>'%']]])->input('number', ['max'=>100, 'min'=>0, 'step'=>0.01, 'style'=>'width:40%'])->hint('Zahtevana zauzetost parcele. <br>Zauzetost je odnos površina parcele pod objektom u odnosu na površinu same parcele, date u procentima.') ?>

        <?= $form->field($model, 'built_index_reg')->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%'])->hint('Zahtevani indeks zauzetosti za datu parelu, na osnovu važećeg prostornog plana. <br>Indeks zauzetosi je odnos ukupne BRGP objekta u odnosu na površinu parcele.') ?>    

        <?= $form->field($model, 'parking_spaces')->input('number', ['min'=>0, 'style'=>'width:40%'])->hint('Ukupan broj isprojektovanih parking mesta na parceli.') ?>

        <?= $form->field($model, 'parking_disabled')->input('number', ['min'=>0, 'style'=>'width:40%'])->hint('Ukupan broj isprojektovanih parking mesta na parceli predviđenih za osobe sa invaliditetom.') ?>

        <div class="row" style="margin:20px 0;">
            <div class="col-md-offset-4 col-md-8">
                <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-'.($model->project->setup_status=='project_lot' ? 'default' : 'success').' '.($model->project->setup_status=='project_lot' ? '' : 'btn-block').' shadow']) ?>
                <?php if($model->project->setup_status=='project_lot'): ?>
                <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj i pređi na sledeći korak <i class="fa fa-arrow-right fa-lg"></i>', ['class' => 'btn btn-success shadow', 'name' => 'step_form', 'value' => 'next_step']) ?>    
            <?php endif; ?>
            </div>        
        </div>
    </div>

    <div class="primary-context normal bottom-bordered">
        <div class="head lower button_to_show_secondary">
            <div class="subaction"><i class="fa fa-caret-right fa-2x this-one"></i></div>
            Visinske kote</div>
        <div class="subhead">Klasa i namena objekta.</div>
    </div>
    <div class="primary-context gray" style="display: none;">   

        <?= $form->field($model, 'road_level', [
                    'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint('Apsolutna visinska kota nivelete, data lokacijskim uslovima.') ?>

        <?= $form->field($model, 'underwater_level', [
                    'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint('Apsolutna visinska kota maksimalnih podzemnih voda.') ?>

        <?= $form->field($model, 'underwater_level_min', [
                    'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%'])->hint('Apsolutna visinska kota minimalnih podzemnih voda.') ?>

        <div class="row" style="margin:20px 0;">
            <div class="col-md-offset-4 col-md-8">
                <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-'.($model->project->setup_status=='project_lot' ? 'default' : 'success').' '.($model->project->setup_status=='project_lot' ? '' : 'btn-block').' shadow']) ?>
                <?php if($model->project->setup_status=='project_lot'): ?>
                <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj i pređi na sledeći korak <i class="fa fa-arrow-right fa-lg"></i>', ['class' => 'btn btn-success shadow', 'name' => 'step_form', 'value' => 'next_step']) ?>    
            <?php endif; ?>
            </div>        
        </div>
    </div>

    <div class="primary-context normal bottom-bordered">
        <div class="head lower button_to_show_secondary">
            <div class="subaction"><i class="fa fa-caret-right fa-2x this-one"></i></div>
            Priključci na infrastrukturu</div>
        <div class="subhead">Klasa i namena objekta.</div>
    </div>
    <div class="primary-context gray" style="display: none;">   

        <?= $form->field($model, 'conn_water')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
        <?= $form->field($model, 'conn_electric')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
        <?= $form->field($model, 'conn_telecom')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
        <?= $form->field($model, 'conn_heating')->textarea(['rows' => 6, 'placeholder'=>'']) ?>
        <?= $form->field($model, 'conn_gas')->textarea(['rows' => 6, 'placeholder'=>'']) ?>

        <div class="row" style="margin:20px 0;">
            <div class="col-md-offset-4 col-md-8">
                <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-'.($model->project->setup_status=='project_lot' ? 'default' : 'success').' '.($model->project->setup_status=='project_lot' ? '' : 'btn-block').' shadow']) ?>
                <?php if($model->project->setup_status=='project_lot'): ?>
                <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj i pređi na sledeći korak <i class="fa fa-arrow-right fa-lg"></i>', ['class' => 'btn btn-success shadow', 'name' => 'step_form', 'value' => 'next_step']) ?>    
            <?php endif; ?>
            </div>        
        </div>
    </div>

    <div class="primary-context normal bottom-bordered">
        <div class="head lower button_to_show_secondary">
            <div class="subaction"><i class="fa fa-caret-right fa-2x this-one"></i></div>
            Opis parcele</div>
        <div class="subhead">Klasa i namena objekta.</div>
    </div>
    <div class="primary-context gray" style="display: none;">
    
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

        <div class="row" style="margin:20px 0;">
            <div class="col-md-offset-4 col-md-8">
                <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-'.($model->project->setup_status=='project_lot' ? 'default' : 'success').' '.($model->project->setup_status=='project_lot' ? '' : 'btn-block').' shadow']) ?>
                <?php if($model->project->setup_status=='project_lot'): ?>
                <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj i pređi na sledeći korak <i class="fa fa-arrow-right fa-lg"></i>', ['class' => 'btn btn-success shadow', 'name' => 'step_form', 'value' => 'next_step']) ?>    
            <?php endif; ?>
            </div>        
        </div>
</div>

<?php ActiveForm::end(); ?>
</div>
</div>