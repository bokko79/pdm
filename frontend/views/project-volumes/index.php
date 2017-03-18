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
$haystack = [];
$phase_volumes = \common\models\PhaseVolumes::find()->where('phase="'.$model->phase.'"')->all();
foreach($phase_volumes as $pv){
  $haystack[] = $pv->volume_id;
}
$sign = null;
$v_id = [];
?>


    
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3">
            <?= $this->render('_menu', [
                    'model' => $model,  
                ]) ?>        
        </div>
        <div class="col-sm-9">
            
            <ul class="bg-info text-info disc" style="margin-bottom: 20px">
              Za izabrani projekat, vrstu radova (<?= $model->projectTypeOfWorks ?>), fazu projetka (<?= $model->projectPhase ?>) i klasu objekta, <b class="">obavezni</b> su sledeći delovi projektne dokumentacije:
              <?php foreach($phase_volumes as $key=>$phase_volume): 
              foreach($model->projectVolumes as $projectVolume){
                if($projectVolume->volume_id==$phase_volume->volume_id){
                  $sign = '<i class="fa fa-check color-green-900"></i>';
                  $v_id[$key] = $projectVolume->id;
                  break;                 
                } else {
                  $sign = '<small class="hint"><i class="'.(($phase_volume->requirement) ? 'fa fa-warning red' : '').'"></i> '.(($phase_volume->requirement) ? 'Sveska je OBAVEZNA! ' : 'Sveska nije dodata. ' ).Html::a('<i class="fa fa-plus-circle"></i> Dodaj svesku', ['create', 'ProjectVolumes[project_id]'=>$model->id, 'ProjectVolumes[volume_id]'=>$phase_volume->volume_id], []). '</small>';
                }
              } ?>
              <li class=""><?= isset($v_id[$key]) ? Html::a(c($phase_volume->volume->name) . ' '. $sign, ['view', 'id'=>$v_id[$key]], []) : c($phase_volume->volume->name) . ' '. $sign ?></li>
            <?php endforeach; ?>
            </ul> 
          <div class="card_container record-full grid-item fadeInUp animated" id="">
            <div class="primary-context gray normal">
                <div class="head"><i class="fa fa-file"></i> <?= Html::encode($this->title) ?> <i class="fa this-one fa-arrow-circle-right"></i>
                <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj svesku', ['create', 'ProjectVolumes[project_id]'=>$model->id], ['class' => 'btn btn-success shadow']) ?>
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
                      /*[
                         'attribute'=>'project_id',
                         'format' => 'raw',
                         'value'=>function ($data) {
                              return Html::a(\yii\helpers\StringHelper::truncate($data->project->name, 50), ['/projects/view', 'id'=>$data->project_id]);
                          },
                      ],*/
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
