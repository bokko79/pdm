<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
?>
<p class="times uppercase"><small>0.3. Odluka o određivanju glavnog projektanta</small></p>	

<p>Na osnovu člana 128. Zakona o planiranju i izgradnji ("Službeni glasnik RS", br. 72/09, 81/09-ispravka, 64/10-odluka US, 24/11 i 121/12, 42/13-odluka US, 50/13-odluka US, 98/13-odluka US, 132/14 i 145/14) i odredbi Pravilnika o sadržini, načinu i postupku izrade i način vršenja kontrole tehničke dokumentacije prema klasi i nameni objekata ("Službeni glasnik RS", br. 23/2015 i 77/2015) kao:</p>

<h2 class="center" style="padding:30px 0; letter-spacing: 4px;">GLAVNI PROJEKTANT</h2>

<p>za izradu <?= c($model->projectPhaseGen) ?> za <?= $model->projectTypeOfWorksGen ?> za objekat <?= $model->name ?>, ulica <?= $model->location->street ?> br. <?= $model->location->number ?>, <?= $model->location->city->town ?>, kat.parc.br.
	<?php if($lots = $model->location->locationLots){
		foreach($lots as $lot){
			echo $lot->lot. ', ';
		}
	} ?> K.O <?= $model->location->county0->name ?>, određuje se:</p>

<div style="padding:20px 0 60px">
	<table class="clear">
		<tr>
			<td class=""><span class="bold"><?= $model->engineer->name .'</span>, '. $model->engineer->title ?> ________________________________</td>
			<td class="right">licenca br. <?= $model->engineer->engineerLicences[0]->no ?></td>
		</tr>
	</table>
	  
</div>


<table class="homepage">
	<tr>
		<td class="right titler">Investitor</td>
		<td class="content">
			<h3><b><?= $model->client->name ?></b></h3>
			<p>ul. <?= $model->client->location->street. ' br. ' . $model->client->location->number . ' ' .$model->client->location->city->town; ?></p>
		</td>
	</tr>
	<tr>
		<td class="right">Odgovorno lice / zastupnik</td>
		<td class="content">				
			<p><?= $model->client->contact_person; ?></p>
		</td>
	</tr>
	<tr>
		<td class="right">Pečat
			<div>
				<?= Html::img('@web/images/legal_files/'.$model->client->stamp, ['style'=>'width:120px; margin-top:20px;']) ?>
			</div>
		</td>
		<td class="content">Potpis
			<div>
				<?= Html::img('@web/images/legal_files/'.$model->client->signature, ['style'=>'width:180px; margin-top:20px;']) ?>
			</div>
		</td>
	</tr>
	<tr>
		<td class="right">Broj dela projekta</td>
		<td class="content"><p><?= $model->code ?></p></td>
	</tr>
	<tr>
		<td class="right">Mesto i datum</td>
		<td class="content"><p><?= $model->location->city->town ?>, <?= $formatter->asDate($model->time, 'php:mm Y') ?></p></td>
	</tr>
</table>