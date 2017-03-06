<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$formatter->nullDisplay = '--';
$building = $model->projectBuilding;
?>
<p>Tabelarno iskazivanje površina uz <?= $model->projectPhase ?> za <?= $building->name ?> <?= $building->spratnost ?>, ulica <?= $model->location->street ?> br. <?= $model->location->number ?>, <?= $model->location->city->town ?>, kat.parc.br.
	<?php if($lots = $model->location->locationLots){
		foreach($lots as $lot){
			echo $lot->lot. ', ';
		}
	} ?> K.O <?= $model->location->county0->name ?></p>

<h4>Tabela 1 – prikaz površina po GUP-u</h4>

<p>Prikaz korisnih BRGP stanovanja i delatosti, kao i površine pod zelenilom</p>

<table class="other smallpadd">
	<tr bgcolor="#eee">
		<td>Etaža</td>
		<td>Bruto</td>
		<td>Stanovanje</td>
		<td>Poslovanje</td>
		<td>Garaže</td>
		<td>Zelenilo</td>
		<td>Odnos stan/posl</td>
	</tr>
	<?php foreach($model->projectBuildingStoreys as $storey): ?>
	<tr>
		<td><?= $storey->name ?></td>
		<td><?= $formatter->format($storey->gross_area, ['decimal',2]) ?></td>
		<td><?= $formatter->format($storey->netAreaStan, ['decimal',2]) ?></td>
		<td><?= $formatter->format($storey->netAreaBiz, ['decimal',2]) ?></td>
		<td><?= $formatter->format($storey->netAreaGarage, ['decimal',2]) ?></td>
		<td><?= ($storey->storey=='prizemlje') ? $formatter->format($model->projectLot->green_area, ['decimal',2]).' m<sup>2</sup> ('.$formatter->format($model->projectLot->greenPct, ['decimal',2]).'%)' : null ; ?></td>
		<td><?= ($storey->storey=='prizemlje') ? 'Stanovanje: '.$formatter->format($building->netAreaStan*100/$building->netArea, ['decimal',2]).'%' : null ; ?>
			<?= ($storey->storey=='prizemlje') ? 'Poslovanje: '.$formatter->format($building->netAreaBiz*100/$building->netArea, ['decimal',2]).'%' : null ; ?>
		</td>
	</tr>
	<?php endforeach; ?>
	<tr>
		<td>Σ BRPG Podzemno</td>
		<td><?= $formatter->format($building->grossBelowArea, ['decimal',2]) ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>Σ BRPG Nadzemno</td>
		<td><?= $formatter->format($building->grossAboveArea, ['decimal',2]) ?></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr>
		<td>Σ BRPG Ukupno</td>
		<td><?= $formatter->format($building->grossArea, ['decimal',2]) ?></td>
		<td><?= $formatter->format($building->netAreaStan, ['decimal',2]) ?></td>
		<td><?= $formatter->format($building->netAreaBiz, ['decimal',2]) ?></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
</table>

<h4>Tabela 2 – prikaz površina po SRPS-u</h4>

<p>Prikaz realnih BRGP (bez redukovanih površina)</p>

<table class="other smallpadd">
	<tr bgcolor="#eee">
		<td>Etaža</td>
		<td>Bruto [m<sup>2</sup>]</td>
		<td>Netto [m<sup>2</sup>]</td>
	</tr>
	<?php foreach($model->projectBuildingStoreys as $storey): ?>
	<tr>
		<td><?= $storey->name ?></td>
		<td class="right"><?= $formatter->format($storey->gross_area, ['decimal',2]) ?></td>
		<td class="right"><?= $formatter->format($storey->netArea, ['decimal',2]) ?></td>
	</tr>
	<?php endforeach; ?>
	<tr>
		<td style="border-top:2px solid #777;">Σ BRPG Podzemno</td>
		<td class="right" style="border-top:2px solid #777;"><?= $formatter->format($building->grossBelowArea, ['decimal',2]) ?></td>
		<td class="right" style="border-top:2px solid #777;"><?= $formatter->format($building->netBelowArea, ['decimal',2]) ?></td>		
	</tr>
	<tr>
		<td>Σ BRPG Nadzemno</td>
		<td class="right"><?= $formatter->format($building->grossAboveArea, ['decimal',2]) ?></td>
		<td class="right"><?= $formatter->format($building->netAboveArea, ['decimal',2]) ?></td>		
	</tr>
	<tr>
		<td>Σ BRPG Ukupno</td>
		<td class="right"><b><?= $formatter->format($building->grossArea, ['decimal',2]) ?></b></td>
		<td class="right"><b><?= $formatter->format($building->netArea, ['decimal',2]) ?></b></td>		
	</tr>
