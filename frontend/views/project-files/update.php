<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectFiles */

$this->title = 'Podešavanje dokumenta: ' . $model->name;

$this->params['page_title'] = 'Projekat';
$this->params['page_title_2'] = $this->title;

$this->params['breadcrumbs'][] = ['label' => '<i class="fa fa-cogs"></i> Podešavanje projekta', 'url' => ['/projects/update', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = $this->title;

$this->params['project'] = $model->project;
?>

<div class="card_container record-full grid-item fadeInUp no-shadow no-margin animated-not" id="">
    <div class="primary-context normal aliceblue bottom-bordered">
        <div class="head colos">
        	<div class="subaction">
        		<?= Html::a('<i class="fa fa-plus fa-2x"></i>', Url::to(['/project-files/create', 'ProjectFiles[project_id]'=>$model->project->id]), ['class' => 'btn btn-link']) ?>
        		<?= Html::a('<i class="fa fa-life-saver fa-2x"></i>', null, ['class' => 'btn btn-link button_to_show_secondary']) ?>
       		</div>
       		<i class="fa fa-copy"></i> Dokumenti projekta
        </div>
        <div class="subhead">Upravljanje dokumentima projekta.</div>
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
	<div class="row" style="">

		<div class="index w300">
			<div class="card_container record-full grid-item no-margin no-padding no-shadow">
				<div class="secondary-context no-padding">        
			        <?php echo ListView::widget([
			            'dataProvider' => $dataProvider,
			            'itemView' => '_file',
			            'itemOptions' => ['tag'=>'ul', 'class'=>'index-menu'],
			            'summary' => '',
			            'emptyText' => '<ul class="index-menu"><li>Nije pronađen nijedan dokument.</li></ul>',
			        ]); ?>        
			    </div>
			</div>
		</div>


		<div class="content view w300 " style="">

				<h4><i class="fa fa-cog"></i> <?= $this->title ?></h4>
				<hr style="margin: 10px 0 40px">
				<?= $this->render('_form', [
			        'model' => $model,
			        'project' => $model->project,
			    ]) ?>

		       
		</div>
	</div>

</div>