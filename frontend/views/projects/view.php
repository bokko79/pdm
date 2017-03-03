<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model common\models\Projects */

$this->title = $model->code. ': '.$model->name. ' '.$model->projectBuilding->storey.', '.$model->location->city->town;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projekti'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><i class="fa fa-file-o"></i> <?= Html::encode($this->title) ?></h1>

<hr>
<div class="container">
    <div class="row">
        <div class="col-sm-7">
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head"><i class="fa fa-plus-circle"></i> Osnovni podaci projekta
                    <div class="action-area normal-case"><?= Html::a('<i class="fa fa-cog"></i> Uredi projekat', Url::to(['/projects/update', 'id'=>$model->id]), ['class' => 'btn btn-success btn-sm']) ?>
                    <?= Html::a($model->status=='deleted' ? Yii::t('app', 'Aktiviraj') : Yii::t('app', '<i class="fa fa-power-off"></i>'), ['activate', 'id' => $model->id], ['class' => 'btn btn-danger btn-sm']) ?>
                        </div>
                    </div>
                    <div class="subhead">Predmetni projekat.</div>
                </div>
                <div class="secondary-context">   
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
                </div>           
            </div> 
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">Projektna dokumentacija
                        <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Novi deo', Url::to(['/project-volumes/create', 'ProjectVolumes[project_id]'=>$model->id]), ['class' => 'btn btn-primary btn-sm']) ?></div>
                    </div>
                    <div class="subhead"><p>Za izabrani projekat, vrstu radova, fazu projetka i klasu objekta, <b class="red">obavezni</b> su sledeći delovi projektne dokumentacije:</p>
                    </div>
                </div>
                <div class="secondary-context">
                    <?php /* $volumes = \common\models\Volumes::find()->all();
                    foreach($volumes as $volume){
                        echo c($volume->name).'<br>';
                    } */ ?>
                    <?php if($volumes = $model->projectVolumes);
                    foreach($volumes as $volume){
                        /*echo Html::a(c($volume->name), Url::to(['/site/glavna-sveska', 'id'=>$model->id]), ['class' => 'btn btn-danger', 'style'=>'width:100%', 'target'=>'_blank']).'<br>';*/
                        echo Html::a(c($volume->name), Url::to(['/project-volumes/view', 'id'=>$volume->id]), ['class' => 'btn btn-default', 'style'=>'width:100%', ]).'<br><br>';
                    } ?>
                </div>
            </div>
        </div>
        <div class="col-sm-5">           

            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head"><?= Html::a('<i class="fa fa-map-marker"></i> Građevinska parcela', Url::to(['/project-lot/view', 'id'=>$model->id]), ['class' => '']) ?>
                    <div class="action-area normal-case"><?= Html::a('<i class="fa fa-wrench"></i>', Url::to(['/project-lot/update', 'id'=>$model->id]), ['class' => 'btn btn-success btn-sm']) ?>
                        </div>
                    </div>
                    <div class="subhead">Predmetna parcela projekta.</div>
                </div>              
            </div>
            
            <hr>
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head"><?= Html::a('<i class="fa fa-home"></i> Objekat', Url::to(['/project-building/view', 'id'=>$model->id]), []) ?> (<?= $model->projectBuilding->spratnost ?>)
                        <div class="action-area normal-case"><?= Html::a('<i class="fa fa-wrench"></i>', Url::to(['/project-building/update', 'id'=>$model->id]), ['class' => 'btn btn-success btn-sm']) ?></div>

                    </div>
                    <div class="subhead">Predmetni objekat projekta.</div>
                </div>
            </div> 
            <hr>

            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head"><i class="fa fa-file"></i> Dokumenti
                    <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Novi dokument', Url::to(['/project-files/create', 'ProjectFiles[project_id]'=>$model->id]), ['class' => 'btn btn-primary btn-sm']) ?>
                        </div>
                    </div>
                    <div class="subhead">Lista dokumenata projekta.

                    </div>
                </div>
                <div class="secondary-context">
                    <?php if($projectFiles = $model->projectFiles){
                        foreach($projectFiles as $projectFile){
                            $thumb = ($projectFile->file and $projectFile->file->type!='pdf') ? Html::img('/images/projects/files/'.$projectFile->file->name, ['style'=>'max-height:30px;']) : null;
                            echo Html::a('<i class="fa fa-file"></i> '.substr($projectFile->name,0,50). '... '.$thumb, Url::to(['/project-files/update', 'id'=>$projectFile->id]), ['class' => 'btn btn-default btn-sm']).'<br><br>';

                        }
                    } ?>
                </div>                
            </div>
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">Investitori
                    <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Novi investitor', Url::to(['/project-clients/create', 'ProjectClients[project_id]'=>$model->id]), ['class' => 'btn btn-primary btn-sm']) ?>
                        </div>
                    </div>
                    <div class="subhead">Lista investitora projekta.

                    </div>
                </div>
                <div class="secondary-context">
                    <?php if($projectClients = $model->projectClients){
                        foreach($projectClients as $projectClient){
                            echo Html::a('<i class="fa fa-building"></i> '.$projectClient->client->name, Url::to(['/project-clients/update', 'id'=>$projectClient->id]), ['class' => 'btn btn-default btn-sm']).'<br><br>';
                        }
                    } ?>
                </div>                
            </div>           
        </div>
    </div>
</div>
