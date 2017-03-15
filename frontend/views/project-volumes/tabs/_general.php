
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;

?>
<div class="card_container record-full grid-item fadeInUp animated" id="">
    <div class="primary-context gray normal">
        <div class="head"><i class="fa fa-file"></i> <?= Html::encode($this->title) ?> <i class="fa this-one fa-arrow-circle-right"></i>
        <div class="action-area normal-case"><?= Html::a(Yii::t('app', '<i class="fa fa-cog"></i>'), ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?> 
        <?php /* if($model->volume->type!='drugo' or $model->volume_id==1): 
          if($model->dataRequirement($model->dataReqs())): ?>
          <?= Html::a('<i class="fa fa-print"></i> PDF Sveske', Url::to(['/site/'.$sveska, 'id'=>$model->project_id, 'volume'=>$model->id]), ['class' => 'btn btn-primary', 'target'=>'_blank']) ?>
          <?php else: ?>
            <?= Html::button('<i class="fa fa-print"></i> PDF Sveske', ['class' => 'btn btn-disabled', 'disabled'=>true]) ?>
          <?php endif; ?>
        <?php endif; */?>
        <?= Html::a(Yii::t('app', '<i class="fa fa-power-off"></i>'), ['delete', 'id' => $model->id], [
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
    <div class="secondary-context">
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
  </div>