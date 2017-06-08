<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Projects */

$title = $model->code. ': '.\yii\helpers\StringHelper::truncate($model->name, 50) . ($model->work!='adaptacija' ? ' ('.(($model->projectBuilding) ? $model->projectBuilding->spratnost : $model->projectExBuilding->spratnost).')' : null);

$this->params['page_title'] = 'Projekat';

$this->title = Yii::t('app', 'Podešavanje projekta: ') . $title;

$this->params['breadcrumbs'][] = ['label' => '<i class="fa fa-cogs"></i> Podešavanje projekta', 'url' => null];

$this->params['project'] = $model;

?>
<div class="card_container record-full grid-item fadeInUp no-shadow no-margin animated-not no-float" id="">
    <div class="primary-context normal aliceblue bottom-bordered">
        <div class="head colos">
        	<div class="subaction">
        		<?= Html::a('<i class="fa fa-life-saver fa-2x"></i>', null, ['class' => 'btn btn-link button_to_show_secondary']) ?>
       		</div>
       		<i class="fa fa-cogs"></i> Opšti podaci projekta
        </div>
        <div class="subhead">Podesite detalj projekta.</div>
    </div>  
    <div class="primary-context aliceblue bottom-bordered" style="display: none;">
	    <div class="container-fluid">
	    	<div class="row">
		    	<div class="col-sm-5">
		    		<h5>Kreiranje novog projekta</h5>
		    		<p>Uputstvo za kreiranje novog projekta.</p>
		    	</div>
		    	<div class="col-sm-7">
		    		<p><iframe src="//www.youtube.com/embed/uwzBAe87jVA" width="100%" height="314" allowfullscreen="allowfullscreen"></iframe></p>
		    	</div>
		    </div>
	    </div>
		    
	</div>
</div>


<?= $this->render('_form_update', [
    'model' => $model,
]) ?>
	    <?php /* $this->render('tabs/_clients', ['model'=>$model]) ?>
	    <?= $this->render('tabs/_docs', ['model'=>$model]) ?>
	    <?= $this->render('tabs/_gallery', ['model'=>$model]) */ ?>


