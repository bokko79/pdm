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
		            <div class="subaction"><?= Html::a('<i class="fa fa-plus fa-2x"></i>', Url::to(['/project-building-classes/create', 'ProjectBuildingClasses[project_building_id]'=>$projectExBuilding->id]), ['class' => 'btn btn-link']) ?></div>
		            Postojeće stanje
		        </div>            
		    </div>
		    <ul class="index-menu">
	       <?php
        	if($projectExBuildingClasses = $projectExBuilding->projectBuildingClasses){
	            foreach($projectExBuildingClasses as $projectExBuildingClass){

	                echo '<li>'.Html::a($projectExBuildingClass->building->name.'<div class="subtext">'.$projectExBuildingClass->percent.'%</div>', Url::to(['/project-building-classes/update', 'id'=>$projectExBuildingClass->id]), ['class' => '', 'style'=>'']).'</li>';
	            }
	        } else {
	            echo '<li>Nije uneta nijedna klasa postojećeg stanja objekta.</li>';
            }
            echo '</ul>';
        } ?>

        <?php if($projectBuilding = $model->projectBuilding){ ?>
        	
	        <div class="primary-context normal top-bordered gray">
		        <div class="head third">
		            <div class="subaction"><?= Html::a('<i class="fa fa-plus fa-2x"></i>', Url::to(['/project-building-classes/create', 'ProjectBuildingClasses[project_building_id]'=>$projectBuilding->id]), ['class' => 'btn btn-link']) ?></div>
		            Predviđeno stanje
		        </div>            
		    </div>
		    <ul class="index-menu">
	       <?php
        	if($projectBuildingClasses = $projectBuilding->projectBuildingClasses){
	            foreach($projectBuildingClasses as $projectBuildingClass){

	                echo '<li>'.Html::a($projectBuildingClass->building->name.'<div class="subtext">'.$projectBuildingClass->percent.'%</div>', Url::to(['/project-building-classes/update', 'id'=>$projectBuildingClass->id]), ['class' => '', 'style'=>'']).'</li>';
	            }
	        } else {
	            echo '<li>Nije uneta nijedna klasa predviđenog stanja objekta.</li>';
            }
            echo '</ul>';
        } ?>
        
    </div>
</div>