<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
?>
<p class="times uppercase"><small>0.6. Podaci o projektantima</small></p>

	<?php if($volumes = $model->projectVolumes){
		foreach ($volumes as $vol){ 
			if($vol->volume->type=='projekat'){ // ako su projekti ?>
				<h3 class="bold uppercase"><?= $vol->number ?>. <?= c($vol->name) ?>:</h3>
				<table class="clear nopadd bottom">
					<tr>
						<td class="shorttitler">Projektant</td>
						<td class="content">
							<p><?= $vol->practice->name ?></p>
							<p><?= $volume->practice->location->fullAddress ?></p>
						</td>					
					</tr>
					<tr>
						<td class="">Glavni projektant</td>
						<td class="content">
							<?= $vol->engineer->name .', '. $vol->engineer->title ?>
						</td>					
					</tr>
					<tr>
						<td class="">Broj licence</td>
						<td class="content">
							<?= $vol->engineerLicence->no ?>
						</td>					
					</tr>
					<tr>
						<td class="">
							Lični pečat
							<div>
								<?= Html::img('@web/images/legal_files/licences/'.$vol->engineerLicence->stamp->name, ['style'=>'width:160px;max-height:140px;  margin-top:10px;']) ?>
							</div>
						</td>
						<td class="content">
							Potpis
							<div>
								<?= $vol->engineer->EngSignature ?>
							</div>
						</td>				
					</tr>
				</table>
	<?php 	}
		}	
	} ?>

<?php if($model->checkIfElaborat): ?>
	<div class="pagebreaker"></div>
	<p class="times uppercase"><small>0.6. Podaci o licima koja su izradila elaborate i studije</small></p>

	<?php if($volumes = $model->projectVolumes){
		foreach ($volumes as $vole){ 
			if($vole->volume->type=='elaborat'){ // ako su projekti ?>
				<h3 class="bold uppercase"><?= c($vole->name) ?>:</h3>
				<table class="clear nopadd bottom">
					<tr>
						<td class="shorttitler">Izrađivač</td>
						<td class="content">
							<p><?= $vole->practice->name ?></p>
							<p><?= $vole->practice->location->fullAddress ?></p>
						</td>					
					</tr>
					<tr>
						<td class="">Ovlašćeno lice</td>
						<td class="content">
							<?= $vole->engineer->name .', '. $vole->engineer->title ?>
						</td>					
					</tr>
					<tr>
						<td class="">Broj ovlašćenja</td>
						<td class="content">
							<?= $vole->engineerLicence->no ?>
						</td>					
					</tr>
					<tr>
						<td class="">
							Lični pečat
							<div>
								<?= Html::img('@web/images/legal_files/licences/'.$vole->engineerLicence->stamp->name, ['style'=>'width:160px; max-height:140px; margin-top:10px;']) ?>
							</div>
						</td>
						<td class="content">
							Potpis
							<div>
								<?= $vole->engineer->EngSignature ?>
							</div>
						</td>				
					</tr>
				</table>
	<?php 	}
		}	
	} ?>
<?php endif; ?>