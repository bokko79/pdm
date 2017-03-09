<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use kartik\editable\Editable;

?>
<?php
    $gridColumns = [
        ['class' => 'kartik\grid\SerialColumn'],
        [
            'attribute'=>'id',
            'format' => 'raw',
            'value'=>function ($data) {

                return Html::a($data->name.'@'.$data->level, ['project-building-storeys/update', 'id' => $data->id]);
            },
            
        ],
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'name',
            'editableOptions'=> function ($model, $key, $index) {
                return [
                    'header'=>'Naziv',
                    'size'=>'',
                    'placement' => 'top',              
                ];
            }
        ], 
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'height',
            'width'=>'50px',
            'hAlign'=>'right',
            'editableOptions'=> function ($model, $key, $index) {
                return [
                    'header'=>'Neto redukovana površina',
                    'size'=>'',
                    'placement' => 'top',              
                ];
            }
        ],
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'level',
            'width'=>'50px',
            'hAlign'=>'right',
            //'format'=>['decimal', 2],
            'pageSummary'=>true,
            'editableOptions'=> function ($model, $key, $index) {
                return [
                    'header'=>'Neto površina',
                    'size'=>'',
                    'placement' => 'top',
                                  
                ];
            }
        ],
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'gross_area',
            //'pageSummary'=>true,
            'editableOptions'=> function ($model, $key, $index) {
                return [
                    'header'=>'Naziv',
                    'size'=>'',
                    'placement' => 'top',              
                ];
            }
        ], 
        [
            'label'=>'neto',
            'format' => 'raw',
            'value'=>function ($data) {
                return $data->netArea;
            },
        ],
        [
            'label'=>'reduk. neto',
            'format' => 'raw',
            'value'=>function ($data) {
                return $data->subNetArea;
            },
        ],
        [
            'class' => 'kartik\grid\ActionColumn',
            'header' => 'Opcije',
            'headerOptions' => ['style' => 'color:#337ab7'],
            'template' => '{generateParts}{view}{update}{delete}',
            'buttons' => [                
                'generateParts' => function ($url, $model, $key) {
                    return Html::a('<i class="fa fa-cubes"></i>', $url, ['class'=>'btn btn-primary btn-sm', 'style'=>'margin-right:10px;', 'data-toggle'=>'modal', 'data-backdrop'=>false, 'data-target'=>'#'.($model->projectBuildingStoreyParts ? '' : 'init-').'storey-parts-modal'.$model->id]);
                },
                'view' => function ($url, $model, $key) {
                    return Html::a('<i class="fa fa-eye"></i>', $url, ['class'=>'btn btn-default btn-sm', 'style'=>'margin-right:10px;']);
                },

                'update' => function ($url, $model, $key) {
                    return Html::a('<i class="fa fa-wrench"></i>', $url, ['class'=>'btn btn-default btn-sm', 'style'=>'margin-right:10px;']);
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="fa fa-power-off"></i>', $url, ['class'=>'btn btn-danger btn-sm', 'data'=>['method'=>'post', 'confirm'=>'Da li ste sigurni da želite da obrišete etažu i sve njene celine i prostorije? Proces ne može biti vraćen.']]);
                },                
            ],
            'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {
                    $url =['/project-building-storeys/view', 'id'=>$model->id];
                    return $url;
                }
                if ($action === 'update') {
                    $url = ['/project-building-storeys/update', 'id'=>$model->id];
                    return $url;
                }
                if ($action === 'delete') {
                    $url = ['/project-building-storeys/index', 'id'=>$model->project_id, 'remove_storey'=>$model->id];
                    return $url;
                }

            },
            'visibleButtons' => [
                'delete' => function ($model, $key, $index) {
                    return $model->storey == 'prizemlje' ? false : true;
                 }
            ]

        ],
    ];
    echo GridView::widget([
        'id' => 'grid',
        'dataProvider'=>$projectBuildingStoreys,
        //'filterModel'=>$searchModel,
        'columns'=>$gridColumns,
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'pjax'=>true, // pjax is set to always true for this demo
        // set your toolbar
        'toolbar'=> [
            ['content'=>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', Url::to(), ['data-toggle'=>'modal', 'data-backdrop'=>false, 'data-target'=>'#storey-modal'.$model->project_id, 'class'=>'btn btn-success']) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['', 'id'=>$model->project_id], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')])
            ],
            '{toggleData}',
        ],
        // set export properties
        'export'=>[
            'fontAwesome'=>true
        ],
        // parameters from the demo form
        'bordered'=>true,
        'striped'=>true,
        'condensed'=>true,
        'responsive'=>true,
        'hover'=>true,
        //'showPageSummary'=>true,
        /*'panel'=>[
            'type'=>GridView::TYPE_DEFAULT,
            'heading'=>'',
        ],*/
        'persistResize'=>true,
        //'perfectScrollbar'=>true,
        //'exportConfig'=>$exportConfig,
    ]);
?>