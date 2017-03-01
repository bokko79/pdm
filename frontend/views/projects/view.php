<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model common\models\Projects */

$this->title = $model->code. ': '.$model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projekti'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><i class="fa fa-file"></i> <?= Html::encode($this->title) ?></h1>

<p>
    <?= Html::a(Yii::t('app', 'Izmeni'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a($model->status=='deleted' ? Yii::t('app', 'Aktiviraj') : Yii::t('app', 'Deaktiviraj'), ['activate', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        /*'data' => [
            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
            'method' => 'post',
        ],*/
    ]) ?>
</p>
<div class="container">
    <div class="row">
        <div class="col-sm-5">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                    'code',
                    [
                       'attribute'=>'client_id',
                       'format' => 'raw',
                       'value'=>function ($data) {
                            return Html::a($data->client->name, ['/clients/view', 'id'=>$data->client_id]);
                        },
                    ],
                    'building.name',
                    'location.city.town',
                    'projectTypeOfWorks',
                    'projectPhase',
                    [
                       'attribute'=>'practice_id',
                       'format' => 'raw',
                       'value'=>function ($data) {
                            return Html::a($data->practice->name, ['/practices/view', 'id'=>$data->practice_id]);
                        },
                    ],
                    [
                       'attribute'=>'engineer_id',
                       'format' => 'raw',
                       'value'=>function ($data) {
                            return Html::a($data->engineer->name, ['/engineers/view', 'id'=>$data->engineer_id]);
                        },
                    ],
                    [
                       'attribute'=>'control_practice_id',
                       'format' => 'raw',
                       'value'=>function ($data) {
                            return Html::a($data->controlPractice->name, ['/practices/view', 'id'=>$data->control_practice_id]);
                        },
                    ],
                    [
                       'attribute'=>'control_engineer_id',
                       'format' => 'raw',
                       'value'=>function ($data) {
                            return Html::a($data->controlEngineer->name, ['/engineers/view', 'id'=>$data->control_engineer_id]);
                        },
                    ],
                    'status',
                    [
                       'attribute'=>'time',
                       'format' => 'raw',
                       'value'=>function ($data) {
                            return Yii::$app->formatter->asDate($data->time, 'php:mm Y');
                        },
                    ],
                    
                ],
            ]) ?>
         
            
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">Investitori
                    <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj investitora', Url::to(['/project-clients/create', 'ProjectClients[project_id]'=>$model->id]), ['class' => 'btn btn-success btn-sm']) ?>
                        </div>
                    </div>
                    <div class="subhead">Lista investitora projekta.

                    </div>
                </div>
                <div class="secondary-context">
                    <?php if($projectClients = $model->projectClients){
                        foreach($projectClients as $projectClient){
                            echo Html::a('<i class="fa fa-building"></i> '.$projectClient->client->name, Url::to(['/project-clients/update', 'id'=>$projectClient->id]), ['class' => 'btn btn-default btn-sm']).'<br>';
                        }
                    } ?>
                </div>                
            </div>
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">Dokumenti
                    <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj dokument', Url::to(['/project-files/create', 'ProjectFiles[project_id]'=>$model->id]), ['class' => 'btn btn-success btn-sm']) ?>
                        </div>
                    </div>
                    <div class="subhead">Lista dokumenata projekta.

                    </div>
                </div>
                <div class="secondary-context">
                    <?php if($projectFiles = $model->projectFiles){
                        foreach($projectFiles as $projectFile){
                            echo Html::a('<i class="fa fa-file"></i> '.$projectFile->name, Url::to(['/project-files/update', 'id'=>$projectFile->id]), ['class' => 'btn btn-default btn-sm']).'<br>';
                        }
                    } ?>
                </div>                
            </div>
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head"><?= Html::a('<i class="fa fa-plus-circle"></i> Parcela', Url::to(['/project-lot/view', 'id'=>$model->id]), ['class' => '']) ?>
                    <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Uredi predmetnu parcelu', Url::to(['/project-lot/update', 'id'=>$model->id]), ['class' => 'btn btn-success btn-sm']) ?>
                        </div>
                    </div>
                    <div class="subhead">Predmetna parcela projekta.</div>
                </div>              
            </div>
            <p>Licenca glavnog projektanta</p>
            <p>delovi objekta</p>
            <p>spratovi/celine/prostorije objekta</p>
            <p>postojeći objekti</p>

        </div>
        <div class="col-sm-7">
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">Katastarske parcele</div>
                    <div class="subhead">Spisak katastarskih parcela na kojima se predviđa/nalazi predmetni objekat.</div>
                </div>
                <div class="secondary-context">
                    <?= Html::a('Dodaj parcelu', Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$model->location_id, 'LocationLots[type]'=>'object']), ['class' => 'btn btn-success btn-sm']) ?><br><br>
                    <?php if($lots = $model->location->locationLots){
                        foreach($lots as $lot){
                            echo Html::a($lot->lot, Url::to(['/location-lots/update', 'id'=>$lot->id]), ['class' => 'btn btn-default btn-sm']);
                        }
                    } ?>
                </div>
                <div class="primary-context gray normal">
                    <div class="head">Katastarske parcele instalacija</div>
                    <div class="subhead">Spisak katastarskih parcela preko kojih prolaze priključci objekta na infrastrukturu.</div>
                </div>
                <div class="secondary-context">
                    <?= Html::a('Dodaj parcelu', Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$model->location_id, 'LocationLots[type]'=>'service']), ['class' => 'btn btn-success btn-sm']) ?><br><br>
                    <?php if($lots = $model->location->serviceLots){
                        foreach($lots as $lot){
                            echo Html::a($lot->lot, Url::to(['/location-lots/update', 'id'=>$lot->id]), ['class' => 'btn btn-default btn-sm']);
                        }
                    } ?>
                </div>
                <div class="primary-context gray normal">
                    <div class="head">Katastarske parcele pristupa</div>
                    <div class="subhead">Spisak katastarskih parcela preko kojih prolaze priključci objekta na infrastrukturu.</div>
                </div>
                <div class="secondary-context">
                    <?= Html::a('Dodaj parcelu', Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$model->location_id, 'LocationLots[type]'=>'access']), ['class' => 'btn btn-success btn-sm']) ?><br><br>
                    <?php if($lots = $model->location->accessLots){
                        foreach($lots as $lot){
                            echo Html::a($lot->lot, Url::to(['/location-lots/update', 'id'=>$lot->id]), ['class' => 'btn btn-default btn-sm']);
                        }
                    } ?>
                </div>
            </div>
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head"><?= ($model->projectBuilding) ? Html::a('Objekat', Url::to(['/project-building/view', 'id'=>$model->id]), []) : 'Objekat projetka' ?></div>
                    <div class="subhead"><?= (!$model->projectBuilding) ? Html::a('Dodaj objekat', Url::to(['/project-building/create', 'ProjectBuilding[project_id]'=>$model->id, 'ProjectBuilding[building_id]'=>$model->building_id]), ['class' => 'btn btn-warning btn-sm']) : null ?></div>
                </div>
            </div> 
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">Potrebni delovi projekta</div>
                    <div class="subhead"><p>Za izabrani projekat, vrstu radova, fazu projetka i klasu objekta, <b class="red">obavezni</b> su sledeći delovi projektne dokumentacije:</p>
                    <?= Html::a('Dodaj deo projekta', Url::to(['/project-volumes/create', 'ProjectVolumes[project_id]'=>$model->id]), ['class' => 'btn btn-success btn-sm']) ?></div>
                </div>
                <div class="secondary-context">
                    <?php /* $volumes = \common\models\Volumes::find()->all();
                    foreach($volumes as $volume){
                        echo c($volume->name).'<br>';
                    } */ ?>
                    <?php if($volumes = $model->projectVolumes);
                    foreach($volumes as $volume){
                        echo Html::a(c($volume->name), Url::to(['/project-volumes/view', 'id'=>$volume->id]), ['class' => '']).'<br>';
                    } ?>
                </div>
            </div>
        </div>
    </div>
</div>
