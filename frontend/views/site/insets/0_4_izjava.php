<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$building = $model->projectBuilding;
?>
<p class="times uppercase"><small>0.4. Izjava glavnog projektanta <?= $model->projectPhaseGen ?></small></p>

<p>Glavni projektant 
	<?= c($model->projectPhaseGen) ?> za <?= $model->projectTypeOfWorksGen ?> objekta <?= $building->name ?> <?= $building->spratnost ?>, 
	<?php if($model->location->street){ echo 'ulica '. $model->location->street;} ?>
	<?php if($model->location->number){ echo ' br. '.$model->location->number. ', ';} ?>
	<?= $model->location->city->town ?>, 
	kat.parc.br.
	<?php if($lots = $model->location->locationLots){
		foreach($lots as $lot){
			echo $lot->lot. ', ';
		}
	} ?>
	K.O <?= $model->location->county0->name ?>
</p>

<p class="center" style="padding:30px 0 0;"><?= $volume->engineer->name .', '. $volume->engineer->title ?></p>

<h2 class="center" style="padding:30px 0; letter-spacing: 4px;">IZJAVLJUJEM</h2>

<p>da su delovi <?= c($model->projectPhaseGen) ?> međusobno usaglašeni i da podaci u glavnoj svesci
odgovaraju sadržini projekta i da su u projektu priloženi odgovarajući elaborati i studije:
</p>

<table class="other" style="margin-bottom: 30px;">
	<?php if($volumes = $model->projectVolumes){
		foreach ($volumes as $vol){
		 if($vol->volume->type=='projekat' or $vol->volume->type=='elaborat'){ ?>
			<tr>
				<td class=""><?= $vol->volume->no ?>.</td>
				<td class="content uppercase">
					<p><?= c($vol->volume->name) ?></p>
				</td>
				<td>
					br. <?= $vol->code ?>
				</td>					
			</tr>
	<?php }
		}
	} ?>
</table>


<table class="homepage">
	<tr>
		<td class="right titler">Glavni projektant <?= $model->projectPhaseGen ?></td>
		<td class="content">
			<p><?= $volume->engineer->name .', '. $volume->engineer->title ?></p>
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
				<?= Html::img('@web/images/legal_files/licences/'.$volume->engineerLicence->stamp->name, ['style'=>'max-width:180px; margin-top:20px;']) ?>
			</div>
		</td>
		<td class="content">Potpis
			<div>
				<?= Html::img('@web/images/legal_files/signatures/'.$volume->engineer->signature, ['style'=>'max-width:180px; margin-top:20px;']) ?>
			</div>
		</td>
	</tr>
	<tr>
		<td class="right">Broj tehničke dokumentacije</td>
		<td class="content"><p><?= $volume->code ?></p></td>
	</tr>
	<tr>
		<td class="right">Mesto i datum</td>
		<td class="content"><p><?= $volume->practice->location->city->town ?>, <?= $formatter->asDate(time(), 'php:mm Y') ?></p></td>
	</tr>
</table>