

<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use common\widgets\Alert;
use yii\bootstrap\Nav;
use kartik\grid\GridView;

?>
<?php if($model->volume->type!='drugo'): ?>
      <div class="card_container record-full grid-item fadeInUp animated" id="">
        <div class="primary-context gray normal">
            <div class="head">Crteži
                <div class="action-area normal-case">
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
                    'dataProvider'=>$projectVolumeDrawings,
                    //'filterModel'=>$searchModel,
                    'columns'=>$gridColumns,
                    'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
                    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
                    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
                    'pjax'=>true, // pjax is set to always true for this demo
                    // set your toolbar
                    'toolbar'=> [
                        ['content'=>
                            Html::a('<i class="glyphicon glyphicon-plus"></i> Dodaj crtež', Url::to(['/project-volume-drawings/create', 'ProjectVolumeDrawings[project_volume_id]'=>$model->id]), ['type'=>'button', 'title'=>Yii::t('app', 'Dodaj crtež'), 'class'=>'btn btn-success']) . ' '.
                            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['', 'id'=>$model->id], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')])
                        ],
                        //'{export}',
                        '{toggleData}',
                    ],
                    // parameters from the demo form
                    'bordered'=>true,
                    'striped'=>true,
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
<?php endif; ?>  