<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$building = $model->projectBuilding;
?>
<p class="times uppercase"><small><?= $volume->number ?>.3. Rešenje o određivanju odgovornog projektanta <?= $volume->volume->nameGen ?></small></p>	

<p>Na osnovu člana 128. Zakona o planiranju i izgradnji ("Službeni glasnik RS", br. 72/09, 81/09-ispravka, 64/10 - US, 24/11, 121/12, 42/13 - US, 50/13 - US, 98/13 - US, 132/14 i 145/14) i odredbi Pravilnika o sadržini, načinu i postupku izrade i način vršenja kontrole tehničke dokumentacije prema klasi i nameni objekata ("Službeni glasnik RS", br. 23/2015 i 77/2015) kao:</p>

<h2 class="center" style="padding:30px 0; letter-spacing: 4px;">ODGOVORNI PROJEKTANT</h2>

<p>za izradu <?= $volume->volume->nameGen ?>, koji je deo <?= c($model->projectPhaseGen) ?> za <?= $model->projectTypeOfWorksGen ?> za objekat <?= $building->name ?> (<?= $building->spratnost ?>), ulica <?= $model->location->street ?> br. <?= $model->location->number ?>, <?= $model->location->city->town ?>, kat.parc.br.
	<?php if($lots = $model->location->locationLots){
		foreach($lots as $lot){
			echo $lot->lot. ', ';
		}
	} ?> K.O <?= $model->location->county0->name ?>, određuje se:</p>

<div style="padding:20px 0 60px">
	<table class="clear">
		<tr>
			<td class=""><span class="bold"><?= $volume->engineer->name .'</span>, '. $volume->engineer->title ?> ________________________________</td>
			<td class="right">licenca br. <?= $volume->engineerLicence->no ?></td>
		</tr>
	</table>
	  
</div>


<table class="homepage">
	<tr>
		<td class="right titler">Projektant</td>
		<td class="content">
			<h3><b><?= $volume->practice->name ?></b></h3>
			<p>ul. <?= $volume->practice->location->street. ' br. ' . $volume->practice->location->number . ' ' .$volume->practice->location->city->town; ?></p>
		</td>
	</tr>
	<tr>
		<td class="right">Odgovorno lice / zastupnik</td>
		<td class="content">				
			<p><?= $volume->practice->director->name; ?><?= $volume->practice->director->title ? ', '.$volume->practice->director->title : null; ?></p>
		</td>
	</tr>
	<tr>
		<td class="right">Pečat
			<div>
				<?= ($volume->practice->stamp) ? Html::img('@web/images/legal_files/stamps/'.$volume->practice->stamp, ['style'=>'width:120px; margin-top:20px;']) : null ?>
			</div>
		</td>
		<td class="content">Potpis
			<div>
				<?= ($volume->practice->signature) ? Html::img('@web/images/legal_files/signatures/'.$volume->practice->signature, ['style'=>'width:180px; margin-top:20px;']) : null ?>
			</div>
		</td>
	</tr>
	<tr>
		<td class="right">Broj dela projekta</td>
		<td class="content"><p><?= $volume->code ?></p></td>
	</tr>
	<tr>
		<td class="right">Mesto i datum</td>
		<td class="content"><p><?= $volume->practice->location->city->town ?>, <?= $formatter->asDate(time(), 'php:mm Y') ?></p></td>
	</tr>
</table>