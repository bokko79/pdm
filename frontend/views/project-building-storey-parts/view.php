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
use kartik\widgets\TouchSpin;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingStoreyParts */

$this->title = $model->mark.':'.$model->name.'@'.$model->projectBuildingStorey->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Etaža objekta'), 'url' => ['/project-building-storeys/view', 'id'=>$model->project_building_storey_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-building-storey-parts-view">

    <h1><?= Html::encode($this->title) ?></h1>
    

</div>

<div class="container">
    <div class="row">
        <div class="col-sm-4">
        <?php $form = kartik\widgets\ActiveForm::begin([
                'id' => 'form-horizontal',
                'type' => ActiveForm::TYPE_VERTICAL,
                
            ]); ?>
            <table class="table table-striped table-hover table-bordered">
            <?php foreach($roomTypes as $key=>$roomType): ?>
            
                <tr>
                    <td class="center"> 
                        <?php /* $form->field($model, 'qty[]')->widget(TouchSpin::classname(), [
                                'options' => ['placeholder' => $roomType->name],
                            ]) */ ?>
                        <?php /* TouchSpin::widget([
    'name' => 'ProjectBuildingStoreyPartRooms[qty][]',
    //'value' => $roomType->id,
    'options' => ['placeholder' => $roomType->name],
    'pluginOptions' => [
        'min' => 0,
        'max' => 6,
    ],
]); */ ?>
<?= $form->field($model, 'qty['.$key.']')->widget(TouchSpin::classname(), [
    'options' => ['placeholder' => $roomType->name],
])->label($roomType->name) ?>

                        <?= $form->field($model, 'room_type_id[]')->hiddenInput(['value'=> $roomType->id])->label(false) ?>
                    </td>
                </tr>
                <?php endforeach; ?> 
            </table>
            <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton('Sačuvaj', ['class' => 'btn btn-success']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
            
        </div>
        <div class="col-sm-8">
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head button_to_show_secondary"><i class="fa fa-plus-circle"></i> Osnovni podaci jedinice
                    <div class="action-area normal-case"><?= Html::a('<i class="fa fa-cog"></i> Uredi jedinicu', Url::to(['/project-building-storey-parts/update', 'id'=>$model->id]), ['class' => 'btn btn-success btn-sm']) ?> <?= Html::a('<i class="fa fa-power-off"></i>', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
                        </div>
                    </div>
                    <div class="subhead"></div>
                </div>
                <div class="secondary-context none">  
                   <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'project_building_storey_id',
                            'type',
                            'name',
                            'mark',
                            'structure',
                            'area',
                            'description:ntext',
                        ],
                    ]) ?>
                </div>
            </div>
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head button_to_show_secondary">Prostorije jedinice etaže
                        <div class="action-area normal-case"><?= Html::a('Dodaj prostoriju', Url::to(['/project-building-storey-part-rooms/create', 'ProjectBuildingStoreyPartRooms[project_building_storey_part_id]'=>$model->id]), ['class' => 'btn btn-success btn-sm']) ?></div>
                    </div>
                    <div class="subhead">Ukupna neto površina jedinice: <?= $model->netArea ?> m<sup>2</sup>. Ukupna redukovana neto površina jedinice: <?= $model->subNetArea ?> m<sup>2</sup></div>
                </div>
                <div class="secondary-context none">               

                <?php
                    $gridColumns = [
                        ['class' => 'kartik\grid\SerialColumn'],
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
                            'width'=>'50px',
                            'hAlign'=>'right',
                            //'format'=>['decimal', 2],
                            'pageSummary'=>true,
                            'editableOptions'=> function ($model, $key, $index) {
                                return [
                                    'header'=>'Oznaka prostorije',
                                    'size'=>'md',
                                    //'asPopover' => false,
                                    //'inputType' => Editable::INPUT_HTML5_INPUT,
                                    'placement' => 'left',              
                                ];
                            }
                        ],
                        [
                            'attribute'=>'name',
                            'format' => 'raw',
                            'value'=>function ($data) {
                                return Html::a($data->roomType->name, ['project-building-storey-part-rooms/update', 'id' => $data->id]);
                            },
                            'filterType'=>GridView::FILTER_SELECT2,
                            'filter'=>\yii\helpers\ArrayHelper::map(\common\models\ProjectBuildingStoreyPartRooms::find()->orderBy('id')->asArray()->all(), 'id', 'roomType.name'), 
                            'filterWidgetOptions'=>[
                                'pluginOptions'=>['allowClear'=>true],
                            ],
                            'filterInputOptions'=>['placeholder'=>'Any Part'],
                            //'group'=>true,  // enable grouping
                        ],                        
                        [
                            'class'=>'kartik\grid\EditableColumn',
                            'attribute'=>'name',
                            'width'=>'50px',
                            'hAlign'=>'right',
                            //'format'=>['decimal', 2],
                            'pageSummary'=>true,
                            'editableOptions'=> function ($model, $key, $index) {
                                return [
                                    'header'=>'Bliži naziv prostorije',
                                    'size'=>'md',
                                    //'asPopover' => false,
                                    //'inputType' => Editable::INPUT_HTML5_INPUT,
                                    'placement' => 'left',              
                                ];
                            }
                        ],
                        [
                            'class'=>'kartik\grid\EditableColumn',
                            'attribute'=>'sub_net_area',
                            'width'=>'50px',
                            'hAlign'=>'right',
                            //'format'=>['decimal', 2],
                            'pageSummary'=>true,
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
                                    'afterInput' => function ($form, $widget) use ($model, $index) {
                                        
                                        echo $form->field($model, 'flooring')->dropDownList([ 'parket' => 'Parket', 'keramika' => 'Keramika', 'estrih' => 'Estrih', 'tarkett' => 'Tarkett', 'beton' => 'Beton', 'opeka' => 'Opeka', 'kamen' => 'Kamen', 'teraco' => 'Teraco', 'zemlja' => 'Zemlja', 'tepih' => 'Tepih', 'drugo' => 'Drugo', ], ['prompt' => '']);
                                    }              
                                ];
                            }
                        ],
                    ];
                    echo GridView::widget([
                        'id' => 'kv-grid-demo',
                        'dataProvider'=>$projectBuildingStoreyPartRooms,
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
                                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['', 'id'=>$model->projectBuildingStorey->project_id], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')])
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
                        /*'panel'=>[
                            'type'=>GridView::TYPE_PRIMARY,
                            'heading'=>'Površine',
                        ],*/
                        'persistResize'=>false,
                        //'perfectScrollbar'=>true,
                        //'exportConfig'=>$exportConfig,
                    ]);
                    ?>
                </div>
            </div> 
        </div>
    </div>   

</div>
