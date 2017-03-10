<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingStoreys */

$this->title = $model->name. ' - ' . $model->storey;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Etaže objekta'), 'url' => ['/project-building-storeys/index', 'id'=>$model->project_id]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container">       
    
    
    <div class="row">
        <div class="col-sm-12">
        
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head"><?= Html::a(c('<i class="fa fa-home"></i> '.$model->project->projectBuilding->name), Url::to(['/project-building-storeys/index', 'id'=>$model->project_id])) ?> <i class="fa fa-arrow-circle-right hint small"></i> <?= c($model->name) ?>: Lista jedinica (celina)
                    <?php if(!$model->sameAs): ?>
                       <div class="action-area normal-case"><?= Html::a('<i class="fa fa-cog"></i> Podešavanje etaže', Url::to(['/project-building-storeys/update', 'id'=>$model->id]), ['class' => 'btn btn-success btn-sm']) ?> <?php if(!$model->copies and $model->storey!='prizemlje'): ?><?= Html::a('<i class="fa fa-power-off"></i>', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => Yii::t('app', 'Da li ste sigurni da želite da obrišete celu etažu, sa svim prostorijama?'),
                                    'method' => 'post',
                                ],
                            ]) ?><?php endif; ?>
                        </div>
                    <?php endif; ?>
                    </div>
                    <div class="subhead">Kota: <?= $model->level ?>; Bruto: <?= $model->gross_area ?> m<sup>2</sup>; Netto: <?= $model->netArea ?> m<sup>2</sup></div>
                </div>
                <div class="secondary-context">               

                <?php
                    $gridColumns = [
                        ['class' => 'kartik\grid\SerialColumn'],
                        'fullType',
                        'name',                      
                        [
                            'class'=>'kartik\grid\EditableColumn',
                            'attribute'=>'mark',
                            'width'=>'50px',
                            //'format'=>['decimal', 2],
                            'pageSummary'=>true,
                            'editableOptions'=> function ($model, $key, $index) {
                                return [
                                    'header'=>'Oznaka jedinice',
                                    'placement' => 'top',              
                                ];
                            }
                        ],
                        [
                            'class'=>'kartik\grid\EditableColumn',
                            'attribute'=>'structure',
                            'width'=>'50px',
                            'hAlign'=>'right',
                            //'format'=>['decimal', 2],
                            'pageSummary'=>true,
                            'editableOptions'=> function ($model, $key, $index) {
                                return [
                                    'header'=>'Struktura jedinice',
                                    'placement' => 'top', 
                                    'data' => [ 'garsonjera' => 'Garsonjera', 'jednosoban' => 'Jednosoban', 'jednoiposoban' => 'Jednoiposoban', 'dvosoban' => 'Dvosoban', 'dvoiposoban' => 'Dvoiposoban', 'trosoban' => 'Trosoban', 'troiposoban' => 'Troiposoban', 'četvorosoban' => 'četvorosoban', 'četvoroiposoban' => 'četvoroiposoban', 'petosoban' => 'Petosoban', 'visesoban' => 'Visesoban', ],

                                    'inputType' => Editable::INPUT_DROPDOWN_LIST,             
                                ];
                            }
                        ],
                        'subNetArea',
                        'netArea',
                        [
                            'class' => 'kartik\grid\ActionColumn',
                            'header' => 'Opcije',
                            'headerOptions' => ['style' => 'color:#337ab7'],
                            'template' => '{generateRooms}{view}{update}{delete}',
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

                        ],
                    ];
                    echo GridView::widget([
                        'id' => 'kv-grid-demo',
                        'dataProvider'=>$model->parts,
                        //'filterModel'=>$searchModel,
                        'columns'=>$gridColumns,
                        'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
                        'headerRowOptions'=>['class'=>'kartik-sheet-style'],
                        'filterRowOptions'=>['class'=>'kartik-sheet-style'],
                        'pjax'=>true, // pjax is set to always true for this demo
                        // set your toolbar
                        'toolbar'=> [
                            ['content'=>
                                Html::button('<i class="glyphicon glyphicon-plus"></i>', ['type'=>'button', 'title'=>Yii::t('app', 'Add Book'), 'class'=>'btn btn-success', 'onclick'=>'alert("This will launch the book creation form.\n\nDisabled for this demo!");']) . ' '.
                                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['', 'id'=>$model->id], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')])
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
        </div>
    </div>   

<?php
if($parts = $model->projectBuildingStoreyParts){
    foreach($parts as $part){
        /*if($part->projectBuildingStoreyPartRooms){
            Modal::begin([
                'id'=>'rooms-modal'.$part->id,
                'size'=>Modal::SIZE_LARGE,
                'class'=>'overlay_modal',
                'header'=> '<h3>Prostorije</h3>',
            ]); ?>
                <div id="loading"><i class="fa fa-cog fa-spin fa-3x gray-color"></i></div>
            <?php Modal::end();
        } else {*/
            Modal::begin([
                'id'=>'init-rooms-modal'.$part->id,
                'size'=>Modal::SIZE_LARGE,
                'class'=>'overlay_modal',
                'header'=> '<h3>Prostorije</h3>',
            ]); ?>
                <div id="loading"><i class="fa fa-cog fa-spin fa-3x gray-color"></i></div>
            <?php Modal::end();
            

        /*}*/
    }
} ?>