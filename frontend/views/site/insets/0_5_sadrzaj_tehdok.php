<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
?>
<p class="times uppercase"><small>0.5. Sadržaj tehničke dokumentacije</small></p>

	<table class="other">
	<?php if($volumes = $model->projectVolumes){
		foreach ($volumes as $volume){ 
			if($volume->volume->type=='projekat' or $volume->volume->type=='elaborat') { ?>
			<tr>
				<td class=""><?= $volume->number ?>.</td>
				<td class="content uppercase">
					<p><?= c($volume->name) ?></p>
				</td>
				<td>
					br. <?= $volume->code ?>
				</td>					
			</tr>
	<?php }
		}
	} ?>		
	</table>