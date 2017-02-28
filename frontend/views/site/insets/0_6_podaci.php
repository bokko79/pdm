<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
?>
<p class="times uppercase"><small>0.6. Podaci o projektantima</small></p>

	<?php if($volumes = $model->projectVolumes){
		foreach ($volumes as $volume){ 
			if($volume->volume->type!='elaborat'){ // ako su projekti ?>
				<h3 class="bold uppercase"><?= $volume->volume->no ?>. <?= c($volume->volume->name) ?>:</h3>
				<table class="clear nopadd bottom">
					<tr>
						<td class="shorttitler">Projektant</td>
						<td class="content">
							<p><?= $model->practice->name ?></p>
							<p>ul. <?= $model->practice->location->street. ' br. ' . $model->practice->location->number . ' ' .$model->practice->location->city->town; ?></p>
						</td>					
					</tr>
					<tr>
						<td class="">Glavni projektant</td>
						<td class="content">
							<?= $model->engineer->name .', '. $model->engineer->title ?>
						</td>					
					</tr>
					<tr>
						<td class="">Broj licence</td>
						<td class="content">
							<?= $model->engineer->engineerLicences[0]->no ?>
						</td>					
					</tr>
					<tr>
						<td class="">
							Lični pečat
							<div>
								<?= Html::img('@web/images/legal_files/licences/'.$model->engineer->engineerLicences[0]->stamp->name, ['style'=>'width:160px; margin-top:10px;']) ?>
							</div>
						</td>
						<td class="content">
							Potpis
							<div>
								<?= Html::img('@web/images/legal_files/'.$model->practice->signature, ['style'=>'width:160px;']) ?>
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
		foreach ($volumes as $volume){ 
			if($volume->volume->type=='elaborat'){ // ako su projekti ?>
				<h3 class="bold uppercase"><?= c($volume->volume->name) ?>:</h3>
				<table class="clear nopadd bottom">
					<tr>
						<td class="shorttitler">Izrađivač</td>
						<td class="content">
							<p><?= $model->practice->name ?></p>
							<p>ul. <?= $model->practice->location->street. ' br. ' . $model->practice->location->number . ' ' .$model->practice->location->city->town; ?></p>
						</td>					
					</tr>
					<tr>
						<td class="">Ovlašćeno lice</td>
						<td class="content">
							<?= $model->engineer->name .', '. $model->engineer->title ?>
						</td>					
					</tr>
					<tr>
						<td class="">Broj ovlašćenja</td>
						<td class="content">
							<?= $model->engineer->engineerLicences[0]->no ?>
						</td>					
					</tr>
					<tr>
						<td class="">
							Lični pečat
							<div>
								<?= Html::img('@web/images/legal_files/licences/'.$model->engineer->engineerLicences[0]->stamp->name, ['style'=>'width:160px; margin-top:10px;']) ?>
							</div>
						</td>
						<td class="content">
							Potpis
							<div>
								<?= Html::img('@web/images/legal_files/'.$model->practice->signature, ['style'=>'width:160px;']) ?>
							</div>
						</td>				
					</tr>
				</table>
	<?php 	}
		}	
	} ?>
<?php endif; ?>