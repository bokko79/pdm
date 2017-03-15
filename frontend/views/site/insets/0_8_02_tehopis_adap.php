<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$formatter->nullDisplay = '--';
$building = $model->projectExBuilding;
$architecture = $building->projectBuildingCharacteristics;
$projectLot = $model->projectLot;
$unit = $model->projectUnit;
$exUnit = $model->projectExUnit;
$unit_architecture = $unit->projectBuildingStoreyPartCharacteristics;
$unit_materials = $unit->projectBuildingStoreyPartMaterials;
$unit_insulations = $unit->projectBuildingStoreyPartInsulations;
$unit_services = $unit->projectBuildingStoreyPartServices;
$unit_structure = $unit->projectBuildingStoreyPartStructure;
$exUnit_architecture = $exUnit->projectBuildingStoreyPartCharacteristics;
$exUnit_materials = $exUnit->projectBuildingStoreyPartMaterials;
$exUnit_insulations = $exUnit->projectBuildingStoreyPartInsulations;
$exUnit_services = $exUnit->projectBuildingStoreyPartServices;
$exUnit_structure = $exUnit->projectBuildingStoreyPartStructure;	
?>
<p class="times uppercase"><small>0.8. Sažeti tehnički opis</small></p>

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
				<?= $building->name ?> (<?= $building->storey ?>)
			</td>
		</tr>
		<tr>
			<td class="right"><b>Lokacija</b></td>
			<td class="content">
				<p><?= $model->location->getLotAddress(true) ?></p>
			</td>
		</tr>
		<tr>
			<td class="right" style="border-bottom:1px dotted #777"><b>Broj tehničke dokumentacije</b></td>
			<td class="content" style="border-bottom:1px dotted #777"><p><?= $model->code ?></p></td>
		</tr>
	</table>

	<h2 class="center uppercase" style="margin-top:30px;">Tehnički opis</h2>
 
	<h3 class="sub">Opšti podaci o lokaciji i objektu</h3>
		<?php if($model->prostorniPlan): // ako postoji prostorni plan ?>
			<h4 class="nopadd">Prostorni plan</h4>
				<p>Naziv plana kome pripada parcela na kojoj je predviđena <?= $model->projectTypeOfWorks ?> jedinice u okviru predmetnog objekta <?= $building->name ?> (<?= $building->storey ?>) je: <?= $model->prostorniPlan->name ?>.</p>
		<?php endif; ?>
		<?php if($model->informacijaOLokaciji and $model->phase=='idr'): // ako postoji informacija o lokaciji ?>
			<h4 class="nopadd"><i class="fa fa-bars"></i> Informacija o lokaciji</h4>
				<p>Na osnovu Informacije o lokaciji br. <?= $model->informacijaOLokaciji->number ?> izdate od strane <?= $model->informacijaOLokaciji->authority->name ?>, dana <?= $formatter->asDate($model->informacijaOLokaciji->date, 'php:j.n.Y.') ?> godine, pristupa se izradi idejnog projekta za adaptaciju jedinice u okviru objekta <?= $building->name ?> (<?= $building->storey ?>), u <?= $model->location->fullAddress ?>.</p>
		<?php endif; ?>

		<!-- PODACI O KATASTARSKOJ PARCELI -->
			<h4 class="nopadd">Katastarska parcela</h4>		

				<!-- FORMIRANJE GRAĐEVINSKE PARCELE -->
				<p>Objekat u okviru kojeg se nalazi predmetna jedinica se nalazi na građevinskoj parceli koja je formirana od <?= $model->location->getLot(2) ?>
			<?php if($model->resenjeOObelezavanjuParcele){
				echo ', na osnovu Rešenja o obeležavanju građevinske parcele broj '.$model->resenjeOObelezavanjuParcele->number. ' od '.$formatter->asDate($model->resenjeOObelezavanjuParcele->date, 'php:j.n.Y.') . ' izdatog od strane '. $model->resenjeOObelezavanjuParcele->authority->name;
			} ?>
			<?php if($model->potvrdaOFormiranjuParcele){
				if($model->resenjeOObelezavanjuParcele){echo ' i';}
				echo ' na osnovu potvrde o formiranju građevinske parcele broj '.$model->potvrdaOFormiranjuParcele->number. ' od '.$formatter->asDate($model->potvrdaOFormiranjuParcele->date, 'php:j.n.Y.') . ' izdatog od strane '. $model->potvrdaOFormiranjuParcele->authority->name;
			} ?>. Građevinska parcela i objekat se nalazi u <?= $model->location->fullAddress ?>.</p>

		<!-- PREDMETNI OBJEKAT -->
		<?php if($architecture->context or $architecture->function or $architecture->position or $architecture->shape): ?>
			<h4 class="nopadd">Predmetni objekat</h4>
			<?= $architecture->context ? '<p>'.$architecture->context.'</p>' : null; ?>
			<?= $architecture->function ? '<p>'.$architecture->function.'</p>' : null; ?>
			<?= $architecture->position ? '<p>'.$architecture->position.'</p>' : null; ?>
			<?= $architecture->shape ? '<p>'.$architecture->shape.'</p>' : null; ?>
		<?php endif; ?>

			<h4 class="nopadd">Predmetna jedinica</h4>
			<p>Predmetna jedinica je <?= $exUnit->structure ?>.</p>
			<?= $exUnit_architecture->position ? '<p>'.$exUnit_architecture->position.'</p>' : null; ?>
			<?= $exUnit_architecture->adjacent ? '<p>'.$exUnit_architecture->adjacent.'</p>' : null; ?>
			<?= $exUnit_architecture->shape ? '<p>'.$exUnit_architecture->shape.'</p>' : null; ?>
			<?= $exUnit_architecture->orientation ? '<p>'.$exUnit_architecture->orientation.'</p>' : null; ?>

	<h3 class="sub">Arhitektonsko rešenje</h3>

	<?php if($exUnit_architecture->function or $exUnit_architecture->access or $exUnit_architecture->entrance or $exUnit_architecture->architecture or $exUnit_architecture->style or $exUnit_architecture->lights or $exUnit_architecture->ventilation): ?>
		<h4 class="sub">Dispozicija, funkcija i arhitektonsko oblikovanje - Postojeće stanje</h4>			
			<?= $exUnit_architecture->function ? '<p>'.$exUnit_architecture->function.'</p>' : null; ?>
			<?= $exUnit_architecture->access ? '<p>'.$exUnit_architecture->access.'</p>' : null; ?>
			<?= $exUnit_architecture->entrance ? '<p>'.$exUnit_architecture->entrance.'</p>' : null; ?>	
			<?= $exUnit_architecture->architecture ? '<p>'.$exUnit_architecture->architecture.'</p>' : null; ?>
			<?= $exUnit_architecture->style ? '<p>'.$exUnit_architecture->style.'</p>' : null; ?>
			<?= $exUnit_architecture->lights ? '<p>'.$exUnit_architecture->lights.'</p>' : null; ?>
			<?= $exUnit_architecture->ventilation ? '<p>'.$exUnit_architecture->ventilation.'</p>' : null; ?>
	<?php endif; ?>
	<?php if($unit_architecture->function or $unit_architecture->access or $unit_architecture->entrance or $unit_architecture->architecture or $unit_architecture->style or $unit_architecture->lights or $unit_architecture->ventilation): ?>
		<h4 class="sub">Dispozicija, funkcija i arhitektonsko oblikovanje - Predviđeno stanje</h4>			
			<?= $unit_architecture->function ? '<p>'.$unit_architecture->function.'</p>' : null; ?>
			<?= $unit_architecture->access ? '<p>'.$unit_architecture->access.'</p>' : null; ?>
			<?= $unit_architecture->entrance ? '<p>'.$unit_architecture->entrance.'</p>' : null; ?>	
			<?= $unit_architecture->architecture ? '<p>'.$unit_architecture->architecture.'</p>' : null; ?>
			<?= $unit_architecture->style ? '<p>'.$unit_architecture->style.'</p>' : null; ?>
			<?= $unit_architecture->lights ? '<p>'.$unit_architecture->lights.'</p>' : null; ?>
			<?= $unit_architecture->ventilation ? '<p>'.$unit_architecture->ventilation.'</p>' : null; ?>		
	<?php endif; ?>
		<h4 class="nopadd">Prostorna struktura sa prikazom površina prostorija jedinice - postojeće stanje</h4>		
		<p>Predmetna jedinica<?= $exUnit->name ?> na etaži <?= $storey->storey ?> , sadrži sledeće prostorije:
			<?php foreach($exUnit->projectBuildingStoreyPartRooms as $key=>$room): ?>
				<?php echo $room->name.', ' ?> <?php ($key+1)==count($exUnit->projectBuildingStoreyPartRooms) ? '' : '' ?>
			<?php endforeach; ?></p>
		<h4 class="sub">Prikaz površina</h4>
		<div style="margin:0 40px 10px 40px;">
			<table class="clear nopadd" style="width:70%;">
				
				<?php foreach($exUnit->projectBuildingStoreyPartRooms as $key=>$room): ?>
				<tr>
					<td class=""><?= $room->mark. '. '.$room->name; ?></td>
					<td class="right"><?= $formatter->format($room->net_area, ['decimal',2]) ?> m<sup>2</sup></td>
				</tr>
				<?php endforeach; ?>
				<tr>
					<td class=""><?= $exUnit->name.' '.$exUnit->mark . ($exUnit->structure ? ' ('.$exUnit->structure.')' : null); ?></td>
					<td class="right"><?= $formatter->format($exUnit->netArea, ['decimal',2]) ?> m<sup>2</sup></td>
				</tr>
			</table>
			<table class="clear nopadd" style="width:70%; margin-top: 20px;">				
				<tr>
					<td class="" style=""><h4 class="uppercase">UKUPNA NETO POVRŠINA</h4></td>
					<td class="right" style=""><?= $formatter->format($exUnit->netArea, ['decimal',2]) ?> m<sup>2</sup></td>
				</tr>
				<tr>
					<td class="" style=""><h4 class="uppercase">UKUPNA REDUKOVANA POVRŠINA</h4></td>
					<td class="right" style=""><?= $formatter->format($exUnit->subNetArea, ['decimal',2]) ?> m<sup>2</sup></td>
				</tr>
				<tr>
					<td class="" style=""><h4 class="uppercase">UKUPNA KORISNA POVRŠINA (-3%)</h4></td>
					<td class="right" style=""><?= $formatter->format($exUnit->subNetArea*0.97, ['decimal',2]) ?> m<sup>2</sup></td>
				</tr>
			</table>
		</div>

		
		<h4 class="nopadd">Prostorna struktura sa prikazom površina prostorija jedinice - predviđeno stanje</h4>	

	<h3 class="sub">Konstrukcija</h3>		
		<?php if($exUnit_structure->wall_external or $exUnit_structure->wall_internal or $exUnit_structure->slab or $exUnit_structure->columns or $exUnit_structure->beam or $exUnit_structure->stair or $exUnit_structure->arch or $exUnit_structure->chimney or $exUnit_materials->door or $exUnit_materials->window or $exUnit_materials->woodwork or $exUnit_materials->steelwork or $exUnit_materials->tinwork): ?>
		<h4 class="nopadd">Postojeće stanje</h4>
		<?= $exUnit_structure->wall_external ? '<h5 class="nopadd">Fasadni i noseći konstruktivni zidovi</h5><p>'.$exUnit_structure->wall_external.'</p>' : null; ?>
		<?= $exUnit_structure->wall_internal ? '<h5 class="nopadd">Unutrašnji zidovi i pregrade</h5><p>'.$exUnit_structure->wall_internal.'</p>' : null; ?>		
		<?= $exUnit_structure->slab ? '<h5 class="nopadd">Ploče i međuspratne konstrukcije</h5><p>'.$exUnit_structure->slab.'</p>' : null; ?>
		<?= $exUnit_structure->columns ? '<h5 class="nopadd">Stubovi i vertikalni serklaži</h5><p>'.$exUnit_structure->columns.'</p>' : null; ?>
		<?= $exUnit_structure->beam ? '<h5 class="nopadd">Grede i horizontalni serklaži</h5><p>'.$exUnit_structure->beam.'</p>' : null; ?>
		<?= $exUnit_structure->stair ? '<h5 class="nopadd">Stepenišna konstrukcija</h5><p>'.$exUnit_structure->stair.'</p>' : null; ?>
		<?= $exUnit_materials->door ? '<h5 class="nopadd">Vrata</h5><p>'.$exUnit_materials->door.'</p>' : null; ?>
		<?= $exUnit_materials->window ? '<h5 class="nopadd">Prozori</h5><p>'.$exUnit_materials->window.'</p>' : null; ?>
		<?= $exUnit_materials->woodwork ? '<h5 class="nopadd">Stolarija</h5><p>'.$exUnit_materials->woodwork.'</p>' : null; ?>
		<?= $exUnit_materials->steelwork ? '<h5 class="nopadd">Bravarija</h5><p>'.$exUnit_materials->steelwork.'</p>' : null; ?>
		<?= $exUnit_materials->tinwork ? '<h5 class="nopadd">Limarija</h5><p>'.$exUnit_materials->tinwork.'</p>' : null; ?>
		<?= $exUnit_structure->arch ? '<h5 class="nopadd">Lukovi i svodovi</h5><p>'.$exUnit_structure->arch.'</p>' : null; ?>
		<?= $exUnit_structure->chimney ? '<h5 class="nopadd">Dimnjaci i ventilacioni kanali</h5><p>'.$exUnit_structure->chimney.'</p>' : null; ?>
		<?php endif; ?>



		<?php if($unit_structure->wall_external or $unit_structure->wall_internal or $unit_structure->slab or $unit_structure->columns or $unit_structure->beam or $unit_structure->stair or $unit_structure->arch or $unit_structure->chimney): ?>
		<h4 class="nopadd">Predviđeno stanje</h4>
		<?= $unit_structure->wall_external ? '<h5 class="nopadd">Fasadni i noseći konstruktivni zidovi</h5><p>'.$unit_structure->wall_external.'</p>' : null; ?>
		<?= $unit_structure->wall_internal ? '<h5 class="nopadd">Unutrašnji zidovi i pregrade</h5><p>'.$unit_structure->wall_internal.'</p>' : null; ?>		
		<?= $unit_structure->slab ? '<h5 class="nopadd">Ploče i međuspratne konstrukcije</h5><p>'.$unit_structure->slab.'</p>' : null; ?>
		<?= $unit_structure->columns ? '<h5 class="nopadd">Stubovi i vertikalni serklaži</h5><p>'.$unit_structure->columns.'</p>' : null; ?>
		<?= $unit_structure->beam ? '<h5 class="nopadd">Grede i horizontalni serklaži</h5><p>'.$unit_structure->beam.'</p>' : null; ?>
		<?= $unit_structure->stair ? '<h5 class="nopadd">Stepenišna konstrukcija</h5><p>'.$unit_structure->stair.'</p>' : null; ?>
		<?= $unit_materials->door ? '<h5 class="nopadd">Vrata</h5><p>'.$unit_materials->door.'</p>' : null; ?>
		<?= $unit_materials->window ? '<h5 class="nopadd">Prozori</h5><p>'.$unit_materials->window.'</p>' : null; ?>
		<?= $unit_materials->woodwork ? '<h5 class="nopadd">Stolarija</h5><p>'.$unit_materials->woodwork.'</p>' : null; ?>
		<?= $unit_materials->steelwork ? '<h5 class="nopadd">Bravarija</h5><p>'.$unit_materials->steelwork.'</p>' : null; ?>
		<?= $unit_materials->tinwork ? '<h5 class="nopadd">Limarija</h5><p>'.$unit_materials->tinwork.'</p>' : null; ?>
		<?= $unit_structure->arch ? '<h5 class="nopadd">Lukovi i svodovi</h5><p>'.$unit_structure->arch.'</p>' : null; ?>
		<?= $unit_structure->chimney ? '<h5 class="nopadd">Dimnjaci i ventilacioni kanali</h5><p>'.$unit_structure->chimney.'</p>' : null; ?>
		<?php endif; ?>



	<h3 class="sub">Materijalizacija</h3>	
		
	<?php if($exUnit_materials->wall_internal or $exUnit_materials->flooring or $exUnit_materials->ceiling or $exUnit_materials->furniture or $exUnit_materials->kitchen or $exUnit_materials->sanitary): ?>
			<h4 class="nopadd">Postojeće stanje</h4>
		<?= $exUnit_materials->wall_internal ? '<h5 class="nopadd">Obrada unutrašnjh zidova</h5><p>'.$exUnit_materials->wall_internal.'</p>' : null; ?>
		<?= $exUnit_materials->flooring ? '<h5 class="nopadd">Obrada podnih površina</h5><p>'.$exUnit_materials->flooring.'</p>' : null; ?>
		<?= $exUnit_materials->ceiling ? '<h5 class="nopadd">Obrada plafona</h5><p>'.$exUnit_materials->ceiling.'</p>' : null; ?>
		<?= $exUnit_materials->furniture ? '<h5 class="nopadd">Nameštaj</h5><p>'.$exUnit_materials->furniture.'</p>' : null; ?>
		<?= $exUnit_materials->kitchen ? '<h5 class="nopadd">Kuhinjski nameštaj</h5><p>'.$exUnit_materials->kitchen.'</p>' : null; ?>
		<?= $exUnit_materials->sanitary ? '<h5 class="nopadd">Sanitarni nameštaj</h5><p>'.$exUnit_materials->sanitary.'</p>' : null; ?>
	<?php endif; ?>

	<?php if($unit_materials->wall_internal or $unit_materials->flooring or $unit_materials->ceiling or $unit_materials->furniture or $unit_materials->kitchen or $unit_materials->sanitary): ?>
		<h4 class="nopadd">Predviđeno stanje</h4>
		<?= $unit_materials->wall_internal ? '<h5 class="nopadd">Obrada unutrašnjh zidova</h5><p>'.$unit_materials->wall_internal.'</p>' : null; ?>
		<?= $unit_materials->flooring ? '<h5 class="nopadd">Obrada podnih površina</h5><p>'.$unit_materials->flooring.'</p>' : null; ?>
		<?= $unit_materials->ceiling ? '<h5 class="nopadd">Obrada plafona</h5><p>'.$unit_materials->ceiling.'</p>' : null; ?>
		<?= $unit_materials->furniture ? '<h5 class="nopadd">Nameštaj</h5><p>'.$unit_materials->furniture.'</p>' : null; ?>
		<?= $unit_materials->kitchen ? '<h5 class="nopadd">Kuhinjski nameštaj</h5><p>'.$unit_materials->kitchen.'</p>' : null; ?>
		<?= $unit_materials->sanitary ? '<h5 class="nopadd">Sanitarni nameštaj</h5><p>'.$unit_materials->sanitary.'</p>' : null; ?>
	<?php endif; ?>

	<h3 class="sub">Izolacija</h3>
	<?php if($exUnit_insulations->general): ?>
		<h4 class="nopadd">Postojeće stanje</h4>
		<?= $exUnit_insulations->general ? '<h5 class="nopadd">Izolacije jedinice</h5><p>'.$exUnit_insulations->thermal.'</p>' : null; ?>
		<!-- TERMOIZOLACIJA OBJEKTA -->
		<?= $exUnit_insulations->thermal ? '<h5 class="nopadd">Termička izolacija</h5><p>'.$exUnit_insulations->thermal.'</p>' : null; ?>
		<!-- HIDROIZOLACIJA OBJEKTA -->
		<?= $exUnit_insulations->hidro ? '<h5 class="nopadd">Hidroizolacija</h5><p>'.$exUnit_insulations->hidro.'</p>' : null; ?>
		<!-- ZVUKOIZOLACIJA OBJEKTA -->
		<?= $exUnit_insulations->sound ? '<h5 class="nopadd">Zvučna zaštita</h5><p>'.$exUnit_insulations->sound.'</p>' : null; ?>
		<!-- PROTIVPOŽARNA IZOLACIJA OBJEKTA -->
		<?= $exUnit_insulations->fireproof ? '<h5 class="nopadd">Protivpožarna izolacija</h5><p>'.$exUnit_insulations->fireproof.'</p>' : null; ?>
	<?php endif; ?>
	<?php if($unit_insulations->general): ?>
		<h4 class="nopadd">Predviđeno stanje</h4>
		<?= $unit_insulations->general ? '<h5 class="nopadd">Izolacije jedinice</h5><p>'.$unit_insulations->thermal.'</p>' : null; ?>
		<!-- TERMOIZOLACIJA OBJEKTA -->
		<?= $unit_insulations->thermal ? '<h5 class="nopadd">Termička izolacija</h5><p>'.$unit_insulations->thermal.'</p>' : null; ?>
		<!-- HIDROIZOLACIJA OBJEKTA -->
		<?= $unit_insulations->hidro ? '<h5 class="nopadd">Hidroizolacija</h5><p>'.$unit_insulations->hidro.'</p>' : null; ?>
		<!-- ZVUKOIZOLACIJA OBJEKTA -->
		<?= $unit_insulations->sound ? '<h5 class="nopadd">Zvučna zaštita</h5><p>'.$unit_insulations->sound.'</p>' : null; ?>
		<!-- PROTIVPOŽARNA IZOLACIJA OBJEKTA -->
		<?= $unit_insulations->fireproof ? '<h5 class="nopadd">Protivpožarna izolacija</h5><p>'.$unit_insulations->fireproof.'</p>' : null; ?>
	<?php endif; ?>	

	<h3 class="sub">Instalacije</h3>
	<?php if($exUnit_services->general): ?>
		<h4 class="nopadd">Postojeće stanje</h4>
		<?= $exUnit_services->general ? '<p>'.$exUnit_services->general.'</p>' : null; ?>
	<?php endif; ?>
	<?php if($unit_services->general): ?>
		<h4 class="nopadd">Predviđeno stanje</h4>
		<?= $unit_services->general ? '<p>'.$unit_services->general.'</p>' : null; ?>
	<?php endif; ?>
		<!-- VODOVOD I HIDRANTI -->
		<?php /* $exUnit_services->water ? '<h4 class="nopadd">Hidrotehničke instalacije: Vodovodna i hidrantska mreža</h4><p>'.$exUnit_services->water.'</p>' : null; ?>
		<!-- KANALIZACIJA -->
		<?= $exUnit_services->sewage ? '<h4 class="nopadd">Kanalizacija</h4><p>'.$exUnit_services->sewage.'</p>' : null; ?>
		<!-- ELEKTROINSTALACIJE JAKE STRUJE -->
		<?= $exUnit_services->electricity ? '<h4 class="nopadd">Elektroinstalacije jake struje</h4><p>'.$exUnit_services->electricity.'</p>' : null; ?>
		<!-- TELEFON I TELEKOMUNIKACIJE -->
		<?= $exUnit_services->phone ? '<h4 class="nopadd">Telefonske, telekomunikacione i signalne instalacije</h4><p>'.$exUnit_services->phone.'</p>' : null; ?>
		<!-- TV -->
		<?= $exUnit_services->tv ? '<h4 class="nopadd">Televizija</h4><p>'.$exUnit_services->tv.'</p>' : null; ?>
		<!-- INSTALACIJE VIDEO NADZORA -->
		<?= $exUnit_services->catv ? '<h4 class="nopadd">Video nadzor</h4><p>'.$exUnit_services->catv.'</p>' : null; ?>
		<!-- OPTIČKE INSTALACIJE -->
		<?= $exUnit_services->internet ? '<h4 class="nopadd">Optičke instalacije</h4><p>'.$exUnit_services->internet.'</p>' : null; ?>
		<!-- INSTALACIJE GREJANJA -->
		<?= $exUnit_services->heating ? '<h4 class="nopadd">Grejanje</h4><p>'.$exUnit_services->heating.'</p>' : null; ?>
		<!-- GASNE INSTALACIJE -->
		<?= $exUnit_services->gas ? '<h4 class="nopadd">Gasne instalacije</h4><p>'.$exUnit_services->gas.'</p>' : null; ?>
		<!-- INSTALACIJE GEOTERMALNOG GREJANJA -->
		<?= $exUnit_services->geotech ? '<h4 class="nopadd">Instalacije geotermalnog grejanja</h4><p>'.$exUnit_services->geotech.'</p>' : null; ?>
		<!-- INSTALACIJE KLIMATIZACIJE -->
		<?= $exUnit_services->ac ? '<h4 class="nopadd">Klimatizacija</h4><p>'.$exUnit_services->ac.'</p>' : null; ?>
		<!-- INSTALACIJE VENTIALCIJE -->
		<?= $exUnit_services->ventilation ? '<h4 class="nopadd">Ventilacija</h4><p>'.$exUnit_services->ventilation.'</p>' : null; ?>		
		<!-- SPRINKLER INSTALACIJE -->
		<?= $exUnit_services->sprinkler ? '<h4 class="nopadd">Sprinkler instalacije</h4><p>'.$exUnit_services->sprinkler.'</p>' : null; ?>
		<!-- PROTIVPOŽARNE INSTALACIJE -->
		<?= $exUnit_services->fire ? '<h4 class="nopadd">Protivpožarne instalacije</h4><p>'.$exUnit_services->fire.'</p>' : null; ?>		
		<!-- INSTALACIJE LIFTOVA I ESKALATORA -->
		<?= $exUnit_services->lift ? '<h4 class="nopadd">Liftovi i eksalatori</h4><p>'.$exUnit_services->lift.'</p>' : null; ?>
		<!-- INSTALACIJE BAZENA -->
		<?= $exUnit_services->pool ? '<h4 class="nopadd">Instalacije bazena</h4><p>'.$exUnit_services->pool.'</p>' : null; ?>		
		<!-- SPECIJALNE I OSTALE INSTALACIJE -->
		<?= $exUnit_services->special ? '<h4 class="nopadd">Specijalne i ostale instalacije jedinice</h4><p>'.$exUnit_services->special.'</p>' : null; */ ?>

	<table class="clear" style="margin-top:40px;">
		<tr>
			<td>
				<?= $volume->practice->location->city->town. ', '.$formatter->asDate(time(), 'php:mm Y.') ?>
			</td>
			<td class="right" style="width:60%;">
				<small>Sastavio:</small><br>
				<?= $volume->engineer->name. ', '.$volume->engineer->title ?><br>
				<small>br. licence:<?= $volume->engineerLicence->no ?></small>
				<div style="width:300px; height: 0px; border-bottom: 1px solid #777;"></div>
				<br>
				<?= Html::img('@web/images/legal_files/licences/'.$volume->engineerLicence->stamp->name, ['style'=>'width:160px; margin-top:10px;']) ?>
				<?= Html::img('@web/images/legal_files/signatures/'.$volume->engineer->signature, ['style'=>'width:160px; margin-top:10px;']) ?>
			</td>
		</tr>
	</table>
</div>
	
