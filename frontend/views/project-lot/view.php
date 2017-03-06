<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectLot */

$this->title = 'Parcela projekta';
$this->params['breadcrumbs'][] = ['label' => $model->project->code. ': Projekat', 'url' => ['/projects/view', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['project'] = $model->project;
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-7">
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head button_to_show_secondary"><i class="fa fa-plus-circle"></i> Osnovni podaci predmetne parcele <i class="fa this-one fa-arrow-circle-right"></i>
                    <div class="action-area normal-case"><?= Html::a('<i class="fa fa-cog"></i> Uredi parcelu', Url::to(['/project-lot/update', 'id'=>$model->project_id]), ['class' => 'btn btn-success btn-sm']) ?>
                        </div>
                    </div>
                    <div class="subhead">Predmetna parcela projekta.</div>
                </div>
                <div class="secondary-context none ">   
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'project_id',
                            'conditions',
                            'width',
                            'length',
                            'disposition:ntext',
                            'type',
                            'area',
                            'ground_level',
                            'road_level',
                            'underwater_level',
                            'ground:ntext',
                            'access:ntext',
                            'ownership:ntext',
                            'adjacent_border:ntext',
                            'services:ntext',
                            'description:ntext',
                            'note:ntext',
                            'legal:ntext',
                            'green_area_reg',
                            'green_area',
                            'occupancy_reg',
                            'built_index_reg',
                            'parking:ntext',
                            'parking_spaces',
                            'parking_disabled',
                        ],
                    ]) ?>
                </div>           
            </div>
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head button_to_show_secondary">Postojeći objekti na parceli <i class="fa this-one fa-arrow-circle-right"></i>
                        <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj postojeći objekat', Url::to(['/project-lot-existing-buildings/create', 'ProjectLotExistingBuildings[project_id]'=>$model->project_id]), ['class' => 'btn btn-success btn-sm']) ?></div>
                    </div>
                    <div class="subhead">Lista postojećih objekata na predmetnoj parceli.
                    </div>
                </div>
                <div class="secondary-context none">
                    <?php if($existings = $model->project->projectLotExistingBuildings);
                    foreach($existings as $existing){
                        echo Html::a(c($existing->mark. ' - '.$existing->buildingType->name.' '.$existing->storeys), Url::to(['/project-lot-existing-buildings/update', 'id'=>$existing->id]), ['class' => 'btn btn-default', 'style'=>'']).'<br>';
                    } ?>
                </div>
            </div>
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head button_to_show_secondary">Predviđeni objekti na parceli <i class="fa this-one fa-arrow-circle-right"></i>
                        <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj predviđeni objekat', Url::to(['/project-lot-future-developments/create', 'ProjectLotFutureDevelopments[project_id]'=>$model->project_id]), ['class' => 'btn btn-success btn-sm']) ?></div>
                    </div>
                    <div class="subhead">Lista postojećih objekata na predmetnoj parceli.
                    </div>
                </div>
                <div class="secondary-context none">
                    <?php if($developments = $model->project->projectLotFutureDevelopments);
                    foreach($developments as $development){
                        echo Html::a(c($development->buildingType->name.' '.$development->name), Url::to(['/project-lot-future-developments/update', 'id'=>$existing->id]), ['class' => 'btn btn-default', 'style'=>'']).'<br>';
                    } ?>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head button_to_show_secondary">Katastarske parcele <i class="fa this-one fa-arrow-circle-right"></i>
                    </div>      
                    <div class="subhead">Spisak katastarskih parcela na kojima se predviđa/nalazi predmetni objekat.</div>              
                </div>
                <div class="primary-context gray normal">
                    <div class="head">Građevinske parcele
                        <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj parcelu', Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$model->project->location_id, 'LocationLots[type]'=>'object']), ['class' => 'btn btn-success btn-sm']) ?></div>
                    </div>      
                    <div class="subhead">Spisak katastarskih parcela na kojima se predviđa/nalazi predmetni objekat.</div>              
                </div>
                <div class="secondary-context none">                   
                    <?php if($lots = $model->project->location->locationLots){
                        foreach($lots as $lot){
                            echo Html::a($lot->lot, Url::to(['/location-lots/update', 'id'=>$lot->id]), ['class' => 'btn btn-default btn-sm']);
                        }
                    } ?>
                </div>
                <div class="primary-context gray normal">
                    <div class="head button_to_show_secondary">Parcele instalacija
                        <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj parcelu', Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$model->project->location_id, 'LocationLots[type]'=>'service']), ['class' => 'btn btn-success btn-sm']) ?></div>
                    </div>    
                    <div class="subhead">Spisak katastarskih parcela preko kojih prolaze priključci objekta na infrastrukturu.</div>                     
                </div>
                <div class="secondary-context none">
                    <?php if($lots = $model->project->location->serviceLots){
                        foreach($lots as $lot){
                            echo Html::a($lot->lot, Url::to(['/location-lots/update', 'id'=>$lot->id]), ['class' => 'btn btn-default btn-sm']);
                        }
                    } ?>
                </div>
                <div class="primary-context gray normal">
                    <div class="head button_to_show_secondary">Parcele pristupa
                        <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj parcelu', Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$model->project->location_id, 'LocationLots[type]'=>'access']), ['class' => 'btn btn-success btn-sm']) ?></div>
                    </div>                    
                    <div class="subhead">Spisak katastarskih parcela preko kojih prolaze priključci objekta na infrastrukturu.</div>   
                </div>
                <div class="secondary-context none">
                    <?php if($lots = $model->project->location->accessLots){
                        foreach($lots as $lot){
                            echo Html::a($lot->lot, Url::to(['/location-lots/update', 'id'=>$lot->id]), ['class' => 'btn btn-default btn-sm']);
                        }
                    } ?>
                </div>
            </div>            
        </div>
    </div>
</div>
