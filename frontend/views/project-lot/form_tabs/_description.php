<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>

<h4>Opis parcele</h4> 
<hr>
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