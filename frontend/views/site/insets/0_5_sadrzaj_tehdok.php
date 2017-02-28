<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
?>
<p class="times uppercase"><small>0.5. Sadržaj tehničke dokumentacije</small></p>

	<table class="other">
	<?php if($volumes = $model->projectVolumes){
		foreach ($volumes as $volume){ ?>
			<tr>
				<td class=""><?= $volume->volume->no ?>.</td>
				<td class="content uppercase">
					<p><?= c($volume->volume->name) ?></p>
				</td>
				<td>
					br. <?= ($volume->number) ? ($volume->number) : $model->code ?>
				</td>					
			</tr>
	<?php
		}
	} ?>		
	</table>