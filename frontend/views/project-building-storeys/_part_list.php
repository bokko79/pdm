<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\bootstrap\Modal;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingStoreys */
$work = $model->projectBuilding->project->work;
?>

        
    <div class="card_container record-full grid-item transparent no-shadow" id="">
        <div class="primary-context normal">
            <div class="head second">Lista jedinica (celina)
            <?php if(!$model->sameAs): ?>
               <div class="subaction"><?php // Html::a('<i class="fa fa-cubes"></i>', Url::to(['']), ['class'=>'btn btn-primary btn-sm', 'style'=>'margin-right:10px;', 'data-toggle'=>'modal', 'data-backdrop'=>false, 'data-target'=>'#'.($model->projectBuildingStoreyParts ? '' : 'init-').'storey-parts-modal'.$model->id]) ?> <?php // Html::a('<i class="fa fa-cog"></i> Podešavanje etaže', Url::to(['/project-building-storeys/update', 'id'=>$model->id]), ['class' => 'btn btn-success btn-sm']) ?> <?php /* if(!$model->copies and $model->storey!='prizemlje'): ?><?= Html::a('<i class="fa fa-power-off"></i>', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => Yii::t('app', 'Da li ste sigurni da želite da obrišete celu etažu, sa svim prostorijama?'),
                            'method' => 'post',
                        ],
                    ]) ?><?php endif; */ ?>
                </div>
            <?php endif; ?>
            </div>
        </div>
        <div class="secondary-context">               

        <?php
            $gridColumns = [
                //['class' => 'kartik\grid\SerialColumn'],
                //'fullType',
                /*[
                    'class'=>'kartik\grid\ExpandRowColumn',
                    'width'=>'50px',
                    'value'=>function ($model, $key, $index, $column) {
                        return GridView::ROW_COLLAPSED;
                    },
                    'detail'=>function ($model, $key, $index, $column) {
                        return Yii::$app->controller->renderPartial('_room_list', ['model'=>$model, 'projectBuildingStoreyPartRooms' => new ActiveDataProvider([
                'query' => \common\models\ProjectBuildingStoreyPartRooms::find()->where(['project_building_storey_part_id' => $model->id])->orderBy('CAST(mark AS UNSIGNED)'),
            ])]);
                    },
                    'headerOptions'=>['class'=>'kartik-sheet-style'],
                    'expandOneOnly'=>true,
                ], */
                [
                    'attribute'=>'mark',
                    'width'=>'50px',
                ],
                'name',
                [
                    'attribute'=>'structure',
                    'width'=>'50px',
                    'hAlign'=>'right',
                ],
                [
                    'attribute'=>'subNetArea',
                    'label' => 'Reduk. P',
                    'width'=>'50px',
                    'hAlign'=>'right',
                ],
                [
                    'attribute'=>'netArea',
                    'label' => 'P netto',
                    'width'=>'50px',
                    'hAlign'=>'right',
                ],
                /*[
                    'class' => 'kartik\grid\ActionColumn',
                    'header' => 'Opcije',
                    'headerOptions' => ['style' => 'color:#337ab7'],
                    //'template' => '{generateRooms}{view}{update}{delete}',
                    'template' => '{delete}',
                    'buttons' => [                
                        'generateRooms' => function ($url, $model, $key) {
                            return Html::a('<i class="fa fa-cubes"></i>', $url, ['class'=>'btn btn-primary btn-sm', 'style'=>'margin-right:10px;', 'data-toggle'=>'modal', 'data-backdrop'=>false, 'data-target'=>'#'.($model->projectBuildingStoreyPartRooms ? 'init-' : 'init-').'rooms-modal'.$model->id]);
                        },
                        'view' => function ($url, $model, $key) {
                            return Html::a('<i class="fa fa-eye"></i>', $url, ['class'=>'btn btn-default btn-sm', 'style'=>'margin-right:10px;']);
                        },

                        'update' => function ($url, $model, $key) {
                            return Html::a('<i class="fa fa-wrench"></i>', $url, ['class'=>'btn btn-default btn-sm', 'style'=>'margin-right:10px;']);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('<i class="fa fa-power-off"></i>', $url, ['class'=>'btn btn-danger btn-sm', 'style'=>'margin-right:10px;']);
                        },                
                    ],
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'view') {
                            $url =['/project-building-storey-parts/view', 'id'=>$model->id];
                            return $url;
                        }
                        if ($action === 'update') {
                            $url = ['/project-building-storey-parts/update', 'id'=>$model->id];
                            return $url;
                        }
                        if ($action === 'delete') {
                            $url = ['/project-building-storey-parts/delete', 'id'=>$model->id];
                            return $url;
                        }

                    },
                    /*'visibleButtons' => [
                        'generateRooms' => function ($model, $key, $index) {
                            return $model->projectBuildingStoreyPartRooms ? false : true;
                         }
                    ]*/

                /*],*/
            ];
            echo GridView::widget([
                'id' => 'kv-grid-storeys',
                'dataProvider'=>$model->parts,
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
                //'showPageSummary'=>true,
                /*'panel'=>[
                    'type'=>GridView::TYPE_DEFAULT,
                    'heading'=>'Površine',
                ],*/
                'persistResize'=>true,
                //'perfectScrollbar'=>true,
                //'exportConfig'=>$exportConfig,
            ]);
            ?>
        </div>
    </div> 