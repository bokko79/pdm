<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
?>
<p class="times uppercase"><small>0.4. Izjava glavnog projektanta <?= $model->projectPhaseGen ?></small></p>

<p>Glavni projektant 
	<?= c($model->projectPhaseGen) ?> za <?= $model->projectTypeOfWorksGen ?> objekta <?= $model->name ?>, 
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

<p class="center" style="padding:30px 0 0;"><?= $model->engineer->name .', '. $model->engineer->title ?></p>

<h2 class="center" style="padding:30px 0; letter-spacing: 4px;">IZJAVLJUJEM</h2>

<p>da su delovi <?= c($model->projectPhaseGen) ?> međusobno usaglašeni i da podaci u glavnoj svesci
odgovaraju sadržini projekta i da su u projektu priloženi odgovarajući elaborati i studije:
</p>

<table class="other" style="margin-bottom: 30px;">
	<?php if($volumes = $model->projectVolumes){
		foreach ($volumes as $volume){ ?>
			<tr>
				<td class=""><?= $volume->volume->no ?>.</td>
				<td class="content uppercase">
					<p><?= c($volume->volume->name) ?></p>
				</td>
				<td>
					br. <?= ($volume->number) ? ($volume->number) : $model->code ?>
				</td>					
			</tr>
	<?php
		}
	} ?>
</table>


<table class="homepage">
	<tr>
		<td class="right titler">Glavni projektant <?= $model->projectPhaseGen ?></td>
		<td class="content">
			<p><?= $model->engineer->name .', '. $model->engineer->title ?></p>
		</td>
	</tr>
	<tr>
		<td class="right">Broj licence</td>
		<td class="content">				
			<p><?= $model->engineer->licenceNumber ?></p>
		</td>
	</tr>
	<tr>
		<td class="right">Lični pečat
			<div style="border:1px solid #777; padding:10px; width:140px;">
				<?= Html::img('@web/images/legal_files/'.$model->practice->stamp, ['style'=>'width:120px; margin-top:20px;']) ?>
			</div>
		</td>
		<td class="content">Potpis
			<div>
				<?= Html::img('@web/images/legal_files/'.$model->client->signature, ['style'=>'width:180px; margin-top:20px;']) ?>
			</div>
		</td>
	</tr>
	<tr>
		<td class="right">Broj tehničke dokumentacije</td>
		<td class="content"><p><?= $model->code ?></p></td>
	</tr>
	<tr>
		<td class="right">Mesto i datum</td>
		<td class="content"><p><?= $model->place->town ?>, <?= $formatter->asDate($model->time, 'php:mm Y') ?></p></td>
	</tr>
</table>