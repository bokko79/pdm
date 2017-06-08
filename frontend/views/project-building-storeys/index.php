<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectBuildingStoreysSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Površine objekta';

$this->params['page_title'] = 'Objekat';
$this->params['page_title_2'] = 'Površine';

$this->params['building'] = $model;

$this->params['breadcrumbs'][] = ['label' => '<i class="fa fa-home"></i> '.$model->name, 'url' => ['/project-building/view', 'id'=>$model->id]];
$this->params['breadcrumbs'][] = $this->title;


$this->params['project'] = $model->project;
?>

<div class="table-responsive container-fluid">
	<div class="row">
		<div class="col-sm-3">
			<?= $this->render('_menu', [
			        'model' => $model,	
			        'unit' => null,
			    ]) ?>        
        </div>
        <div class="col-sm-9">
        	<div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">
                    	<div class="subaction"><?= $model->project->work!='adaptacija' ? Html::a('<i class="glyphicon glyphicon-plus"></i> Dodaj/ukloni spratove', Url::to(), ['data-toggle'=>'modal', 'data-backdrop'=>false, 'data-target'=>'#storey-modal'.$model->id, 'class'=>'btn btn-primary']) : null ?>
                    		<?php // $model->project->work!='adaptacija' ? Html::a('<i class="glyphicon glyphicon-star"></i> Sve prostorije', Url::to(['/project-building-storey-part-rooms/index', 'id'=>$model->id]), ['class'=>'btn btn-default']) : null ?>
                    	</div>
                    	Spratovi <?= ($model->project->work!='nova_gradnja' and $model->project->work!='promena_namene' and $model->project->work!='ozakonjenje') ? $model->state : null; ?>
                    </div>
                    <div class="subhead"><?= $model->spratnost ?></div>
                </div>
                <div class="secondary-context">
					<?= $this->render('_grid', [
				        'model' => $model,				        
				        'projectBuildingStoreys' => $model->storeys,
				    ]) ?>
                </div>                
            </div>
        </div>
    </div>
</div>

<?php
foreach($model->projectBuildingStoreys as $storey){
	if($storey->projectBuildingStoreyParts){
		Modal::begin([
		    'id'=>'storey-parts-modal'.$storey->id,
		    'size'=>Modal::SIZE_LARGE,
		    'class'=>'overlay_modal',
		    'header'=> '<h3>Celine/jedinice sprata</h3>',
		]); ?>
		    <div id="loading"><i class="fa fa-cog fa-spin fa-3x gray-color"></i></div>
		<?php Modal::end();
	} else {
		Modal::begin([
		    'id'=>'init-storey-parts-modal'.$storey->id,
		    'size'=>Modal::SIZE_LARGE,
		    'class'=>'overlay_modal',
		    'header'=> '<h3>Celine/jedinice sprata</h3>',
		]); ?>
		    <div id="loading"><i class="fa fa-cog fa-spin fa-3x gray-color"></i></div>
		<?php Modal::end();
    } 
} 
Modal::begin([
    'id'=>'storey-modal'.$model->id,
    'size'=>Modal::SIZE_LARGE,
    'class'=>'overlay_modal',
    'header'=> '<h3>Spratovi</h3>',
]); ?>
    <div id="loading"><i class="fa fa-cog fa-spin fa-3x gray-color"></i></div>
<?php Modal::end(); ?>	
