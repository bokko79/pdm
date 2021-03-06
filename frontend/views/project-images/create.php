<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectFiles */

$this->title = 'Nove slike projekta';


$this->params['page_title'] = 'Projekat';
$this->params['page_title_2'] = 'Nove slike';

$this->params['breadcrumbs'][] = ['label' => '<i class="fa fa-cogs"></i> Podešavanje projekta', 'url' => ['/projects/update', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = $this->title;

$this->params['project'] = $model->project;
?>

<div class="card_container record-full grid-item fadeInUp no-shadow no-margin animated-not" id="">
    <div class="primary-context normal aliceblue bottom-bordered">
        <div class="head colos">
        	<div class="subaction">
        		<?= Html::a('<i class="fa fa-life-saver fa-2x"></i>', null, ['class' => 'btn btn-link button_to_show_secondary']) ?>
       		</div>
       		<i class="fa fa-image"></i> Galerija projekta
        </div>
        <div class="subhead">Kreirajte novi projekat.</div>
    </div>  
    <div class="primary-context aliceblue bottom-bordered" style="display: none;">
	    <div class="container-fluid">
	    	<div class="row">
		    	<div class="col-sm-5 text">
		    		<h5>Upravljanje galerijom projekta</h5>
		    		<h6>Dodavanje slika projekta.</h6>
		    		<p>Nova slika projekta.</p>
		    		<h6>Podešavanje slika projekta.</h6>
		    		<p>Podešavanje slike projekta.</p>
		    		<h6>Uklanjanje slike projekta.</h6>
		    		<p>Uklanjanje slike projekta.</p>
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
			            'itemView' => '_image',
			            'itemOptions' => ['tag'=>'ul', 'class'=>'index-menu'],
			            'summary' => '',
			            'emptyText' => '<ul class="index-menu"><li>Nije uneta nijedna slika.</li></ul>',
			        ]); ?>        
			    </div>                
			</div>
		</div>
		<div class="content view w300 " style="">
			<h4><i class="fa fa-plus"></i> <?= $this->title ?></h4>
			<hr style="margin: 10px 0 40px">
			<?= $this->render('_form', [
		        'model' => $model,
		        'project' => $model->project,
		    ]) ?>
		</div>
	</div>
</div>