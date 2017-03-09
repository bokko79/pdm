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

$this->title = Yii::t('app', 'Etaže objekta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Objekat'), 'url' => ['/project-building/view', 'id'=>$model->project_id]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['project'] = $model->project;
?>

<div class="table-responsive container-fluid">
	<div class="row">
        <div class="col-sm-12">
        	<div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head"><span class="button_to_show_secondary">Etaže objekta <?= $model->spratnost ?></span>
                    	<div class="action-area normal-case"><?=  Html::a('<i class="glyphicon glyphicon-plus"></i> Podesi etaže', Url::to(), ['data-toggle'=>'modal', 'data-backdrop'=>false, 'data-target'=>'#storey-modal'.$model->project_id, 'class'=>'btn btn-success']) ?>
                    		<?=  Html::a('<i class="glyphicon glyphicon-star"></i> Sve prostorije', Url::to(['/project-building-storey-part-rooms/index', 'id'=>$model->project_id]), ['class'=>'btn btn-default']) ?>
                    	</div>
                    </div>
                    <div class="subhead"></div>
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
foreach($model->project->projectBuildingStoreys as $storey){
	if($storey->projectBuildingStoreyParts){
		Modal::begin([
		    'id'=>'storey-parts-modal'.$storey->id,
		    'size'=>Modal::SIZE_LARGE,
		    'class'=>'overlay_modal',
		    'header'=> '<h3>Celine/jedinice etaže</h3>',
		]); ?>
		    <div id="loading"><i class="fa fa-cog fa-spin fa-3x gray-color"></i></div>
		<?php Modal::end();
	} else {
		Modal::begin([
		    'id'=>'init-storey-parts-modal'.$storey->id,
		    'size'=>Modal::SIZE_LARGE,
		    'class'=>'overlay_modal',
		    'header'=> '<h3>Celine/jedinice etaže</h3>',
		]); ?>
		    <div id="loading"><i class="fa fa-cog fa-spin fa-3x gray-color"></i></div>
		<?php Modal::end();
    } 
} 
Modal::begin([
    'id'=>'storey-modal'.$model->project_id,
    'size'=>Modal::SIZE_LARGE,
    'class'=>'overlay_modal',
    'header'=> '<h3>Etaže</h3>',
]); ?>
    <div id="loading"><i class="fa fa-cog fa-spin fa-3x gray-color"></i></div>
<?php Modal::end(); ?>	
