<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
?>
<p class="times uppercase"><small>0.9. Izjave ovlašćenih lica o merama za ispunjenje osnovnih zahteva za objekat</small></p>

<?php if($volumes = $model->projectVolumes){
		foreach ($volumes as $key=>$volume){
			if($volume->volume->type == 'elaborat'): ?>
			<p>Kao ovlašćeno lice koje je izradilo <?= $volume->volume->name ?> koji se prilaže projektu <b><?= $model->projectPhase ?></b> za objekat <b><?= $model->projectBuilding->name ?> <?= $model->projectBuilding->spratnost ?: null ?></b>, ulica <?= $model->location->street ?> br. <?= $model->location->number ?>, <?= $model->location->city->town ?>, kat.parc.br. <?php foreach($model->location->locationLots as $lot){echo $lot->lot.', ';} ?>K.O. <?= $model->location->county0->name ?></p>

			<p class="center" style="padding:30px 0 0;"><?= $volume->engineer->name .', '. $volume->engineer->title ?></p>

			<h2 class="center" style="padding:30px 0; letter-spacing: 4px;">IZJAVLJUJEM</h2>

			<p>1. da je elaborat izrađen u svemu uskladu sa Zakonom o planiranju i izgradnji,
			<?php if($volume->volume_id==14){
					echo 'Zakonom o zaštiti od požara';
				} elseif($volume->volume_id==15){
					echo 'Pravilniku o energetskoj efikasnosti zgrada';
				} else {
					echo '';
				} ?>, propisima, standardima i normativima iz oblasti 
			<?php if($volume->volume_id==14){
					echo 'zaštite od požara';
				} elseif($volume->volume_id==15){
					echo 'energetske efikasnosti zgrada';
				} else {
					echo '';
				} ?> i pravilima struke;</p>
			<p>2. da elaborat sadrži propisane i utvrđene mere i normative osnovnog zahteva za objekat –
			<?php if($volume->volume_id==14){
					echo 'zaštita od požara';
				} elseif($volume->volume_id==15){
					echo 'energetska efikasnost objekta';
				} else {
					echo '';
				} ?>.</p>

				<table class="homepage" style="margin-top:40px;">
					<tr>
						<td class="right titler">Ovlašćeno lice<br> <span class="uppercase">(<?= $model->phase ?>)</span></td>
						<td class="content">
							<p><?= $volume->engineer->name .', '. $volume->engineer->title ?></p>
						</td>
					</tr>
					<tr>
						<td class="right">Broj licence</td>
						<td class="content">				
							<p><?= $model->engineer->engineerLicences[0]->no ?></p>
						</td>
					</tr>
					<tr>
						<td class="right">Lični pečat
							<div style="padding:10px;">
								<?= Html::img('@web/images/legal_files/licences/'.$volume->engineer->engineerLicences[0]->stamp->name, ['style'=>'max-width:150px; margin-top:20px;']) ?>
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
						<td class="content"><p><?= $volume->practice->location->city->town ?>, <?= $formatter->asDate($model->time, 'php:mm Y') ?></p></td>
					</tr>
				</table>

			<?php endif; ?>
			<?php if(($key+1)<count($model->brElaborata)): ?>
				<div class="pagebreaker"></div>
			<?php endif; ?>
	<?php
		}
	} ?>


			