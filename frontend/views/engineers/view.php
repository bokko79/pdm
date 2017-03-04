<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Engineers */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inženjeri'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
     
<div class="card_container record-full grid-item fadeInUp animated" style="background-image: url('../images/legal_files/other/<?= $model->other ?>')" id="">
    <div class="primary-context gray normal">
        <div class="head"><i class="fa fa-user-circle-o"></i> <?= Html::encode($this->title) ?>
        <div class="action-area normal-case"><?= Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Podesi'), ['update', 'id' => $model->id], ['class' => 'btn btn-success btn-sm' ]) ?>
            </div>
        </div>
        <div class="subhead">Lista Vaših projekata.</div>
    </div>              
</div>
<hr>
<div class="container-fluid">
     
    <div class="row">
        <div class="col-sm-8">
            <h3>Projekti</h3>
            <p>Projekti na kojima je inženjer glavni projektant.</p>
            <?= GridView::widget([
                'dataProvider' => $projects,
                'columns' => [
                    [
                        'label'=>'Naziv projekta',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::a($data->name, ['projects/view', 'id' => $data->id]);
                        },
                    ],
                    'code',
                    [
                        'label'=>'Lokacija',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::a($data->location->city->town, ['projects/view', 'id' => $data->id]);
                        },
                    ],
                    /*[
                        'label'=>'Projektant',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::a($data->practice->name, ['practices/view', 'id' => $data->practice_id]);
                        },
                    ],*/
                    [
                        'label'=>'Investitor',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::a($data->client->name, ['clients/view', 'id' => $data->client_id]);
                        },
                    ],
                ],
            ]); ?>
             <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">Dokumenti
                    <div class="action-area"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj dokument', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->id, 'LegalFilesSearch[entity]'=>'engineer']), ['class' => 'btn btn-primary btn-sm']) ?></div>
                    </div>
                    <div class="subhead"></div>
                </div>
                
                <div class="secondary-context">
                    <?= GridView::widget([
                        'dataProvider' => $engineerFiles,
                        'columns' => [
                            [
                                'label'=>'Vrsta dokumenta',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->docType, ['legal-files/view', 'id' => $data->id]);
                                },
                            ],
                            'value',
                        ],
                    ]); ?>
                </div>
            </div>

            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head"><?= Html::a('<i class="fa fa-stamp"></i> Licencni paketi', Url::to(['/engineer-licences/index', 'engineer_id'=>$model->id]), ['class' => '']) ?>
                    <div class="action-area"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj licencni paket', Url::to(['/engineer-licences/create', 'EngineerLicences[engineer_id]'=>$model->id]), ['class' => 'btn btn-primary btn-sm']) ?></div></div>
                    
                    <div class="subhead">Licencni paketi inžerenja. Paket podrazumeva broj licence, kao i kopiju, potvrdu i lični petat.</div>
                </div>    
                <div class="secondary-context">
                    <?= GridView::widget([
                        'dataProvider' => $engineerLicences,
                        'columns' => [
                            [
                                'label'=>'Broj licence',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->no, ['engineer-licences/update', 'id' => $data->id]);
                                },
                            ],
                        ],
                        'summary' => false,
                    ]); ?>
                </div>            
            </div>
        </div>
        <div class="col-sm-4"> 
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">Osnovni podaci</div>
                    
                </div>
                
                <div class="secondary-context">
                   <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'name',
                            'title',
                            'phone',
                            'email:email',
                        ],
                    ]) ?>      
           
                </div>
            </div>

            
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            
        </div>
    </div>
</div>
