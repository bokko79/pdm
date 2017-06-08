<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$practice = $volume->practice;
$engineer = $volume->engineer;
$building = $model->projectBuilding;
?>
<p class="times uppercase"><small><?= $volume->number ?>.3. Rešenje o određivanju odgovornog projektanta <?= $volume->volume->nameGen ?></small></p>	

<p>Na osnovu člana 128. Zakona o planiranju i izgradnji ("Službeni glasnik RS", br. 72/09, 81/09-ispravka, 64/10 - US, 24/11, 121/12, 42/13 - US, 50/13 - US, 98/13 - US, 132/14 i 145/14) i odredbi Pravilnika o sadržini, načinu i postupku izrade i način vršenja kontrole tehničke dokumentacije prema klasi i nameni objekata ("Službeni glasnik RS", br. 23/2015 i 77/2015) kao:</p>

<h2 class="center" style="padding:30px 0; letter-spacing: 4px;">ODGOVORNI PROJEKTANT</h2>

<p>za izradu <?= $volume->volume->nameGen ?>, koji je deo <?= c($model->projectPhaseGen) ?> za <?= $model->projectTypeOfWorksGen ?> za objekat <?= $building->name ?> (<?= $building->spratnost ?>), <?= $model->location->lotAddress ?>, određuje se:</p>

<div style="padding:20px 0 60px">
	<table class="clear">
		<tr>
			<td class=""><span class="bold"><?= $engineer->name .'</span>, '. $engineer->title ?> ________________________________</td>
			<td class="right">licenca br. <?= $volume->engineerLicence->no ?></td>
		</tr>
	</table>
	  
</div>


<table class="homepage">
	<tr>
		<td class="right titler">Projektant</td>
		<td class="content">
			<h3><b><?= $practice->name ?></b></h3>
			<p><?= $practice->location->fullAddress ?></p>
		</td>
	</tr>
	<tr>
		<td class="right">Odgovorno lice / zastupnik</td>
		<td class="content">				
			<p><?= $practice->director->name . ($practice->director ? ', '. $practice->director->expertees->short : null) ?></p>
		</td>
	</tr>
	<tr>
		<td class="right">Pečat
			<div>
				<?= $practice->seal ?>
			</div>
		</td>
		<td class="content">Potpis
			<div>
				<?= $practice->director->engSignature ?>
			</div>
		</td>
	</tr>
	<tr>
		<td class="right">Broj dela projekta</td>
		<td class="content"><p><?= $volume->code ?></p></td>
	</tr>
	<tr>
		<td class="right">Mesto i datum</td>
		<td class="content"><p><?= $practice->location->city->town ?>, <?= $formatter->asDate(time(), 'php:F Y.') ?></p></td>
	</tr>
</table>