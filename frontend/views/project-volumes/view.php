<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectVolumes */

$this->title = c($model->name) . ' projekta ';
$this->params['breadcrumbs'][] = ['label' => $model->project->name, 'url' => ['/projects/view', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-volumes-view">

    <h1><?= Html::encode($this->title).Html::a($model->project->code, ['/projects/view', 'id' => $model->project_id], []) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Izmeni'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Obriši'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-5">
          <?= DetailView::widget([
              'model' => $model,
              'attributes' => [
                  [
                     'attribute'=>'project_id',
                     'format' => 'raw',
                     'value'=>function ($data) {
                          return Html::a($data->project->name, ['/projects/view', 'id'=>$data->project_id]);
                      },
                  ],
                   'volume_id',
                  [
                     'attribute'=>'practice_id',
                     'format' => 'raw',
                     'value'=>function ($data) {
                          return Html::a($data->practice->name, ['/practices/view', 'id'=>$data->practice_id]);
                      },
                  ],
                  [
                     'attribute'=>'engineer_id',
                     'format' => 'raw',
                     'value'=>function ($data) {
                          return Html::a($data->engineer->name, ['/engineers/view', 'id'=>$data->engineer_id]);
                      },
                  ],
                  [
                     'attribute'=>'engineer_licence_id',
                     'format' => 'raw',
                     'value'=>function ($data) {
                          return Html::a($data->engineerLicence->no, ['/engineer-licences/update', 'id'=>$data->engineer_licence_id]);
                      },
                  ],
                  [
                     'attribute'=>'control_practice_id',
                     'format' => 'raw',
                     'value'=>function ($data) {
                          return Html::a($data->controlPractice->name, ['/practices/view', 'id'=>$data->control_practice_id]);
                      },
                  ],
                  [
                     'attribute'=>'control_engineer_id',
                     'format' => 'raw',
                     'value'=>function ($data) {
                          return Html::a($data->controlEngineer->name, ['/engineers/view', 'id'=>$data->control_engineer_id]);
                      },
                  ],
                  [
                     'attribute'=>'control_engineer_licence_id',
                     'format' => 'raw',
                     'value'=>function ($data) {
                          return $data->controlEngineerLicence ? Html::a($data->controlEngineerLicence->no, ['/engineer-licences/update', 'id'=>$data->control_engineer_licence_id]) : null;
                      },
                  ],
                  'number',
                  'name',
                  'code',
              ],
          ]) ?>

        </div>

        <div class="col-sm-7">
          <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head"><?= $model->number ?>. <?= $model->name ?>
                        <div class="action-area normal-case"><?= Html::a('Generiši deo projekta', Url::to(['/site/glavna-sveska', 'id'=>$model->project_id, 'volume'=>$model->id]), ['class' => 'btn btn-primary', 'target'=>'_blank']) ?></div>
                    </div>
                    
                </div>               
            </div>
        
        </div>
    </div>
</div>
