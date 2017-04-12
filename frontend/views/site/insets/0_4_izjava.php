<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$building = $model->projectBuilding ? $model->projectBuilding : $model->projectExBuilding;
$engineer = $volume->engineer;
?>
<p class="times uppercase"><small>0.4. Izjava glavnog projektanta <?= $model->projectPhaseGen ?></small></p>

<p>Glavni projektant 
	<?= c($model->projectPhaseGen) ?> za <?= $model->projectTypeOfWorksGen ?> <?= $model->work=='adaptacija' ? ($model->projectUnit->type=='stan' ? 'stambene jedinice br. ' : 'poslovnog prostora') : 'objekta' ?> <?= $model->work=='adaptacija' ? $model->projectUnit->mark. ' ('.$model->projectUnit->projectBuildingStorey->name.') u okviru objekta' : '' ?> <?= $building->name ?> (<?= $model->work=='adaptacija' ? $building->storey : $building->spratnost ?>), <?= $model->location->lotAddress ?>
</p>

<p class="center" style="padding:30px 0 0;"><?= $engineer->name .', '. $engineer->expertees->short ?></p>

<h2 class="center" style="padding:30px 0; letter-spacing: 4px;">IZJAVLJUJEM</h2>

<p>da su delovi <?= c($model->projectPhaseGen) ?> međusobno usaglašeni i da podaci u glavnoj svesci
odgovaraju sadržini projekta i da su u projektu priloženi odgovarajući elaborati i studije:
</p>

<table class="other" style="margin-bottom: 30px;">
	<?php if($volumes = $model->projectVolumes){
	foreach ($volumes as $vol){
		if($vol->volume->type=='projekat'){ ?>
			<tr>
				<td class=""><?= $vol->number ?>.</td>
				<td class="content uppercase">
					<p><?= c($vol->name) ?></p>
				</td>
				<td>
					br. <?= $vol->code ?>
				</td>					
			</tr>
	<?php }
	}
	foreach ($volumes as $vol){
		if($vol->volume->type=='elaborat'){ ?>
			<tr>
				<td class=""></td>
				<td class="content uppercase">
					<p><?= c($vol->name) ?></p>
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
			<p><?= $engineer->name .', '. $engineer->expertees->short ?></p>
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
				<?= Html::img('@web/images/legal_files/licences/'.$volume->engineerLicence->stamp->name, ['style'=>'max-width:180px; max-height:160px; margin-top:20px;']) ?>
			</div>
		</td>
		<td class="content">Potpis
			<div>
				<?= Html::img('@web/images/legal_files/signatures/'.$volume->engineer->signature, ['style'=>'max-width:180px; max-height:160px; margin-top:20px;']) ?>
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