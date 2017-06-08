<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Engineers */

$this->title = Yii::t('app', 'Podešavanje profila {modelClass}', [
    'modelClass' => 'inženjera',
]);
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inženjeri'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->user_id]];
//$this->params['breadcrumbs'][] = Yii::t('app', 'Izmeni');

$this->params['page_title'] = 'Inženjer';
?>

        

<div class="container-fluid">
<div class="row">

	    <div class="card_container record-full grid-item fadeInUp no-shadow transparent no-margin animated-not" id="">
            <div class="primary-context normal bottom-bordered">
                <div class="head colos"><?= Html::encode($this->title) ?>
                    <div class="subaction"></div>
                </div>
                
                <div class="subhead">Podešavanje podataka koji se tiču profesionalnog profila inženjera.</div>
            </div> 
              
            <div class="secondary-context">

			    <?= $this->render('_form', [
			        'model' => $model,
			    ]) ?>

			</div>                   
        </div>
	</div>
</div>
