<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectVolumes */

$this->title = c($model->name);
$this->params['breadcrumbs'][] = ['label' => $model->project->name, 'url' => ['/projects/view', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['project'] = $model->project;
?>

<div class="card_container record-full grid-item fadeInUp animated" id="">
    <div class="primary-context gray normal">
        <div class="head"><i class="fa fa-file"></i> Projekat <?= Html::a($model->project->code, ['/projects/view', 'id' => $model->project_id], []) . ': '. Html::encode($this->title) ?>
        <div class="action-area normal-case"><?= Html::a(Yii::t('app', '<i class="fa fa-wrench"></i> Izmeni'), ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', '<i class="fa fa-power-off"></i> Obriši'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
            </div>
        </div>
        <div class="subhead">Deo projektne dokumentacije.</div>
    </div>              
</div>
<hr>

<?= Alert::widget() ?>
<div class="container-fluid">

    <div class="row">
        <div class="col-sm-7">
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
                          return $data->controlPractice ? Html::a($data->controlPractice->name, ['/practices/view', 'id'=>$data->control_practice_id]) : null;
                      },
                  ],
                  [
                     'attribute'=>'control_engineer_id',
                     'format' => 'raw',
                     'value'=>function ($data) {
                          return $data->controlEngineer ? Html::a($data->controlEngineer->name, ['/engineers/view', 'id'=>$data->control_engineer_id]) : null;
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
                  'control_text'
              ],
          ]) ?>

        </div>

        <div class="col-sm-5">
          <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head major"><?= $model->number ?>. <?= $model->name ?>
                        <div class="action-area normal-case"><?= Html::a('Generiši deo projekta', Url::to(['/site/glavna-sveska', 'id'=>$model->project_id, 'volume'=>$model->id]), ['class' => 'btn btn-primary', 'target'=>'_blank']) ?></div>
                    </div>
                    
                </div>               
            </div>
        
        </div>
    </div>
</div>
