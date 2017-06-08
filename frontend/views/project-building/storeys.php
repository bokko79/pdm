<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectBuildingStoreysSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Etaže objekta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Objekat'), 'url' => ['/project-building/view', 'id'=>$model->project_id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Površine jedinica objekta'), 'url' => ['/project-building-storey-parts/index', 'id'=>$model->project_id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Površine prostorija objekta'), 'url' => ['/project-building-storey-part-rooms/index', 'id'=>$model->project_id]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['page_title'] = 'Objekat';
$this->params['project'] = $model->project;
$this->params['building'] = $model;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';
$formatter->nullDisplay = '--';
?>

<div class="card_container record-full grid-item fadeInUp no-shadow no-margin animated-not no-float" id="">
    <div class="primary-context normal aliceblue bottom-bordered">
        <div class="head colos">
            <div class="subaction">
            	<?= Html::a('<i class="fa fa-plus fa-2x"></i>', null, ['class' => 'btn btn-link button_to_show_table']) ?>
            	<?= Html::a('<i class="fa fa-bars fa-2x"></i>', Url::to(['/project-building-storey-parts/view', 'id'=>$model->projectBuildingStoreys[0]->projectBuildingStoreyParts[0]->id]), ['class' => 'btn btn-link']) ?>
                <?= Html::a('<i class="fa fa-life-saver fa-2x"></i>', null, ['class' => 'btn btn-link button_to_show_secondary']) ?>
            </div>
            <i class="fa fa-cube"></i> Spratovi objekta <span class="fs_12">(<?= $model->state ?>)</span>
         </div>
        <div class="subhead">Upravljanje spratovima, jedinicama i prostorijama objekta objekta.</div>
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

<div class="container-fluid full">
	<div class="row hidden-table" style="display:none;">
		<div class="col-sm-7">
			<h3 class="right">Dodaj novi sprat</h3>
		</div>
		<div class="col-sm-5">
			<table class="table table hover">
					<tr><td class="center"><?= Html::a(Yii::t('app', '<i class="fa fa-plus fa-lg"></i> Podrum'), ['/project-building/storeys', 'id' => $model->id, 'add_storey'=>'podrum'], [ 'class' => 'btn btn-default btn-block', 'data' => ['method' => 'post',]]) ?></td></tr>
					<?php if(!$model->s): ?><tr><td class="center"><?= Html::a(Yii::t('app', '<i class="fa fa-plus fa-lg"></i> Suteren'), ['/project-building/storeys', 'id' => $model->id, 'add_storey'=>'suteren'], [ 'class' => 'btn btn-default btn-block', 'data' => ['method' => 'post',]]); ?></td></tr><?php endif; ?>
					<?php if(!$model->g): ?><tr><td class="center"><?= Html::a(Yii::t('app', '<i class="fa fa-plus fa-lg"></i> Galerija'), ['/project-building/storeys', 'id' => $model->id, 'add_storey'=>'galerija'], [ 'class' => 'btn btn-default btn-block', 'data' => ['method' => 'post',]]); ?></td></tr><?php endif; ?>
					<tr><td class="center"><?= Html::a(Yii::t('app', '<i class="fa fa-plus fa-lg"></i> Sprat'), ['/project-building/storeys', 'id' => $model->id, 'add_storey'=>'sprat'], [ 'class' => 'btn btn-default btn-block', 'data' => ['method' => 'post',]]) ?></td></tr>
					<tr><td class="center"><?= Html::a(Yii::t('app', '<i class="fa fa-plus fa-lg"></i> Povučeni sprat'), ['/project-building/storeys', 'id' => $model->id, 'add_storey'=>'povucenisprat'], [ 'class' => 'btn btn-default btn-block', 'data' => ['method' => 'post',]]) ?></td></tr>
					<tr><td class="center"><?= Html::a(Yii::t('app', '<i class="fa fa-plus fa-lg"></i> Mansarda'), ['/project-building/storeys', 'id' => $model->id, 'add_storey'=>'mansarda'], [ 'class' => 'btn btn-default btn-block', 'data' => ['method' => 'post',]]) ?></td></tr>
					<tr><td class="center"><?= Html::a(Yii::t('app', '<i class="fa fa-plus fa-lg"></i> Potkrovlje'), ['/project-building/storeys', 'id' => $model->id, 'add_storey'=>'potkrovlje'], [ 'class' => 'btn btn-default btn-block', 'data' => ['method' => 'post',]]) ?></td></tr>
					<?php if(!$model->t): ?><tr><td class="center" style="width: 30%;"><?= Html::a(Yii::t('app', '<i class="fa fa-plus fa-lg"></i> Tavan'), ['/project-building/storeys', 'id' => $model->id, 'add_storey'=>'tavan'], [ 'class' => 'btn btn-default btn-block', 'data' => ['method' => 'post',]]); ?></td></tr><?php endif; ?>
			</table>
		</div>
		
	</div>
	<div class="row">

			<?php
				$gridColumns = [
                      //['class' => 'kartik\grid\SerialColumn'],
					
					[
					    'class'=>'kartik\grid\ExpandRowColumn',
					    'label'=> false,
					    'width'=>'50px',
					    'value'=>function ($model, $key, $index, $column) {
					        return GridView::ROW_COLLAPSED;
					    },
					    'detail'=>function ($model, $key, $index, $column) {
					        return Yii::$app->controller->renderPartial('../project-building-storeys/_part_list', ['model'=>$model]);
					    },
					    'expandOneOnly'=>true,
					],
					[
						'label'=> false,
						'format' => 'raw',
						'hAlign'=>'center',
						'width'=>'40px',
						'value'=>function ($data) {
							return '<span class="fs_20 bold">'.$data->mark.' '.($data->readyCompletely() ? '<i class="fa fa-check green fs_11"></i>' : '<i class="fa fa-warning fs_11 red"></i>').'</span>';
						},
					],
					[
						'label'=> false,
						'format' => 'raw',
						'hAlign'=>'center',
						'width'=>'15%',
						'value'=>function ($data) {
							return '<span class="fs_20 bold">'.($data->level>0 ? '+' : ($data->level==0 ? '&plusmn;' : '')) . \Yii::$app->formatter->format($data->level, ['decimal',2]) . '</span><br><span class="fs_11">aps.' . ($data->absoluteLevel>0 ? '+' : ($data->absoluteLevel==0 ? '&plusmn;' : '')) . \Yii::$app->formatter->format($data->absoluteLevel, ['decimal',2]).'</span>';
						},
					],
					[
						'label'=> false,
						'format' => 'raw',
						//'width'=>'15%',
						'value'=>function ($data) {
							return '<span class="fs_20 bold '.($data->sameAs ? 'gray-color' : '').'">'.c($data->name) . '</span>'.($data->sameAs ? '<br><span class="fs_11 hint"> isti kao ' . $data->sameAs->name.'</span>' : null);
						},
					],
					/*[
						'class'=>'kartik\grid\EditableColumn',
						'label'=> false,
						'attribute'=>'name',
						'noWrap' => false,
						'contentOptions' => [
							'style'=>'max-width:250px; overflow: hidden; word-wrap: break-word;',
							'class' => 'fs_20 bold',
						],
						'readonly'=>function($model, $key, $index, $widget) {
					        return ($model->storey!='sprat'); 
					    },
					    'value'=>function ($data) {
							return c($data->name);
						},
						'editableOptions'=> function ($model, $key, $index) {
							return [
								'header'=>'Naziv',
								//'inputType'=>\kartik\editable\Editable::INPUT_TEXTAREA,
								//'size'=>'lg',
								'placement' => 'top',
						        'displayValue' => '<span class="fs_20 bold">' . c($model->name) . '</span>',
							];
						}
					],*/
					[
						'class'=>'kartik\grid\EditableColumn',
						'attribute'=>'height',
						'label'=> 'Spratna h [m]',
						'hAlign'=>'right',
						'width'=>'15%',
						'contentOptions' => ['class' => 'fs_16 bold gray-color'],
						'readonly'=>function($model, $key, $index, $widget) {
					        return ($model->same_as_id!=null); 
					    },
					    'value'=>function ($data) {
							return \Yii::$app->formatter->format($data->height, ['decimal',2]);
						},
						'editableOptions'=> function ($model, $key, $index) {
							return [
								'header'=>'Spratna visina [m]',
								'size'=>'',
								'placement' => 'top',
								'displayValue' => '<span class="fs_16 bold">' . \Yii::$app->formatter->format($model->height, ['decimal',2]) . '</span>',              
							];
						}
					],
					[
						'class'=>'kartik\grid\EditableColumn',
						'attribute'=>'gross_area',
						'label'=> 'Bruto P',
						'hAlign'=>'right',
						'width'=>'15%',
						'contentOptions' => ['class' => 'fs_16 bold gray-color'],
						'readonly'=>function($model, $key, $index, $widget) {
					        return ($model->same_as_id!=null); 
					    },
					    'value'=>function ($data) {
							return \Yii::$app->formatter->format($data->gross_area, ['decimal',2]);
						},
						'editableOptions'=> function ($model, $key, $index) {
							return [
								'header'=>'Bruto površina [m<sup>2</sup>]',
								'size'=>'',
								'placement' => 'top', 
								'displayValue' => '<span class="fs_16 bold">' . \Yii::$app->formatter->format($model->gross_area, ['decimal',2]) . '</span>',              
							];
						}
					],  
					[
						'class' => 'kartik\grid\ActionColumn',
						'template' => '{generateUnits}{delete}',
						'header' => '',
						//'width'=>'30px',
						'buttons' => [ 
							'generateUnits' => function ($url, $model, $key) {
								return $model->readyForUnits() ? Html::a('<i class="fa fa-cubes fa-lg"></i>', $url, ['class'=>'btn btn-link btn-xs', 'data-toggle'=>'modal', 'data-backdrop'=>false, 'data-target'=>'#init-storey-parts-modal'.$model->id,]) : null;
							},                             
							'copy' => function ($url, $model, $key) {
								return $model->storey!='sprat' ? '' : Html::a('<i class="fa fa-copy fa-lg"></i>', $url, ['class'=>'btn btn-link btn-xs', 'data'=>['method'=>'post', 'confirm'=>'Kopirajte sprat.']]);
							},
							'delete' => function ($url, $model, $key) {
								return $model->deletable() ? '' : Html::a('<i class="fa fa-times fa-lg"></i>', $url, ['class'=>'btn btn-link btn-xs', 'data'=>['method'=>'post', 'confirm'=>'Da li ste sigurni da želite da obrišete sprat? Proces ne može biti vraćen.']]);
							},                
						],
						'urlCreator' => function ($action, $model, $key, $index) {

							if ($action === 'delete') {
								return ['/project-building-storeys/delete', 'id'=>$model->id];
							}
							if ($action === 'copy') {
								return ['/project-building/storeys', 'id' => $model->project_building_id, 'copy_storey'=>$model->id];
							}

						},
					],
				];
				echo GridView::widget([
					'id' => 'grid-storeys',
					'dataProvider'=>$spratovi,
					'columns'=>$gridColumns,
					'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false

					'pjax'=>true, // pjax is set to always true for this demo
					// set your toolbar

					'striped'=>false,
					'bordered'=>false,
					// 'condensed'=>true,
					'responsive'=>true,
					'hover'=>true,
					'showPageSummary'=>false,
					'rowOptions' => function ($model, $index, $widget, $grid){
						return ($model->storey=='prizemlje') ? ['class' => GridView::TYPE_SUCCESS] : null;
				    },			
				]);
			?>
			<?php if(($model->project->setup_status=='storeys_ex' or $model->project->setup_status=='storeys_new') and $model->ready()): ?>
              <div class="card_container record-full grid-item no-margin no-padding no-shadow">
                <div class="primary-context bordered text aliceblue">
                  <p>Kada završite podešavanje spratova objekta, pređite na sledeći korak.</p>
                  <?php $form = kartik\widgets\ActiveForm::begin([
                      'id' => 'step-form-volumes',
                      'type' => ActiveForm::TYPE_HORIZONTAL,
                      'fullSpan' => 10,      
                      'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
                      'options' => ['enctype' => 'multipart/form-data'],
                  ]); ?>
                    <div class="row" style="margin:50px 0 0;">                
                      <div class="col-md-12">                            
                        <?= Html::submitButton('Sledeći korak <i class="fa fa-arrow-circle-right"></i>', ['class' => 'btn btn-success shadow btn-block btn-lg', 'name' => 'step_form', 'value' => 'next_step']) ?>
                      </div>            
                    </div>
                  <?php ActiveForm::end(); ?>
                </div>
              </div>

            <?php endif; ?>

	</div>			
</div>

