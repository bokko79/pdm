<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$formatter->nullDisplay = '--';
$building = $model->projectBuilding;
$architecture = $model->projectBuildingCharacteristics;
$materials = $model->projectBuildingMaterials;
$insulations = $model->projectBuildingInsulations;
$services = $model->projectBuildingServices;
$structure = $model->projectBuildingStructure;
$projectLot = $model->projectLot;
$existingBuildings = $model->projectLotExistingBuildings;
$futureDevs = $model->projectLotFutureDevelopments;
?>
<p class="times uppercase"><small>1.<?= ($model->phase=='idp' or $model->phase=='pgd' or $model->phase=='pzi' or $model->phase=='pio') ? 5 : 3; ?>.1 Tehnički opis</small></p>

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
				<?= $building->name ?> <?= $building->spratnost ?>
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

	<h2 class="center uppercase" style="margin-top:30px;">Tehnički opis</h2>
 
	<h3 class="sub">Opšti podaci i lokacija</h3>
		<?php if($model->prostorniPlan): // ako postoji prostorni plan ?>
			<h4 class="nopadd"><i class="fa fa-bars"></i> Prostorni plan</h4>
				<p>Naziv plana kome pripada parcela na kojoj je predviđena izgradnja objekta je: <?= $model->prostorniPlan->name ?>.</p>
		<?php endif; ?>
		<?php if($model->informacijaOLokaciji and $model->phase=='idr'): // ako postoji informacija o lokaciji ?>
			<h4 class="nopadd"><i class="fa fa-bars"></i> Informacija o lokaciji</h4>
				<p>Na osnovu Informacije o lokaciji br. <?= $model->informacijaOLokaciji->number ?> izdate od strane <?= $model->informacijaOLokaciji->authority->name ?>, dana <?= $formatter->asDate($model->informacijaOLokaciji->date, 'php:j.n.Y.') ?> godine, pristupa se izradi idejnog rešenja za objekat <?= $building->name ?>, u ul. <?= $model->location->street. ' br. ' . $model->location->number . ', ' .$model->location->city->town ?>.</p>
		<?php endif; ?>

		<!-- PODACI O KATASTARSKOJ PARCELI -->
			<h4 class="nopadd">Katastarska parcela</h4>
			
			<?php if($projectLot->conditions==1): ?>
				<p>Katastarska parcela ispunjava uslov za građevinsku parcelu prema <?= ($model->prostorniPlan) ? 'navedenom' : 'važećem' ?> prostornom planu.</p>
			<?php endif; ?>

				<!-- FORMIRANJE GRAĐEVINSKE PARCELE -->
				<p>Predmetni objekat se nalazi na građevinskoj parceli koja je formirana od <?= (count($model->location->locationLots)==1) ? 'katastarske parcele broj '.$model->location->locationLots[0]->lot. ', ' : 'katastarskih parcela broj '; ?>
			<?php if(count($model->location->locationLots)>1){
					foreach($model->location->locationLots as $lot){
						echo $lot->lot.', ';
					}
			} ?>K.O. <?= $model->location->county0->name ?>
			<?php if($model->resenjeOObelezavanjuParcele){
				echo ', na osnovu Rešenja o obeležavanju građevinske parcele broj '.$model->resenjeOObelezavanjuParcele->number. ' od '.$formatter->asDate($model->resenjeOObelezavanjuParcele->date, 'php:j.n.Y.') . ' izdatog od strane '. $model->resenjeOObelezavanjuParcele->authority->name;
			} ?>
			<?php if($model->potvrdaOFormiranjuParcele){
				if($model->resenjeOObelezavanjuParcele){echo ' i';}
				echo ' na osnovu potvrde o formiranju građevinske parcele broj '.$model->potvrdaOFormiranjuParcele->number. ' od '.$formatter->asDate($model->potvrdaOFormiranjuParcele->date, 'php:j.n.Y.') . ' izdatog od strane '. $model->potvrdaOFormiranjuParcele->authority->name;
			} ?>. Građevinska parcela se nalazi u ulici <?= $model->location->street. ' br. ' . $model->location->number . ', ' .$model->location->city->town ?>.</p>
				<!-- OPIS PARCELE -->
				<?= $projectLot->description ? '<p>'.$projectLot->description.'</p>' : null; ?>
				<!-- POZICIJA GRAĐEVINSKE PARCELE -->
				<p><?= $projectLot->disposition ?></p>
				<!-- POVRŠINA GRAĐEVINSKE PARCELE -->
				<p>Dimenzije građevinske parcele su <?= $formatter->format($projectLot->width, ['decimal',2]) ?>m x <?= $formatter->format($projectLot->length, ['decimal',2]) ?>m, a ukupna površina je <?= $formatter->format($projectLot->area, ['decimal',2]) ?> m<sup style="">2</sup></p>
				<!-- GRAĐEVINSKA I REGULACIONA LINIJA PARCELE -->
				<p><?= $projectLot->adjacent_border ?></p>				
				<!-- INSTALACIJE GRAĐEVINSKE PARCELE -->
				<p><?= $projectLot->services ?></p>
				<!-- TEREN GRAĐEVINSKE PARCELE -->
				<p>Teren na kome se nalazi predmetna parcela je <?= $projectLot->groundType ?>.</p>
				<!-- VISINSKE KOTE -->
				<p>Visinske kote:</p>
				<ul>
					<li>kota terena: <?= $formatter->format($projectLot->ground_level, ['decimal',2]) ?> m,</li>
					<li>kota nivelete: <?= $formatter->format($projectLot->road_level, ['decimal',2]) ?> m,</li>
					<li>kota maksimalnih podzemnih voda: <?= $formatter->format($projectLot->underwater_level, ['decimal',2]) ?> m.</li>
				</ul>
				<!-- PRAVNO-VLASNIČKA STRUKTURA PARCELE -->
				<?= $projectLot->ownership ? '<p>'.$projectLot->ownership.'</p>' : null; ?>
				<?= $projectLot->legal ? '<p>'.$projectLot->legal.'</p>' : null; ?>
				<!-- OSTALE KARAKTERISTIKE GRAĐEVINSKE PARCELE -->
				<?= $projectLot->note ? '<p>'.$projectLot->note.'</p>' : null; ?>

		<?php if($existingBuildings): ?>
			<h4 class="nopadd">Postojeći objekti na parceli</h4>
			<?php if(count($existingBuildings)==1): ?>
			<p>Na parceli postoji građevinski <?= $existingBuildings[0]->buildingType->name ?> objekat, spratnosti <?= $existingBuildings[0]->storeys ?> i bruto površine <?= $existingBuildings[0]->gross_area ?> m<sup>2</sup>.
			<?php echo $existingBuildings[0]->removal==1 ? 'Postojeći objekat na parceli se mora ukloniti pre početka izgradnje novog objekta.</p>' : 'Postojeći objekat na parceli se zadržava tokom izgradnje novog objekta.</p>'; ?>
			<?php else: ?>
			<p>Na parceli postoje građevinski objekti, i to:</p>
			<ul>
				<?php foreach($existingBuildings as $eb){
					echo '<li>'.$eb->buildingType->name.' objekat, spratnosti '.$eb->storeys.' i bruto površine '.$eb->gross_area.'  m<sup>2</sup>;</li>';
				} ?>
			</ul>
			<?php echo $existingBuildings[0]->removal==1 ? '<p>Svi objekti na parceli se moraju ukloniti pre početka izgradnje novog objekta.</p>' : '<p>Svi objekti na parceli se zadržavaju tokom izgradnje novog objekta.</p>'; ?>
			<?php endif; ?>
		<?php endif; ?>

		<?php if($futureDevs): ?>
			<h4 class="nopadd">Predviđeni objekti na parceli</h4>
				<p>Na parceli se predviđa izgradnja sledećih objekata:</p>
			<?php foreach($futureDevs as $futureDev): ?>				
				<ul>
					<li><?= $futureDev->name ?></li>
				</ul>
			<?php endforeach; ?>
		<?php endif; ?>

			<h4 class="nopadd">Tabelarni prikaz urbanističkih parametara</h4>
				<table class="other smallpadd" style="margin-bottom: 30px;">
					<tr bgcolor="#ddd">
						<td class="titler">Kapacitet</td>
						<td style="">Zahtevane površine [m<sup>2</sup>]</td>
						<td style="">Ostvarene površine [m<sup>2</sup>]</td>
					</tr>
					<tr>
						<td class="titler" bgcolor="#eee">BGP</td>
						<td style=""><?= $formatter->format($building->occupancyAreaReg, ['decimal',2]) ?> m<sup>2</sup> (z=<?= $formatter->format($model->projectLot->occupancy_reg, ['decimal',2]) ?>%)</td>
						<td style=""><?= $formatter->format($building->pr->gross_area, ['decimal',2]) ?> m<sup>2</sup> (z=<?= $formatter->format($building->occupancy*100, ['decimal',2]) ?>%)</td>
					</tr>
					<tr>
						<td class="titler" bgcolor="#eee">BRGP nadzemnih etaža</td>
						<td style=""><?= $formatter->format($building->builtAreaReg, ['decimal',2]) ?> m<sup>2</sup> (i=<?= $formatter->format($model->projectLot->built_index_reg, ['decimal',2]) ?>)</td>
						<td style=""><?= $formatter->format($building->grossAboveArea, ['decimal',2]) ?> m<sup>2</sup> (i=<?= $formatter->format($building->builtIndex, ['decimal',2]) ?>)</td>
					</tr>
					<tr>
						<td class="titler" bgcolor="#eee">BRGP podzemnih etaža</td>
						<td style=""></td>
						<td style=""><?= $formatter->format($building->grossBelowArea, ['decimal',2]) ?> m<sup>2</sup></td>
					</tr>
					<tr>
						<td class="titler" bgcolor="#eee">Površine pod zelenilom</td>
						<td style=""><?= ($model->projectLot->green_area_reg) ? $formatter->format($model->projectLot->green_area_reg*$model->projectLot->area/100, ['decimal',2]) : null ?> m<sup>2</sup> (<?= $formatter->format($model->projectLot->green_area_reg, ['decimal',2]) ?> %)</td>
						<td style=""><?= $formatter->format($model->projectLot->green_area, ['decimal',2]) ?> m<sup>2</sup> (<?= ($building->pr->gross_area) ? $formatter->format($model->projectLot->green_area/$building->pr->gross_area, ['decimal',2]) :null ?> %)</td>
					</tr>
				</table>

	<h3 class="sub">Saobraćajno rešenje</h3>
		<h4 class="nopadd">Prilazi parceli</h4>
			<!-- PRISTUP PARCELI I OBJEKTU -->
			<?= $projectLot->access ? '<p>'.$projectLot->access.'</p>' : null; ?>

		<h4 class="nopadd">Parking</h4>
			<!-- PARKING NA PARCELI I OBJEKTU -->
			<?= $projectLot->parking ? '<p>'.$projectLot->parking.'</p>' : null; ?>

		<h4 class="nopadd">Obračun potrebnog broja parking mesta</h4>
				<table class="clear">
					<tr>
						<td class="titler">Broj stanova</td>
						<td style=""><?= $building->brStanova ?></td>
						<td style=""> = <?= $building->brStanova ?> (1 parking mesto/stan) </td>
					</tr>
					<tr>
						<td class="titler">Površina poslovnih prostora</td>
						<td style=""><?= $building->netAreaBiz ?> m<sup>2</sup></td>
						<td style=""> = <?= $building->netAreaBiz/80 ?> (1 parking mesto/80 m<sup>2</sup>) </td>
					</tr>
					<tr>
						<td class="titler" style="border-top: 1px dotted #aaa;">Ukupno parking mesta</td>
						<td style="border-top: 1px dotted #aaa;"></td>
						<td style="border-top: 1px dotted #aaa;"> = <b><?= $building->brStanova+$building->netAreaBiz/80 ?></b></td>
					</tr>
				</table>
			<p>Od predviđenih <?= $projectLot->parking_spaces ?> parking mesta, <?= $projectLot->parking_disabled ?> su predviđeni za osobe sa invaliditetom.</p>

	<h3 class="sub">Arhitektonsko rešenje</h3>
		<h4 class="nopadd">Prostorna organizacija</h4>
			<p>Prostorna organizacija proizišla je iz Rešenja o lokacijskoj dozvoli za izgradnju objekta: <?= $building->name ?>, na navedenoj katastarskoj parceli izdatog od strane <?= $model->lokacijskiUslovi->authority->name ?> pod brojem <?= $model->lokacijskiUslovi->number ?> od <?= $formatter->asDate($model->lokacijskiUslovi->date, 'php:j.n.Y.') ?> godine.</p>
		
		<h4 class="sub">Dispozicija i funkcija</h4>
			<?= $architecture->function ? '<h5 class="nopadd">Namena objekta</h5><p>'.$architecture->function.'</p>' : null; ?>
			<?= $architecture->access ? '<h5 class="nopadd">Pristupi i prilazi objektu</h5><p>'.$architecture->access.'</p>' : null; ?>
			<?= $architecture->entrance ? '<h5 class="nopadd">Ulazi u objekat</h5><p>'.$architecture->entrance.'</p>' : null; ?>

		<h4 class="nopadd">Dimenzije, položaj i oblik</h4>
			<p>Predmetni objekat je <?= $building->objectType ?>, dimenzija <?= $building->width ?>m x <?= $building->length ?>m.</p>
			<?= $architecture->shape ? '<h5 class="nopadd">Oblik objekta</h5><p>'.$architecture->shape.'</p>' : null; ?>
			<?= $architecture->position ? '<h5 class="nopadd">Položaj objekta</h5><p>'.$architecture->position.'</p>' : null; ?>
			<?= $architecture->adjacent ? '<h5 class="nopadd">Odnos prema susednim objektima</h5><p>'.$architecture->adjacent.'</p>' : null; ?>
			<?= $architecture->orientation ? '<h5 class="nopadd">Orjentacija objekta</h5><p>'.$architecture->orientation.'</p>' : null; ?>

		<h4 class="nopadd">Prostorna struktura</h4>
		<?php foreach($model->projectBuildingStoreys as $storey): ?>
		<p>Na koti <?= ($storey->level)==0 ? '&plusmn;' : null ?><?= ($storey->level)>0 ? '+' : null ?><?= $formatter->format($storey->level, ['decimal',2]) ?>  (aps. kota <?= ($storey->level+$projectLot->ground_level)>0 ? '+' : null ?><?= $formatter->format($storey->level+$projectLot->ground_level, ['decimal',2]) ?>) <b><?= $storey->name ?></b>, predviđene su sledeće prostorno-funkcionalne celine, odnosno jedinice:
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

		<h4 class="sub">Prikaz površina</h4>
		<div style="margin:0 40px 10px 40px;">
			<table class="clear nopadd" style="width:70%;">
			<?php foreach($model->projectBuildingStoreys as $storey): ?>
				<tr>
					<td class="" style="width:40%; border-bottom:1px dotted #777; padding-top:20px;"><h4 class="uppercase"><?= $storey->name ?></h4></td>
					<td style="border-bottom:1px dotted #777; width:160px;"></td>
				</tr>
				<?php foreach($storey->projectBuildingStoreyParts as $key=>$part): ?>
				<tr>
					<td class=""><?= ($key+1). '. '.$part->name.' '.$part->mark . ($part->structure ? ' ('.$part->structure.')' : null); ?></td>
					<td class="right"><?= $formatter->format($part->netArea, ['decimal',2]) ?> m<sup>2</sup></td>
				</tr>
				<?php endforeach; ?>
				<tr>
					<td class=""  bgcolor="#ddd" style="border-top:1px solid #777 "><h4 class=""><?= $storey->name ?> ukupno netto: </h4></td>
					<td class="right" bgcolor="#ddd" style="border-top:1px solid #777 "><b><?= $formatter->format($storey->netArea, ['decimal',2]) ?> m<sup>2</sup></b></td>
				</tr>
				<tr>
					<td class=""  bgcolor="#ddd" style="border-bottom:3px solid #777 "><h4 class=""><?= $storey->name ?> ukupno bruto: </h4></td>
					<td class="right" bgcolor="#ddd" style="border-bottom:3px solid #777 "><b><?= $formatter->format($storey->gross_area, ['decimal',2]) ?> m<sup>2</sup></b></td>
				</tr>
			<?php endforeach; ?>
			</table>
			<table class="clear nopadd" style="width:70%; margin-top: 20px;">
				<tr>
					<td class="" style=""><h4 class="uppercase">UKUPNA BRUTTO POVRŠINA</h4></td>
					<td class="right" style=""><?= $formatter->format($building->grossArea, ['decimal',2]) ?> m<sup>2</sup></td>
				</tr>
				<tr>
					<td class="" style=""><h4 class="uppercase">UKUPNA NETO POVRŠINA</h4></td>
					<td class="right" style=""><?= $formatter->format($building->netArea, ['decimal',2]) ?> m<sup>2</sup></td>
				</tr>
				<tr>
					<td class="" style=""><h4 class="uppercase">UKUPNA REDUKOVANA POVRŠINA</h4></td>
					<td class="right" style=""><?= $formatter->format($building->subNetArea, ['decimal',2]) ?> m<sup>2</sup></td>
				</tr>
				<tr>
					<td class="" style=""><h4 class="uppercase">UKUPNA KORISNA POVRŠINA (-3%)</h4></td>
					<td class="right" style=""><?= $formatter->format($building->subNetArea*0.97, ['decimal',2]) ?> m<sup>2</sup></td>
				</tr>
				<tr>
					<td class="" style=""><h4 class="uppercase">UKUPNA STAMBENA POVRŠINA</h4></td>
					<td class="right" style=""><?= $formatter->format($building->netAreaStan, ['decimal',2]) ?> m<sup>2</sup></td>
				</tr>
				<tr>
					<td class="" style=""><h4 class="uppercase">BROJ STAMBENIH JEDINICA</h4></td>
					<td class="right" style=""><?= $building->brStanova ?></td>
				</tr>
				<tr>
					<td class="" style=""><h4 class="uppercase">PROSEČNA VELIČINA STANA</h4></td>
					<td class="right" style=""><?= $formatter->format($building->netAreaStan/$building->brStanova, ['decimal',2]) ?> m<sup>2</sup></td>
				</tr>
				<tr>
					<td class="" style=""><h4 class="uppercase">UKUPNA POSLOVNA POVRŠINA</h4></td>
					<td class="right" style=""><?= $formatter->format($building->netAreaBiz, ['decimal',2]) ?> m<sup>2</sup></td>
				</tr>
				<tr>
					<td class="" style=""><h4 class="uppercase">BROJ POSLOVNIH PROSTORA</h4></td>
					<td class="right" style=""><?= $building->brPoslProstora ?></td>
				</tr>
				<tr>
					<td class="" style=""><h4 class="uppercase">BROJ PARKING MESTA</h4></td>
					<td class="right" style=""><?= $projectLot->parking_spaces ?> (<?= $projectLot->parking_disabled ?> za osobe sa inv.)</td>
				</tr>
			</table>
		</div>

		<h4 class="sub">Arhitektonsko oblikovanje</h4>
			<?= $architecture->context ? '<h5 class="nopadd">Arhitektonski kontekst</h5><p>'.$architecture->context.'</p>' : null; ?>
			<?= $architecture->architecture ? '<h5 class="nopadd">Arhitektonsko oblikovanje</h5><p>'.$architecture->architecture.'</p>' : null; ?>
			<?= $architecture->style ? '<h5 class="nopadd">Arhitektonski stil i izraz</h5><p>'.$architecture->style.'</p>' : null; ?>
			<?= $architecture->environment ? '<h5 class="nopadd">Odnos prema životnoj sredini</h5><p>'.$architecture->environment.'</p>' : null; ?>
			<?= $architecture->lights ? '<h5 class="nopadd">Prirodno osvetljenje</h5><p>'.$architecture->lights.'</p>' : null; ?>
			<?= $architecture->ventilation ? '<h5 class="nopadd">Provertravanje</h5><p>'.$architecture->ventilation.'</p>' : null; ?>

	<h3 class="sub">Konstrukcija</h3>
		<?php if($structure->construction or $structure->foundation): ?>
		<h4 class="nopadd">Konstrukcija i temelji</h4>
		<?= $structure->construction ? '<h5 class="nopadd">Konstrukcija i konstruktivni sistem objekta</h5><p>'.$structure->construction.'</p>' : null; ?>
		<?= $structure->foundation ? '<h5 class="nopadd">Temelji</h5><p>'.$structure->foundation.'</p>' : null; ?>
		<?php endif; ?>
		
		<?php if($structure->wall_external or $structure->wall_internal): ?>
		<h4 class="nopadd">Zidovi i platna</h4>
		<?= $structure->wall_external ? '<h5 class="nopadd">Fasadni i noseći konstruktivni zidovi</h5><p>'.$structure->wall_external.'</p>' : null; ?>
		<?= $structure->wall_internal ? '<h5 class="nopadd">Unutrašnji zidovi i pregrade</h5><p>'.$structure->wall_internal.'</p>' : null; ?>		
		<?php endif; ?>

		<?php if($structure->slab or $structure->columns or $structure->beam): ?>
		<h4 class="nopadd">Ploče i linijski elementi</h4>
		<?= $structure->slab ? '<h5 class="nopadd">Ploče i međuspratne konstrukcije</h5><p>'.$structure->slab.'</p>' : null; ?>
		<?= $structure->columns ? '<h5 class="nopadd">Stubovi i vertikalni serklaži</h5><p>'.$structure->columns.'</p>' : null; ?>
		<?= $structure->beam ? '<h5 class="nopadd">Grede i horizontalni serklaži</h5><p>'.$structure->beam.'</p>' : null; ?>
		<?php endif; ?>
		
		<?php if($structure->roof or $structure->stair): ?>
		<h4 class="nopadd">Krovna i stepenišna konstrukcija</h4>
		<?= $structure->roof ? '<h5 class="nopadd">Krovna konstrukcija</h5><p>'.$structure->roof.'</p>' : null; ?>
		<?= $structure->stair ? '<h5 class="nopadd">Stepenišna konstrukcija</h5><p>'.$structure->stair.'</p>' : null; ?>
		<?php endif; ?>
		
		<?php if($structure->truss or $structure->arch or $structure->chimney): ?>
		<h4 class="nopadd">Ostale konstrukcije</h4>
		<?= $structure->truss ? '<h5 class="nopadd">Rešetkasti nosači</h5><p>'.$structure->truss.'</p>' : null; ?>
		<?= $structure->arch ? '<h5 class="nopadd">Lukovi i svodovi</h5><p>'.$structure->arch.'</p>' : null; ?>
		<?= $structure->chimney ? '<h5 class="nopadd">Dimnjaci i ventilacioni kanali</h5><p>'.$structure->chimney.'</p>' : null; ?>
		<?php endif; ?>


	<h3 class="sub">Materijalizacija</h3>		
		<?php if($materials->access or $materials->facade or $materials->roofing): ?>
		<h4 class="nopadd">Spoljašnja obrada</h4>
		<?= $materials->access ? '<h5 class="nopadd">Obrada spoljnih površina, staza i partera</h5><p>'.$materials->access.'</p>' : null; ?>
		<?= $materials->facade ? '<h5 class="nopadd">Obrada fasade</h5><p>'.$materials->facade.'</p>' : null; ?>
		<?= $materials->roofing ? '<h5 class="nopadd">Krovni pokrivač</h5><p>'.$materials->roofing.'</p>' : null; ?>
		<?php endif; ?>

		<?php if($materials->door or $materials->window or $materials->woodwork or $materials->steelwork or $materials->tinwork): ?>
		<h4 class="nopadd">Stolarija, bravarija i limarija</h4>
		<?= $materials->door ? '<h5 class="nopadd">Vrata</h5><p>'.$materials->door.'</p>' : null; ?>
		<?= $materials->window ? '<h5 class="nopadd">Prozori</h5><p>'.$materials->window.'</p>' : null; ?>
		<?= $materials->woodwork ? '<h5 class="nopadd">Stolarija</h5><p>'.$materials->woodwork.'</p>' : null; ?>
		<?= $materials->steelwork ? '<h5 class="nopadd">Bravarija</h5><p>'.$materials->steelwork.'</p>' : null; ?>
		<?= $materials->tinwork ? '<h5 class="nopadd">Limarija</h5><p>'.$materials->tinwork.'</p>' : null; ?>
		<?php endif; ?>

		<?php if($materials->wall_internal or $materials->flooring or $materials->ceiling): ?>
		<h4 class="nopadd">Unutrašnja obrada</h4>
		<?= $materials->wall_internal ? '<h5 class="nopadd">Obrada unutrašnjh zidova</h5><p>'.$materials->wall_internal.'</p>' : null; ?>
		<?= $materials->flooring ? '<h5 class="nopadd">Obrada podnih površina</h5><p>'.$materials->flooring.'</p>' : null; ?>
		<?= $materials->ceiling ? '<h5 class="nopadd">Obrada plafona</h5><p>'.$materials->ceiling.'</p>' : null; ?>
		<?php endif; ?>

		<?php if($materials->furniture or $materials->kitchen or $materials->sanitary): ?>
		<h4 class="nopadd">Nameštaj i sanitarije</h4>
		<?= $materials->furniture ? '<h5 class="nopadd">Nameštaj</h5><p>'.$materials->furniture.'</p>' : null; ?>
		<?= $materials->kitchen ? '<h5 class="nopadd">Kuhinjski nameštaj</h5><p>'.$materials->kitchen.'</p>' : null; ?>
		<?= $materials->sanitary ? '<h5 class="nopadd">Sanitarni nameštaj</h5><p>'.$materials->sanitary.'</p>' : null; ?>
		<?php endif; ?>

	<h3 class="sub">Izolacija</h3>

		<!-- TERMOIZOLACIJA OBJEKTA -->
		<?= $insulations->thermal ? '<h4 class="nopadd">Termička izolacija objekta</h4><p>'.$insulations->thermal.'</p>' : null; ?>
		<!-- HIDROIZOLACIJA OBJEKTA -->
		<?= $insulations->hidro ? '<h4 class="nopadd">Hidroizolacija objekta</h4><p>'.$insulations->hidro.'</p>' : null; ?>
		<!-- ZVUKOIZOLACIJA OBJEKTA -->
		<?= $insulations->sound ? '<h4 class="nopadd">Zvučna zaštita objekta</h4><p>'.$insulations->sound.'</p>' : null; ?>
		<!-- PROTIVPOŽARNA IZOLACIJA OBJEKTA -->
		<?= $insulations->fireproof ? '<h4 class="nopadd">Protivpožarna izolacija objekta</h4><p>'.$insulations->fireproof.'</p>' : null; ?>
		<!-- HEMIJSKA IZOLACIJA OBJEKTA -->
		<?= $insulations->chemical ? '<h4 class="nopadd">Izolacija objekta od opasnih materija</h4><p>'.$insulations->chemical.'</p>' : null; ?>


	<h3 class="sub">Instalacije</h3>

		<!-- VODOVOD I HIDRANTI -->
		<?= $services->water ? '<h4 class="nopadd">Hidrotehničke instalacije: Vodovodna i hidrantska mreža</h4><p>'.$services->water.'</p>' : null; ?>
		<!-- KANALIZACIJA -->
		<?= $services->sewage ? '<h4 class="nopadd">Kanalizacija</h4><p>'.$services->sewage.'</p>' : null; ?>
		<!-- ELEKTROINSTALACIJE JAKE STRUJE -->
		<?= $services->electricity ? '<h4 class="nopadd">Elektroinstalacije jake struje</h4><p>'.$services->electricity.'</p>' : null; ?>
		<!-- TELEFON I TELEKOMUNIKACIJE -->
		<?= $services->phone ? '<h4 class="nopadd">Telefonske, telekomunikacione i signalne instalacije</h4><p>'.$services->phone.'</p>' : null; ?>
		<!-- TV -->
		<?= $services->tv ? '<h4 class="nopadd">Televizija</h4><p>'.$services->tv.'</p>' : null; ?>
		<!-- INSTALACIJE VIDEO NADZORA -->
		<?= $services->catv ? '<h4 class="nopadd">Video nadzor</h4><p>'.$services->catv.'</p>' : null; ?>
		<!-- OPTIČKE INSTALACIJE -->
		<?= $services->internet ? '<h4 class="nopadd">Optičke instalacije</h4><p>'.$services->internet.'</p>' : null; ?>
		<!-- INSTALACIJE GREJANJA -->
		<?= $services->heating ? '<h4 class="nopadd">Grejanje</h4><p>'.$services->heating.'</p>' : null; ?>
		<!-- GASNE INSTALACIJE -->
		<?= $services->gas ? '<h4 class="nopadd">Gasne instalacije</h4><p>'.$services->gas.'</p>' : null; ?>
		<!-- INSTALACIJE GEOTERMALNOG GREJANJA -->
		<?= $services->geotech ? '<h4 class="nopadd">Instalacije geotermalnog grejanja</h4><p>'.$services->geotech.'</p>' : null; ?>
		<!-- INSTALACIJE KLIMATIZACIJE -->
		<?= $services->ac ? '<h4 class="nopadd">Klimatizacija</h4><p>'.$services->ac.'</p>' : null; ?>
		<!-- INSTALACIJE VENTIALCIJE -->
		<?= $services->ventilation ? '<h4 class="nopadd">Ventilacija</h4><p>'.$services->ventilation.'</p>' : null; ?>		
		<!-- SPRINKLER INSTALACIJE -->
		<?= $services->sprinkler ? '<h4 class="nopadd">Sprinkler instalacije</h4><p>'.$services->sprinkler.'</p>' : null; ?>
		<!-- PROTIVPOŽARNE INSTALACIJE -->
		<?= $services->fire ? '<h4 class="nopadd">Protivpožarne instalacije</h4><p>'.$services->fire.'</p>' : null; ?>		
		<!-- INSTALACIJE LIFTOVA I ESKALATORA -->
		<?= $services->lift ? '<h4 class="nopadd">Liftovi i eksalatori</h4><p>'.$services->lift.'</p>' : null; ?>
		<!-- INSTALACIJE BAZENA -->
		<?= $services->pool ? '<h4 class="nopadd">Instalacije bazena</h4><p>'.$services->pool.'</p>' : null; ?>		
		<!-- SAOBRAĆAJNE INSTALACIJE -->
		<?= $services->traffic ? '<h4 class="nopadd">Saobraćajne instalacije</h4><p>'.$services->traffic.'</p>' : null; ?>		
		<!-- SPECIJALNE I OSTALE INSTALACIJE -->
		<?= $services->special ? '<h4 class="nopadd">Specijalne i ostale instalacije objekta</h4><p>'.$services->special.'</p>' : null; ?>


	<table class="clear" style="margin-top:40px;">
		<tr>
			<td>
				<?= $volume->practice->location->city->town. ', '.$formatter->asDate(time(), 'php:mm Y.') ?>
			</td>
			<td class="right" style="width:60%;">
				<small>Sastavio:</small><br>
				<?= $volume->engineer->name. ', '.$volume->engineer->title ?><br>
				<small>br. licence:<?= $volume->engineer->engineerLicences[0]->no ?></small>
				<div style="width:300px; height: 0px; border-bottom: 1px solid #777;"></div>
				<br>
				<?= Html::img('@web/images/legal_files/licences/'.$volume->engineer->engineerLicences[0]->stamp->name, ['style'=>'width:160px; margin-top:10px;']) ?>
				<?= Html::img('@web/images/legal_files/signatures/'.$volume->engineer->signature, ['style'=>'width:160px; margin-top:10px;']) ?>
			</td>
		</tr>
	</table>
</div>
	
