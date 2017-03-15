<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$practice = $volume->practice;
$engineer = $volume->engineer;
$building = $model->projectBuilding ? $model->projectBuilding : $model->projectExBuilding;
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
					<p><?= $client->location->fullAddress; ?></p>
			<?php }
			} ?>
		</td>
	</tr>
	<tr>
		<td class="right">Objekat</td>
		<td class="content">
		<?php if($model->work!='adaptacija'): ?>
			<h3><b><?= c($building->name) ?></b> (<?= $building->spratnost ?>)</h3>
		<?php else: ?>
			<h3><b><?= c($building->name) ?></b> (<?= $building->storey ?>)</h3>
		<?php endif; ?>
			<p><?= $model->location->getLotAddress(true) ?></p>
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
		<td class="content">
			<?php // c($model->projectTypeOfWorks) ?>
			<?= c($model->name) ?>
			<?php if($model->work=='adaptacija'): ?>
				(<?= $model->projectUnit->projectBuildingStorey->name ?>)
			<?php endif; ?>	
			</td>
	</tr>
	<tr>
		<td class="right" style="padding-bottom: 5px; border-top:1px dotted #777">Projektant</td>
		<td class="content" style="padding-bottom: 5px; border-top:1px dotted #777">
			<p><?= $practice->name ?></p>
			<p><?= $practice->location->fullAddress; ?></p>
		</td>			
	</tr>
	<tr>
		<td class="right" style="padding:5px 20px;">Odgovorno lice projektanta</td>
		<td class="content" style="padding:5px 20px;">
			<?= $practice->director->name . ($practice->director ? ', '. $practice->director->title : null) ?></td>			
	</tr>
	<tr>
		<td class="right" style="padding:5px 20px;">
			<small>Pečat projektanta</small> 
			<div>
				<?= Html::img('@web/images/legal_files/stamps/'.$practice->stamp, ['style'=>'width:120px; max-height:120px; margin-top:10px;']) ?>
			</div>
		</td>
		<td class="content" style="padding:5px 20px;">
			<small>Potpis odgovornog lica projektanta</small> 
			<div>
				<?= Html::img('@web/images/legal_files/signatures/'.$practice->signature, ['style'=>'width:160px; max-height:120px;']) ?>
			</div>
		</td>			
	</tr>
	<tr>
		<td class="right" style="padding-bottom: 5px;">Glavni projektant</td>
		<td class="content" style="padding-bottom: 5px;">
			<p><?= $engineer->name .', '. $engineer->title ?></p>
			<p>Broj licence: <?= $volume->engineerLicence->no ?></p>
		</td>			
	</tr>
	<tr>
		<td class="right" style="padding:5px 20px 20px;">
			<small>Lični pečat glavnog projektanta</small> 
			<div>
				<?= Html::img('@web/images/legal_files/licences/'.$volume->engineerLicence->stamp->name, ['style'=>'width:160px; max-height:120px; margin-top:10px;']) ?>
			</div>
		</td>
		<td class="content" style="padding:5px 20px 20px;">
			<small>Potpis glavnog projektanta</small> 
			<div>
				<?= Html::img('@web/images/legal_files/signatures/'.$engineer->signature, ['style'=>'width:160px; max-height:120px;']) ?>
			</div>
		</td>				
	</tr>
	<tr>
		<td class="right" style="border-top:1px dotted #777">Broj tehničke dokumentacije</td>
		<td class="content" style="border-top:1px dotted #777"><p><?= $volume->code ?></p></td>
	</tr>
	<tr>
		<td class="right">Mesto i datum</td>
		<td class="content"><p><?= $practice->location->city->town ?>, <?= $formatter->asDate(time(), 'php:mm Y') ?></p></td>
	</tr>
</table>