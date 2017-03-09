<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$formatter->nullDisplay = '--';
$practice = $volume->practice;
$client = $model->client;
$engineer = $volume->engineer;
$location = $model->location;
$building = $model->projectBuilding;
?>
<?php foreach($volume->projectVolumeDrawings as $key=>$drawing): ?>
	<?php if($drawing->print_title){ ?>
	<div style="width:550px; text-align: center; margin-bottom: 10px;">
	

<span style="font-size: 20pt; font-weight: bold; text-transform: uppercase; width:70%"><?= c($drawing->title) ?></span>
<span style="font-size: 16pt; font-weight: bold;"><?php if($storey = $drawing->projectBuildingStorey){
				echo '<br>na koti '.($storey->level>0 ? '+' : null). $formatter->format($storey->level, ['decimal',2]).' (aps. '.$formatter->format($storey->absoluteLevel, ['decimal',2]).')';
				} ?><br>
R 1:<?= $drawing->scale ?></span>
</div>
<?php } ?>
<div style="width:550px; padding:0; border: 2px solid #000;">

<table class="sheet" style="width:550px !important;">	
	<tr>
		<td class="" rowspan="5" style="margin:0; padding:0; border-right:1px solid #aaa"><?= Html::img('@web/images/legal_files/visual/'.$practice->logo, ['style'=>'width:100px; height:180px;']) ?></td>
		<td colspan="2" class="middle" bgcolor="#eee">
			<table class="clear nopadd" style="">
				<tr>
					<td rowspan="3" class="middle"><h3><b><?= $practice->name ?></b></h3></td>
					<td class="right hint">ul. <?= $practice->location->street ?> br. <?= $practice->location->number ?><br><?= $practice->location->city->town ?></td>
				</tr>
				<tr>					
					<td class="right hint">tel: <?= $practice->phone ?></td>
				</tr>
				<tr>					
					<td class="right hint">email: <?= $practice->email ?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="right uppercase hint"><small>projekat</small></td>
		<td class=""><b><?= $model->name ?></b></td>
	</tr>
	<tr>
		<td class="right uppercase hint"><small>investitor</small></td>
		<td class=""><b><?= $client->name ?></b>, <?= $client->location->city->town ?></td>
	</tr>
	<tr>
		<td class="right uppercase hint"><small>objekat</small></td>
		<td class=""><?= $building->name ?> <?= $building->spratnost ? '<small>('.$building->spratnost.')</small>' : null ?></td>
	</tr>
	<tr>
		<td class="right uppercase hint"><small>lokacija</small></td>
		<td class="">
			<?= $location->street ?> br. <?= $location->number ?>, <?= $location->city->town ?><br>
			<small>kat.parc.br.<?= $location->locationLots[0]->lot ?>, K.O. <?= $location->county0->name ?></small>
		</td>
	</tr>
</table>	


<table class="sheet" style="width:550px !important;">	
	<tr>
		<td class="right uppercase hint" style="width:40px;"><small>vtd</small></td>
		<td class="uppercase"><b><?= $model->phase ?></b></td>
		<td class="right uppercase hint"><small>deo projekta</small></td>
		<td class="" colspan="2"><b><?= $volume->number ?>. <?= c($volume->name) ?></b></td>
		<td class="" rowspan="4" style="border-left: 1px solid #aaa"><?= Html::img('@web/images/legal_files/licences/'.$volume->engineerLicence->stamp->name, ['style'=>'max-width:130px;']) ?></td>
	</tr>
	<tr>
		<td class="right uppercase hint"><small>projekt ant</small></td>
		<td class="" colspan="4"><b><?= $engineer->name ?></b>, <?= $engineer->title ?> (<?= $volume->engineerLicence->no ?>)</td>
	</tr>
	<tr>
		<td class="right uppercase hint"><small>prilog</small></td>
		<td class="uppercase" colspan="4" style="font-size: 12pt"><?= c($drawing->name) ?>
			<?php if($storey = $drawing->projectBuildingStorey){
				echo ' ('.($storey->level>0 ? '+' : null). $formatter->format($storey->level, ['decimal',2]).')';
				} ?>
		</td>
	</tr>
	<tr>
		<td class="right uppercase hint" colspan="2"><small>br.teh. dok.</small><br><span style="font-size: 11pt;"><b><?= $volume->code ?></b></span></td>
		<td class="right uppercase hint"><small>datum</small><br><span style="font-size: 11pt; text-transform: lowercase;"><b><?= $formatter->asDate(time(), 'php:mm Y') ?></b></span></td>
		<td class="right uppercase hint"><small>razmera</small><br><span style="font-size: 11pt;"><b>1:<?= $drawing->scale ?></b></span></td>
		<td class="right uppercase hint"><small>br.lista</small><br><span style="font-size: 11pt;"><b><?= $drawing->number ?></b></span></td>
	</tr>
</table>
</div>
<?= ($key+1)<count($volume->projectVolumeDrawings) ? '<div class="pagebreaker"></div>' : null; ?>
<?php endforeach; ?>