<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$engineer = $volume->engineer;
$client = $model->client;
$building = $model->projectBuilding ? $model->projectBuilding : $model->projectExBuilding;
?>
<p class="times uppercase"><small>0.3. Odluka o određivanju glavnog projektanta</small></p>	

<p>Na osnovu člana 128. Zakona o planiranju i izgradnji ("Službeni glasnik RS", br. 72/09, 81/09-ispravka, 64/10-odluka US, 24/11 i 121/12, 42/13-odluka US, 50/13-odluka US, 98/13-odluka US, 132/14 i 145/14) i odredbi Pravilnika o sadržini, načinu i postupku izrade i način vršenja kontrole tehničke dokumentacije prema klasi i nameni objekata ("Službeni glasnik RS", br. 23/2015 i 77/2015) kao:</p>

<h2 class="center" style="padding:30px 0; letter-spacing: 4px;">GLAVNI PROJEKTANT</h2>

<p>za izradu <?= c($model->projectPhaseGen) ?> za <?= $model->projectTypeOfWorksGen ?> <?= $model->work=='adaptacija' ? ($model->projectUnit->type=='stan' ? 'stambene jedinice br. ' : 'poslovnog prostora') : 'objekta' ?> <?= $model->work=='adaptacija' ? $model->projectUnit->mark. ' ('.$model->projectUnit->projectBuildingStorey->name.') u okviru objekta' : '' ?> <?= $building->name ?> (<?= $model->work=='adaptacija' ? $building->storey : $building->spratnost ?>), <?= $model->location->lotAddress ?>, određuje se:</p>

<div style="padding:20px 0 60px">
	<table class="clear">
		<tr>
			<td class="center"><span class="bold"><?= $engineer->name .'</span>, '. $engineer->title ?>  ____________________________</td>
			<td class="right">licenca br. <?= $volume->engineerLicence->no ?></td>
		</tr>
	</table>
	  
</div>


<table class="homepage">
	<tr>
		<td class="right titler">Investitor</td>
		<td class="content">
			<?php if($projectClients = $model->projectClients){
				foreach($projectClients as $projectClient){ ?>
					<h3><b><?= $projectClient->client->name ?></b></h3>
					<p><?= $projectClient->client->location->fullAddress; ?></p>
			<?php }
			} ?>
		</td>
	</tr>
	<?php if($model->work!='adaptacija'): ?>
	<tr>
		<td class="right">Odgovorno lice / zastupnik</td>
		<td class="content">				
			<p><?= $client->contact_person; ?></p>
		</td>
	</tr>
	<?php endif; ?>
	<tr>
		<td class="right"><?= $model->work!='adaptacija' ? 'Pečat' : '' ?>
			<div>
				<?= ($client->stamp) ? Html::img('@web/images/legal_files/stamps/'.$client->stamp, ['style'=>'width:120px; margin-top:20px;']) : null ?>
			</div>
		</td>
		<td class="content" style="height:140px !important;">Potpis
			<div>
				<?= ($client->stamp) ? Html::img('@web/images/legal_files/signatures/'.$client->signature, ['style'=>'width:180px; max-height:140x; margin-top:20px;']) : null ?>
			</div>
		</td>
	</tr>
	<tr>
		<td class="right">Broj dela projekta</td>
		<td class="content"><p><?= $volume->code ?></p></td>
	</tr>
	<tr>
		<td class="right">Mesto i datum</td>
		<td class="content"><p><?= $client->location->city->town ?>, <?= $formatter->asDate(time(), 'php:mm Y') ?></p></td>
	</tr>
</table>