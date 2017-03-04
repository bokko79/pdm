<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$formatter->nullDisplay = '--';
$building = $model->projectBuilding;
?>
	<table class="other nopadd">
		<tr>
			<td colspan="18" class="center"><h1>Obračun redukovanih neto površina objekta</h1></td>
		</tr>
		<tr>
			<td colspan="18" class="center"><h2>Objekat: <?= $building->name. ' ('.$building->spratnost.') ul. '.$model->location->street. ' br. '.$model->location->number.', ' .$model->location->city->town ?></h2></td>
		</tr>
		<tr><td colspan="18" style="height:1px; border-bottom: 3px solid #000; padding:0;"></td></tr>
		<tr>
			<td rowspan="2" class="center">Etaža</td>
			<td rowspan="2" class="center">Naziv prostorije</td>
			<td rowspan="2" class="center">Jed. mere</td>
			<td colspan="3" class="center">Stambene prostorije</td>
			<td colspan="3" class="center">Poslovne prostorije</td>
			<td colspan="3" class="center">Garažne prostorije</td>
			<td colspan="3" class="center">Zajedničke prostorije</td>
			<td colspan="3" class="center">Tehničke prostorije</td>			
		</tr>

		<tr>
			<td class="center"><small>podna površina</small></td>
			<td class="center"><small>korisna površina</small></td>
			<td class="center"><small>korisna površina umanjena za 3%</small></td>

			<td class="center"><small>podna površina</small></td>
			<td class="center"><small>korisna površina</small></td>
			<td class="center"><small>korisna površina umanjena za 3%</small></td>

			<td class="center"><small>podna površina</small></td>
			<td class="center"><small>korisna površina</small></td>
			<td class="center"><small>korisna površina umanjena za 3%</small></td>

			<td class="center"><small>podna površina</small></td>
			<td class="center"><small>korisna površina</small></td>
			<td class="center"><small>korisna površina umanjena za 3%</small></td>

			<td class="center"><small>podna površina</small></td>
			<td class="center"><small>korisna površina</small></td>
			<td class="center"><small>korisna površina umanjena za 3%</small></td>
		</tr>
		<tr><td colspan="18" style="height:1px; border-bottom: 2px solid #000; padding:0;"></td></tr>
		<?php // izlistaj sve storey
			// izlistaj sve parts ?>
		<?php foreach($model->projectBuildingStoreys as $storey): ?>				
			
					
				<?php foreach($storey->projectBuildingStoreyParts as $part): ?>	
				<tr>
					<td><?= $storey->name. ' ' .$storey->storey ?></td>
					<td><?= $part->type. ' ' .$part->mark ?></td>
					<td class="center">m<sup>2</sup></td>

					<td class="right"><?= ( $part->type == 'stan') ? $formatter->format($part->netArea, ['decimal',2]) : null ?></td>
					<td class="right"><?= ( $part->type == 'stan') ? $formatter->format($part->subNetArea, ['decimal',2]) : null ?></td>
					<td class="right"><?= ( $part->type == 'stan') ? $formatter->format($part->subNetArea*0.97, ['decimal',2]) : null ?></td>

					<td class="right"><?= ( $part->type == 'biz') ? $formatter->format($part->netArea, ['decimal',2]) : null ?></td>
					<td class="right"><?= ( $part->type == 'biz') ? $formatter->format($part->subNetArea, ['decimal',2]) : null ?></td>
					<td class="right"><?= ( $part->type == 'biz') ? $formatter->format($part->subNetArea*0.97, ['decimal',2]) : null ?></td>

					<td class="right"><?= ( $part->type == 'garage') ? $formatter->format($part->netArea, ['decimal',2]) : null ?></td>
					<td class="right"><?= ( $part->type == 'garage') ? $formatter->format($part->subNetArea, ['decimal',2]) : null ?></td>
					<td class="right"><?= ( $part->type == 'garage') ? $formatter->format($part->subNetArea*0.97, ['decimal',2]) : null ?></td>

					<td class="right"><?= ( $part->type == 'common') ? $formatter->format($part->netArea, ['decimal',2]) : null ?></td>
					<td class="right"><?= ( $part->type == 'common') ? $formatter->format($part->subNetArea, ['decimal',2]) : null ?></td>
					<td class="right"><?= ( $part->type == 'common') ? $formatter->format($part->subNetArea*0.97, ['decimal',2]) : null ?></td>

					<td class="right"><?= ( $part->type == 'tech') ? $formatter->format($part->netArea, ['decimal',2]) : null ?></td>
					<td class="right"><?= ( $part->type == 'tech') ? $formatter->format($part->subNetArea, ['decimal',2]) : null ?></td>
					<td class="right"><?= ( $part->type == 'tech') ? $formatter->format($part->subNetArea*0.97, ['decimal',2]) : null ?></td>
				</tr>
				<?php endforeach; ?>
				<tr><td colspan="18" style="height:1px; border-bottom: 2px solid #000; padding:0;"></td></tr>
				<tr>
					<td colspan="3">Ukupno <?= $storey->name. ' ' .$storey->storey ?></td>

					<td class="right"><?= $formatter->format($storey->netAreaStan, ['decimal',2]) ?></td>
					<td class="right"><?= $formatter->format($storey->subNetAreaStan, ['decimal',2]) ?></td>
					<td class="right"><?= $formatter->format($storey->subNetAreaStan*0.97, ['decimal',2]) ?></td>

					<td class="right"><?= $formatter->format($storey->netAreaBiz, ['decimal',2]) ?></td>
					<td class="right"><?= $formatter->format($storey->subNetAreaBiz, ['decimal',2]) ?></td>
					<td class="right"><?= $formatter->format($storey->subNetAreaBiz*0.97, ['decimal',2]) ?></td>

					<td class="right"><?= $formatter->format($storey->netAreaGarage, ['decimal',2]) ?></td>
					<td class="right"><?= $formatter->format($storey->subNetAreaGarage, ['decimal',2]) ?></td>
					<td class="right"><?= $formatter->format($storey->subNetAreaGarage*0.97, ['decimal',2]) ?></td>

					<td class="right"><?= $formatter->format($storey->netAreaCommon, ['decimal',2]) ?></td>
					<td class="right"><?= $formatter->format($storey->subNetAreaCommon, ['decimal',2]) ?></td>
					<td class="right"><?= $formatter->format($storey->subNetAreaCommon*0.97, ['decimal',2]) ?></td>

					<td class="right"><?= $formatter->format($storey->netAreaTech, ['decimal',2]) ?></td>
					<td class="right"><?= $formatter->format($storey->subNetAreaTech, ['decimal',2]) ?></td>
					<td class="right"><?= $formatter->format($storey->subNetAreaTech*0.97, ['decimal',2]) ?></td>
				</tr>
				<tr><td colspan="18" style="height:1px; border-bottom: 2px solid #000; padding:0;"></td></tr>
		<?php endforeach; ?>

		<tr>
			<td colspan="2"><b>Ukupna podna površina prostora</b></td>
			<td class="center">m<sup>2</sup></td>

			<td class="right"><?= $formatter->format($building->netAreaStan, ['decimal',2]) ?></td>
			<td class="right"></td>
			<td class="right"></td>

			<td class="right"><?= $formatter->format($building->netAreaBiz, ['decimal',2]) ?></td>
			<td class="right"></td>
			<td class="right"></td>

			<td class="right"><?= $formatter->format($building->netAreaGarage, ['decimal',2]) ?></td>
			<td class="right"></td>
			<td class="right"></td>

			<td class="right"><?= $formatter->format($building->netAreaCommon, ['decimal',2]) ?></td>
			<td class="right"></td>
			<td class="right"></td>

			<td class="right"><?= $formatter->format($building->netAreaTech, ['decimal',2]) ?></td>
			<td class="right"></td>
			<td class="right"></td>
		</tr>

		<tr>
			<td colspan="2"><b>Ukupna korisna površina prostora</b></td>
			<td class="center">m<sup>2</sup></td>

			<td class="right"></td>
			<td class="right"><?= $formatter->format($building->subNetAreaStan, ['decimal',2]) ?></td>
			<td class="right"></td>

			<td class="right"></td>
			<td class="right"><?= $formatter->format($building->subNetAreaBiz, ['decimal',2]) ?></td>
			<td class="right"></td>

			<td class="right"></td>
			<td class="right"><?= $formatter->format($building->subNetAreaGarage, ['decimal',2]) ?></td>
			<td class="right"></td>

			<td class="right"></td>
			<td class="right"><?= $formatter->format($building->subNetAreaCommon, ['decimal',2]) ?></td>
			<td class="right"></td>

			<td class="right"></td>
			<td class="right"><?= $formatter->format($building->subNetAreaTech, ['decimal',2]) ?></td>
			<td class="right"></td>
		</tr>

		<tr>
			<td colspan="2"><b>Ukupna korisna površina objekta umanjena za 3%</b></td>
			<td class="center">m<sup>2</sup></td>

			<td class="right"></td>
			<td class="right"></td>
			<td class="right"><?= $formatter->format($building->subNetAreaStan*0.97, ['decimal',2]) ?></td>

			<td class="right"></td>
			<td class="right"></td>
			<td class="right"><?= $formatter->format($building->subNetAreaBiz*0.97, ['decimal',2]) ?></td>

			<td class="right"></td>
			<td class="right"></td>
			<td class="right"><?= $formatter->format($building->subNetAreaGarage*0.97, ['decimal',2]) ?></td>

			<td class="right"></td>
			<td class="right"></td>
			<td class="right"><?= $formatter->format($building->subNetAreaCommon*0.97, ['decimal',2]) ?></td>

			<td class="right"></td>
			<td class="right"></td>
			<td class="right"><?= $formatter->format($building->subNetAreaTech*0.97, ['decimal',2]) ?></td>			
		</tr>		

		<tr>
			<td colspan="2"><h2>Ukupna bruto površina objekta</h2></td>
			<td colspan="16" class="center"><h2><?= $formatter->format($building->grossArea, ['decimal',2]) ?> m<sup>2</sup></h2></td>						
		</tr>

		<tr>
			<td colspan="2"><h2>Ukupna podna površina objekta</h2></td>
			<td colspan="16" class="center"><h2><?= $formatter->format($building->netArea, ['decimal',2]) ?> m<sup>2</sup></h2></td>						
		</tr>

		<tr>
			<td colspan="2"><h2>Ukupna korisna površina objekta</h2></td>
			<td colspan="16" class="center"><h2><?= $formatter->format($building->subNetArea, ['decimal',2]) ?> m<sup>2</sup></h2></td>						
		</tr>

		<tr>
			<td colspan="2"><h2>Za obračun komunalnih naknada korisnu površinu umanjiti za 3%</h2></td>
			<td colspan="16" class="center"><h2><?= $formatter->format($building->subNetArea*0.97, ['decimal',2]) ?> m<sup>2</sup></h2></td>						
		</tr>
	</table>