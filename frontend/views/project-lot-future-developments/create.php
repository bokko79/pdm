<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectLotFutureDevelopments */

$this->title = 'Dodavanje predviđenog objekta na parceli';


$this->params['page_title'] = 'Lokacija';
$this->params['page_title_2'] = 'Novi predviđeni objekat';

$this->params['breadcrumbs'][] = ['label' => '<i class="fa fa-map-marker"></i> Lokacija projekta', 'url' => ['/project-lot/view', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = $this->title;

$this->params['project'] = $model->project;
?>

<div class="card_container record-full grid-item fadeInUp no-shadow no-margin animated-not" id="">
    <div class="primary-context normal aliceblue bottom-bordered">
        <div class="head colos">
        	<div class="subaction">
        		<?= Html::a('<i class="fa fa-life-saver fa-2x"></i>', null, ['class' => 'btn btn-link button_to_show_secondary']) ?>
       		</div>
       		<i class="fa fa-copy"></i> Predviđeni objekti na parceli
        </div>
        <div class="subhead">Upravljanje predviđenim objektima i strukturama na predmetnoj parceli/parcelama projekta.</div>
    </div>  
    <div class="primary-context aliceblue bottom-bordered" style="display: none;">
	    <div class="container-fluid">
	    	<div class="row">
		    	<div class="col-sm-5 text">
		    		<h5>Upravljanje dokumentima projekta</h5>
		    		<h6>Dodavanje dokumenta projekta.</h6>
		    		<p>Novi dokument projekta.</p>
		    		<h6>Podešavanje dokumenta projekta.</h6>
		    		<p>Podešavanje dokumenta projekta.</p>
		    		<h6>Uklanjanje dokumenta projekta.</h6>
		    		<p>Uklanjanje dokumenta projekta.</p>
		    	</div>
		    	<div class="col-sm-7">
		    		<p><iframe src="//www.youtube.com/embed/sDYVYgiGW3c" width="100%" height="314" allowfullscreen="allowfullscreen"></iframe></p>
		    	</div>
		    </div>
	    </div>		    
	</div>
</div>

<div class="container-fluid listed">
	<div class="row">

		<div class="index w300">
			<?= $this->render('_future', [
			        'model' => $model->project->projectLot,
			    ]) ?>
		</div>


		<div class="content view w300" style="">

				<h4><i class="fa fa-cog"></i> <?= $this->title ?></h4>
				<hr style="margin: 10px 0 40px">
				<?= $this->render('_form', [
			        'model' => $model,
			        'project' => $model->project,
			    ]) ?>

		       
		</div>
	</div>

</div>