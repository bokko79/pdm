 <?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;

?>
<div class="card_container record-full grid-item no-margin no-padding no-shadow" id="existing">
    <div class="secondary-context no-padding">
        
        <?php if($projectExBuilding = $model->projectExBuilding){ ?>
        	
	        <div class="primary-context normal top-bordered gray">
		        <div class="head third">
		            <div class="subaction"><?= Html::a('<i class="fa fa-plus fa-2x"></i>', Url::to(['/project-building-heights/create', 'ProjectBuildingHeights[project_building_id]'=>$projectExBuilding->id]), ['class' => 'btn btn-link']) ?></div>
		            Postojeće stanje
		        </div>            
		    </div>
		    <ul class="index-menu">
	       <?php
        	if($projectExBuildingHeights = $projectExBuilding->projectBuildingHeights){
	            foreach($projectExBuildingHeights as $projectExBuildingHeight){

	                echo '<li>'.Html::a($projectExBuildingHeight->name.' ('.$projectExBuildingHeight->part.')<div class="subtext">+'.$projectExBuildingHeight->level.'m</div>', Url::to(['/project-building-heights/update', 'id'=>$projectExBuildingHeight->id]), ['class' => '', 'style'=>'']).'</li>';
	            }
	        } else {
	            echo '<li>Nije uneta nijedna visina postojećeg stanja objekta.</li>';
            }
            echo '</ul>';
        } ?>

        <?php if($projectBuilding = $model->projectBuilding){ ?>
        	
	        <div class="primary-context normal top-bordered gray">
		        <div class="head third">
		            <div class="subaction"><?= Html::a('<i class="fa fa-plus fa-2x"></i>', Url::to(['/project-building-heights/create', 'ProjectBuildingHeights[project_building_id]'=>$projectBuilding->id]), ['class' => 'btn btn-link']) ?></div>
		            Predviđeno stanje
		        </div>            
		    </div>
		    <ul class="index-menu">
	       <?php
        	if($projectBuildingHeights = $projectBuilding->projectBuildingHeights){
	            foreach($projectBuildingHeights as $projectBuildingHeight){

	                echo '<li>'.Html::a($projectBuildingHeight->name.' ('.$projectBuildingHeight->name.')<div class="subtext">+'.$projectBuildingHeight->level.'m</div>', Url::to(['/project-building-heights/update', 'id'=>$projectBuildingHeight->id]), ['class' => '', 'style'=>'']).'</li>';
	            }
	        } else {
	            echo '<li>Nije uneta nijedna visina predviđenog stanja objekta.</li>';
            }
            echo '</ul>';
        } ?>
        
    </div>
</div>