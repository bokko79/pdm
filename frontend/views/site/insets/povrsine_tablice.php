<?php

use yii\helpers\Html;
use yii\helpers\Url;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$formatter->nullDisplay = '--';
?>
<?php 
	if($model->projectBuilding):
		foreach($model->projectBuilding->projectBuildingStoreys as $newStorey): ?>
			<?= $this->render('_povrsine', ['storey'=>$newStorey, 'test'=>($model->projectExBuilding ? '(predviđeno stanje)' : '')]) ?>
<?php 	
		endforeach;
	endif; ?>

<?php 
	if($model->projectExBuilding):
		foreach($model->projectExBuilding->projectBuildingStoreys as $exStorey): ?>
			<?= $this->render('_povrsine', ['storey'=>$exStorey, 'test'=>($model->projectBuilding ? '(postojeće stanje)' : '')]) ?>
<?php 	
		endforeach;
	endif; ?>