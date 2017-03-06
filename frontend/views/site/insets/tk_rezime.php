<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$building = $model->projectBuilding;
?>
<p class="times uppercase"><small>2.2.<?= $vol->number ?>. Rezime izveštaja o tehničkoj kontroli</small></p>	

<p>Na osnovu Zakona o planiranju i izgradnji ("Službeni glasnik RS", br. 72/09, 81/09-ispravka, 64/10 - US, 24/11, 121/12, 42/13 - US, 50/13 - US, 98/13 - US, 132/14 i 145/14) i odredbi Pravilnika o sadržini, načinu i postupku izrade i način vršenja kontrole tehničke dokumentacije prema klasi i nameni objekata ("Službeni glasnik RS", br. 23/2015 i 77/2015) kontrolom projekta smo ustanovili da:</p>


<p><?= $vol->control_text ?></p>


<table class="homepage">
	<tr>
		<td class="right titler">Vršilac tehničke kontrole</td>
		<td class="content">
			<p><?= $vol->controlEngineer->name .', '. $vol->controlEngineer->title ?></p>
		</td>
	</tr>
	<tr>
		<td class="right">Broj licence</td>
		<td class="content">				
			<p><?= $vol->controlEngineerLicence->no ?></p>
		</td>
	</tr>
	<tr>
		<td class="right">Lični pečat
			<div style="padding:10px;">
				<?= Html::img('@web/images/legal_files/licences/'.$vol->controlEngineerLicence->stamp->name, ['style'=>'max-width:180px; margin-top:20px;']) ?>
			</div>
		</td>
		<td class="content">Potpis
			<div>
				<?= Html::img('@web/images/legal_files/signatures/'.$vol->controlEngineer->signature, ['style'=>'max-width:180px; margin-top:20px;']) ?>
			</div>
		</td>
	</tr>
	<tr>
		<td class="right">Naziv i oznaka dela projekta</td>
		<td class="content"><p><?= $vol->number ?>. <?= $vol->name ?></p></td>
	</tr>
	<tr>
		<td class="right">Mesto i datum</td>
		<td class="content"><p><?= $vol->controlPractice->location->city->town ?>, <?= $formatter->asDate(time(), 'php:mm Y') ?></p></td>
	</tr>
</table>