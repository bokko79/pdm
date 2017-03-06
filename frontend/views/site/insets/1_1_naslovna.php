<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$building = $model->projectBuilding;
?>
<?php // $this->render('../pdf/_header', ['model'=>$model, 'volume'=>$volume]) ?>
<p class="times uppercase"><small><?= $volume->number ?>.1. Naslovna strana <?= $volume->volume->nameGen ?></small></p>	
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
			<td class="right">Naziv i oznaka dela projekta</td>
			<td class="content bold"><h3><?= $volume->number ?> - <?= $volume->name ?: $volume->volume->name ?></h3></td>
		</tr>
		<tr>
			<td class="right">Za građenje/izvođenje radova</td>
			<td class="content"><?= c($model->projectTypeOfWorks) ?></td>
		</tr>
		<tr>
			<td class="right" style="padding-bottom: 5px; border-top:1px dotted #777">Projektant</td>
			<td class="content" style="padding-bottom: 5px; border-top:1px dotted #777"><p><?= $volume->practice->name ?></p>
				<p>ul. <?= $volume->practice->location->street. ' br. ' . $volume->practice->location->number . ' ' .$volume->practice->location->city->town; ?></p>
			</td>			
		</tr>
		<tr>
			<td class="right" style="padding:5px 20px;">Odgovorno lice projektanta</td>
			<td class="content" style="padding:5px 20px;"><?= $volume->practice->director->name . ($volume->practice->practiceEngineers[0] ? ', '. $volume->practice->director->title : null) ?></td>			
		</tr>
		<tr>
			<td class="right" style="padding:5px 20px;">
				<small>Pečat projektanta</small> 
				<div>
					<?= Html::img('@web/images/legal_files/stamps/'.$volume->practice->stamp, ['style'=>'width:120px; max-height:120px; margin-top:10px;']) ?>
				</div>
			</td>
			<td class="content" style="padding:5px 20px;">
				<small>Potpis odgovornog lica projektanta</small> 
				<div>
					<?= Html::img('@web/images/legal_files/signatures/'.$volume->practice->signature, ['style'=>'width:160px; max-height:120px;']) ?>
				</div>
			</td>			
		</tr>
		<tr>
			<td class="right" style="padding-bottom: 5px;">Odgovorni projektant</td>
			<td class="content" style="padding-bottom: 5px;">
				<p><?= $volume->engineer->name .', '. $volume->engineer->title ?></p>
				<p>Broj licence: <?= $volume->engineerLicence->no ?></p>
			</td>			
		</tr>
		<tr>
			<td class="right" style="padding:5px 20px 20px;">
				<small>Lični pečat odgovornog projektanta</small> 
				<div>
					<?= Html::img('@web/images/legal_files/licences/'.$volume->engineerLicence->stamp->name, ['style'=>'width:160px; margin-top:10px;']) ?>
				</div>
			</td>
			<td class="content" style="padding:5px 20px 20px;">
				<small>Potpis odgovornog projektanta</small> 
				<div>
					<?= Html::img('@web/images/legal_files/signatures/'.$volume->engineer->signature, ['style'=>'width:160px;']) ?>
				</div>
			</td>				
		</tr>
		<tr>
			<td class="right" style="border-top:1px dotted #777">Broj tehničke dokumentacije</td>
			<td class="content" style="border-top:1px dotted #777"><p><?= $volume->code ?></p></td>
		</tr>
		<tr>
			<td class="right">Mesto i datum</td>
			<td class="content"><p><?= $volume->practice->location->city->town ?>, <?= $formatter->asDate(time(), 'php:mm Y') ?></p></td>
		</tr>
	</table>