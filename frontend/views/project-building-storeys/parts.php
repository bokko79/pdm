<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectBuildingStoreysSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Prostorne jedinice etaže objekta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Etaže'), 'url' => ['/project-building/storeys', 'id'=>$model->project_id]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['project'] = $model->project;
?>
<h1><i class="fa fa-bars"></i> <?= Html::encode($this->title) ?></h1>

<p>Upravljanje etažama, jedinicama i prostorijama objekta. Dodajte i/ili uklonite etaže iz predmetnog objekta.</p>

<div class="table-responsive container">
	<div class="row">		
		<div class="col-sm-7">
			<h3><?= Html::a($model->storey, ['/project-building-storeys/view', 'id' => $model->id]) ?></h3>
			<table class="table table-striped table-hover table-bordered">				
				<tr>
					<td class="center">
						
						<?= Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Dodaj Stan'), ['/project-building-storeys/parts', 'id' => $model->id, 'add_part'=>'stan'], [ 'class' => 'btn btn-primary', 'data' => ['method' => 'post',], 'style'=>'width:100%;']) ?>
					</td>
					<td>
						<?php 
							if($model->st){
								foreach($model->st as $st){
									echo Html::a($st->mark ? c($st->mark) : c($st->fullType), Url::to(['/project-building-storey-parts/view', 'id'=>$st->id]), ['class' => 'btn btn-default btn-sm']). ' '.Html::a('<i class="fa fa-wrench"></i>', Url::to(['/project-building-storey-parts/update', 'id'=>$st->id]), ['class' => 'btn btn-success btn-sm']). ' ' .Html::a('<i class="fa fa-power-off"></i>', Url::to(['/project-building-storeys/parts', 'id' => $model->id, 'remove_part'=>$st->id]), ['class' => 'btn btn-danger btn-sm']) . '<br><br>';
								}								 
							} else {
									echo '<span class="hint">Etaža nema stanove.</span>';
							}  ?>
					</td>
				</tr>
				<tr>
					<td class="center" style="width: 30%;">
						<?= (!$model->s) ? Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Dodaj stambene prostorije'), ['/project-building-storeys/parts', 'id' => $model->id, 'add_part'=>'stamb'], [ 'class' => 'btn btn-primary', 'data' => ['method' => 'post',], 'style'=>'width:100%;']) : Html::button(Yii::t('app', 'Stambene prostorije'), [ 'class' => 'btn btn-default', 'disabled' => 'disabled', 'style'=>'width:100%;']); ?>
					</td>
					<td>
						<?= ($model->s) ? Html::a($model->s->name ? c($model->s->name) : c($model->s->fullType), Url::to(['/project-building-storey-parts/view', 'id'=>$model->s->id]), ['class' => 'btn btn-default btn-sm']). ' '.Html::a('<i class="fa fa-wrench"></i>', Url::to(['/project-building-storey-parts/update', 'id'=>$model->c->id]), ['class' => 'btn btn-success btn-sm']). ' ' .Html::a('<i class="fa fa-power-off"></i>', Url::to(['/project-building-storeys/parts', 'id' => $model->id, 'remove_part'=>$model->s->id]), ['class' => 'btn btn-danger btn-sm']) : '<span class="hint">Etaža nema stambene prostorije.</span>' ?>
					</td>
				</tr>
				<tr>
					<td class="center">
						
						<?= Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Dodaj poslovni prostor'), ['/project-building-storeys/parts', 'id' => $model->id, 'add_part'=>'biz'], [ 'class' => 'btn btn-primary', 'data' => ['method' => 'post',], 'style'=>'width:100%;']) ?>
					</td>
					<td>
						<?php 
							if($model->b){
								foreach($model->b as $b){
									echo Html::a($b->mark ? c($b->mark) : c($b->fullType), Url::to(['/project-building-storey-parts/view', 'id'=>$b->id]), ['class' => 'btn btn-default btn-sm']). ' '.Html::a('<i class="fa fa-wrench"></i>', Url::to(['/project-building-storey-parts/update', 'id'=>$b->id]), ['class' => 'btn btn-success btn-sm']). ' ' .Html::a('<i class="fa fa-power-off"></i>', Url::to(['/project-building-storeys/parts', 'id' => $model->id, 'remove_part'=>$b->id]), ['class' => 'btn btn-danger btn-sm']) . '<br><br>';
								}								 
							} else {
									echo '<span class="hint">Etaža nema poslovni prostor.</span>';
							}  ?>
					</td>
				</tr>
				<tr>
					<td class="center" style="width: 30%;">
						<?= (!$model->p) ? Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Dodaj poslovne prostorije'), ['/project-building-storeys/parts', 'id' => $model->id, 'add_part'=>'posl'], [ 'class' => 'btn btn-primary', 'data' => ['method' => 'post',], 'style'=>'width:100%;']) : Html::button(Yii::t('app', 'Stambene prostorije'), [ 'class' => 'btn btn-default', 'disabled' => 'disabled', 'style'=>'width:100%;']); ?>
					</td>
					<td>
						<?= ($model->p) ? Html::a($model->p->name ? c($model->p->name) : c($model->p->fullType), Url::to(['/project-building-storey-parts/view', 'id'=>$model->p->id]), ['class' => 'btn btn-default btn-sm']). ' '.Html::a('<i class="fa fa-wrench"></i>', Url::to(['/project-building-storey-parts/update', 'id'=>$model->p->id]), ['class' => 'btn btn-success btn-sm']). ' ' .Html::a('<i class="fa fa-power-off"></i>', Url::to(['/project-building-storeys/parts', 'id' => $model->id, 'remove_part'=>$model->p->id]), ['class' => 'btn btn-danger btn-sm']) : '<span class="hint">Etaža nema poslovne prostorije.</span>' ?>
					</td>
				</tr>
				<tr>
					<td class="center" style="width: 30%;">
						<?= (!$model->c) ? Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Dodaj zajedničke prostorije'), ['/project-building-storeys/parts', 'id' => $model->id, 'add_part'=>'common'], [ 'class' => 'btn btn-primary', 'data' => ['method' => 'post',], 'style'=>'width:100%;']) : Html::button(Yii::t('app', 'Zajedničke prostorije'), [ 'class' => 'btn btn-default', 'disabled' => 'disabled', 'style'=>'width:100%;']); ?>
					</td>
					<td>
						<?= ($model->c) ? Html::a($model->c->name ? c($model->c->name) : c($model->c->fullType), Url::to(['/project-building-storey-parts/view', 'id'=>$model->c->id]), ['class' => 'btn btn-default btn-sm']). ' '.Html::a('<i class="fa fa-wrench"></i>', Url::to(['/project-building-storey-parts/update', 'id'=>$model->c->id]), ['class' => 'btn btn-success btn-sm']). ' ' .Html::a('<i class="fa fa-power-off"></i>', Url::to(['/project-building-storeys/parts', 'id' => $model->id, 'remove_part'=>$model->c->id]), ['class' => 'btn btn-danger btn-sm']) : '<span class="hint">Etaža nema zajedničke prostorije.</span>' ?>
					</td>
				</tr>
				<tr>
					<td class="center" style="width: 30%;">
						<?= (!$model->t) ? Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Dodaj tehničke prostorije'), ['/project-building-storeys/parts', 'id' => $model->id, 'add_part'=>'tech'], [ 'class' => 'btn btn-primary', 'data' => ['method' => 'post',], 'style'=>'width:100%;']) : Html::button(Yii::t('app', 'Tehničke prostorije'), [ 'class' => 'btn btn-default', 'disabled' => 'disabled', 'style'=>'width:100%;']); ?>
					</td>
					<td>
						<?= ($model->t) ? Html::a($model->t->name ? c($model->t->name) : c($model->t->fullType), Url::to(['/project-building-storey-parts/view', 'id'=>$model->t->id]), ['class' => 'btn btn-default btn-sm']). ' '.Html::a('<i class="fa fa-wrench"></i>', Url::to(['/project-building-storey-parts/update', 'id'=>$model->t->id]), ['class' => 'btn btn-success btn-sm']). ' ' .Html::a('<i class="fa fa-power-off"></i>', Url::to(['/project-building-storeys/parts', 'id' => $model->id, 'remove_part'=>$model->t->id]), ['class' => 'btn btn-danger btn-sm']) : '<span class="hint">Etaža nema tehničke prostorije.</span>' ?>
					</td>
				</tr>
				<tr>
					<td class="center" style="width: 30%;">
						<?= (!$model->g) ? Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Dodaj garažni prostor'), ['/project-building-storeys/parts', 'id' => $model->id, 'add_part'=>'garage'], [ 'class' => 'btn btn-primary', 'data' => ['method' => 'post',], 'style'=>'width:100%;']) : Html::button(Yii::t('app', 'Garažni prostor'), [ 'class' => 'btn btn-default', 'disabled' => 'disabled', 'style'=>'width:100%;']); ?>
					</td>
					<td>
						<?= ($model->g) ? Html::a($model->g->name ? c($model->g->name) : c($model->g->fullType), Url::to(['/project-building-storey-parts/view', 'id'=>$model->g->id]), ['class' => 'btn btn-default btn-sm']). ' '.Html::a('<i class="fa fa-wrench"></i>', Url::to(['/project-building-storey-parts/update', 'id'=>$model->g->id]), ['class' => 'btn btn-success btn-sm']). ' ' .Html::a('<i class="fa fa-power-off"></i>', Url::to(['/project-building-storeys/parts', 'id' => $model->id, 'remove_part'=>$model->g->id]), ['class' => 'btn btn-danger btn-sm']) : '<span class="hint">Etaža nema garažni prostor.</span>' ?>
					</td>
				</tr>
				<tr>
					<td class="center" style="width: 30%;">
						<?= (!$model->e) ? Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Dodaj spoljašnji prostor'), ['/project-building-storeys/parts', 'id' => $model->id, 'add_part'=>'external'], [ 'class' => 'btn btn-primary', 'data' => ['method' => 'post',], 'style'=>'width:100%;']) : Html::button(Yii::t('app', 'Spoljašnji prostor'), [ 'class' => 'btn btn-default', 'disabled' => 'disabled', 'style'=>'width:100%;']); ?>
					</td>
					<td>
						<?= ($model->e) ? Html::a($model->e->name ? c($model->e->name) : c($model->e->fullType), Url::to(['/project-building-storey-parts/view', 'id'=>$model->e->id]), ['class' => 'btn btn-default btn-sm']). ' '.Html::a('<i class="fa fa-wrench"></i>', Url::to(['/project-building-storey-parts/update', 'id'=>$model->e->id]), ['class' => 'btn btn-success btn-sm']). ' ' .Html::a('<i class="fa fa-power-off"></i>', Url::to(['/project-building-storeys/parts', 'id' => $model->id, 'remove_part'=>$model->e->id]), ['class' => 'btn btn-danger btn-sm']) : '<span class="hint">Etaža nema garažni prostor.</span>' ?>
					</td>
				</tr>		
			</table>
		</div>
		<div class="col-sm-5">
			<div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head button_to_show_secondary">Jedinice etaže
                    </div>
                </div>
                <div class="secondary-context">
                    <?= GridView::widget([
                        'dataProvider' => $projectBuildingStoreyParts,
                        'columns' => [
                            [
                                'label'=>'Jedinica',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->fullType.' '.$data->mark, ['project-building-storey-parts/update', 'id' => $data->id]);
                                },
                            ],
                            'structure',
                            [
                                'label'=>'Površina',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->netArea, ['project-building-storey-parts/update', 'id' => $data->id]);
                                },
                            ],
                           // ['class' => 'yii\grid\ActionColumn'],
                        ],
                        'summary' => false,
                    ]); ?>
                </div>
            </div>
		</div>
	</div>
			
</div>