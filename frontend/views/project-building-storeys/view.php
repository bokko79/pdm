<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\bootstrap\Modal;
use yii\bootstrap\Nav;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingStoreys */

$this->title = $model->name. ' - ' . $model->storey;

$this->params['page_title'] = 'Objekat';
$this->params['page_title_2'] = 'Površine';
$this->params['page_title_3'] = c($model->name);

$this->params['breadcrumbs'][] = ['label' => '<i class="fa fa-home"></i> '.$model->projectBuilding->name, 'url' => ['/project-building/view', 'id'=>$model->projectBuilding->id]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Površine objekta'), 'url' => ['/project-building-storeys/index', 'id'=>$model->project_building_id]];
$this->params['breadcrumbs'][] = $this->title;

$this->params['building'] = $model->projectBuilding;
$this->params['storey'] = $model;

$this->params['project'] = $model->projectBuilding->project;

$work = $model->projectBuilding->project->work;
?>

<div class="card_container record-full grid-item fadeInUp no-shadow no-margin animated-not no-float" id="">
    <div class="primary-context normal aliceblue bottom-bordered">
        <div class="head colos">
            <div class="subaction">
                <?= Html::a('<i class="fa fa-life-saver fa-2x"></i>', null, ['class' => 'btn btn-link button_to_show_secondary']) ?>
            </div>
            <i class="fa fa-superscript"></i> Površine prostorija <span class="fs_12">(<?= $model->projectBuilding->state ?>)</span>
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
            <?= $this->render('_menu', [
                    'model' => $model->projectBuilding,  
                    'unit' => null,
                ]) ?>        
        </div>
        <div class="content view">
        
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">Lista jedinica (celina) sprata
                    <?php if(!$model->sameAs): ?>
                       <div class="subaction"><?= Html::a('<i class="fa fa-cubes"></i> Dodaj/ukloni jedinice', Url::to(['']), ['class'=>'btn btn-primary', 'style'=>'margin-right:10px;', 'data-toggle'=>'modal', 'data-backdrop'=>false, 'data-target'=>'#'.($model->projectBuildingStoreyParts ? '' : 'init-').'storey-parts-modal'.$model->id]) ?> <?= Html::a('<i class="fa fa-cog"></i>', Url::to(['/project-building-storeys/update', 'id'=>$model->id]), ['class' => 'btn btn-success']) ?> <?php if(!$model->copies and $model->storey!='prizemlje'): ?><?= Html::a('<i class="fa fa-power-off"></i>', ['delete', 'id' => $model->id], [
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
                        //['class' => 'kartik\grid\SerialColumn'],
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
                            //'hAlign'=>'right',
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
                            'class' => 'kartik\grid\ActionColumn',
                            'header' => 'Opcije',
                            'headerOptions' => ['style' => 'color:#337ab7'],
                            //'template' => '{generateRooms}{view}{update}{delete}',
                            'template' => '{view}{delete}',
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
        </div>
    </div>
</div>   
<?php

    if($model->projectBuildingStoreyParts){
        Modal::begin([
            'id'=>'storey-parts-modal'.$model->id,
            'size'=>Modal::SIZE_LARGE,
            'class'=>'overlay_modal',
            'header'=> '<h3>Celine/jedinice etaže</h3>',
        ]); ?>
            <div id="loading"><i class="fa fa-cog fa-spin fa-3x gray-color"></i></div>
        <?php Modal::end();
    } else {
        Modal::begin([
            'id'=>'init-storey-parts-modal'.$model->id,
            'size'=>Modal::SIZE_LARGE,
            'class'=>'overlay_modal',
            'header'=> '<h3>Celine/jedinice etaže</h3>',
        ]); ?>
            <div id="loading"><i class="fa fa-cog fa-spin fa-3x gray-color"></i></div>
        <?php Modal::end();
    } 
 ?>  
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
