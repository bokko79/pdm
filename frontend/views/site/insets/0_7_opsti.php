<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$formatter->nullDisplay = '--';
$dual = false;
$building = $model->projectBuilding ? $model->projectBuilding : $model->projectExBuilding;
if($model->work=='rekonstrukcija' or $model->work=='sanacija' or $model->work=='dogradnja'){
	$dual = true;
	$building = $model->projectBuilding;
	$exBuilding = $model->projectExBuilding;
}
?>
<p class="times uppercase"><small>0.7. Podaci o objektu i lokaciji</small></p>
	<h3 class="uppercase bold">Opšti podaci o objektu i lokaciji</h3>
	<table class="other smallpadd" style="border: 1px solid #777;">
		<tr>
			<td class="shorttitler"><small>tip objekta</small></td>
			<td class="content">
				<?= $building->objectType ?>
			</td>
		</tr>
		<tr>
			<td class=""><small>vrsta radova</small></td>
			<td class="content">
				<?= $model->projectTypeOfWorks ?>
			</td>
		</tr>	
		<tr>
			<td class=""><small>kategorija objekta</small></td>
			<td class="content">
				<?= $model->building->category ?>
			</td>
		</tr>
		<tr>
			<td class=""><small>klasifikacija pojedinih delova objekta</small></td>
			<td class="container">
				<table class="clear">
					<tr>
						<td class="titler" style="border-bottom: 1px dotted #777; border-right: 1px dotted #777;"><small>učešće u ukupnoj površini objekta (%)</small></td>
						<td style="border-bottom: 1px dotted #777;"><small>klasifikaciona oznaka</small></td>
					</tr>
					<?php // foreach loop kroz sve delove objekta  ?>
					<?php foreach($building->projectBuildingClasses as $class): ?>
					<tr>
						<td class="titler" style="border-bottom: 1px dotted #777; border-right: 1px dotted #777;"><?= $formatter->format($class->percent, ['decimal',2]) ?> (<?= $formatter->format($class->area, ['decimal',2]) ?> m<sup>2</sup>)</td>
						<td style="border-bottom: 1px dotted #777;"><?= $class->building->category. ' - '.$class->building->class. ': <i>'.$class->building->name ?></i></td>
					</tr>
					<?php endforeach; ?>
				</table>
			</td>
		</tr>
		<?php if($model->prostorniplan): ?>
		<tr>
			<td class=""><small>naziv prostornog, odnosno urbanističkog plana</small></td>
			<td class="content">
				<?= $model->prostorniplan->name ?>
			</td>
		</tr>
		<?php endif; ?>
		<tr>
			<td class=""><small>mesto</small></td>
			<td class="content">
				<?= $model->location->city->town ?>
			</td>
		</tr>
		<tr>
			<td class=""><small>broj katastarske parcele/spisak katastarskih parcela i katastarska opština</small></td>
			<td class="content">
				<?= $model->location->getLot() ?>
			</td>
		</tr>
		<tr>
			<td class=""><small>broj katastarske parcele/spisak katastarskih parcela i katastarska opština preko kojih prelaze priključci za infrastrukturu</small></td>
			<td class="content">
				<?= $model->location->getServiceLot() ?>
			</td>
		</tr>
		<tr>
			<td class=""><small>broj katastarske parcele/spisak katastarskih parcela i katastarska opština na kojoj se nalazi priključak na javnu saobraćajnicu</small></td>
			<td class="content">
				<?= $model->location->getAccessLot() ?>
			</td>
		</tr>		
	</table>
	<?php if($model->work!='adaptacija'): ?>
	<h4 class="uppercase bold">Priključci na infrastrukturu</h4>
	<table class="other smallpadd" style="border: 1px solid #777;">
		<?php if($model->projectLot->conn_water): ?>
		<tr>
			<td class="shorttitler"><small>priključak na vodovodnu i kanalizacionu mrežu</small></td>
			<td class="content">
				<?= $model->projectLot->conn_water ?>
			</td>
		</tr>
		<?php endif; ?>
		<?php if($model->projectLot->conn_electric): ?>
		<tr>
			<td class=""><small>priključak na elektro-energetsku mrežu</small></td>
			<td class="content">
				<?= $model->projectLot->conn_electric ?>
			</td>
		</tr>	
		<?php endif; ?>
		<?php if($model->projectLot->conn_telecom): ?>
		<tr>
			<td class=""><small>priključak na telekomunikacionu mrežu</small></td>
			<td class="content">
				<?= $model->projectLot->conn_telecom ?>
			</td>
		</tr>	
		<?php endif; ?>
		<?php if($model->projectLot->conn_heating): ?>
		<tr>
			<td class="shorttitler"><small>priključak na toplovodnu instalaciju</small></td>
			<td class="content">
				<?= $model->projectLot->conn_heating ?>
			</td>
		</tr>
		<?php endif; ?>
		<?php if($model->projectLot->conn_gas): ?>
		<tr>
			<td class=""><small>priključak na gasovod</small></td>
			<td class="content">
				<?= $model->projectLot->conn_gas ?>
			</td>
		</tr>	
		<?php endif; ?>
	</table>
	<?php endif; ?>
	<?php if($model->phase!='idr'): ?>
	<h4 class="uppercase bold">Lokacijski uslovi</h4>
	<table class="other smallpadd" style="border: 1px solid #777;">
		<tr>
			<td class="shorttitler"><small>Lokacijski uslovi</small></td>
			<td class="content">
				<?= $model->lokacijskiUslovi->name ?>
			</td>
			<td class="content">
				Br.: <?= $model->lokacijskiUslovi->number ?><br>
				Datum: <?= $formatter->asDate($model->lokacijskiUslovi->date, 'php:j.n.Y.') ?>
			</td>
		</tr>
	</table>
	<?php endif; ?>
	
	<?php if($saglasnosti = $model->saglasnosti){ ?>
	<h4 class="uppercase bold">Saglasnosti</h4>
	<table class="other smallpadd" style="border: 1px solid #777;">
		<?php
			foreach($saglasnosti as $saglasnost){ ?>
				<tr>
					<td class="shorttitler"><small>Obavezne saglasnosti</small></td>
					<td class="content">
						<?= $saglasnost->name ?>
					</td>
					<td class="content">
						Br.: <?= $saglasnost->number ?><br>
						Datum: <?= $formatter->asDate($saglasnost->date, 'php:j.n.Y.') ?>
					</td>
				</tr>
		<?php
			} ?>
	</table>
	<?php
		} ?>


	<div class="pagebreaker"></div>


	<h3 class="uppercase bold">Osnovni podaci o objektu i lokaciji</h3>

	<table class="other smallpadd" style="border: 1px solid #777;">
		<tr>
			<td class="shorttitler" rowspan="<?= ($model->work!='adaptacija') ? 13 : 5 ?>" style="width: 25%"><small>dimenzije objekta:</small></td>
			<td class="" style="width: 45%"><small>ukupna površina parcele/parcela:</small></td>
			<td class="content right" style="width: 35%">
				<?= $formatter->format($model->projectLot->area, ['decimal',2]) ?> m<sup>2</sup>
			</td>
		</tr>
		<?php if($model->work=='adaptacija'): ?>
		<tr>
			<td class=""><small>BRGP dela objekta (član 145.):</small></td>
			<td class="content right">
				<?= $formatter->format($building->gross_area_part, ['decimal',2]) ?> m<sup>2</sup>
			</td>
		</tr>
		<?php endif; ?>
		<?php if($model->work!='adaptacija'): ?>
		<tr>
			<td class=""><small>ukupna BRUTO izgrađena površina:</small></td>
			<td class="content right">
			<?php if($dual): ?>
				<small>postojeće: </small>
				<?= $formatter->format($exBuilding->grossArea, ['decimal',2]) ?> m<sup>2</sup>
				<br>
				<small>predviđeno: </small>
				<?= $formatter->format($building->grossArea, ['decimal',2]) ?> m<sup>2</sup>
			<?php else: ?>
				<?= $formatter->format($building->grossArea, ['decimal',2]) ?> m<sup>2</sup>
			<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td class=""><small>ukupna BRGP nadzemno:</small></td>
			<td class="content right">
			<?php if($dual): ?>
				<small>postojeće: </small>
				<?= $formatter->format($exBuilding->grossAboveArea, ['decimal',2]) ?> m<sup>2</sup>
				<br>
				<small>predviđeno: </small>
				<?= $formatter->format($building->grossAboveArea, ['decimal',2]) ?> m<sup>2</sup>
			<?php else: ?>
				<?= $formatter->format($building->grossAboveArea, ['decimal',2]) ?> m<sup>2</sup>
			<?php endif; ?>				
			</td>
		</tr>	
		<tr>
			<td class=""><small>ukupna BRGP podzemno:</small></td>
			<td class="content right">
			<?php if($dual): ?>
				<small>postojeće: </small>
				<?= $formatter->format($exBuilding->grossBelowArea, ['decimal',2]) ?> m<sup>2</sup>
				<br>
				<small>predviđeno: </small>
				<?= $formatter->format($building->grossBelowArea, ['decimal',2]) ?> m<sup>2</sup>
			<?php else: ?>
				<?= $formatter->format($building->grossBelowArea, ['decimal',2]) ?> m<sup>2</sup>
			<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td class=""><small>ukupna NETO površina:</small></td>
			<td class="content right">
			<?php if($dual): ?>
				<small>postojeće: </small>
				<?= $formatter->format($exBuilding->netArea, ['decimal',2]) ?> m<sup>2</sup>
				<br>
				<small>predviđeno: </small>
				<?= $formatter->format($building->netArea, ['decimal',2]) ?> m<sup>2</sup>
			<?php else: ?>
				<?= $formatter->format($building->netArea, ['decimal',2]) ?> m<sup>2</sup>
			<?php endif; ?>
			</td>
		</tr>	
		<tr>
			<td class=""><small>površina prizemlja:</small></td>
			<td class="content right">
			<?php if($dual): ?>
				<small>postojeće: </small>
				<?= $formatter->format($exBuilding->pr->netArea, ['decimal',2]) ?> m<sup>2</sup>
				<br>
				<small>predviđeno: </small>
				<?= $formatter->format($building->pr->netArea, ['decimal',2]) ?> m<sup>2</sup>
			<?php else: ?>
				<?= $formatter->format($building->pr->netArea, ['decimal',2]) ?> m<sup>2</sup>
			<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td class=""><small>površina zemljišta pod objektom/zauzetost:</small></td>
			<td class="content right">
			<?php if($dual): ?>
				<small>postojeće: </small>
				<?= $formatter->format($exBuilding->pr->gross_area, ['decimal',2]) ?> m<sup>2</sup><br>
				(<?= $formatter->format($exBuilding->occupancy, ['percent',2]) ?>)
				<br>
				<small>predviđeno: </small>
				<?= $formatter->format($building->pr->gross_area, ['decimal',2]) ?> m<sup>2</sup><br>
				(<?= $formatter->format($building->occupancy, ['percent',2]) ?>)
			<?php else: ?>
				<?= $formatter->format($building->pr->gross_area, ['decimal',2]) ?> m<sup>2</sup><br>
				(<?= $formatter->format($building->occupancy, ['percent',2]) ?>)
			<?php endif; ?>				
			</td>
		</tr>
		<?php endif; ?>
		<tr>
			<td class=""><small>spratnost (nadzemnih i podzemnih etaža):</small></td>
			<td class="content">
				<?= ($model->work!='adaptacija') ? $building->spratnost : $building->storey ?>
			</td>
		</tr>
		<?php if($model->work!='adaptacija'): ?>
		<tr>
			<td class=""><small>visina objekta (venac, sleme, povučeni sprat i dr.) prema lokacijskim uslovima:</small></td>
			<td class="content"><small>
				<?php if($heights = $model->projectBuilding->projectBuildingHeights){
					foreach($heights as $height){
						echo '- '.$height->name. ': '. $formatter->format($height->absoluteHeight, ['decimal',2]).'<br>';
					}
				} ?></small>
			</td>
		</tr>	
		<tr>
			<td class=""><small>apsolutna visinska kota (venac, sleme, povučeni sprat i dr.) prema lokacijskim
