<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$formatter->nullDisplay = '--';
$building = $model->projectBuilding;
?>
<?php foreach($model->projectBuildingDoorwin as $doorwin): ?>
	
	<table class="smallpadd" style="border:2px solid black !important;">
		<tr>
			<td colspan="2" rowspan="2" style="height:60px;"><h2>Pozicija</h2></td>
			<td><?= $doorwin->schemeType ?></td>
			<td rowspan="2" class="right"><h2>POS <?= $doorwin->pos_no ?></h2></td>
		</tr>	
		<tr>
			<td><?= $doorwin->schemeSubType ?></td>
		</tr>	
		<tr>
			<td class="uppercase nopadd" style="width:100px;">Opis pozicije</td>
			<td class="nopadd"><?= $doorwin->description ?></td>
			<td rowspan="9" colspan="2" style="width:360px !important; height:500px !important;">
			<div style="width:360px !important; height:560px !important;">
				<?= Html::img('@web/images/legal_files/stamps/'.$model->practice->stamp, ['style'=>'width:360px; height: 500px; margin-top:10px;']) ?>
			</div>
			
			</td>
		</tr>
		<tr>
			<td rowspan="2" class="uppercase">Dimenzije</td>
			<td class="">Zidarska mera: <?= $doorwin->width ?>/<?= $doorwin->height ?> cm</td>			
		</tr>
		<tr>			
			<td class="">Proizvodna mera: <?= $doorwin->width-2 ?>/<?= $doorwin->height-2 ?> cm</td>			
		</tr>
		<tr>
			<td rowspan="2" class="uppercase">Materijal</td>
			<td class="">Okvira: <?= $doorwin->frame ?></td>			
		</tr>
		<tr>			
			<td class="">Ispune: <?= $doorwin->sash ?></td>			
		</tr>
		<tr>
			<td class="uppercase">Način otvaranja</td>
			<td class=""><?= $doorwin->opening_type ?></td>			
		</tr>
		<tr>
			<td class="uppercase">Okovi</td>
			<td class=""><?= $doorwin->metal ?></td>			
		</tr>
		<tr>
			<td class="uppercase">Obrada</td>
			<td class=""><?= $doorwin->material ?></td>			
		</tr>
		
		<tr>
			<td class="uppercase">Broj komada</td>
			<td class="" style="padding:0; vertical-align: middle">
			<?php if($doorwin->pos_type!='metal'): ?>
				<table class="nopadd clear" style="padding:0;">
					<tr><td class="storeys"></td>
					<?php foreach($model->projectBuildingStoreys as $storey): ?>
						<td class="storeys center"><?= c($storey->order_no) ?></td>
					<?php endforeach; ?>
						<td class="storeys-bottom">uk.</td>
					</tr>
					<tr><td class="storeys">Levih</td>
					<?php foreach($model->projectBuildingStoreys as $storey): ?>
						<td class="storeys center"><?= $storey->getSchemePosition($doorwin->id)->lefts ? $storey->getSchemePosition($doorwin->id)->lefts : '-' ?></td>
					<?php endforeach; ?>
						<td class="storeys-bottom"><?= $doorwin->lefts ?></td>
					</tr>
					<tr><td class="storeys">Desnih</td>
					<?php foreach($model->projectBuildingStoreys as $storey): ?>
						<td class="storeys center"><?= $storey->getSchemePosition($doorwin->id)->rights ? $storey->getSchemePosition($doorwin->id)->rights : '-' ?></td>
					<?php endforeach; ?>
						<td class="storeys-bottom"><?= $doorwin->rights ?></td>
					</tr>
					<tr><td class="storeys-right">Ukupno</td>
					<?php foreach($model->projectBuildingStoreys as $storey): ?>
						<td class="storeys-right center"><?= $storey->getSchemePosition($doorwin->id)->total ? $storey->getSchemePosition($doorwin->id)->total : '-' ?></td>
					<?php endforeach; ?>
						<td class="storeys-right"><?= $doorwin->total ?></td>
					</tr>
				</table>
			<?php else: ?>
				<?= $doorwin->length ?> m
			<?php endif; ?>
			</td>			
		</tr>		
		<tr>
			<td class="uppercase">Napomena</td>
			<td class=""><?= $doorwin->note ?></td>	
			<td class="right" colspan="2"><h3>R 1:<?= $doorwin->scale ?></h3></td>		
		</tr>
	</table>

	<div class="pagebreaker"></div>

<?php endforeach; ?>