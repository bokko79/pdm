<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$building = $model->projectBuilding;
?>
<p class="times uppercase"><small>2.0. Izjava vršioca tehničke kontrole</small></p>	
	<table class="homepage smallpadd">
		<tr>
			<td class="right titler">Investitor</td>
			<td class="content">
				<?php if($projectClients = $model->projectClients){
					foreach($projectClients as $projectClient){
						$client = $projectClient->client; ?>
						<h3><b><?= $client->name ?></b></h3>
						<p>ul. <?= $client->location->street. ' br. ' . $client->location->number . ', ' .$client->location->city->town; ?></p>
						<?php
					}
				}?>
			</td>
		</tr>
		<tr>
			<td class="right">Objekat</td>
			<td class="content">
				<h3><b><?= $building->name ?></b></h3>
				<p>ul. <?= $model->location->street. ' br. ' . $model->location->number . ' ' .$model->location->city->town ?></p>
				<p>kat.parc.br. 
				<?php if($lots = $model->location->locationLots){
					foreach($lots as $lot){
						
						echo $lot->lot.', ';
					}
				}?>
					<?= 'K.O. '.$model->location->county0->name; ?></p>
			</td>
		</tr>
		<tr>
			<td class="right">Vrsta tehničke dokumentacije</td>
			<td class="content"><p class="uppercase"><?= $model->projectPhase ?></p></td>
		</tr>
		<tr>
			<td class="right">Za građenje/izvođenje radova</td>
			<td class="content"><?= c($model->projectTypeOfWorks) ?></td>
		</tr>		
		<tr>
			<td class="right" style="border-top:1px dotted #777">Broj tehničke dokumentacije</td>
			<td class="content" style="border-top:1px dotted #777"><p><?= $volume->code ?></p></td>
		</tr>
	</table>

<p style="padding-top: 20px; margin:0; line-height: 0;">Kao zastupnik vršioca tehničke kontrole projekta za građevinsku dozvolu za
	<?= $model->projectTypeOfWorksGen ?> objekta <?= $building->name ?> <?= $building->spratnost ?>, 
	<?php if($model->location->street){ echo 'ulica '. $model->location->street;} ?>
	<?php if($model->location->number){ echo ' br. '.$model->location->number. ', ';} ?>
	<?= $model->location->city->town ?>, 
	kat.parc.br.
	<?php if($lots = $model->location->locationLots){
		foreach($lots as $lot){
			echo $lot->lot. ', ';
		}
	} ?>
	K.O <?= $model->location->county0->name ?>,
</p>

<p class="center" style="padding:5px 0 ; margin:0; line-height: 0;"><?= $model->controlEngineer->name .', '. $model->controlEngineer->title ?></p>

<h2 class="center" style="letter-spacing: 4px;">POTVRĐUJEM</h2>


<p style="padding:0; margin:0; line-height: 0;">1. da je projekat za građevinsku dozvolu urađen u skladu sa lokacijskim uslovima br. <?= $model->lokacijskiUslovi->number ?>,
</p>
<p style="padding:0; margin:0; line-height: 0;">2. da je projekat za građevinsku dozvolu usklađen sa zakonima i drugim propisima i da je izrađen u svemu prema tehničkim propisima, standardima i normativima koji se odnose na projektovanje i građenje te vrste i klase objekta;</p>
<p style="padding:0; margin:0; line-height: 0;">3. da projekat za građevinsku dozvolu ima sve neophodne delove utvrđene odredbama pravilnika kojim se uređuje sadržina tehničke dokumentacije;</p>
<p style="padding:0; margin:0; line-height: 0;">4. da su u projektu za građevinsku dozvolu ispravno primenjeni rezultati svih prethodnih i istražnih radova izvršenih za potrebe izrade projekta za građevinsku dozvolu, kao i da su u projektu sadržane sve opšte i posebne tehničke, tehnološke i druge podloge i podaci;</p>
<p style="padding:0; margin:0; line-height: 0;">5. da su projektom za građevinsku dozvolu obezbeđene tehničke mere za ispunjenje osnovnih zahteva za predmetni objekat.</p>

<table class="homepage smallpadd">
	<tr>
		<td class="right titler">Vršilac tehničke kontrole</td>
		<td class="content">
			<h3><b><?= $model->controlPractice->name ?></b></h3>
			<p>ul. <?= $model->controlPractice->location->street. ' br. ' . $model->controlPractice->location->number . ' ' .$model->controlPractice->location->city->town; ?></p>
		</td>
	</tr>
	<tr>
		<td class="right">Odgovorno lice / zastupnik</td>
		<td class="content">				
			<p><?= $model->controlPractice->director->name. ', '.$model->controlPractice->director->title; ?></p>
		</td>
	</tr>
	<tr>
		<td class="right">Pečat
			<div>
				<?= ($model->controlPractice->stamp) ? Html::img('@web/images/legal_files/stamps/'.$model->controlPractice->stamp, ['style'=>'width:120px;max-height:140px; margin-top:20px;']) : null ?>
			</div>
		</td>
		<td class="content">Potpis
			<div>
				<?= ($model->controlPractice->stamp) ? Html::img('@web/images/legal_files/signatures/'.$model->controlPractice->signature, ['style'=>'width:180px; max-height:140px; margin-top:20px;']) : null ?>
			</div>
		</td>
	</tr>
	<tr>
		<td class="right">Broj tehničke kontrole</td>
		<td class="content"><p><?= $model->tehnickaKontrola->code ?></p></td>
	</tr>
	<tr>
		<td class="right">Mesto i datum</td>
		<td class="content"><p><?= $model->controlPractice->location->city->town ?>, <?= $formatter->asDate(time(), 'php:mm Y') ?></p></td>
	</tr>
</table>