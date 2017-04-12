<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;

?>
<div class="row">
  <div class="col-sm-4">
    <?php 
        $fotorama = \metalguardian\fotorama\Fotorama::begin(
            [
                'options' => [
                    'loop' => true,
                    'hash' => true,
                    'allowfullscreen' => true,
                    'width' => '100%',
                    'minwidth' => '400',
                    'maxwidth' => '555',
                    'minheight' => '560',
                    'maxheight' => '100%',
                    'height' => '560',
                    'ratio' => 555/560,
                    'nav' => false,
                    //'fit' => 'cover',
                ],
                //'tagName' => 'span',
                'useHtmlData' => false,
                'htmlOptions' => [
                    'style'=>'',
                    'class'=>'card-width-cover'
                ],
            ]
        ); 
        ?>
        <?php foreach ($model->projectFiles as $media): ?>
            <?= Html::img('@web/images/projects/'.$model->year.'/'.$model->id.'/'.$media->file->name) ?>
        <?php endforeach; ?>
        <?php $fotorama->end(); ?>
  </div>
  <div class="col-sm-8">
      <div class="card_container record-full grid-item fadeInUp animated" id="">
          <div class="primary-context gray normal">
              <div class="head"><i class="fa fa-plus-circle"></i> Opšti podaci projekta
                <div class="action-area normal-case"><?= Html::a('<i class="fa fa-cog"></i>', Url::to(['/projects/update', 'id'=>$model->id]), ['class' => 'btn btn-success btn-sm shadow']) ?>
                        <?= Html::a($model->status=='deleted' ? Yii::t('app', 'Aktiviraj') : Yii::t('app', '<i class="fa fa-power-off"></i>'), ['activate', 'id' => $model->id], ['class' => 'btn btn-danger shadow btn-sm', 'data'=>['confirm'=>'Da li ste sigurni da želite da deaktivirate projekat? Podaci neće biti obrisani, samo deaktivirani. Da biste ponovo pristupili projektu, zapišite ID projekta i unesite ga u pretrazi projekata.']]) ?>
                </div>
              </div>
              <div class="subhead">Predmetni projekat.</div>
          </div>
          <div class="secondary-context">   
              <?= DetailView::widget([
                  'model' => $model,
                  'attributes' => [
                      'id',
                      'name',
                      'code',
                      [
                         'attribute'=>'client_id',
                         'format' => 'raw',
                         'value'=>function ($data) {
                              return Html::a($data->client->name, ['/clients/view', 'id'=>$data->client_id]);
                          },
                      ],
                      'building.name',
                      'location.city.town',
                      'projectTypeOfWorks',
                      'projectPhase',
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
                      'status',
                      [
                         'attribute'=>'time',
                         'format' => 'raw',
                         'value'=>function ($data) {
                              return Yii::$app->formatter->asDate($data->time, 'php:mm Y');
                          },
                      ],
                      
                  ],
              ]) ?>
          </div>            
      </div>
  </div>
</div>
    
      