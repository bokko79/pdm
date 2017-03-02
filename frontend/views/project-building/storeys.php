<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectBuildingStoreysSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Etaže objekta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Objekat'), 'url' => ['/project-building/view', 'id'=>$model->project_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><i class="fa fa-bars"></i> <?= Html::encode($this->title) ?></h1>

<p>Upravljanje etažama, jedinicama i prostorijama objekta. Dodajte i/ili uklonite etaže iz predmetnog objekta.</p>

<div class="table-responsive container">
	<div class="row">		
		<div class="col-sm-7">
			<h3>Spratnost objekta: <?= $model->spratnost ?></h3>
			<table class="table table-striped table-hover table-bordered">
				<tr>
					<td class="center">						
						<?= Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Dodaj podrum'), ['/project-building/storeys', 'id' => $model->project_id, 'add_storey'=>'podrum'], [ 'class' => 'btn btn-primary', 'data' => ['method' => 'post',], 'style'=>'width:100%;']) ?>
					</td>
					<td>
						<?php 
							if($model->po){
								foreach($model->po as $po){
									echo Html::a($po->name ? c($po->name) : c($po->storey), Url::to(['/project-building-storeys/view', 'id'=>$po->id]), ['class' => 'btn btn-default btn-sm']). ' '.Html::a('<i class="fa fa-wrench"></i>', Url::to(['/project-building-storeys/update', 'id'=>$po->id]), ['class' => 'btn btn-success btn-sm']). ' ' . ((!$po->projectBuildingStoreyParts) ? Html::a('<i class="fa fa-power-off"></i>', Url::to(['/project-building/storeys', 'id' => $model->project_id, 'remove_storey'=>$po->id]), ['class' => 'btn btn-danger btn-sm']) : '<span class="hint">Podrum ne može biti obrisan jer sadrži jedinice/prostorije.</span>'). '<br><br>';
								}								 
							} else {
									echo '<span class="hint">Objekat nema podrum.</span>';
							}  ?>
					</td>
				</tr>
				<tr>
					<td class="center">
						<?= (!$model->s) ? Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Dodaj suteren'), ['/project-building/storeys', 'id' => $model->project_id, 'add_storey'=>'suteren'], [ 'class' => 'btn btn-primary', 'data' => ['method' => 'post',], 'style'=>'width:100%;']) : Html::button(Yii::t('app', 'Suteren'), [ 'class' => 'btn btn-default', 'disabled' => 'disabled', 'style'=>'width:100%;']); ?>
					</td>
					<td>
						<?= ($model->s) ? Html::a($model->s->name ? c($model->s->name) : c($model->s->storey), Url::to(['/project-building-storeys/view', 'id'=>$model->s->id]), ['class' => 'btn btn-default btn-sm']). ' '.Html::a('<i class="fa fa-wrench"></i>', Url::to(['/project-building-storeys/update', 'id'=>$model->s->id]), ['class' => 'btn btn-success btn-sm']). ' ' .((!$model->s->projectBuildingStoreyParts) ? Html::a('<i class="fa fa-power-off"></i>', Url::to(['/project-building/storeys', 'id' => $model->project_id, 'remove_storey'=>$model->s->id]), ['class' => 'btn btn-danger btn-sm']) : '<span class="hint">Suteren ne može biti obrisan jer sadrži jedinice/prostorije.</span>') : '<span class="hint">Objekat nema suteren.</span>' ?>
					</td>
				</tr>

				<tr>
					<td class="center">
						<?= Html::button(Yii::t('app', 'Prizemlje'), [ 'class' => 'btn btn-default', 'disabled' => 'disabled', 'style'=>'width:100%;']); ?>
					</td>
					<td>
						<?= Html::a('Prizemlje', Url::to(['/project-building-storeys/view', 'id'=>$model->pr->id]), ['class' => 'btn btn-default btn-sm']). ' '.Html::a('<i class="fa fa-wrench"></i>', Url::to(['/project-building-storeys/update', 'id'=>$model->pr->id]), ['class' => 'btn btn-success btn-sm']) ?>
					</td>
				</tr>
				<tr>
					<td class="center">
						<?= (!$model->g) ? Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Dodaj galeriju'), ['/project-building/storeys', 'id' => $model->project_id, 'add_storey'=>'galerija'], [ 'class' => 'btn btn-primary', 'data' => ['method' => 'post',], 'style'=>'width:100%;']) : Html::button(Yii::t('app', 'Tavan'), [ 'class' => 'btn btn-default', 'disabled' => 'disabled', 'style'=>'width:100%;']); ?>
					</td>
					<td>
						<?= ($model->g) ? Html::a($model->g->name ? c($model->g->name) : c($model->g->storey), Url::to(['/project-building-storeys/view', 'id'=>$model->g->id]), ['class' => 'btn btn-default btn-sm']). ' '.Html::a('<i class="fa fa-wrench"></i>', Url::to(['/project-building-storeys/update', 'id'=>$model->g->id]), ['class' => 'btn btn-success btn-sm']). ' ' .((!$model->g->projectBuildingStoreyParts) ? Html::a('<i class="fa fa-power-off"></i>', Url::to(['/project-building/storeys', 'id' => $model->project_id, 'remove_storey'=>$model->g->id]), ['class' => 'btn btn-danger btn-sm']) : '<span class="hint">Galerija ne može biti obrisana jer sadrži jedinice/prostorije.</span>') : '<span class="hint">Objekat nema galeriju.</span>' ?>
					</td>
				</tr>
				<tr>
					<td class="center">
						
						<?= Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Dodaj sprat'), ['/project-building/storeys', 'id' => $model->project_id, 'add_storey'=>'sprat'], [ 'class' => 'btn btn-primary', 'data' => ['method' => 'post',], 'style'=>'width:100%;']) ?>
					</td>
					<td>
						<?php 
							if($model->sp){
								foreach($model->sp as $sp){
									echo Html::a($sp->name ? c($sp->name) : c($sp->storey), Url::to(['/project-building-storeys/view', 'id'=>$sp->id]), ['class' => 'btn btn-default btn-sm']). ' '.Html::a('<i class="fa fa-wrench"></i>', Url::to(['/project-building-storeys/update', 'id'=>$sp->id]), ['class' => 'btn btn-success btn-sm']). ' ' .((!$sp->projectBuildingStoreyParts) ? Html::a('<i class="fa fa-power-off"></i>', Url::to(['/project-building/storeys', 'id' => $model->project_id, 'remove_storey'=>$sp->id]), ['class' => 'btn btn-danger btn-sm']) : '<span class="hint">Sprat ne može biti obrisan jer sadrži jedinice/prostorije.</span>') . '<br><br>';
								}								 
							} else {
									echo '<span class="hint">Objekat nema sprat.</span>';
							}  ?>
					</td>
				</tr>
				<tr>
					<td class="center">
						
						<?= Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Dodaj povučeni sprat'), ['/project-building/storeys', 'id' => $model->project_id, 'add_storey'=>'povucenisprat'], [ 'class' => 'btn btn-primary', 'data' => ['method' => 'post',], 'style'=>'width:100%;']) ?>
					</td>
					<td>
						<?php 
							if($model->ps){
								foreach($model->ps as $ps){
									echo Html::a($ps->name ? c($ps->name) : c($ps->storey), Url::to(['/project-building-storeys/view', 'id'=>$ps->id]), ['class' => 'btn btn-default btn-sm']). ' '.Html::a('<i class="fa fa-wrench"></i>', Url::to(['/project-building-storeys/update', 'id'=>$ps->id]), ['class' => 'btn btn-success btn-sm']). ' ' .((!$ps->projectBuildingStoreyParts) ? Html::a('<i class="fa fa-power-off"></i>', Url::to(['/project-building/storeys', 'id' => $model->project_id, 'remove_storey'=>$ps->id]), ['class' => 'btn btn-danger btn-sm']) : '<span class="hint">Povučeni sprat ne može biti obrisan jer sadrži jedinice/prostorije.</span>') . '<br><br>';
								}								 
							} else {
									echo '<span class="hint">Objekat nema povučeni sprat.</span>';
							}  ?>
					</td>
				</tr>
				<tr>
					<td class="center">
						
						<?= Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Dodaj mansardu'), ['/project-building/storeys', 'id' => $model->project_id, 'add_storey'=>'mansarda'], [ 'class' => 'btn btn-primary', 'data' => ['method' => 'post',], 'style'=>'width:100%;']) ?>
					</td>
					<td>
						<?php 
							if($model->m){
								foreach($model->m as $m){
									echo Html::a($m->name ? c($m->name) : c($m->storey), Url::to(['/project-building-storeys/view', 'id'=>$m->id]), ['class' => 'btn btn-default btn-sm']). ' '.Html::a('<i class="fa fa-wrench"></i>', Url::to(['/project-building-storeys/update', 'id'=>$m->id]), ['class' => 'btn btn-success btn-sm']). ' ' .((!$m->projectBuildingStoreyParts) ? Html::a('<i class="fa fa-power-off"></i>', Url::to(['/project-building/storeys', 'id' => $model->project_id, 'remove_storey'=>$m->id]), ['class' => 'btn btn-danger btn-sm']) : '<span class="hint">Mansarda ne može biti obrisana jer sadrži jedinice/prostorije.</span>') . '<br><br>';
								}								 
							} else {
									echo '<span class="hint">Objekat nema mansardu.</span>';
							}  ?>
					</td>
				</tr>
				<tr>
					<td class="center">
						
						<?= Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Dodaj potkrovlje'), ['/project-building/storeys', 'id' => $model->project_id, 'add_storey'=>'potkrovlje'], [ 'class' => 'btn btn-primary', 'data' => ['method' => 'post',], 'style'=>'width:100%;']) ?>
					</td>
					<td>
						<?php 
							if($model->pk){
								foreach($model->pk as $pk){
									echo Html::a($pk->name ? c($pk->name) : c($pk->storey), Url::to(['/project-building-storeys/view', 'id'=>$pk->id]), ['class' => 'btn btn-default btn-sm']). ' '.Html::a('<i class="fa fa-wrench"></i>', Url::to(['/project-building-storeys/update', 'id'=>$pk->id]), ['class' => 'btn btn-success btn-sm']). ' ' .((!$pk->projectBuildingStoreyParts) ? Html::a('<i class="fa fa-power-off"></i>', Url::to(['/project-building/storeys', 'id' => $model->project_id, 'remove_storey'=>$pk->id]), ['class' => 'btn btn-danger btn-sm']) : '<span class="hint">Potkrovlje ne može biti obrisano jer sadrži jedinice/prostorije.</span>'). '<br><br>';
								}								 
							} else {
									echo '<span class="hint">Objekat nema potkrovlje.</span>';
							}  ?>
					</td>
				</tr>
				<tr>
					<td class="center" style="width: 30%;">
						<?= (!$model->t) ? Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Dodaj tavan'), ['/project-building/storeys', 'id' => $model->project_id, 'add_storey'=>'tavan'], [ 'class' => 'btn btn-primary', 'data' => ['method' => 'post',], 'style'=>'width:100%;']) : Html::button(Yii::t('app', 'Tavan'), [ 'class' => 'btn btn-default', 'disabled' => 'disabled', 'style'=>'width:100%;']); ?>
					</td>
					<td>
						<?= ($model->t) ? Html::a($model->t->name ? c($model->t->name) : c($model->t->storey), Url::to(['/project-building-storeys/view', 'id'=>$model->t->id]), ['class' => 'btn btn-default btn-sm']). ' '.Html::a('<i class="fa fa-wrench"></i>', Url::to(['/project-building-storeys/update', 'id'=>$model->t->id]), ['class' => 'btn btn-success btn-sm']). ' ' .((!$model->t->projectBuildingStoreyParts) ? Html::a('<i class="fa fa-power-off"></i>', Url::to(['/project-building/storeys', 'id' => $model->project_id, 'remove_storey'=>$model->t->id]), ['class' => 'btn btn-danger btn-sm']) : '<span class="hint">Tavan ne može biti obrisan jer sadrži jedinice/prostorije.</span>') : '<span class="hint">Objekat nema tavan.</span>' ?>
					</td>
				</tr>
			</table>
		</div>
	</div>
			
</div>