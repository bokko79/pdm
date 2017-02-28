<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
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
	<?php if($model->phase=='idp' or $model->phase=='pgd' or $model->phase=='pzi' or $model->phase=='pio'): ?>
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
	<?php if($model->phase=='idp' or $model->phase=='pgd' or $model->phase=='pio'): ?>
		<tr>
			<td class="">0.8.</td>
			<td class="content">
				<p>Sažeti tehnički opis</p>
			</td>
		</tr>
	<?php endif; ?>
	<?php if($model->phase=='idp' or $model->phase=='pgd'): ?>
		<tr>
			<td class="">0.9.</td>
			<td class="content">
				<p>Izjave ovlašćenih lica o merama za ispunjenje osnovnih zahteva za objekat</p>
			</td>
		</tr>
	<?php endif; ?>
	<?php if($model->phase=='pgd' or $model->phase=='pio'): ?>
		<tr>
			<td class="">0.10.</td>
			<td class="content">
				<p>Kopije dobijenih saglasnosti</p>
			</td>
		</tr>
	<?php endif; ?>
	<?php if($model->phase=='pio'): ?>
		<tr>
			<td class="">0.11.</td>
			<td class="content">
				<p>Izjava investitora, vršioca stručnog nadzora i izvođača radova</p>
			</td>
		</tr>
	<?php endif; ?>
	</table>