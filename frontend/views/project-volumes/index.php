<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectVolumesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sveske projekta');
$this->params['breadcrumbs'][] = $this->title;
$this->params['project'] = $model;
?>


    <p>
        
    </p>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
          <div class="card_container record-full grid-item fadeInUp animated" id="">
            <div class="primary-context gray normal">
                <div class="head"><i class="fa fa-file"></i> <?= Html::encode($this->title) ?> <i class="fa this-one fa-arrow-circle-right"></i>
                <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj svesku', ['create', 'ProjectVolumes[project_id]'=>$model->id], ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
                <div class="subhead">Delovi projektne tehničke dokumentacije.</div>
            </div>
            <div class="secondary-context">
              <?= GridView::widget([
                  'dataProvider' => $dataProvider,
                  //'filterModel' => $searchModel,
                  'columns' => [
                      'number',
                      [
                         'attribute'=>'volume_id',
                         'format' => 'raw',
                         'value'=>function ($data) {
                              return Html::a(c($data->volume->name), ['view', 'id'=>$data->id]);
                          },
                      ],
                      [
                         'attribute'=>'project_id',
                         'format' => 'raw',
                         'value'=>function ($data) {
                              return Html::a(\yii\helpers\StringHelper::truncate($data->project->name, 50), ['/projects/view', 'id'=>$data->project_id]);
                          },
                      ],
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
                      
                      // 'number',

                      ['class' => 'yii\grid\ActionColumn'],
                  ],
              ]); ?>
            </div>
          </div>
        </div>
    </div>
</div>
