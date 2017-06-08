<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Projects */

$this->title = $model->type=='presentation' ? Yii::t('app', 'Nova prezentacija projekta') : Yii::t('app', 'Novi projekat');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Moji projekti'), 'url' => ['/user/security/home']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['page_title'] = 'Projekat';
?>

<div class="card_container record-full grid-item fadeInUp no-shadow no-margin animated-not" id="">
    <div class="primary-context normal aliceblue bottom-bordered">
        <div class="head colos"><i class="fa fa-plus"></i> <?= Html::encode($this->title) ?>
        
        <div class="subaction"><?= Html::a('<i class="fa fa-life-saver fa-2x"></i>', null, ['class' => 'btn btn-link button_to_show_secondary']) ?></div>
        </div>
        <div class="subhead">Kreirajte novi projekat.</div>
    </div>  
    <div class="primary-context aliceblue bottom-bordered" style="display: none;">
	    <div class="container-fluid">
	    	<div class="row">
		    	<div class="col-sm-5">
		    		<h5>Kreiranje novog projekta</h5>
		    		<p>Uputstvo za kreiranje novog projekta.</p>
		    	</div>
		    	<div class="col-sm-7">
		    		<p><iframe src="//www.youtube.com/embed/KP4Ed3xJ0t8" width="100%" height="314" allowfullscreen="allowfullscreen"></iframe></p>
		    	</div>
		    </div>
	    </div>
		    
	</div>  
    <div class="secondary-context gray">

	    <?= $this->render('_form', [
	        'model' => $model,
	        'location' => $location,
	       // 'clients' => $clients,
	    ]) ?>
	</div>
</div>

