<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$formatter->nullDisplay = '--';
$building = $model->projectBuilding ? $model->projectBuilding : $model->projectExBuilding;
?>
<p class="times uppercase"><small>1.<?= ($model->phase=='idp' or $model->phase=='pgd' or $model->phase=='pzi' or $model->phase=='pio') ? 6 : 4; ?>.2 Predviđena investiciona vrednost objekta</small></p>

<div style="margin: 20px;">

	<table class="homepage" style="border:none;">
		<tr>
			<td class="right titler"><b>Investitor</b></td>
			<td class="content">
				<?php if($projectClients = $model->projectClients){
					foreach($projectClients as $projectClient){
						$client = $projectClient->client; ?>
						<b><?= $client->name ?></b>
						<p>ul. <?= $client->location->street. ' br. ' . $client->location->number . ', ' .$client->location->city->town; ?></p>
						<?php
					}
				}?>
			</td>
		</tr>
		<tr>
			<td class="right"><b>Objekat</b></td>
			<td class="content">
				<?= $building->name ?><?= $building->spratnost ?>				
			</td>
		</tr>
		<tr>
			<td class="right"><b>Lokacija</b></td>
			<td class="content">
				<p>ul. <?= $model->location->street. ' br. ' . $model->location->number . ' ' .$model->location->city->town ?></p>
				<p>kat.parc.br. 
				<?php if($lots = $model->location->locationLots){
					foreach($lots as $lot){
						
						echo $lot->lot.', ';
					}
				}?>
					<?= 'K.O. '.$model->location->county0->name; ?>
						
					</p>
			</td>
		</tr>
		<tr>
			<td class="right" style="border-bottom:1px dotted #777"><b>Broj tehničke dokumentacije</b></td>
			<td class="content" style="border-bottom:1px dotted #777"><p><?= $volume->code ?></p></td>
		</tr>
	</table>

	<h2 class="center uppercase" style="margin-top:30px;">Predviđena investiciona vrednost objekta</h2>