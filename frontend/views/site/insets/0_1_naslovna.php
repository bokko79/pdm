<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
?>
<p class="times uppercase"><small>0.1. Naslovna strana glavne sveske</small></p>	
	<table class="homepage">
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
				<h3><b><?= $model->name ?></b></h3>
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
			<td class="right">Vrsta tehničke dokumentacije</td>
			<td class="content"><p class="uppercase"><?= $model->projectPhase ?></p></td>
		</tr>
		<tr>
			<td class="right">Naziv i oznaka dela projekta</td>
			<td class="content bold"><h3>0 - Glavna sveska</h3></td>
		</tr>
		<tr>
			<td class="right">Za građenje/izvođenje radova</td>
			<td class="content"><?= c($model->projectTypeOfWorks) ?></td>
		</tr>
		<tr>
			<td class="right" style="padding-bottom: 5px; border-top:1px dotted #777">Projektant</td>
			<td class="content" style="padding-bottom: 5px; border-top:1px dotted #777"><p><?= $model->practice->name ?></p>
				<p>ul. <?= $model->practice->location->street. ' br. ' . $model->practice->location->number . ' ' .$model->practice->location->city->town; ?></p>
			</td>			
		</tr>
		<tr>
			<td class="right" style="padding:5px 20px;">Odgovorno lice projektanta</td>
			<td class="content" style="padding:5px 20px;"><?= $model->practice->practiceEngineers[0]->engineer->name . ($model->practice->practiceEngineers[0] ? ', '. $model->practice->practiceEngineers[0]->engineer->title : null) ?></td>			
		</tr>
		<tr>
			<td class="right" style="padding:5px 20px;">
				<small>Pečat projektanta</small> 
				<div>
					<?= Html::img('@web/images/legal_files/stamps/'.$model->practice->stamp, ['style'=>'width:120px; margin-top:10px;']) ?>
				</div>
			</td>
			<td class="content" style="padding:5px 20px;">
				<small>Potpis odgovornog lica projektanta</small> 
				<div>
					<?= Html::img('@web/images/legal_files/signatures/'.$model->practice->signature, ['style'=>'width:160px;']) ?>
				</div>
			</td>			
		</tr>
		<tr>
			<td class="right" style="padding-bottom: 5px;">Glavni projektant</td>
			<td class="content" style="padding-bottom: 5px;">
				<p><?= $model->engineer->name .', '. $model->engineer->title ?></p>
				<p>Broj licence: <?= $model->engineer->engineerLicences[0]->no ?></p>
			</td>			
		</tr>
		<tr>
			<td class="right" style="padding:5px 20px 20px;">
				<small>Lični pečat glavnog projektanta</small> 
				<div>
					<?= Html::img('@web/images/legal_files/licences/'.$model->engineer->engineerLicences[0]->stamp->name, ['style'=>'width:160px; margin-top:10px;']) ?>
				</div>
			</td>
			<td class="content" style="padding:5px 20px 20px;">
				<small>Potpis glavnog projektanta</small> 
				<div>
					<?= Html::img('@web/images/legal_files/signatures/'.$model->engineer->signature, ['style'=>'width:160px;']) ?>
				</div>
			</td>				
		</tr>
		<tr>
			<td class="right" style="border-top:1px dotted #777">Broj tehničke dokumentacije</td>
			<td class="content" style="border-top:1px dotted #777"><p><?= $model->code ?></p></td>
		</tr>
		<tr>
			<td class="right">Mesto i datum</td>
			<td class="content"><p><?= $model->practice->location->city->town ?>, <?= $formatter->asDate($model->time, 'php:mm Y') ?></p></td>
		</tr>
	</table>