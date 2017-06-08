<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingClasses */

$this->title = 'Nova klasa objekta ('.$projectBuilding->state.')' ;

$this->params['page_title'] = 'Objekat';
$this->params['page_title_2'] = $this->title;

$this->params['breadcrumbs'][] = ['label' => '<i class="fa fa-home"></i> '.c($projectBuilding->name) . ': ' . $projectBuilding->state, 'url' => ['/project-building/view', 'id' => $projectBuilding->id]];
$this->params['breadcrumbs'][] = $this->title;

$this->params['building'] = $projectBuilding;

$this->params['project'] = $projectBuilding->project;
?>

<div class="card_container record-full grid-item fadeInUp no-shadow no-margin animated-not" id="">
    <div class="primary-context normal aliceblue bottom-bordered">
        <div class="head colos">
        	<div class="subaction">
        		<?php if($projectExBuilding = $projectBuilding->project->projectExBuilding){ ?>        	
			        <?= Html::a('<i class="fa fa-plus fa-2x"></i> Postojeće stanje', Url::to(['/project-building-classes/create', 'ProjectBuildingClasses[project_building_id]'=>$projectExBuilding->id]), ['class' => 'btn btn-link']) ?>				            
		        <?php } ?>

		        <?php if($projectBuilding = $projectBuilding->project->projectBuilding){ ?>		        	
			        <?= Html::a('<i class="fa fa-plus fa-2x"></i> Predviđeno stanje', Url::to(['/project-building-classes/create', 'ProjectBuildingClasses[project_building_id]'=>$projectBuilding->id]), ['class' => 'btn btn-link']) ?>
		        <?php } ?>
        		<?= Html::a('<i class="fa fa-life-saver fa-2x"></i>', null, ['class' => 'btn btn-link button_to_show_secondary']) ?>
       		</div>
        	<i class="fa fa-tags"></i> Klase delova objekta
        </div>
        <div class="subhead">Klase karakterističnih delova objekta prema Pravilniku o klasifikaciji objekata.</div>
    </div>  
    <div class="primary-context aliceblue bottom-bordered" style="display: none;">
	    <div class="container-fluid">
	    	<div class="row">
		    	<div class="col-sm-5 text">
		    		<h5>Upravljanje investitorima projekta</h5>
		    		<h6>Novi investitor projekta.</h6>
		    		<p>Novi investitor projekta.</p>
		    		<h6>Podešavanje investitora projekta.</h6>
		    		<p>Podešavanje investitora projekta.</p>
		    		<h6>Uklanjanje investitora projekta.</h6>
		    		<p>Uklanjanje investitora projekta.</p>
		    	</div>
		    	<div class="col-sm-7">
		    		<p><iframe src="//www.youtube.com/embed/sDYVYgiGW3c" width="100%" height="314" allowfullscreen="allowfullscreen"></iframe></p>
		    	</div>
		    </div>
	    </div>
		    
	</div>
</div>

<div class="container-fluid listed">
	<div class="row" style="">

		<div class="index w300">
			<?= $this->render('_classes', [
			        'model' => $projectBuilding->project,
			    ]) ?>
		</div>


		<div class="content view w300" style="">

				<h4><?= $this->title ?></h4>
				<hr style="margin: 10px 0 40px">
				<?= $this->render('_form', [
			        'model' => $model,
			    ]) ?>

		       
		</div>
	</div>

</div>