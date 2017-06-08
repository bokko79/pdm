<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use kartik\editable\Editable;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\bootstrap\Nav;
use common\widgets\Alert;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingStoreyParts */

$this->title = c($model->name) . '  '. $model->mark;

$this->params['page_title'] = 'Objekat';
$this->params['page_title_2'] = 'Površine';
$this->params['page_title_3'] = c($model->projectBuildingStorey->name);
$this->params['page_title_4'] = c($model->name). ' ' . $model->mark ?: null;

$this->params['building'] = $model->projectBuildingStorey->projectBuilding;
$this->params['storey'] = $model->projectBuildingStorey;
$this->params['part'] = $model;

$this->params['breadcrumbs'][] = ['label' => '<i class="fa fa-home"></i> '.$model->projectBuildingStorey->projectBuilding->name, 'url' => ['/project-building/view', 'id'=>$model->projectBuildingStorey->projectBuilding->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Površine objekta'), 'url' => ['/project-building-storeys/index', 'id'=>$model->projectBuildingStorey->project_building_id]];
$this->params['breadcrumbs'][] = ['label' => c($model->projectBuildingStorey->name), 'url' => ['/project-building-storeys/view', 'id'=>$model->projectBuildingStorey->project_building_id]];
$this->params['breadcrumbs'][] = $this->title;

$this->params['project'] = $model->projectBuildingStorey->projectBuilding->project;
?>

<div class="card_container record-full grid-item fadeInUp no-shadow no-margin animated-not no-float" id="">
    <div class="primary-context normal aliceblue bottom-bordered">
        <div class="head colos">
            <div class="subaction">
                
                <?= ($model->projectBuildingStorey->projectBuilding->project->work=='adaptacija') ? Html::a('<i class="fa fa-cog"></i>', Url::to(['update', 'id'=>$model->id]), ['class'=>'btn btn-link ']) : null ?> <?= Html::a('<i class="fa fa-cubes fa-2x"></i>', Url::to(['']), ['class'=>'btn btn-link', 'data-toggle'=>'modal', 'data-backdrop'=>false, 'data-target'=>'#init-rooms-modal'.$model->id]) ?> <?= Html::a('<i class="fa fa-plus fa-2x"></i>', Url::to(['/project-building-storey-part-rooms/create', 'ProjectBuildingStoreyPartRooms[project_building_storey_part_id]'=>$model->id]), ['class' => 'btn btn-link']) ?>
                <?= Html::a('<i class="fa fa-life-saver fa-2x"></i>', null, ['class' => 'btn btn-link button_to_show_secondary']) ?>
            </div>
            <i class="fa fa-superscript"></i> Površine prostorija <span class="fs_12">(<?= $model->projectBuildingStorey->projectBuilding->state ?>)</span>
         </div>
        <div class="subhead">Upravljanje spratovima, jedinicama i prostorijama objekta objekta.</div>
    </div>  
    <div class="primary-context aliceblue bottom-bordered" style="display: none;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5 text">
                    <h5>Upravljanje dokumentima projekta</h5>
                    <h6>Dodavanje dokumenta projekta.</h6>
                    <p>Novi dokument projekta.</p>
                    <h6>Podešavanje dokumenta projekta.</h6>
                    <p>Podešavanje dokumenta projekta.</p>
                    <h6>Uklanjanje dokumenta projekta.</h6>
                    <p>Uklanjanje dokumenta projekta.</p>
                </div>
                <div class="col-sm-7">
                    <p><iframe src="//www.youtube.com/embed/sDYVYgiGW3c" width="100%" height="314" allowfullscreen="allowfullscreen"></iframe></p>
                </div>
            </div>
        </div>          
    </div>
</div>

<div class="container-fluid listed">
    <div class="row">
        <div class="index w200">
         <?php if($model->projectBuildingStorey->projectBuilding->project->work!='adaptacija'): ?>
            <?= $this->render('/project-building-storeys/_menu', [
                    'model' => $model->projectBuildingStorey->projectBuilding,  
                    'unit' => $model,
                ]) ?>        
        <?php endif; ?>
        </div>
        <div class="content view">
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head"><?= Html::a(c($model->projectBuildingStorey->name), Url::to(['/project-building-storeys/view', 'id'=>$model->project_building_storey_id])) ?> <i class="fa fa-arrow-circle-right hint small"></i> <?= c($model->name) ?> <?= $model->mark ?>: <?= $model->mode=='new' ? 'Predviđeno stanje' : 'Postojeće stanje'; ?>
                    </div>
                </div>
                <div class="secondary-context">               

                <?php
                    $gridColumns = [
                        //['class' => 'kartik\grid\SerialColumn'],
                        /*[
                            'attribute'=>'project_building_storey_part_id',
                            'format' => 'raw',
                            'value'=>function ($data) {
                                return Html::a($data->projectBuildingStoreyPart->fullType. ' '.$data->projectBuildingStoreyPart->mark, ['project-building-storey-parts/view', 'id' => $data->project_building_storey_part_id]);
                            },
                            'filterType'=>GridView::FILTER_SELECT2,
                            'filter'=>\yii\helpers\ArrayHelper::map(\common\models\ProjectBuildingStoreyParts::find()->orderBy('id')->asArray()->all(), 'id', 'fullname'), 
                            'filterWidgetOptions'=>[
                                'pluginOptions'=>['allowClear'=>true],
                            ],
                            'filterInputOptions'=>['placeholder'=>'Any Part'],
                            'group'=>true,  // enable grouping
                            'groupFooter'=>function ($model, $key, $index, $widget) { // Closure method
                                return [
                                    'mergeColumns'=>[[1,4]], // columns to merge in summary
                                    'content'=>[             // content to show in each summary cell
                                        1=>'Summary (' . $model->projectBuildingStoreyPart->projectBuildingStorey->name . ')',                                        
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
                        ],*/
                        [
                            'class'=>'kartik\grid\EditableColumn',
                            'attribute'=>'mark',
                            'label'=>'br.',
                            'width'=>'40px',
                            'pageSummary'=>true,
                            'editableOptions'=> function ($model, $key, $index) {
                                return [
                                    'header'=>'Oznaka prostorije',
                                    'placement' => 'top',
                                    'pluginEvents' => [
                                        "editableChange"=>"function(event, val) { console.log('Changed Value ' + val); }",
                                        
                                    ],
                                ];
                            },
                                    
                        ],                                            
                        [
                            'class'=>'kartik\grid\EditableColumn',
                            'attribute'=>'name',
                            'width'=>'150px',
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
                            'label'=>'Pod',
                            'width'=>'110px',
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
                            'label'=>'reduk P[2]',
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
                            'label'=>'P[m2]',
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
                                    return Html::a('<i class="fa fa-times"></i>', $url, ['class'=>'btn btn-danger btn-sm', 'data'=>['method'=>'post', 'confirm'=>'Da li ste sigurni da želite da obrišete prostoriju?']]);
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
                        'id' => 'kv-grid-parts',
                        'dataProvider'=>$projectBuildingStoreyPartRooms,
                        //'filterModel'=>$searchModel,
                        'columns'=>$gridColumns,
                        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
                        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
                        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
                        'pjax'=>true, // pjax is set to always true for this demo                        
                        'bordered'=>true,
                        'striped'=>true,
                        'condensed'=>true,
                        'responsive'=>true,
                        'hover'=>true,                        
                        'persistResize'=>true,
                        'showPageSummary' => true,
                    ]);
                    ?>
                </div>
            </div> 
        </div>
    </div>
<?php if($model->projectBuildingStorey->projectBuilding->project->work=='adaptacija'): ?>
    <div class="row">
        <div class="col-sm-9 col-sm-offset-3">
            <?= $this->render('tabs/_characteristics', [
                    'model' => $model,  
                ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-9 col-sm-offset-3">
            <?= $this->render('tabs/_structure', [
                    'model' => $model,  
                ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-9 col-sm-offset-3">
            <?= $this->render('tabs/_materials', [
                    'model' => $model,  
                ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-9 col-sm-offset-3">
            <?= $this->render('tabs/_insulations', [
                    'model' => $model,  
                ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-9 col-sm-offset-3">
            <?= $this->render('tabs/_services', [
                    'model' => $model,  
                ]) ?>
        </div>
    </div>
<?php endif; ?>
</div>


