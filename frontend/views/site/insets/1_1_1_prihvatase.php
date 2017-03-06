<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$building = $model->projectBuilding;
?>
<p>Na osnovu člana 124. stav 5. Zakona o planiranju i izgradnji ("Službeni glasnik RS", br. 72/09, 81/09 - ispravka, 64/10 - US, 24/11, 121/12, 42/13 - US, 50/13 - US, 98/13 - US, 132/14 i 145/14) i člana 71. Pravilnika o sadržini, načinu i postupku izrade i način vršenja kontrole tehničke dokumentacije prema klasi i nameni objekata ("Službeni glasnik RS", br. 23/2015 i 77/2015)</p>

<table class="homepage">
	<tr>
		<td class="center" colspan="2" style="padding-top:50px 0 30px;"><h2 class="uppercase" style="padding:30px 0; letter-spacing: 4px;">Projekat se prihvata</td>
		
	</tr>
	<tr>
		<td class="center" colspan="2" style=""><h3><b><?= $volume->controlPractice->name ?></b></td>		
	</tr>
	<tr>
		<td class="center" colspan="2" style=""><p>Izveštaj br. <?= $model->tehnickaKontrola->code ?> od <?= $formatter->asDate($model->tehnickaKontrola->time, 'php:j.n.Y.') ?> godine.</p></td>		
	</tr>	
	<tr>
		<td class="right">vršilac tehničke kontrole</td>
		<td class="">direktor</td>
	</tr>
	<tr>
		<td class="right"><?= $model->tehnickaKontrola->practice->name ?></td>
		<td class=""><?= $model->tehnickaKontrola->engineer->name ?></td>
	</tr>
	<tr>
		<td class="right"><small>Lični pečat i potpis</small>
			<div style="padding:10px;">
				<?= Html::img('@web/images/legal_files/licences/'.$volume->controlEngineerLicence->stamp->name, ['style'=>'max-width:180px; margin-top:20px;']) ?>
			</div>
		</td>
		<td class="content"><small>Pečat i potpis</small>
			<div>
				<?= Html::img('@web/images/legal_files/signatures/'.$volume->controlEngineer->signature, ['style'=>'max-width:180px; margin-top:20px;']) ?>
			</div>
		</td>
	</tr>
</table>