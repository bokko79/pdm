<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$building = $model->projectBuilding;
?>
<?php // $this->render('../pdf/_header', ['model'=>$model, 'volume'=>$volume]) ?>
<p class="times uppercase"><small>1. Naslovna strana izvoda iz projekta</small></p>	
	<table class="homepage">
		<tr>
			<td class="right"></td>
			<td class="content bold uppercase" style="padding-top:30px;"><h2>Izvod iz projekta</h2></td>
		</tr>
		<tr>
			<td class="right shorttitler">Investitor</td>
			<td class="content">
				<?php if($projectClients = $model->projectClients){
					foreach($projectClients as $projectClient){
						$client = $projectClient->client; ?>
						<h3><b><?= $client->name ?></b></h3>
						<p>ul. <?= $client->location->street. ' br. ' . $client->location->number . ', ' .$client->location->city->town; ?></p>
						<?php
					}
				}?>
			</td>
		</tr>
		<tr>
			<td class="right">Objekat</td>
			<td class="content">
				<h3><b><?= $building->name ?></b></h3>
				<p>ul. <?= $model->location->lotAddress; ?></p>
			</td>
		</tr>
		<tr>
			<td class="right">Sadržaj</td>
			<td class="content">
				<ol>
					<li>Naslovna strana</li>
					<li>Izjava vršioca tehničke kontrole</li>
					<li>Glavna sveska projekta za građevinsku dozvolu</li>
					<li>Grafički prilozi
						<ul>
							<?php if($drawings = $volume->projectVolumeDrawings){
								foreach($drawings as $key=>$drawing){
									echo '<li>4.'.($key+1).'. '.c($drawing->title).' (R 1:'.$drawing->scale.')</li>';
								}
							} ?>
						</ul>
					</li>
				</ol>
			</td>
		</tr>	
		
		<tr>
			<td class="right" style="">Glavni projektant</td>
			<td class="content" style="">
				<p><?= $volume->engineer->name .', '. $volume->engineer->title ?></p>
				<p>Broj licence: <?= $volume->engineerLicence->no ?></p>
			</td>			
		</tr>
		<tr>
			<td colspan="2" class="center uppercase" style="padding:40px 0 0; letter-spacing: 4px; border-top:1px dotted #aaa;"><h2>Potvrđujem</h2></td>
		</tr>
		<tr>
			<td colspan="2" class="center" style="padding:0px 0 40px;"><p>usklađenost izvoda iz projekta sa podacima iz projekta za građevinsku dozvolu</p></td>
		</tr>
		<tr>
			<td class="right" style="padding:5px 20px 20px;">
				<small>Lični pečat odgovornog projektanta</small> 
				<div>
					<?= Html::img('@web/images/legal_files/licences/'.$volume->engineerLicence->stamp->name, ['style'=>'width:160px; max-height:140px; margin-top:10px;']) ?>
				</div>
			</td>
			<td class="content" style="padding:5px 20px 20px;">
				<small>Potpis odgovornog projektanta</small> 
				<div>
					<?= Html::img('@web/images/legal_files/signatures/'.$volume->engineer->signature, ['style'=>'width:160px; max-height:140px;']) ?>
				</div>
			</td>				
		</tr>
		<tr>
			<td class="right">Mesto i datum</td>
			<td class="content"><p><?= $volume->practice->location->city->town ?>, <?= $formatter->asDate(time(), 'php:mm Y') ?></p></td>
		</tr>
	</table>