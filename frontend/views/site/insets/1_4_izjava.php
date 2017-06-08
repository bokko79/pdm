<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$practice = $volume->practice;
$engineer = $volume->engineer;
$building = $model->projectBuilding;
?>
<p class="times uppercase"><small><?= $volume->number ?>.4. Izjava odgovornog projektanta <?= $volume->volume->nameGen ?></small></p>

<p>Odgovorni projektant 
	<?= $volume->volume->nameGen ?>, koji je deo <?= c($model->projectPhaseGen) ?> za <?= $model->projectTypeOfWorksGen ?> za objekat <?= $building->name ?> (<?= $building->spratnost ?>), ulica <?= $model->location->street ?> br. <?= $model->location->number ?>, <?= $model->location->city->town ?>, kat.parc.br.
	<?php if($lots = $model->location->locationLots){
		foreach($lots as $lot){
			echo $lot->lot. ', ';
		}
	} ?> K.O <?= $model->location->county0->name ?>
</p>

<p class="center" style="padding:30px 0 0;"><?= $engineer->name .', '. $engineer->title ?></p>

<h2 class="center" style="padding:30px 0; letter-spacing: 4px;">IZJAVLJUJEM</h2>

<?php if($model->phase=='pgd'): ?>
<p>1. da je projekat u svemu u skladu sa izdatim lokacijskim uslovima br. <?= $model->lokacijskiUslovi->number ?>,
</p>
<?php endif; ?>
<?php if($model->phase=='pzi'): ?>
<p>1. da je projekat u svemu u skladu sa izdatim lokacijskim uslovima br. <?= $model->lokacijskiUslovi->number ?>, građevinskom dozvolom br. <?= $model->graDozvola->number ?> i projektom za građevinsku dozvolu,
</p>
<?php endif; ?>
<p><?= ($model->phase=='pzi' or $model->phase=='pgd') ? 2 : 1; ?>. da je projekat izrađen u skladu sa Zakonom o planiranju i izgradnji, propisima, standardima i normativima iz oblasti izgradnje objekata i pravilima struke,</p>
<p><?= ($model->phase=='pzi' or $model->phase=='pgd') ? 3 : 2; ?>. da su pri izradi projekta poštovane sve propisane i utvrđene mere i preporuke za ispunjenje osnovnih zahteva za objekat i da je projekat izrađen u skladu sa merama i preporukama kojima se dokazuje ispunjenost osnovnih zahteva.</p>


<table class="homepage">
	<tr>
		<td class="right titler">Odgovorni projektant <?= $volume->volume->nameGen ?></td>
		<td class="content">
			<p><?= $engineer->name .', '. $engineer->title ?></p>
		</td>
	</tr>
	<tr>
		<td class="right">Broj licence</td>
		<td class="content">				
			<p><?= $volume->engineerLicence->no ?></p>
		</td>
	</tr>
	<tr>
		<td class="right">Lični pečat
			<div style="padding:10px;">
				<?= Html::img('@web/images/legal_files/licences/'.$volume->engineerLicence->stamp->name, ['style'=>'width:160px; max-height:120px; margin-top:10px;']) ?>
			</div>
		</td>
		<td class="content">Potpis
			<div>
				<?= $engineer->EngSignature ?>
			</div>
		</td>
	</tr>
	<tr>
		<td class="right">Broj tehničke dokumentacije</td>
		<td class="content"><p><?= $volume->code ?></p></td>
	</tr>
	<tr>
		<td class="right">Mesto i datum</td>
		<td class="content"><p><?= $practice->location->city->town ?>, <?= $formatter->asDate(time(), 'php:F Y.') ?></p></td>
	</tr>
</table>