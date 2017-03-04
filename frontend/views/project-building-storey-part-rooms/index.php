<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\editable\Editable;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectBuildingStoreyPartRoomsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Površine prostorija');
$this->params['breadcrumbs'][] = ['label' => 'Etaže', 'url' => ['/project-building/storeys', 'id' => $project->id]];
$this->params['breadcrumbs'][] = ['label' => 'Površine jedinica', 'url' => ['/project-building-storey-parts/index', 'id' => $project->id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php
$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'label'=>'Etaža',
        'format' => 'raw',
        'value'=>function ($data) {
            return Html::a($data->projectBuildingStoreyPart->projectBuildingStorey->name, ['project-building-storeys/view', 'id' => $data->projectBuildingStoreyPart->project_building_storey_id]);
        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\ProjectBuildingStoreys::find()->orderBy('id')->asArray()->all(), 'id', 'name'), 
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Any Storey'],
        'group'=>true,  // enable grouping
        'groupFooter'=>function ($model, $key, $index, $widget) { // Closure method
            return [
                'mergeColumns'=>[[1,5]], // columns to merge in summary
                'content'=>[             // content to show in each summary cell
                    1=>'Summary (' . $model->projectBuildingStoreyPart->projectBuildingStorey->name . ')',
                    //6=>GridView::F_SUM,
                    //7=>GridView::F_SUM,
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
            return Html::a($data->projectBuildingStoreyPart->mark. ' '.$data->projectBuildingStoreyPart->type, ['project-building-storey-parts/view', 'id' => $data->project_building_storey_part_id]);
        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\ProjectBuildingStoreyParts::find()->orderBy('id')->asArray()->all(), 'id', 'fullname'), 
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Any Part'],
        'group'=>true,  // enable grouping
        'subGroupOf'=>1,
        'groupFooter'=>function ($model, $key, $index, $widget) { // Closure method
            return [
                'mergeColumns'=>[[2,5]], // columns to merge in summary
                'content'=>[             // content to show in each summary cell
                    1=>'Summary (' . $model->projectBuildingStoreyPart->projectBuildingStorey->name . ')',
                    //6=>GridView::F_SUM,
                    //7=>GridView::F_SUM,
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
    'mark',
    [
        'attribute'=>'name',
        'format' => 'raw',
        'value'=>function ($data) {
            return Html::a($data->name, ['project-building-storey-part-rooms/view', 'id' => $data->id]);
        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\ProjectBuildingStoreyPartRooms::find()->orderBy('id')->asArray()->all(), 'id', 'fullname'), 
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Any Part'],
        //'group'=>true,  // enable grouping
    ],
    'flooring',
    [
        'attribute'=>'sub_net_area',
        'width'=>'150px',
        'hAlign'=>'right',
        //'format'=>['decimal', 2],
        'pageSummary'=>true
    ],
    [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'net_area',
        'width'=>'150px',
        'hAlign'=>'right',
        //'format'=>['decimal', 2],
        'pageSummary'=>true,
        'editableOptions'=> function ($model, $key, $index) {
            return [
                'header'=>'Neto površina',
                'size'=>'md',                
            ];
        }
    ],
    //'level',
    //'gross_area',
    //['class' => 'kartik\grid\ActionColumn', 'urlCreator'=>function(){return '#';}]
];
echo GridView::widget([
    'id' => 'kv-grid-demo',
    'dataProvider'=>$dataProvider,
    'filterModel'=>$searchModel,
    'columns'=>$gridColumns,
    'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
    'headerRowOptions'=>['class'=>'kartik-sheet-style'],
    'filterRowOptions'=>['class'=>'kartik-sheet-style'],
    'pjax'=>true, // pjax is set to always true for this demo
    // set your toolbar
    'toolbar'=> [
        ['content'=>
            Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>Yii::t('app', 'Add Book'), 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['', 'id'=>$project->id], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')])
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
        'heading'=>'Površine',
    ],
    'persistResize'=>false,
    //'perfectScrollbar'=>true,
    //'exportConfig'=>$exportConfig,
]);
?>
