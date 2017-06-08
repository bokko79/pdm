<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model common\models\LocationLots */

$this->title = 'Podešavanje katastarskih parcela';

$this->params['page_title'] = 'Lokacija';
$this->params['page_title_2'] = 'Katastarske parcele';

$this->params['breadcrumbs'][] = ['label' => '<i class="fa fa-map-marker"></i> Lokacija projekta', 'url' => ['/project-lot/view', 'id' => $model->location->project->id]];
$this->params['breadcrumbs'][] = $this->title;

$this->params['project'] = $model->location->project;
?>

<div class="card_container record-full grid-item fadeInUp no-shadow no-margin animated-not" id="">
    <div class="primary-context normal aliceblue bottom-bordered">
        <div class="head colos">
        	<div class="subaction">
        		<?= Html::a('<i class="fa fa-plus fa-2x"></i> Građevinska', Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$model->id, 'LocationLots[type]'=>'object']), ['class' => 'btn btn-link']) ?>
        		<?= Html::a('<i class="fa fa-life-saver fa-2x"></i>', null, ['class' => 'btn btn-link button_to_show_secondary']) ?>
       		</div>
        	<i class="fa fa-th-large"></i> Katastarske parcele projekta
        </div>
        <div class="subhead">Upravljanje katastarskim parcelama projekta.</div>
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
			<?= $this->render('../project-lot/tabs/_lots_index', [
			        'model' => $model->location->project->projectLot,
			    ]) ?>
		</div>


		<div class="content view w300" style="">

				<h4><i class="fa fa-cog"></i> <?= $this->title ?></h4>
				<hr style="margin: 10px 0 40px">
				<?= $this->render('_form', [
			        'model' => $model,
			    ]) ?>

		       
		</div>
	</div>

</div>
		


	

    


