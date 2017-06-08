<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectVolumeDrawingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Crteži sveske';

$this->params['page_title'] = 'Sveske';
$this->params['page_title_2'] = c($model->name);
$this->params['page_title_3'] = 'Crteži';

$this->params['volume'] = $model;

$this->params['breadcrumbs'][] = ['label' => '<i class="fa fa-book"></i> Sveske projekta', 'url' => ['/project-volumes', 'ProjectVolumes[project_id]' => $model->project_id]];
$this->params['breadcrumbs'][] = ['label' => $model->number. '. '.$model->name, 'url' => ['/project-volumes/view', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = $this->title;

$this->params['project'] = $model->project;
?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="card_container record-full grid-item fadeInUp animated" id="">
        <div class="primary-context gray normal">
            <div class="head"><?= Html::a('<i class="fa fa-arrow-circle-left"></i> Nazad', Url::to(['/project-volumes/view', 'id'=>$model->id]), ['class'=>'btn btn-default']) ?> <?= $model->name ?>: <?= Html::encode($this->title) ?>
                <div class="action-area normal-case">
                    <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Dodaj crtež', Url::to(['/project-volume-drawings/create', 'ProjectVolumeDrawings[project_volume_id]'=>$model->id]), ['class'=>'btn btn-success']) ?>
                <?php if($model->projectVolumeDrawings): ?>
                  <?= Html::a('<i class="fa fa-print"></i> PDF Tablice', Url::to(['/site/tablice', 'id'=>$model->project_id, 'volume'=>$model->id]), ['class'=>'btn btn-primary shadow', 'target'=>'_blank']) ?>
                  <?php endif; ?> 
                  <?php if($model->volume_id==2): ?>
                  <?= Html::a('<i class="fa fa-print"></i> PDF Površine', Url::to(['/site/povrsine', 'id'=>$model->project_id, 'volume'=>$model->id]), ['class'=>'btn btn-warning shadow', 'target'=>'_blank']) ?>
                  <?php endif; ?>   
                  </div>
            </div>
            <div class="subhead"><p>Lista crteža</p>
            </div>
        </div>
        <div class="secondary-context">
          
            <?php /* if($drawings = $model->projectVolumeDrawings);
            foreach($drawings as $drawing){
                /*echo Html::a(c($volume->name), Url::to(['/site/glavna-sveska', 'id'=>$model->id]), ['class' => 'btn btn-danger', 'style'=>'width:100%', 'target'=>'_blank']).'<br>';
                echo Html::a($drawing->number.'. '.c($drawing->name), Url::to(['/project-volume-drawings/update', 'id'=>$drawing->id]), ['class' => 'btn btn-default', 'style'=>'width:100%', ]).'<hr>';
            } */ ?>

            <?php
                $gridColumns = [
                    ['class' => 'kartik\grid\SerialColumn'],
                  
                    [
                        'class'=>'kartik\grid\EditableColumn',
                        'attribute'=>'number',
                        'width'=>'50px',
                        'hAlign'=>'right',
                        //'format'=>['decimal', 2],
                        'pageSummary'=>true,
                        'editableOptions'=> function ($model, $key, $index) {
                            return [
                                'header'=>'Broj lista',
                                'size'=>'sm',
                                //'asPopover' => false,
                                //'inputType' => Editable::INPUT_HTML5_INPUT,
                                'placement' => 'top',              
                            ];
                        }
                    ],
                    [
                        'class'=>'kartik\grid\EditableColumn',
                        'attribute'=>'title',
                        'width'=>'50px',
                        'hAlign'=>'right',
                        //'format'=>['decimal', 2],
                        'pageSummary'=>true,
                        'editableOptions'=> function ($model, $key, $index) {
                            return [
                                'header'=>'Glavni naslov crteža',
                                'size'=>'md',
                                //'asPopover' => false,
                                //'inputType' => Editable::INPUT_HTML5_INPUT,
                                'placement' => 'top',              
                            ];
                        }
                    ],                       
                    [
                        'class'=>'kartik\grid\EditableColumn',
                        'attribute'=>'name',
                        'width'=>'50px',
                        'hAlign'=>'right',
                        //'format'=>['decimal', 2],
                        'pageSummary'=>true,
                        'editableOptions'=> function ($model, $key, $index) {
                            return [
                                'header'=>'Naziv crteža',
                                'size'=>'md',
                                //'asPopover' => false,
                                //'inputType' => Editable::INPUT_HTML5_INPUT,
                                'placement' => 'top',              
                            ];
                        }
                    ],                        
                    [
                        'class'=>'kartik\grid\EditableColumn',
                        'attribute'=>'scale',
                        'width'=>'50px',
                        'hAlign'=>'right',
                        //'format'=>['decimal', 2],
                        'pageSummary'=>true,
                        'editableOptions'=> function ($model, $key, $index) {
                            return [
                                'header'=>'Razmera',
                                'size'=>'sm',
                                //'asPopover' => false,
                                //'inputType' => Editable::INPUT_HTML5_INPUT,
                                'placement' => 'top',               
                            ];
                        }
                    ],
                    [
                       'label'=>'Akcija',
                       'format' => 'raw',
                       'width' =>'50px',
                       'value'=>function ($data) {
                            return Html::a('<i class="fa fa-cog"></i>', ['/project-volume-drawings/update', 'id'=>$data->id], ['class' => 'btn btn-success btn-sm shadow']). ' '.Html::a(Yii::t('app', '<i class="fa fa-power-off"></i>'), ['/project-volume-drawings/delete', 'id' => $data->id], [
                'class' => 'btn btn-danger btn-sm shadow',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]);
                        },
                    ],
                ];
                echo GridView::widget([
                    'id' => 'kv-grid-demo',
                    'dataProvider'=>$dataProvider,
                    //'filterModel'=>$searchModel,
                    'columns'=>$gridColumns,
                    'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
                    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
                    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
                    'pjax'=>true, // pjax is set to always true for this demo
                    // set your toolbar
                    'toolbar'=> [
                        ['content'=>
                            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['', 'id'=>$model->id], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')])
                        ],
                        //'{export}',
                        '{toggleData}',
                    ],
                    // parameters from the demo form
                    'bordered'=>false,
                    'striped'=>false,
                    'condensed'=>false,
                    'responsive'=>true,
                    'hover'=>true,
                    //'showPageSummary'=>true,
                    'panel'=>[
                        'type'=>GridView::TYPE_DEFAULT,
                        //'heading'=>'Crteži sveske',
                    ],
                    'persistResize'=>false,
                    //'perfectScrollbar'=>true,
                    //'exportConfig'=>$exportConfig,
                ]);
                ?>
        </div>
      </div>
