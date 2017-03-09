<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
?>
<p class="times uppercase"><small>2.1. Vršioci tehničke kontrole</small></p>

	<?php if($volumes = $model->projectVolumes){
		foreach ($volumes as $volume){ 
			if($volume->volume->type=='projekat'){ // ako su projekti ?>
				<h3 class="bold uppercase"><?= $volume->number ?>. <?= c($volume->name) ?>:</h3>
				<table class="clear nopadd">
					<tr>
						<td class="shorttitler">Vršilac tehničke kontrole:</td>
						<td class="content">
							<p><?= $volume->controlEngineer->name ?>, <?= $volume->controlEngineer->title ?> (<?= $volume->controlEngineerLicence->no ?>)</p>
						</td>					
					</tr>					
				</table>
	<?php 	}
		}	
	} ?>
