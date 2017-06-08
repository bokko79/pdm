<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$formatter->nullDisplay = '--';
$building = $model->projectBuilding ? $model->projectBuilding : $model->projectExBuilding;
$volume = $model->projekatArhitekture;
$works = \common\models\QsWorks::find()->all();
//$model->exchange = 124.5;
?>
<p class="times uppercase"><small>1.6.3 Predmer i predračun radova</small></p>

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
				<p><?= $model->location->getLotAddress(true) ?></p>
			</td>
		</tr>
		<tr>
			<td class="right" style="border-bottom:1px dotted #777"><b>Broj tehničke dokumentacije</b></td>
			<td class="content" style="border-bottom:1px dotted #777"><p><?= $model->code ?></p></td>
		</tr>
	</table>

	<h2 class="center uppercase" style="margin-top:30px; padding: 15px 0; background: #f2f2f2; border-bottom: 1px solid #777; border-top: 1px solid #777; ">Predmer i predračun radova</h2>

	<table class="clear predmer">
		<tr>
			<td>Poz.</td>
			<td>Opis pozicije</td>
			<td>j.m.</td>
			<td>kol.</td>
			<td>jed. cena</td>
			<td>ukupno</td>
		</tr>
		<?php 
			foreach($model->projectDistinctWorks as $key=>$pdw){ ?>
			<tr bgcolor="#f2f2f2">
				<td class="center"><h3><?= ConverToRoman($key+1) ?></h3></td>
				<td colspan="5"><h3 class=""><?= c($pdw->work->name) ?></h3></td>
				
			</tr>
			<tr>
				<td></td>
				<td><?= $pdw->work->description ?></td>	
				<td colspan="4"></td>			
			</tr>

			<?php
				foreach($model->getProjectDistinctSubworks($pdw->work_id) as $sbkey=>$pdsw){ ?>
				<tr>
					<td></td>
					<td colspan="5"><h4 class="uppercase"><?= ConverToRoman($key+1).'.'.($sbkey+1) ?> <?= c($pdsw->subwork->name) ?></h4></td>				
				</tr>
				<?php
					foreach($model->getProjectDistinctPositions($pdsw->subwork_id) as $poskey=>$pdp){ ?>
					<tr>
						<td class="center top"><?= ConverToRoman($key+1).'.'.($sbkey+1).'.'.($poskey+1) ?></td>
						<td><b><?= $pdp->name ?></b> <?= $pdp->action ?></td>
						<td><?= $pdp->position->units ?></td>
						<td class="right"><?= $formatter->format($pdp->qty, ['decimal',2]) ?></td>
						<td class="right"><?= $formatter->format($pdp->position->price*$model->exchange, ['decimal',2]) ?></td>
						<td class="right"><?= $formatter->format($pdp->position->price*$model->exchange*$pdp->qty, ['decimal',2]) ?></td>			
					</tr>
		<?php
		 	 		}
				} ?>
			<tr>
				<td class="total"><b><?= ConverToRoman($key+1) ?></b></td>
				<td class="total" colspan="4"><b>UKUPNO:</b></td>	
				<td class="right total"><b><?= $formatter->format($model->getProjectWorkTotalPrice($pdw->work_id), ['decimal',2]) ?></b></td>			
			</tr>
			<tr>
				<td colspan="6"></td>		
			</tr>
		<?php
			} ?>

			<tr>
				<td colspan="6"></td>		
			</tr>
			<tr bgcolor="#f2f2f2">
				<td colspan="6" class="center"><h2 class=" uppercase">Rekapitulacija</h2></td>		
			</tr>
			<tr>
				<td colspan="6"></td>		
			</tr>

		<?php 
			foreach($model->projectDistinctWorks as $key=>$pdw){ ?>
			<tr>
				<td class=""><h4><?= ConverToRoman($key+1) ?></h4></td>
				<td colspan="4" class="uppercase"><h4 class=""><?= c($pdw->work->name) ?></h4></td>
				<td class="right"><h4 class=""><?= $formatter->format($model->getProjectWorkTotalPrice($pdw->work_id), ['decimal',2]) ?></h4></td>
			</tr>
		<?php
			} ?>
			<tr>
				<td colspan="6"></td>		
			</tr>
			<tr>
				<td class="total"></td>
				<td class="total" colspan="4"><h3>UKUPNO:</h3></td>	
				<td class="right total"><h3><?= $formatter->format($model->getProjectTotalPrice(), ['decimal',2]) ?></h3></td>			
			</tr>
	</table>




	<table class="clear" style="margin-top:40px;">
		<tr>
			<td>
				<?= ($volume ? $volume->practice->location->city->town : $model->practice->location->city->town). ', '.$formatter->asDate(time(), 'php:mm Y.') ?>
			</td>
			<td class="right" style="width:60%;">
				<small>Sastavio:</small><br>
				<?= $volume ? $volume->engineer->name. ', '.$volume->engineer->title : $model->engineer->name. ', '.$model->engineer->title ?><br>
				<small>br. licence:<?= $volume->engineerLicence->no ?></small>
				<br>
				<?= $volume ? Html::img('@web/images/legal_files/licences/'.$volume->engineerLicence->stamp->name, ['style'=>'width:160px; max-height:140px;']) : Html::img('@web/images/legal_files/licences/'.$model->engineer->engineerLicences[0]->stamp->name, ['style'=>'width:160px; max-height:140px;']) ?>
				<?= $volume ? $volume->engineer->engSignature : $model->engineer->engSignature ?>
			</td>
		</tr>
	</table>