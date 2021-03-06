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

?>


            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <?php /*<div class="primary-context gray normal">
                    <div class="head"><?= Html::a(c($model->projectBuildingStorey->name), Url::to(['/project-building-storeys/view', 'id'=>$model->project_building_storey_id])) ?> <i class="fa fa-arrow-circle-right hint small"></i> <?= c($model->name) ?> <?= $model->mark ?>: <?= $model->mode=='new' ? 'Predviđeno stanje' : 'Postojeće stanje'; ?>
                        <div class="action-area normal-case"><?= ($model->projectBuildingStorey->projectBuilding->project->work=='adaptacija') ? Html::a('<i class="fa fa-cog"></i> Podesi jedinicu', Url::to(['update', 'id'=>$model->id]), ['class'=>'btn btn-success ', 'style'=>'margin-right:10px;']) : null ?> <?= Html::a('<i class="fa fa-cubes"></i>', Url::to(['']), ['class'=>'btn btn-primary btn-sm', 'style'=>'margin-right:10px;', 'data-toggle'=>'modal', 'data-backdrop'=>false, 'data-target'=>'#init-rooms-modal'.$model->id]) ?> <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Dodaj prostoriju', Url::to(['/project-building-storey-part-rooms/create', 'ProjectBuildingStoreyPartRooms[project_building_storey_part_id]'=>$model->id]), ['class' => 'btn btn-primary btn-sm']) ?></div>
                    </div>
                </div> */ ?>
                <div class="secondary-context">               

                <?php
                    $gridColumns = [
                       // ['class' => 'kartik\grid\SerialColumn'],
                        [
                            'attribute'=>'project_building_storey_part_id',
                            'format' => 'raw',
                            'label' => 'Jed.',
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
                        ],
                        [
                            'class'=>'kartik\grid\EditableColumn',
                            'attribute'=>'mark',
                            'label' => 'Ozn.',
                            'width'=>'50px',
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
                            'label' => 'Reduk. P',
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
                            'label' => 'P netto',
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
                        /*[
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
                        ],*/
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
                    ]);
                    ?>
                </div>
            </div> 
        
<?php
    Modal::begin([
        'id'=>'init-rooms-modal'.$model->id,
        'size'=>Modal::SIZE_LARGE,
        'class'=>'overlay_modal',
        'header'=> '<h3>Prostorije</h3>',
    ]); ?>
        <div id="loading"><i class="fa fa-cog fa-spin fa-3x gray-color"></i></div>
    <?php Modal::end(); ?>