</table>

<h4>Tabela 3</h4>

<p>Prikaz uporednih površina i drugih urbanističkih parametara</p>

<table class="other smallpadd">
	<tr bgcolor="#eee">
		<td>Kapacitet</td>
		<td>iz PDR [m<sup>2</sup>]</td>
		<td>po projektu [m<sup>2</sup>]</td>
		<td>iz PDR [index]</td>
		<td>po projektu [index]</td>
	</tr>
	<tr>
		<td >Površina parcele</td>
		<td class="right" ><?= $formatter->format($model->projectLot->area, ['decimal',2]) ?></td>
		<td class="right" ><?= $formatter->format($model->projectLot->area, ['decimal',2]) ?></td>		
		<td class="right"></td>
		<td class="right"></td>
	</tr>

	<tr>
		<td >Spratnost</td>
		<td class="right" >max. <?= $building->storey ?></td>
		<td class="right" ><?= $building->spratnost ?></td>		
		<td class="right"></td>
		<td class="right"></td>
	</tr>
	
	<tr>
		<td >Zauzetost</td>
		<td class="right" >max. <?= $formatter->format($building->occupancyAreaReg, ['decimal',2]) ?></td>
		<td class="right" ><?= $formatter->format($building->pr->gross_area, ['decimal',2]) ?></td>		
		<td class="right">max. <?= $formatter->format($model->projectLot->occupancy_reg, ['decimal',2]) ?></td>
		<td class="right"><?= $formatter->format($building->occupancy*100, ['decimal',2]) ?></td>
	</tr>
	<tr>
		<td style="">Σ BRPG Podzemno</td>
		<td class="right" style=""></td>
		<td class="right" style=""><?= $formatter->format($building->grossBelowArea, ['decimal',2]) ?></td>	
		<td class="right"></td>
		<td class="right"></td>		
	</tr>
	<tr>
		<td>Σ BRPG Nadzemno</td>
		<td class="right">max. <?= $formatter->format($building->builtAreaReg, ['decimal',2]) ?></td>
		<td class="right"><?= $formatter->format($building->grossAboveArea, ['decimal',2]) ?></td>	
		<td class="right">max. <?= $formatter->format($model->projectLot->built_index_reg, ['decimal',2]) ?></td>
		<td class="right"><?= $formatter->format($building->builtIndex, ['decimal',2]) ?></td>	
	</tr>
	<tr>
		<td >Broj stanova</td>
		<td class="right" ></td>
		<td class="right" ><?= $building->brStanova ?></td>		
		<td class="right"></td>
		<td class="right"><?= $formatter->format($building->netAreaStan*100/$building->netArea, ['decimal',2]) ?>%</td>
	</tr>
	<tr>
		<td >Broj poslovnih prostora</td>
		<td class="right" ></td>
		<td class="right" ><?= $building->brPoslProstora ?></td>		
		<td class="right"></td>
		<td class="right"><?= $formatter->format($building->netAreaBiz*100/$building->netArea, ['decimal',2]) ?></td>
	</tr>
	<tr>
		<td >Broj garaža</td>
		<td class="right" ></td>
		<td class="right" ></td>		
		<td class="right"></td>
		<td class="right"><?= $formatter->format($building->netAreaGarage*100/$building->netArea, ['decimal',2]) ?>%</td>
	</tr>
	<tr>
		<td >Broj parking mesta</td>
		<td class="right" >1pm/1stan<br>1pm/80 m<sup>2</sup>posl.p.</td>
		<td class="right" ><?= $building->brStanova ?>x1=<?= $building->brStanova ?><br><?= $formatter->format($building->netAreaBiz, ['decimal',2]) ?>/80=<?= $formatter->format($building->netAreaBiz/80, ['decimal',2]) ?></td>		
		<td class="right"><?= $model->projectLot->parking_spaces ?></td>
		<td class="right"><?= $model->projectLot->parking_spaces-$model->projectLot->parking_disabled ?>+<?= $model->projectLot->parking_disabled ?>za osobe sa inv.<br>ukupno <?= $model->projectLot->parking_spaces ?></td>
	</tr>
	<tr>
		<td >Zelenilo</td>
		<td class="right" >min. <?= $formatter->format($model->projectLot->greenPctReg, ['decimal',2]) ?></td>
		<td class="right" ><?= $formatter->format($model->projectLot->green_area, ['decimal',2]) ?></td>		
		<td class="right">min. <?= $formatter->format($model->projectLot->green_area_reg, ['decimal',2]) ?></td>
		<td class="right"><?= $formatter->format($model->projectLot->greenPct, ['decimal',2]) ?></td>
	</tr>
</table>

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