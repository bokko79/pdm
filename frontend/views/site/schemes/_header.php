<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$formatter->nullDisplay = '--';
$building = $model->projectBuilding;
$doorwin = $model->projectBuildingDoorwin[0];
?>
<?= Html::img('@web/images/legal_files/visual/'.$model->practice->memo, ['style'=>'margin-bottom:20px;']) ?>
		<table class="smallpadd" style="border:2px solid black">
		<tr>
			<td class="right">
				<table class="nopadd clear">
					<tr><td><small>Investitor</small></td></tr>
					<tr><td><h4><b><?= $model->client->name ?></b></h4></td></tr>
					<tr><td class="hint">ul. <?= $model->client->location->street ?> br. <?= $model->client->location->number ?>, <?= $model->client->location->city->town ?></td></tr>
				</table>
			</td>
			<td class="">
				<table class="nopadd clear">
					<tr><td><small>Objekat</small></td></tr>
					<tr><td><h4><b><?= $building->name ?>, <?= $building->spratnost ?></b></h4></td></tr>
					<tr><td class="hint">ul. <?= $model->location->street ?> br. <?= $model->location->number ?>, <?= $model->location->city->town ?>, kat.parc.br. 
						<?php if($lots = $model->location->locationLots){foreach($lots as $lot){echo $lot->lot. ', '; }} ?>	 K.O. <?= $model->location->county0->name ?></td></tr>
				</table>
			</td>
		</tr>		
	</table>

