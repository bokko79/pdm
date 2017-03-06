<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<p class="times uppercase"><small><?= $volume->number ?>.2. Sadržaj <?= $volume->volume->nameGen ?></small></p>	
	<table class="other">
		<tr>
			<td class=""><?= $volume->number ?>.1.</td>
			<td class="content">
				<p>Naslovna strana <?= $volume->volume->nameGen ?></p>
			</td>
		</tr>
		<tr>
			<td class=""><?= $volume->number ?>.2.</td>
			<td class="content">
				<p>Sadržaj <?= $volume->volume->nameGen ?></p>
			</td>
		</tr>
	<?php if($model->phase=='idp' or $model->phase=='pgd' or $model->phase=='pzi' or $model->phase=='pio'): ?>
		<tr>
			<td class=""><?= $volume->number ?>.3.</td>
			<td class="content">
				<p>Rešenje o određivanju odgovornog projektanta <?= $volume->volume->nameGen ?></p>
			</td>
		</tr>	
		<tr>
			<td class=""><?= $volume->number ?>.4.</td>
			<td class="content">
				<p>Izjava odgovornog projektanta <?= $volume->volume->nameGen ?></p>
			</td>
		</tr>
	<?php endif; ?>
		<tr>
			<td class=""><?= $volume->number ?>.<?= ($model->phase=='idp' or $model->phase=='pgd' or $model->phase=='pzi' or $model->phase=='pio') ? 5 : 3; ?>.</td>
			<td class="content">
				<p>Tekstualna dokumentacija</p>
			</td>
		</tr>
		<tr>
			<td class=""><?= $volume->number ?>.<?= ($model->phase=='idp' or $model->phase=='pgd' or $model->phase=='pzi' or $model->phase=='pio') ? 6 : 4; ?>.</td>
			<td class="content">
				<p>Numerička dokumentacija</p>
			</td>
		</tr>
		<tr>
			<td class=""><?= $volume->number ?>.<?= ($model->phase=='idp' or $model->phase=='pgd' or $model->phase=='pzi' or $model->phase=='pio') ? 7 : 5; ?>.</td>
			<td class="content">
				<p>Grafička dokumentacija</p>
			</td>
		</tr>

	</table>