uslovima:</small></td>
			<td class="content"><small>
				<?php if($heights = $model->projectBuilding->projectBuildingHeights){
					foreach($heights as $height){
						echo '- '.$height->name. ': '. $formatter->format($height->level, ['decimal',2]). ' (aps. '.$formatter->format($height->absoluteLevel, ['decimal',2]).')<br>';
					}
				} ?></small>
			</td>
		</tr>
		<?php endif; ?>
		<tr>
			<td class=""><small>spratna visina:</small></td>
			<td class="content right">
				<?= $formatter->format($building->storey_height, ['decimal',2]) ?> m
			</td>
		</tr>
		<?php if($model->work=='adaptacija'): ?>
		<tr>
			<td class=""><small>neto površina jedinice:</small></td>
			<td class="content right">
				<small>postojeće: </small>
				<?= $formatter->format($model->projectExUnit->netArea, ['decimal',2]) ?> m<sup>2</sup>
				<br>
				<small>predviđeno: </small>
				<?= $formatter->format($model->projectUnit->netArea, ['decimal',2]) ?> m<sup>2</sup>
			</td>
		</tr>
		<?php endif; ?>
		<?php if($model->work!='adaptacija'): ?>
		<tr>
			<td class=""><small>broj funkcionalnih jedinica/broj stanova:</small></td>
			<td class="content">
				<?= ($building->brStanova or $building->brPoslProstora) ? $building->brStanova+$building->brPoslProstora. ' (stanova: '.$building->brStanova.' i poslovnih prostora: '.$building->brPoslProstora.')' : null ?>
			</td>
		</tr>	
		<tr>
			<td class=""><small>broj parking mesta:</small></td>
			<td class="content right">
				<?= $model->projectLot->parking_spaces ?>
			</td>
		</tr>
	<?php endif; ?>
	<?php if($model->work!='adaptacija'): ?>
		<tr>
			<td class="shorttitler" rowspan="4"><small>materijalizacija objekta:</small></td>
			<td class=""><small>materijalizacija fasade:</small></td>
			<td class="content">
				<?= $model->projectBuilding->projectBuildingMaterials->facade ?>
			</td>
		</tr>
		<tr>
			<td class=""><small>orijentacija slemena:</small></td>
			<td class="content">
				<?= $building->ridge_orientation ?>
			</td>
		</tr>	
		<tr>
			<td class=""><small>nagib krova:</small></td>
			<td class="content">
				<?= $building->roof_pitch ?> <sup>o</sup>
			</td>
		</tr>
		<tr>
			<td class=""><small>materijalizacija krova:</small></td>
			<td class="content">
				<?= $model->projectBuilding->projectBuildingMaterials->roofing ?>
			</td>
		</tr>
	<?php endif; ?>
		<?php if($model->phase=='idr' or $model->phase=='pgd' or $model->phase=='pzi' or $model->phase=='pio'): ?>
		<tr>
			<td class="shorttitler"><small>procenat zelenih površina:</small></td>
			<td class="right"><small>dato lokacijskim uslovima:</small><br>
				<?= $formatter->format($model->projectLot->greenPctReg, ['decimal',2]) ?> m<sup>2</sup> (<?= $formatter->format($model->projectLot->green_area_reg, ['decimal',2]) ?> %)</td>
			<td class="content">
				<small>ostvareno: </small><br>
				<?= $formatter->format($model->projectLot->green_area, ['decimal',2]) ?> m<sup>2</sup> (<?= ($building->pr->gross_area) ? $formatter->format($model->projectLot->greenPct, ['decimal',2]) : null ?> %)
			</td>
		</tr>
		<?php endif; ?>

		<?php if($model->phase=='idr' or $model->phase=='pgd' or $model->phase=='pzi' or $model->phase=='pio'): ?>
		<tr>
			<td class="shorttitler"><small>indeks zauzetosti:</small></td>
			<td class="right"><small>dato lokacijskim uslovima: </small><br>
				<?= $formatter->format($model->projectLot->occupancy_reg, ['decimal',2]) ?>% (<?= $formatter->format($building->occupancyAreaReg, ['decimal',2]) ?> m<sup>2</sup>)</td>
			<td class="content">
				<small>ostvareno: </small><br>
				<?= $formatter->format($building->occupancy*100, ['decimal',2]) ?> %
				(<?= $formatter->format($building->pr->gross_area, ['decimal',2]) ?> m<sup>2</sup>)
			</td>
		</tr>
		<?php endif; ?>

		<?php if($model->phase=='idr' or $model->phase=='pgd' or $model->phase=='pzi' or $model->phase=='pio'): ?>
		<tr>
			<td class="shorttitler"><small>indeks izgrađenosti:</small></td>
			<td class="right"><small>dato lokacijskim uslovima: </small><br>
				<?= $formatter->format($model->projectLot->built_index_reg, ['decimal',2]) ?> (<?= $formatter->format($building->builtAreaReg, ['decimal',2]) ?> m<sup>2</sup>)</td>
			<td class="content">
				<small>ostvareno: </small><br>
				<?= $formatter->format($building->builtIndex, ['decimal',2]) ?> (<?= $formatter->format($building->grossAboveArea, ['decimal',2]) ?> m<sup>2</sup>)
			</td>
		</tr>
		<?php endif; ?>
		<tr>
			<td class="shorttitler"><small>druge karakterstike objekta:</small></td>
			<td class="content" colspan="2">
				<small><?= $building->characteristics ?></small>
			</td>
		</tr>
		<tr>
			<td class="shorttitler"><small>predračunska vrednost investicije sa PDV:</small></td>
			<td class="content right" colspan="2">
				<?= $formatter->format($building->cost, ['currency']) ?>
			</td>
		</tr>
	</table>
	<div class="right">
		<?= Html::img('@web/images/legal_files/licences/'.$volume->engineerLicence->stamp->name, ['style'=>'width:160px; max-height:140px; margin-top:10px;']) ?>
		<?= $volume->engineer->engSignature ?>
	</div>
	