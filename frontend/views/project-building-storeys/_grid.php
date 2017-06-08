<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use kartik\editable\Editable;
use kartik\grid\ExpandRowColumn;

?>
<?php
    $gridColumns = [
        //['class' => 'kartik\grid\SerialColumn'],
        [
            'class'=>'kartik\grid\ExpandRowColumn',
            'width'=>'50px',
            'value'=>function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail'=>function ($model, $key, $index, $column) {
                return Yii::$app->controller->renderPartial('_part_list', ['model'=>$model]);
            },
            'headerOptions'=>['class'=>'kartik-sheet-style'],
            'expandOneOnly'=>true,
        ],
        [
            'label'=>'Sprat',
            'format' => 'raw',
            'value'=>function ($data) {

                return $data->projectBuilding->project->work!='adaptacija' ? Html::a($data->name.'@'.$data->level, ['project-building-storeys/update', 'id' => $data->id]) : $data->name.'@'.$data->level;
            },
            
        ],
        [
            'class'=>'kartik\grid\EditableColumn',
            'label'=>'Naziv sprata',
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
            'label'=>'h [m]',
            'width'=>'50px',
            'hAlign'=>'right',
            'editableOptions'=> function ($model, $key, $index) {
                return [
                    'header'=>'Spratna visina',
                    'size'=>'',
                    'placement' => 'top',              
                ];
            }
        ],
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'level',
            'label'=>'Rel. kota [m]',
            'width'=>'50px',
            'hAlign'=>'right',
            //'format'=>['decimal', 2],
            
            'editableOptions'=> function ($model, $key, $index) {
                return [
                    'header'=>'Relativna visinska kota',
                    'size'=>'',
                    'placement' => 'top',
                                  
                ];
            }
        ],         
        [
            'label'=>'Reduk. P [m2]',
            'format' => 'raw',
            'hAlign'=>'right',
            'pageSummary'=>true,
            'value'=>function ($data) {
                return $data->subNetArea;
            },
        ],
        [
            'label'=>'P netto [m2]',
            'format' => 'raw',
            'hAlign'=>'right',
            'pageSummary'=>true,
            'value'=>function ($data) {
                return $data->netArea;
            },
        ],
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'gross_area',
            'label'=>'P bruto [m2]',
            'hAlign'=>'right',
            'pageSummary'=>true,
            'editableOptions'=> function ($model, $key, $index) {
                return [
                    'header'=>'Bruto površina',
                    'size'=>'',
                    'placement' => 'top',              
                ];
            }
        ],
        
        /*[
            'class' => 'kartik\grid\ActionColumn',
            'header' => 'Jedinice/celine',
            'headerOptions' => ['style' => 'color:#337ab7'],
            //'template' => '{generateParts}{view}{update}{delete}',
            'template' => '{generateParts}',
            'buttons' => [                
                'generateParts' => function ($url, $model, $key) {
                    return $model->projectBuilding->project->work!='adaptacija' ? Html::a('<i class="fa fa-cubes"></i>', $url, ['class'=>'btn btn-primary btn-sm', 'style'=>'margin-right:10px;', 'data-toggle'=>'modal', 'data-backdrop'=>false, 'data-target'=>'#'.($model->projectBuildingStoreyParts ? '' : 'init-').'storey-parts-modal'.$model->id]) : null;
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
                    $url = ['/project-building-storeys/index', 'id'=>$model->id, 'remove_storey'=>$model->id];
                    return $url;
                }

            },
            'visibleButtons' => [
                'delete' => function ($model, $key, $index) {
                    return $model->storey == 'prizemlje' ? false : true;
                 }
            ]

        ],*/
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
                Html::a('<i class="glyphicon glyphicon-plus"></i>', Url::to(), ['data-toggle'=>'modal', 'data-backdrop'=>false, 'data-target'=>'#storey-modal'.$model->id, 'class'=>'btn btn-success']) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['', 'id'=>$model->id], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')])
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
        'responsive'=>false,
        'hover'=>true,
        'showPageSummary'=>true,
        /*'panel'=>[
            'type'=>GridView::TYPE_DEFAULT,
            'heading'=>'',
        ],*/
        'persistResize'=>true,
        //'perfectScrollbar'=>true,
        //'exportConfig'=>$exportConfig,
    ]);
?>