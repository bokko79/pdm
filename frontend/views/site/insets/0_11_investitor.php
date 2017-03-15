<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
?>
<p class="times uppercase"><small>0.11. Izjava investitora, vršioca stručnog nadzora i izvođača radova</small></p>

<p>Na osnovu člana 124. stav 5. Zakona o planiranju i izgradnji ("Službeni glasnik RS", br. 72/09, 81/09-ispravka, 64/10 - US, 24/11, 121/12, 42/13 - US, 50/13 - US, 98/13 - US, 132/14 i 145/14) i člana 71. Pravilnika o sadržini, načinu i postupku izrade i način vršenja kontrole tehničke dokumentacije prema klasi i nameni objekata ("Službeni glasnik RS", br. 23/2015 i 77/2015)</p>

<h2 class="center" style="padding:30px 0; letter-spacing: 4px;">IZJAVLJUJEM</h2>

<p>da prilikom izvođenja radova na izgradnji objekta <?= $model->projectBuilding->name ?> <?= $model->projectBuilding->spratnost ?>, nije došlo do odstupanja od Projekta za izvođenje objekta, te da je izvedeno stanje jednako projektovanom stanju.</p>

<table class="homepage" style="margin:20px 0">
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
		<td class="right">Odgovorno lice / zastupnik</td>
		<td class="content">				
			<p><?= $model->client->contact_person; ?></p>
		</td>
	</tr>
	<tr>
		<td class="right">Pečat
			<div>
				<?= ($model->client->stamp) ? Html::img('@web/images/legal_files/stamps/'.$model->client->stamp, ['style'=>'width:120px; margin-top:20px;']) : null ?>
			</div>
		</td>
		<td class="content">Potpis
			<div>
				<?= ($model->client->stamp) ? Html::img('@web/images/legal_files/signatures/'.$model->client->signature, ['style'=>'width:180px; margin-top:20px;']) : null ?>
			</div>
		</td>
	</tr>
</table>

<table class="homepage" style="margin:20px 0">
	<tr>
		<td class="right titler">Stručni nadzor</td>
		<td class="content">
			<h3><b><?= $model->supervisionPractice->name ?></b></h3>
			<p>ul. <?= $model->supervisionPractice->location->street. ' br. ' . $model->supervisionPractice->location->number . ' ' .$model->supervisionPractice->location->city->town; ?></p>
		</td>
	</tr>
	<tr>
		<td class="right">Odgovorno lice / zastupnik</td>
		<td class="content">				
			<p><?= $model->supervisionEngineer->name. ', '.$model->supervisionEngineer->title; ?></p>
		</td>
	</tr>
	<tr>
		<td class="right">Pečat
			<div>
				<?= Html::img('@web/images/legal_files/licences/'.$model->supervisionEngineer->engineerLicences[0]->stamp->name, ['style'=>'max-width:150px; margin-top:20px;']) ?>
			</div>
		</td>
		<td class="content">Potpis
			<div>
				<?= Html::img('@web/images/legal_files/signatures/'.$model->supervisionEngineer->signature, ['style'=>'max-width:180px; margin-top:20px;']) ?>
			</div>
		</td>
	</tr>
</table>


<table class="homepage" style="margin:20px 0">
	<tr>
		<td class="right titler">Generalni izvođač radova</td>
		<td class="content">
			<h3><b><?= $model->builderPractice->name ?></b></h3>
			<p>ul. <?= $model->builderPractice->location->street. ' br. ' . $model->builderPractice->location->number . ' ' .$model->builderPractice->location->city->town; ?></p>
		</td>
	</tr>
	<tr>
		<td class="right">Odgovorno lice / zastupnik</td>
		<td class="content">				
			<p><?= $model->builderEngineer->name. ', '.$model->builderEngineer->title; ?></p>
		</td>
	</tr>
	<tr>
		<td class="right">Pečat
			<div>
				<?= Html::img('@web/images/legal_files/licences/'.$model->builderEngineer->engineerLicences[0]->stamp->name, ['style'=>'max-width:150px; margin-top:20px;']) ?>
			</div>
		</td>
		<td class="content">Potpis
			<div>
				<?= Html::img('@web/images/legal_files/signatures/'.$model->builderEngineer->signature, ['style'=>'max-width:180px; margin-top:20px;']) ?>
			</div>
		</td>
	</tr>
	<tr>
		<td class="right">Mesto i datum</td>
		<td class="content"><p><?= $model->location->city->town ?>, <?= $formatter->asDate(time(), 'php:mm Y') ?></p></td>
	</tr>
</table>