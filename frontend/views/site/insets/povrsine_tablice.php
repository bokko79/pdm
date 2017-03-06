<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$formatter->nullDisplay = '--';
?>
<?php foreach($model->projectBuildingStoreys as $storey): ?>
<table class="smallpadd" style="width:300px !important;">
	<tr bgcolor="#ddd">
		<td colspan="5"><h2><?= c($stan->name) ?>: Pregled površina</h2></td>
	</tr>
	<?php if($storey->st): ?>
		<?php foreach($storey->st as $stan): ?>
			<tr bgcolor="#eee">
				<td colspan="5" style="border-top:2px solid #000;"><h3><b><?= $stan->fullType. ' '.$stan->mark ?> - <?= $stan->structure ?></b></h3></td>
			</tr>
			<tr>
				<td style="width:15px;" class="center hint subtitle">br.</td>
				<td style="width:105px" class="center hint subtitle">naziv prostorije</td>
				<td style="width:60px" class="center hint subtitle">obrada poda</td>
				<td style="width:60px" class="center hint subtitle">red. površ. [m<sup>2</sup>]</td>
				<td style="width:60px" class="center hint subtitle">površina [m<sup>2</sup>]</td>
			</tr>
			<?php foreach($stan->projectBuildingStoreyPartRooms as $room): ?>
				<tr>
					<td style="width:15px;"><?= $room->mark ?></td>
					<td><?= $room->roomType->name ?></td>
					<td><?= $room->flooring ?></td>
					<td class="right"><?= $room->sub_net_area ? $formatter->format($room->sub_net_area, ['decimal',2]) : null ?></td>
					<td class="right"><?= $room->net_area ? $formatter->format($room->net_area, ['decimal',2]) : null ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td colspan="2" rowspan="2" style="background: #eee;border-top:3px solid #777;vertical-align: middle;" class="center"><h3>ukupno <?= $stan->fullType. ' '.$stan->mark ?></h3></td>
				<td class="right">netto:</td>
				<td class="right"><b><?= $formatter->format($stan->subNetArea, ['decimal',2]) ?></b></td>
				<td class="right"><b><?= $formatter->format($stan->netArea, ['decimal',2]) ?></b></td>
			</tr>
			<tr>
				<td class="right">netto (-3%):</td>
				<td class="right"><?= $formatter->format($stan->subNetArea*0.97, ['decimal',2]) ?></td>
				<td class="right"><?= $formatter->format($stan->netArea*0.97, ['decimal',2]) ?></td>
			</tr>
		<?php endforeach; ?>
	<?php endif; ?>
	
	<?php if($storey->b): ?>
		<tr bgcolor="#eee">
			<td colspan="5" style="border-top:2px solid #000;"><h3><b>Poslovni prostori</b></h3></td>
		</tr>

		<?php foreach($storey->b as $biz): ?>
			<tr>
				<td colspan="5"><?= $biz->fullType. ' '.$biz->mark ?></td>
			</tr>
			<tr>
				<td style="width:15px;" class="center hint subtitle">br.</td>
				<td style="width:105px" class="center hint subtitle">naziv prostorije</td>
				<td style="width:60px" class="center hint subtitle">obrada poda</td>
				<td style="width:60px" class="center hint subtitle">red. površ. [m<sup>2</sup>]</td>
				<td style="width:60px" class="center hint subtitle">površina [m<sup>2</sup>]</td>
			</tr>
			<?php foreach($biz->projectBuildingStoreyPartRooms as $room): ?>
				<tr>
					<td><?= $room->mark ?></td>
					<td><?= $room->roomType->name ?></td>
					<td><?= $room->flooring ?></td>
					<td class="right"><?= $room->sub_net_area ? $formatter->format($room->sub_net_area, ['decimal',2]) : null ?></td>
					<td class="right"><?= $room->net_area ? $formatter->format($room->net_area, ['decimal',2]) : null ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
			<td colspan="2" rowspan="2" style="background: #eee;border-top:3px solid #777;vertical-align: middle;" class="center"><h3>ukupno <?= $biz->fullType. ' '.$biz->mark ?></h3></td>
				<td class="right">netto:</td>
				<td class="right"><b><?= $formatter->format($biz->subNetArea, ['decimal',2]) ?></b></td>
				<td class="right"><b><?= $formatter->format($biz->netArea, ['decimal',2]) ?></b></td>
			</tr>
			<tr>
				<td class="right">netto (-3%):</td>
				<td class="right"><?= $formatter->format($biz->subNetArea*0.97, ['decimal',2]) ?></td>
				<td class="right"><?= $formatter->format($biz->netArea*0.97, ['decimal',2]) ?></td>
			</tr>
		<?php endforeach; ?>
	<?php endif; ?>

	<?php if($storey->g): ?>
		<tr bgcolor="#eee">
			<td colspan="5" style="border-top:2px solid #000;"><h3><b>Garažni i saobr. prostori</b></h3></td>
		</tr>	
		<tr>
			<td style="width:15px;" class="center hint subtitle">br.</td>
			<td style="width:105px" class="center hint subtitle">naziv prostorije</td>
			<td style="width:60px" class="center hint subtitle">obrada poda</td>
			<td style="width:60px" class="center hint subtitle">red. površ. [m<sup>2</sup>]</td>
			<td style="width:60px" class="center hint subtitle">površina [m<sup>2</sup>]</td>
		</tr>
		<?php foreach($storey->g->projectBuildingStoreyPartRooms as $room): ?>
			<tr>
				<td><?= $room->mark ?></td>
				<td><?= $room->roomType->name ?></td>
				<td><?= $room->flooring ?></td>
				<td class="right"><?= $room->sub_net_area ? $formatter->format($room->sub_net_area, ['decimal',2]) : null ?></td>
				<td class="right"><?= $room->net_area ? $formatter->format($room->net_area, ['decimal',2]) : null ?></td>
			</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="2" rowspan="2" style="background: #eee;border-top:3px solid #777;vertical-align: middle;" class="center"><h3>ukupno <?= $storey->g->fullType. ' '.$storey->g->mark ?></h3></td>
			<td class="right">netto:</td>
			<td class="right"><b><?= $formatter->format($storey->g->subNetArea, ['decimal',2]) ?></b></td>
			<td class="right"><b><?= $formatter->format($storey->g->netArea, ['decimal',2]) ?></b></td>
		</tr>
		<tr>
			<td class="right">netto (-3%):</td>
			<td class="right"><?= $formatter->format($storey->g->subNetArea*0.97, ['decimal',2]) ?></td>
			<td class="right"><?= $formatter->format($storey->g->netArea*0.97, ['decimal',2]) ?></td>
		</tr>
		
	<?php endif; ?>

	<?php if($storey->t): ?>
	<tr bgcolor="#eee">
			<td colspan="5" style="border-top:2px solid #000;"><h3><b>Tehničke prostorije</b></h3></td>
		</tr>
		<tr>
			<td style="width:15px;" class="center hint subtitle">br.</td>
			<td style="width:105px" class="center hint subtitle">naziv prostorije</td>
			<td style="width:60px" class="center hint subtitle">obrada poda</td>
			<td style="width:60px" class="center hint subtitle">red. površ. [m<sup>2</sup>]</td>
			<td style="width:60px" class="center hint subtitle">površina [m<sup>2</sup>]</td>
		</tr>
		<?php foreach($storey->t->projectBuildingStoreyPartRooms as $room): ?>
			<tr>
				<td><?= $room->mark ?></td>
				<td><?= $room->roomType->name ?></td>
				<td><?= $room->flooring ?></td>
				<td class="right"><?= $room->sub_net_area ? $formatter->format($room->sub_net_area, ['decimal',2]) : null ?></td>
				<td class="right"><?= $room->net_area ? $formatter->format($room->net_area, ['decimal',2]) : null ?></td>
			</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="2" rowspan="2" style="background: #eee;border-top:3px solid #777;vertical-align: middle;" class="center"><h3>ukupno <?= $storey->t->fullType. ' '.$storey->t->mark ?></h3></td>
			<td class="right">netto:</td>
			<td class="right"><b><?= $formatter->format($storey->t->subNetArea, ['decimal',2]) ?></b></td>
			<td class="right"><b><?= $formatter->format($storey->t->netArea, ['decimal',2]) ?></b></td>
		</tr>
		<tr>
			<td class="right">netto (-3%):</td>
			<td class="right"><?= $formatter->format($storey->t->subNetArea*0.97, ['decimal',2]) ?></td>
			<td class="right"><?= $formatter->format($storey->t->netArea*0.97, ['decimal',2]) ?></td>
		</tr>
		
	<?php endif; ?>

	<?php if($storey->c): ?>
		<tr bgcolor="#eee">
			<td colspan="5" style="border-top:2px solid #000;"><h3><b>Zajedničke prostorije</b></h3></td>
		</tr>
		<tr>
			<td style="width:15px;" class="center hint subtitle">br.</td>
			<td style="width:105px" class="center hint subtitle">naziv prostorije</td>
			<td style="width:60px" class="center hint subtitle">obrada poda</td>
			<td style="width:60px" class="center hint subtitle">red. površ. [m<sup>2</sup>]</td>
			<td style="width:60px" class="center hint subtitle">površina [m<sup>2</sup>]</td>
		</tr>
		<?php foreach($storey->c->projectBuildingStoreyPartRooms as $room): ?>
			<tr>
				<td><?= $room->mark ?></td>
				<td><?= $room->roomType->name ?></td>
				<td><?= $room->flooring ?></td>
				<td class="right"><?= $room->sub_net_area ? $formatter->format($room->sub_net_area, ['decimal',2]) : null ?></td>
				<td class="right"><?= $room->net_area ? $formatter->format($room->net_area, ['decimal',2]) : null ?></td>
			</tr>
		<?php endforeach; ?>
		<tr>
			<td colspan="2" rowspan="2" style="background: #eee; border-top:3px solid #777; vertical-align: middle;" class="center"><h3>ukupno <?= $storey->c->fullType. ' '.$storey->c->mark ?></h3></td>
			<td class="right">netto:</td>
			<td class="right"><b><?= $formatter->format($storey->c->subNetArea, ['decimal',2]) ?></b></td>
			<td class="right"><b><?= $formatter->format($storey->c->netArea, ['decimal',2]) ?></b></td>
		</tr>
		<tr>
			<td class="right">netto (-3%):</td>
			<td class="right"><?= $formatter->format($storey->c->subNetArea*0.97, ['decimal',2]) ?></td>
			<td class="right"><?= $formatter->format($storey->c->netArea*0.97, ['decimal',2]) ?></td>
		</tr>
		
	<?php endif; ?>
	<tr bgcolor="#ddd" style="border-top:3px solid #777; padding:10px 0">
		<td colspan="5"><h2><?= $storey->name ?></h2></td>
	</tr>
	<tr>
		<td colspan="3" class="center hint subtitle">naziv prostorije</td>
		<td class="center hint subtitle" style="width: 60px;">red. p. [m<sup>2</sup>]</td>
		<td class="center hint subtitle"  style="width: 60px;">površina [m<sup>2</sup>]</td>
	</tr>
	<?php if($storey->st): ?>
		<tr>
			<td colspan="3" class="uppercase">Stambene jedinice</td>
			<td class="right"><?= $formatter->format($storey->subNetAreaStan, ['decimal',2]) ?></td>
			<td class="right"><?= $formatter->format($storey->netAreaStan, ['decimal',2]) ?></td>
		</tr>
	<?php endif; ?>
	<?php if($storey->b): ?>
		<tr>
			<td colspan="3" class="uppercase">Poslovni prostor</td>
			<td class="right"><?= $formatter->format($storey->subNetAreaBiz, ['decimal',2]) ?></td>
			<td class="right"><?= $formatter->format($storey->netAreaBiz, ['decimal',2]) ?></td>
		</tr>
	<?php endif; ?>
	<?php if($storey->g): ?>
		<tr>
			<td colspan="3" class="uppercase">Garaže</td>
			<td class="right"><?= $formatter->format($storey->subNetAreaGarage, ['decimal',2]) ?></td>
			<td class="right"><?= $formatter->format($storey->netAreaGarage, ['decimal',2]) ?></td>
		</tr>
	<?php endif; ?>
	<?php if($storey->t): ?>
		<tr>
			<td colspan="3" class="uppercase">Tehničke prostorije</td>
			<td class="right"><?= $formatter->format($storey->subNetAreaTech, ['decimal',2]) ?></td>
			<td class="right"><?= $formatter->format($storey->netAreaTech, ['decimal',2]) ?></td>
		</tr>
	<?php endif; ?>
	<?php if($storey->c): ?>
		<tr>
			<td colspan="3" class="uppercase">Zajedničke prostorije</td>
			<td class="right"><?= $formatter->format($storey->subNetAreaCommon, ['decimal',2]) ?></td>
			<td class="right"><?= $formatter->format($storey->netAreaCommon, ['decimal',2]) ?></td>
		</tr>
	<?php endif; ?>
	<tr>
		<td colspan="2" rowspan="3" style="background: #eee; vertical-align: middle;" class="center"><h3><b>ukupno <?= $storey->name ?></b></h3></td>
		<td class="right">netto:</td>
		<td class="right"><b><?= $formatter->format($storey->subNetArea, ['decimal',2]) ?></b></td>
		<td class="right"><b><?= $formatter->format($storey->netArea, ['decimal',2]) ?></b></td>
	</tr>
	<tr>
		<td class="right">netto (-3%):</td>
		<td class="right"><?= $formatter->format($storey->subNetArea*0.97, ['decimal',2]) ?></td>
		<td class="right"><?= $formatter->format($storey->netArea*0.97, ['decimal',2]) ?></td>
	</tr>
	<tr>
		<td class="right">bruto:</td>
		<td colspan="2" class="right"><h3><b><?= $formatter->format($storey->gross_area, ['decimal',2]) ?></b></h3></td>
	</tr>
</table>
<div class="pagebreaker"></div>
<?php endforeach; ?>