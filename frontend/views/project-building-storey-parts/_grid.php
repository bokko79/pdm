<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use kartik\editable\Editable;

?>
<?php
    ${"gridColumns" . $storey->id} = [
        ['class' => 'kartik\grid\SerialColumn'],
        [
            'label'=>'Etaža',
            'format' => 'raw',
            'value'=>function ($data) {
                $st = $data->projectBuildingStoreyPart->projectBuildingStorey;
                return Html::a($st->name.' @ '.$st->level.'<br>('.$st->gross_area.'m<sup>2</sup>)', ['project-building-storeys/update', 'id' => $st->id]);
            },
            'group'=>true,  // enable grouping
            'groupFooter'=>function ($model, $key, $index, $widget) { // Closure method
                return [
                    'mergeColumns'=>[[1,5]], // columns to merge in summary
                    'content'=>[             // content to show in each summary cell
                        1=>'Summary (' . $model->name . ')',                                        
                        6=>GridView::F_SUM,
                        7=>GridView::F_SUM,
                    ],
                    'contentFormats'=>[      // content reformatting for each summary cell
                        6=>['format'=>'number', 'decimals'=>2],
                        7=>['format'=>'number', 'decimals'=>2],
                    ],
                    'contentOptions'=>[      // content html attributes for each summary cell
                        1=>['style'=>'font-variant:small-caps'],
                        6=>['style'=>'text-align:right'],
                        7=>['style'=>'text-align:right'],
                    ],
                    // html attributes for group summary row
                    'options'=>['class'=>'danger','style'=>'font-weight:bold;']
                ];
            }
        ],
        [
            'attribute'=>'project_building_storey_part_id',
            'format' => 'raw',
            'value'=>function ($data) {
                return Html::a($data->projectBuildingStoreyPart->fullType. ' '.$data->projectBuildingStoreyPart->mark, ['project-building-storey-parts/update', 'id' => $data->project_building_storey_part_id]);
            },
            'group'=>true,  // enable grouping
            'groupFooter'=>function ($model, $key, $index, $widget) { // Closure method
                return [
                    'mergeColumns'=>[[1,5]], // columns to merge in summary
                    'content'=>[             // content to show in each summary cell
                        1=>'Summary (' . $model->name . ')',                                        
                        6=>GridView::F_SUM,
                        7=>GridView::F_SUM,
                    ],
                    'contentFormats'=>[      // content reformatting for each summary cell
                        6=>['format'=>'number', 'decimals'=>2],
                        7=>['format'=>'number', 'decimals'=>2],
                    ],
                    'contentOptions'=>[      // content html attributes for each summary cell
                        1=>['style'=>'font-variant:small-caps'],
                        6=>['style'=>'text-align:right'],
                        7=>['style'=>'text-align:right'],
                    ],
                    // html attributes for group summary row
                    'options'=>['class'=>'danger','style'=>'font-weight:bold;']
                ];
            },
            'subGroupOf'=>1,
        ],
        [
            'attribute'=>'projectBuildingStoreyPart.mark',            
            'group'=>true,  // enable grouping
            'subGroupOf'=>2,
        ],
        [
            'attribute'=>'roomType.name',
            'format' => 'raw',
            'value'=>function ($data) {
                return Html::a($data->roomType->name, ['project-building-storey-part-rooms/update', 'id' => $data->id]);
            },
            //'group'=>true,  // enable grouping
        ], 
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'mark',
            'width'=>'50px',
            //'format'=>['decimal', 2],
            //'pageSummary'=>true,
            'editableOptions'=> function ($model, $key, $index) {
                return [
                    'header'=>'Oznaka',
                    'size'=>'md',
                    //'asPopover' => false,
                    //'inputType' => Editable::INPUT_HTML5_INPUT,
                    'placement' => 'left',              
                ];
            }
        ],                               
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'name',
            //'pageSummary'=>true,
            'editableOptions'=> function ($model, $key, $index) {
                return [
                    'header'=>'Naziv',
                    'size'=>'md',
                    //'asPopover' => false,
                    //'inputType' => Editable::INPUT_HTML5_INPUT,
                    'placement' => 'left',              
                ];
            }
        ],
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'flooring',
            //'format'=>['decimal', 2],
            //'pageSummary'=>true,
            'editableOptions'=> function ($model, $key, $index) {
                return [
                    'header'=>'Obrada poda',
                    'size'=>'md',
                    //'asPopover' => false,
                    //'inputType' => Editable::INPUT_HTML5_INPUT,
                    'placement' => 'left', 
                    'data' => [ 'parket' => 'Parket', 'keramika' => 'Keramika', 'estrih' => 'Estrih', 'tarkett' => 'Tarkett', 'beton' => 'Beton', 'opeka' => 'Opeka', 'kamen' => 'Kamen', 'teraco' => 'Teraco', 'zemlja' => 'Zemlja', 'tepih' => 'Tepih', 'drugo' => 'Drugo', ],

                    'inputType' => Editable::INPUT_DROPDOWN_LIST,             
                ];
            }
        ],
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'sub_net_area',
            'width'=>'50px',
            'hAlign'=>'right',
            //'format'=>['decimal', 2],
            //'pageSummary'=>true,
            'editableOptions'=> function ($model, $key, $index) {
                return [
                    'header'=>'Neto redukovana površina',
                    'size'=>'md',
                    //'asPopover' => false,
                    //'inputType' => Editable::INPUT_HTML5_INPUT,
                    'placement' => 'left',              
                ];
            }
        ],
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'net_area',
            'width'=>'50px',
            'hAlign'=>'right',
            //'format'=>['decimal', 2],
            'pageSummary'=>true,
            'editableOptions'=> function ($model, $key, $index) {
                return [
                    'header'=>'Neto površina',
                    'size'=>'md',
                    //'asPopover' => false,
                    //'inputType' => Editable::INPUT_HTML5_INPUT,
                    'placement' => 'left',
                                  
                ];
            }
        ],
        /*[
            'attribute'=>'type',
            'format' => 'raw',
            'value'=>function ($data) {
                return Html::a($data->fullType, ['project-building-storey-part-rooms/update', 'id' => $data->id]);
            },
            //'group'=>true,  // enable grouping
        ], 
        'mark',
        'structure',
        'name',
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
        ],*/
    ];
    echo GridView::widget([
        'id' => 'grid'.$storey->id,
        'dataProvider'=>$projectBuildingStoreyPartRooms,
        //'filterModel'=>$searchModel,
        'columns'=>${"gridColumns" . $storey->id},
        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
        'pjax'=>true, // pjax is set to always true for this demo
        // set your toolbar
        'toolbar'=> [
            ['content'=>
                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>Yii::t('app', 'Add Book'), 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['', 'id'=>$model->project_id], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')])
            ],
            '{export}',
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
        'panel'=>[
            'type'=>GridView::TYPE_DEFAULT,
            'heading'=>$storey->storey,
        ],
        'persistResize'=>true,
        //'perfectScrollbar'=>true,
        //'exportConfig'=>$exportConfig,
    ]);
?>