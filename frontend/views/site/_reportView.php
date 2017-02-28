<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
	<!--<link rel="stylesheet" href="@frontend/web/css/style_pdf.css">-->
	<style type="text/css">
		html, body {font-family: 'freesans', sans-serif;}
.center {text-align: center}
.right {text-align: right}
.uppercase {text-transform: uppercase;}
.times {font-family: 'freeserif', serif;}
h3 {font-weight: 900; font-size: 14pt;}
table {
    vertical-align: top;
}

table, th, td {
    /*border: 1px solid #777;*/
}
table {width: 100%; border: 1px solid #000}
table.other th, table.other td {
    border: 1px dotted #777;
}
table.homepage td {padding: 20px; }
table.other td {padding: 10px; }
.pagebreaker {page-break-after: always;}
	</style>
}
</head>
<body>
	<p class="times uppercase"><small>0.1. Naslovna strana glavne sveske</small></p>	
	<table class="homepage">
		<tr>
			<td class="right">Investitor</td>
			<td class="content">
				<h3><b><?= $model->client->name ?></b></h3>
				<p>ul. <?= $model->client->location->street. ' br. ' . $model->client->location->number . ' ' .$model->client->location->city->town; ?></p>
			</td>
		</tr>
		<tr>
			<td class="right">Objekat</td>
			<td class="content">
				<h3><?= $model->name ?></h3>
				<p>ul. <?= $model->location->street. ' br. ' . $model->location->number . ' ' .$model->location->city->town ?></p>
				<p><?= 'K.O. '.$model->location->county0->name; ?></p>
			</td>
		</tr>
		<tr>
			<td class="right">Vrsta tehničke dokumentacije</td>
			<td class="content"><p class="uppercase"><?= $model->projectType ?></p></td>
		</tr>
		<tr>
			<td class="right">Naziv i oznaka dela projekta</td>
			<td class="content"><h3>0 - Glavna sveska</h3></td>
		</tr>
		<tr>
			<td class="right">Za građenje/izvođenje radova</td>
			<td class="content"><?= $model->phase ?></td>
		</tr>
		<tr>
			<td class="right">Pečat i potpis
				<div>
					<?= Html::img('@web/images/legal_files/'.$model->practice->stamp, ['style'=>'width:80px;']) ?>
					<?= Html::img('@web/images/legal_files/'.$model->practice->signature, ['style'=>'width:80px;']) ?>
				</div></td>
			<td class="content">
				<p style="line-height: 25px">Projektant:</p><br>
				<p><?= $model->practice->name ?></p>
				<p>ul. <?= $model->practice->location->street. ' br. ' . $model->practice->location->number . ' ' .$model->practice->location->city->town; ?></p>
				<p><small>Odgovorno lice projektanta</small></p>
				<?= $model->engineer->name .', '. $model->engineer->title ?>
				
			</td>
		</tr>
		<tr>
			<td class="right">Pečat i potpis
				<div>
					<?= Html::img('@web/images/legal_files/'.$model->practice->stamp, ['style'=>'width:80px;']) ?>
					<?= Html::img('@web/images/legal_files/'.$model->practice->signature, ['style'=>'width:80px;']) ?>
				</div></td>
			<td class="content">
				<p>Glavni projektant:</p>
				<p><?= $model->engineer->name .', '. $model->engineer->title ?></p>
				<p>Broj licence: <?= $model->engineer->licenceNumber ?></p>
				
				
			</td>
		</tr>
		<tr>
			<td class="right">Broj dela projekta</td>
			<td class="content"><p><?= $model->code ?></p></td>
		</tr>
		<tr>
			<td class="right">Mesto i datum</td>
			<td class="content"><p><?= $model->place->town ?>, <?= $formatter->asDate($model->time, 'long') ?></p></td>
		</tr>
	</table>

	<div class="pagebreaker"></div>

	<p class="times uppercase"><small>0.2. Sadržaj glavne sveske</small></p>	
	<table class="other">
		<tr>
			<td class="">0.1.</td>
			<td class="content">
				<p>Naslovna strana glavne sveske</p>
			</td>
		</tr>
		<tr>
			<td class="">0.2.</td>
			<td class="content">
				<p>Sadržaj glavne sveske</p>
			</td>
		</tr>
	<?php if($model->type=='idp' or $model->type=='pgd' or $model->type=='pzi' or $model->type=='pio'): ?>
		<tr>
			<td class="">0.3.</td>
			<td class="content">
				<p>Odluka o određivanju glavnog projektanta</p>
			</td>
		</tr>	
		<tr>
			<td class="">0.4.</td>
			<td class="content">
				<p>Izjava glavnog projektanta</p>
			</td>
		</tr>
	<?php endif; ?>
		<tr>
			<td class="">0.5.</td>
			<td class="content">
				<p>Sadržaj tehničke dokumentacije</p>
			</td>
		</tr>
		<tr>
			<td class="">0.6.</td>
			<td class="content">
				<p>Podaci o projektantima</p>
			</td>
		</tr>
		<tr>
			<td class="">0.7.</td>
			<td class="content">
				<p>Opšti podaci o objektu</p>
			</td>
		</tr>
		<tr>
			<td class="">0.8.</td>
			<td class="content">
				<p>Sažeti tehnički opis</p>
			</td>
		</tr>
		<tr>
			<td class="">0.9.</td>
			<td class="content">
				<p>Izjave ovlašćenih lica o merama za ispunjenje osnovnih zahteva za objekat</p>
			</td>
		</tr>
		<tr>
			<td class="">0.10.</td>
			<td class="content">
				<p>Kopije dobijenih saglasnosti</p>
			</td>
		</tr>
		<tr>
			<td class="">0.11.</td>
			<td class="content">
				<p>Izjava investitora, vršioca stručnog nadzora i izvođača radova</p>
			</td>
		</tr>
	</table>

	<div class="pagebreaker"></div>

	<?php // 0.3. Odluka o određivanju glavnog projektanta ?>
	<p class="times uppercase"><small>0.3. Odluka o određivanju glavnog projektanta</small></p>

	<div class="pagebreaker"></div>

	<?php // 0.4. Izjava glavnog projektanta ?>
	<p class="times uppercase"><small>0.4. Izjava glavnog projektanta</small></p>

	<div class="pagebreaker"></div>

	<?php // 0.5. Sadržaj tehničke dokumentacije ?>
	<p class="times uppercase"><small>0.5. Sadržaj tehničke dokumentacije</small></p>

	<div class="pagebreaker"></div>

	<?php // 0.6. Podaci o projektantima ?>
	<p class="times uppercase"><small>0.6. Podaci o projektantima</small></p>

	<div class="pagebreaker"></div>

	<?php // 0.7. Opšti podaci o objektu ?>
	<p class="times uppercase"><small>0.7. Opšti podaci o objektu</small></p>

	<div class="pagebreaker"></div>

	<?php // 0.8. Sažeti tehnički opis ?>
	<p class="times uppercase"><small>0.8. Sažeti tehnički opis</small></p>

	<div class="pagebreaker"></div>

	<?php // 0.9. Izjave ovlašćenih lica o merama za ispunjenje osnovnih zahteva za objekat ?>
	<p class="times uppercase"><small>0.9. Izjave ovlašćenih lica o merama za ispunjenje osnovnih zahteva za objekat</small></p>

	<div class="pagebreaker"></div>

	<?php // 0.10. Kopije dobijenih saglasnosti ?>
	<p class="times uppercase"><small>0.10. Kopije dobijenih saglasnosti</small></p>

	<div class="pagebreaker"></div>

	<?php // 0.11. Izjava investitora, vršioca stručnog nadzora i izvođača radova ?>
	<p class="times uppercase"><small>0.11. Izjava investitora, vršioca stručnog nadzora i izvođača radova</small></p>


</body>
</html>
