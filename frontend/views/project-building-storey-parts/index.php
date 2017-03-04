<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use kartik\editable\Editable;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectBuildingStoreysSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Površina jedinica objekta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Objekat'), 'url' => ['/project-building/view', 'id'=>$project->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Površine jedinica objekta'), 'url' => ['/project-building-storey-parts/index', 'id'=>$project->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Površine prostorija objekta'), 'url' => ['/project-building-storey-part-rooms/index', 'id'=>$project->id]];
?>
<div class="project-building-storeys-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    [
        'attribute'=>'project_building_storey_id',
        'format' => 'raw',
        'value'=>function ($data) {
            return Html::a($data->projectBuildingStorey->name, ['project-building-storeys/view', 'id' => $data->project_building_storey_id]);
        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\ProjectBuildingStoreys::find()->orderBy('level')->asArray()->all(), 'id', 'name'), 
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Any Storey'],
        'group'=>true,  // enable grouping
        'groupFooter'=>function ($model, $key, $index, $widget) { // Closure method
            return [
                'mergeColumns'=>[[1,4]], // columns to merge in summary
                'content'=>[             // content to show in each summary cell
                    1=>'Summary',                                        
                    5=>GridView::F_SUM,
                    6=>GridView::F_SUM,
                ],
                'contentFormats'=>[      // content reformatting for each summary cell
                    5=>['format'=>'number', 'decimals'=>2],
                    6=>['format'=>'number', 'decimals'=>2],
                ],
                'contentOptions'=>[      // content html attributes for each summary cell
                    1=>['style'=>'font-variant:small-caps'],
                    5=>['style'=>'text-align:right'],
                    6=>['style'=>'text-align:right'],
                ],
                // html attributes for group summary row
                'options'=>['class'=>'danger','style'=>'font-weight:bold;']
            ];
        }
    ],
    [
        'attribute'=>'mark',
        'format' => 'raw',
        'value'=>function ($data) {
            return Html::a($data->mark. ' '.$data->type, ['project-building-storey-parts/view', 'id' => $data->id]);
        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\ProjectBuildingStoreyParts::find()->asArray()->all(), 'id', 'mark'), 
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Any Part'],
        'group'=>true,  // enable grouping
        'subGroupOf'=>1,
    ],
    'structure',
    [
        'attribute'=>'name',
        'format' => 'raw',
        'value'=>function ($data) {
            return Html::a($data->name, ['project-building-storey-part-rooms/view', 'id' => $data->id]);
        },
        'filterType'=>GridView::FILTER_SELECT2,
        'filter'=>\yii\helpers\ArrayHelper::map(\common\models\ProjectBuildingStoreyParts::find()->orderBy('id')->asArray()->all(), 'id', 'fullname'), 
        'filterWidgetOptions'=>[
            'pluginOptions'=>['allowClear'=>true],
        ],
        'filterInputOptions'=>['placeholder'=>'Any Part'],
        //'group'=>true,  // enable grouping
    ],
    [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'area',
        'width'=>'50px',
        'hAlign'=>'right',
        'pageSummary'=>true,
        'editableOptions'=> function ($model, $key, $index) {
            return [
                'header'=>'Neto površina',
                'size'=>'xs',     
                'placement' => 'left',           
            ];
        }
    ],
    [
        'class' => '\kartik\grid\FormulaColumn',
        'value' => function ($model, $key, $index, $widget) {
            $p = compact('model', 'key', 'index');
            // Write your formula below
            return $widget->col(5, $p) *0.97;
        },
        //'format'=>['decimal', 2],
        'hAlign'=>'right',
        'width'=>'50px',
        'label'=>'3% redukovana',
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
    'condensed'=>false,
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
    'exportConfig' => [
        GridView::PDF => [
            'label' => Yii::t('app', 'PDF'),
            'icon' => 'file-pdf-o',
            'iconOptions' => ['class' => 'text-danger'],
            'showHeader' => false,
            'showPageSummary' => false,
            'showFooter' => false,
            'showCaption' => false,
            //'filename' => Yii::t('kvgrid', 'grid-export'),
            //'alertMsg' => Yii::t('kvgrid', 'The PDF export file will be generated for download.'),
            //'options' => ['title' => Yii::t('kvgrid', 'Portable Document Format')],
            'mime' => 'application/pdf',
            'config' => [
                'mode' => 'c',
                'format' => 'A4-P',
                'destination' => 'D',
                'marginTop' => 20,
                'marginBottom' => 20,
                'cssInline' => '.kv-wrap{padding:20px;}' .
                    '.kv-align-center{text-align:center;}' .
                    '.kv-align-left{text-align:left;}' .
                    '.kv-align-right{text-align:right;}' .
                    '.kv-align-top{vertical-align:top!important;}' .
                    '.kv-align-bottom{vertical-align:bottom!important;}' .
                    '.kv-align-middle{vertical-align:middle!important;}' .
                    '.kv-page-summary{border-top:4px double #ddd;font-weight: bold;}' .
                    '.kv-table-footer{border-top:4px double #ddd;font-weight: bold;}' .
                    '.kv-table-caption{font-size:1.5em;padding:8px;border:1px solid #ddd;border-bottom:none;}'.
                    '.body{font-family:"Arial, sans-serif";}',
                'methods' => [
                    
                ],
                'options' => [
                    //'title' => $title,
                    //'subject' => Yii::t('kvgrid', 'PDF export generated by kartik-v/yii2-grid extension'),
                    //'keywords' => Yii::t('kvgrid', 'krajee, grid, export, yii2-grid, pdf')
                ],
                'contentBefore'=>'',
                'contentAfter'=>''
            ]
        ],
    ],
]);
?>




