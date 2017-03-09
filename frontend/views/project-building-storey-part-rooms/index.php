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
$this->params['breadcrumbs'][] = ['label' => 'Objekat', 'url' => ['/project-building/view', 'id' => $project->id]];
$this->params['breadcrumbs'][] = ['label' => 'Etaže', 'url' => ['/project-building-storeys/index', 'id' => $project->id]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['project'] = $project;
?>

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
        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\ProjectBuildingStoreys::find()->where('project_id='.$project->id)->orderBy('id')->asArray()->all(), 'id', 'name'), 
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
            return Html::a($data->projectBuildingStoreyPart->mark. ' '.$data->projectBuildingStoreyPart->fullType, ['project-building-storey-parts/view', 'id' => $data->project_building_storey_part_id]);
        },
        /*'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\ProjectBuildingStoreyParts::find()->innerJoin('project_building_storeys as pbs')->where('pbs.project_id='.$project->id)->orderBy('project_building_storey_parts.id')->groupBy('id')->asArray()->all(), 'id', 'name'), 
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Bilo koja'],*/
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
    [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'mark',
        'width'=>'50px',
        'hAlign'=>'right',
        //'format'=>['decimal', 2],
        'pageSummary'=>true,
        'editableOptions'=> function ($model, $key, $index) {
            return [
                'header'=>'Oznaka prostorije',
                'size'=>'',
                'placement' => 'top',              
            ];
        }
    ],
    [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'name',
        /*'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\ProjectBuildingStoreyPartRooms::find()->innerJoin('project_building_storey_parts as pbsp')->innerJoin('project_building_storeys as pbs')->where('pbs.project_id='.$project->id)->groupBy('pbs.id')->asArray()->all(), 'id', 'name'), 
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Bilo koja'],*/
        'pageSummary'=>true,
        'editableOptions'=> function ($model, $key, $index) {
            return [
                'header'=>'Bliži naziv prostorije',
                'placement' => 'top',              
            ];
        }
    ],   
    [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'flooring',
        'pageSummary'=>true,
        'editableOptions'=> function ($model, $key, $index) {
            return [
                'header'=>'Obrada poda',
                'placement' => 'top',  
                'inputType' => Editable::INPUT_DROPDOWN_LIST,
                'data' => [ 'parket' => 'Parket', 'keramika' => 'Keramika', 'estrih' => 'Estrih', 'tarkett' => 'Tarkett', 'beton' => 'Beton', 'opeka' => 'Opeka', 'kamen' => 'Kamen', 'teraco' => 'Teraco', 'zemlja' => 'Zemlja', 'tepih' => 'Tepih', 'drugo' => 'Drugo', ],            
            ];
        }
    ],                   
    
    [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'sub_net_area',
        'width'=>'50px',
        'hAlign'=>'right',
        'pageSummary'=>true,
        'editableOptions'=> function ($model, $key, $index) {
            return [
                'header'=>'Neto redukovana površina',
                'placement' => 'top',              
            ];
        }
    ],
    [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'net_area',
        'width'=>'50px',
        'hAlign'=>'right',
        'pageSummary'=>true,
        'editableOptions'=> function ($model, $key, $index) {
            return [
                'header'=>'Neto površina',
                'placement' => 'top',                                                 
            ];
        }
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'header' => 'Opcije',
        'headerOptions' => ['style' => 'color:#337ab7'],
        'template' => '{update}{delete}',
        'buttons' => [
            'update' => function ($url, $model, $key) {
                return Html::a('<i class="fa fa-wrench"></i>', $url, ['class'=>'btn btn-default btn-sm', 'style'=>'margin-right:10px;']);
            },
            'delete' => function ($url, $model, $key) {
                return Html::a('<i class="fa fa-power-off"></i>', $url, ['class'=>'btn btn-danger btn-sm', 'data'=>['method'=>'post', 'confirm'=>'Da li ste sigurni da želite da obrišete prostoriju?']]);
            },                
        ],
        'urlCreator' => function ($action, $model, $key, $index) {
            if ($action === 'update') {
                $url = ['/project-building-storey-part-rooms/update', 'id'=>$model->id];
                return $url;
            }
            if ($action === 'delete') {
                $url = ['/project-building-storey-part-rooms/delete', 'id'=>$model->id];
                return $url;
            }
        }
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
    'pjax'=>true,
    'bordered'=>true,
    'striped'=>true,
    'condensed'=>true,
    'responsive'=>true,
    'hover'=>true,
    'persistResize'=>false,
    'toolbar'=> [
        '{toggleData}',
    ],
    'panel'=>[
        'type'=>GridView::TYPE_DEFAULT,
        //'heading'=>$storey->storey,
    ],
]);
?>
