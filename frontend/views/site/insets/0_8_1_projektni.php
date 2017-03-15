<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$formatter->nullDisplay = '--';
$building = $model->projectBuilding;
$architecture = $model->projectBuilding->projectBuildingCharacteristics;
$materials = $model->projectBuilding->projectBuildingMaterials;
$insulations = $model->projectBuilding->projectBuildingInsulations;
$services = $model->projectBuilding->projectBuildingServices;
$structure = $model->projectBuilding->projectBuildingStructure;
$projectLot = $model->projectLot;
$existingBuildings = $model->projectLotExistingBuildings;
$futureDevs = $model->projectLotFutureDevelopments;
?>

<div style="margin: 20px;">

	<table class="homepage" style="border:none;">
		<tr>
			<td class="right titler"><b>Investitor</b></td>
			<td class="content">
				<?php if($projectClients = $model->projectClients){
					foreach($projectClients as $projectClient){ ?>
						<b><?= $projectClient->client->name ?></b>
						<p><?= $projectClient->client->location->fullAddress ?></p>
						<?php
					}
				}?>
			</td>
		</tr>
		<tr>
			<td class="right"><b>Objekat</b></td>
			<td class="content">
				<?= $model->name ?> (<?= $building->spratnost ?>)			
			</td>
		</tr>
		<tr>
			<td class="right"><b>Lokacija</b></td>
			<td class="content">
				<p><p><?= $model->location->getLotAddress(true) ?></p></p>
			</td>
		</tr>
		<?php if($model->phase!='idr'): ?>
		<tr>
			<td class="right"><b>Lokacijski uslovi</b></td>
			<td class="content">
				<p><p><?= $model->lokacijskiUslovi->number ?></p></p>
			</td>
		</tr>
		<?php endif; ?>
		<tr>
			<td class="right"><b>Klimatska zona</b></td>
			<td class="content">
				<p><?= ConverToRoman($projectLot->climate) ?> klimatska zona</p>
			</td>
		</tr>
		<tr>
			<td class="right"><b>Seizmička zona</b></td>
			<td class="content">
				<p><?= ConverToRoman($projectLot->seismic) ?> seizmička zona</p>
			</td>
		</tr>
	</table>

	<h2 class="center uppercase" style="margin-top:30px;">Projektni zadatak</h2>
 
	<h3 class="sub">Opšti podaci o objektu</h3>		

		<h4 class="nopadd">Dimenzije, položaj i oblik</h4>
			<p>Isprojektovati predmetni objekat kao <?= $building->objectType ?>, dimenzija <?= $building->width ?>m x <?= $building->length ?>m i spratnosti <?= $building->spratnost ?>.</p>
			<?= $architecture->function ? '<h5 class="nopadd">Namena objekta</h5><p>'.$architecture->function.'</p>' : null; ?>
			<?= $architecture->shape ? '<h5 class="nopadd">Oblik objekta</h5><p>'.$architecture->shape.'</p>' : null; ?>
			<?= $architecture->position ? '<h5 class="nopadd">Položaj objekta</h5><p>'.$architecture->position.'</p>' : null; ?>
			<?= $architecture->adjacent ? '<h5 class="nopadd">Odnos prema susednim objektima</h5><p>'.$architecture->adjacent.'</p>' : null; ?>
			<?= $architecture->orientation ? '<h5 class="nopadd">Orjentacija objekta</h5><p>'.$architecture->orientation.'</p>' : null; ?>

		<h4 class="nopadd">Prostorna struktura</h4>
		<?php foreach($model->projectBuilding->projectBuildingStoreys as $storey): ?>
		<p>Na koti <?= ($storey->level)==0 ? '&plusmn;' : null ?><?= ($storey->level)>0 ? '+' : null ?><?= $formatter->format($storey->level, ['decimal',2]) ?>  (aps. kota <?= ($storey->level+$projectLot->ground_level)>0 ? '+' : null ?><?= $formatter->format($storey->level+$projectLot->ground_level, ['decimal',2]) ?>) <b><?= $storey->name ?></b>, spratne visine <?= $formatter->format($storey->height, ['decimal',2]) ?>m, predviđene su sledeće prostorno-funkcionalne celine, odnosno jedinice:
				<?php if($storey->brStanova){echo 'stambene jedinice ('.$storey->brStanova .'), ' ;} ?>
				<?php if($storey->brPoslProstora){echo 'poslovni prostori ('.$storey->brPoslProstora .'), ';} ?>
				<?php if($storey->c){echo $storey->c->fullType.' (';
					foreach($ps = $storey->c->projectBuildingStoreyPartRooms as $key=>$room){
						echo $room->roomType->name. (($key+1)==count($ps) ? null : ', ');
					}
					echo '), ';
				} ?>
				<?php if($storey->g){echo $storey->g->fullType.', ';} ?>
				<?php if($storey->t){echo $storey->t->fullType.', ';} ?></p>
		<?php endforeach; ?>
		

	<h3 class="sub">Ostali podaci</h3>
		<h4 class="sub">Konstrukcija i materijali</h4>
		<?= $structure->construction ? '<h5 class="nopadd">Konstrukcija i konstruktivni sistem objekta</h5><p>'.$structure->construction.'</p>' : null; ?>
		<?= $structure->wall_external ? '<h5 class="nopadd">Fasadni i noseći konstruktivni zidovi</h5><p>'.$structure->wall_external.'</p>' : null; ?>
		<?= $structure->wall_internal ? '<h5 class="nopadd">Unutrašnji zidovi i pregrade</h5><p>'.$structure->wall_internal.'</p>' : null; ?>
		<?= $structure->slab ? '<h5 class="nopadd">Ploče i međuspratne konstrukcije</h5><p>'.$structure->slab.'</p>' : null; ?>
		<?= $materials->facade ? '<h5 class="nopadd">Obrada fasade</h5><p>'.$materials->facade.'</p>' : null; ?>
		<?= $structure->roof ? '<h5 class="nopadd">Krovna konstrukcija</h5><p>'.$structure->roof.'</p>' : null; ?>
		<?= $materials->roofing ? '<h5 class="nopadd">Krovni pokrivač</h5><p>'.$materials->roofing.'</p>' : null; ?>

		<?= $materials->woodwork ? '<h5 class="nopadd">Stolarija</h5><p>'.$materials->woodwork.'</p>' : null; ?>
		<?= $materials->steelwork ? '<h5 class="nopadd">Bravarija</h5><p>'.$materials->steelwork.'</p>' : null; ?>
		<?= $materials->tinwork ? '<h5 class="nopadd">Limarija</h5><p>'.$materials->tinwork.'</p>' : null; ?>

		<?= $materials->wall_internal ? '<h5 class="nopadd">Obrada unutrašnjh zidova</h5><p>'.$materials->wall_internal.'</p>' : null; ?>
		<?= $materials->flooring ? '<h5 class="nopadd">Obrada podnih površina</h5><p>'.$materials->flooring.'</p>' : null; ?>
		<?= $materials->ceiling ? '<h5 class="nopadd">Obrada plafona</h5><p>'.$materials->ceiling.'</p>' : null; ?>


		<?= $insulations->general ? '<h5 class="nopadd">Termička izolacija objekta</h5><p>'.$insulations->general.'</p>' : null; ?>
		<!-- KANALIZACIJA -->
		<?= $services->sewage ? '<h5 class="nopadd">Kanalizacija</h5><p>'.$services->sewage.'</p>' : null; ?>
		<!-- ELEKTROINSTALACIJE JAKE STRUJE -->
		<?= $services->electricity ? '<h5 class="nopadd">Elektroinstalacije jake struje</h5><p>'.$services->electricity.'</p>' : null; ?>

		<!-- INSTALACIJE GREJANJA -->
		<?= $services->heating ? '<h5 class="nopadd">Grejanje</h5><p>'.$services->heating.'</p>' : null; ?>



	<table class="clear" style="margin-top:40px;">
		<tr>
			<td>
				<?= $model->client->location->city->town. ', '.$formatter->asDate(time(), 'php:mm Y.') ?>
			</td>
			<td class="right" style="width:60%;">
				<small>Investitor:</small><br>
				<?php if($projectClients = $model->projectClients){
					foreach($projectClients as $projectClient){ ?>
						<b><?= $projectClient->client->name ?></b>
						<p><?= $projectClient->client->location->fullAddress ?></p>
						<?php
					}
				}?>
				<div style="width:300px; height: 0px; border-bottom: 1px solid #777;"></div>
				<br>
				<?= Html::img('@web/images/legal_files/stamp/'.$model->client->stamp, ['style'=>'width:160px; margin-top:10px;']) ?>
				<?= Html::img('@web/images/legal_files/signatures/'.$model->client->signature, ['style'=>'width:160px; margin-top:10px;']) ?>
			</td>
		</tr>
	</table>
</div>
	
