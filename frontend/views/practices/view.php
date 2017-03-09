<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Practices */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Firme'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card_container record-full grid-item fadeInUp animated" id="">
    <div class="primary-context gray normal">
        <div class="head"><i class="fa fa-shield"></i> <?= Html::encode($this->title) ?>
        <div class="action-area normal-case"><?= Html::a(Yii::t('app', '<i class="fa fa-cogs"></i> Podesi'), ['update', 'id' => $model->id], ['class' => 'btn btn-success btn-sm' ]) ?>
            </div>
        </div>
        <div class="subhead">Profil firme.</div>
    </div>              
</div>
<hr>

<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                    'location.street',
                    'location.number',
                    'location.city.town',
                    'phone',
                    'email:email',
                    [
                       'attribute'=>'engineer_id',
                       'format' => 'raw',
                       'value'=>function ($data) {
                            return Html::a($data->engineer->name, ['/engineers/view', 'id'=>$data->engineer_id]);
                        },
                    ],
                    'fax',
                    'tax_no',
                    'company_no',
                    'account_no',
                    'bank',
                ],
            ]) ?>             
        </div>
        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-12">                    
                    <div class="card_container record-full grid-item fadeInUp animated" id="">
                        <div class="primary-context gray normal">
                            <div class="head button_to_show_secondary">Memorandum zaglavlje
                            <div class="action-area normal-case"><?= ($model->memo) ? Html::a('<i class="fa fa-cogs"></i> Promeni', Url::to(['/legal-files/update', 'id'=>$model->memoID->id]), ['class' => 'btn btn-success btn-sm']) : Html::a('<i class="fa fa-plus-circle"></i> Dodaj memorandum zaglavlje', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->id, 'LegalFilesSearch[entity]'=>'practice', 'LegalFilesSearch[type]'=>'memo-header']), ['class' => 'btn btn-primary btn-sm']) ?></div>
                            </div>                           
                        </div>
                        <div class="secondary-context ">
                            <?= ($model->memo) ? Html::img('/images/legal_files/visual/'.$model->memo)  : null ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card_container record-full grid-item fadeInUp animated" id="" style="height:300px;">
                        <div class="primary-context gray normal">
                            <div class="head button_to_show_secondary">Logo
                                <div class="action-area normal-case">
                                    <?= ($model->logo) ? Html::a('<i class="fa fa-cogs"></i>', Url::to(['/legal-files/update', 'id'=>$model->logoID->id]), ['class' => 'btn btn-success btn-sm']) : null ?>
                                     <?php if(!$model->logo): ?><?= Html::a('<i class="fa fa-plus-circle"></i>', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->id, 'LegalFilesSearch[entity]'=>'practice', 'LegalFilesSearch[type]'=>'logo']), ['class' => 'btn btn-primary btn-sm']) ?><?php endif; ?>
                                </div>
                            </div>
                           
                        </div>
                        <div class="secondary-context ">
                            <?= ($model->logo) ? Html::img('/images/legal_files/visual/'.$model->logo, ['style'=>'max-height:180px;']) : null ?>
                        </div>
                    </div>                                  
                </div>
                <div class="col-sm-4">                     
                    <div class="card_container record-full grid-item fadeInUp animated" id="" style="height:300px;">
                        <div class="primary-context gray normal">
                            <div class="head button_to_show_secondary">Pečat
                            <div class="action-area normal-case"><?= ($model->stamp) ? Html::a('<i class="fa fa-cogs"></i> Promeni', Url::to(['/legal-files/update', 'id'=>$model->stampID->id]), ['class' => 'btn btn-success btn-sm']) : Html::a('<i class="fa fa-plus-circle"></i> Dodaj pečat', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->id, 'LegalFilesSearch[entity]'=>'practice', 'LegalFilesSearch[type]'=>'company_stamp']), ['class' => 'btn btn-primary btn-sm']) ?></div>
                            </div>
                        </div>
                        <div class="secondary-context ">
                            <?= ($model->stamp) ? Html::img('/images/legal_files/stamps/'.$model->stamp, ['style'=>'max-height:180px;']) : null ?>
                        </div>
                    </div>           
                </div>
                <div class="col-sm-4">
                    <div class="card_container record-full grid-item fadeInUp animated" id="" style="height:300px;">
                        <div class="primary-context gray normal">
                            <div class="head button_to_show_secondary">Potpis ovl. lica
                            <div class="action-area normal-case"><?= ($model->signature) ? Html::a('<i class="fa fa-cogs"></i> Promeni', Url::to(['/legal-files/update', 'id'=>$model->signatureID->id]), ['class' => 'btn btn-success btn-sm']) :  Html::a('<i class="fa fa-plus-circle"></i> Dodaj potpis ovlašćenog lica', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->id, 'LegalFilesSearch[entity]'=>'practice', 'LegalFilesSearch[type]'=>'signature']), ['class' => 'btn btn-primary btn-sm']) ?></div>
                            </div>
                        </div>
                        <div class="secondary-context">
                            <?= ($model->signature) ? Html::img('/images/legal_files/signatures/'.$model->signature, ['style'=>'max-height:180px;']) : null ?>
                        </div>
                    </div>                       
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                   
                    <div class="card_container record-full grid-item fadeInUp animated">
                        <div class="primary-context gray normal">
                            <div class="head ">Rešenje APR
                            <div class="action-area normal-case">
                            <?= ($model->apr) ? Html::a('APR pdf', ['/site/download', 'path'=>'/images/legal_files/docs/'.$model->apr], ['class' => 'btn btn-link btn-sm']) : null ?>
                            <?= ($model->apr) ? Html::a('<i class="fa fa-cogs"></i> Promeni', Url::to(['/legal-files/update', 'id'=>$model->aprID->id]), ['class' => 'btn btn-success btn-sm']) : null ?>
                            <?php if(!$model->apr): ?>><?= Html::a('<i class="fa fa-plus-circle"></i>', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->id, 'LegalFilesSearch[entity]'=>'practice', 'LegalFilesSearch[type]'=>'apr']), ['class' => 'btn btn-primary btn-sm']) ?><?php endif; ?>
                            
                            </div>
                        </div>
                    </div>                                  
                
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head button_to_show_secondary">Projekti

                    </div>
                    <div class="subhead">Projekti na kojima firma ima svojstvo projektanta.</div>
                </div>
                <div class="secondary-context">
                    <?= GridView::widget([
                        'dataProvider' => $projects,
                        'columns' => [
                            [
                                'attribute'=>'name',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->name, ['projects/view', 'id' => $data->id]);
                                },
                            ],
                            'code',
                            'projectPhase',
                            'projectTypeOfWorks',
                            [
                                'attribute'=>'location_id',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return $data->location->city->town;
                                },
                            ],
                            [
                                'attribute'=>'engineer_id',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->engineer->name, ['engineers/view', 'id' => $data->engineer_id]);
                                },
                            ],
                            [
                                'attribute'=>'client_id',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->client->name, ['clients/view', 'id' => $data->client_id]);
                                },
                            ],
                        ],
                    ]); ?>
                </div>
            </div> 
            
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head button_to_show_secondary">Inženjeri firme
                    <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Novi inženjer firme', ['/practice-engineers/create', 'PracticeEngineersSearch[practice_id]' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?></div>
                    </div>
                </div>
                <div class="secondary-context none">
                    <?= GridView::widget([
                        'dataProvider' => $practiceEngineers,
                        'columns' => [
                            [
                                'label'=>'Zasposleni',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->engineer->name, ['engineers/view', 'id' => $data->engineer_id]);
                                },
                            ],
                            'position',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => '',
                                  'template' => '{view}{update}{delete}',
                                  'buttons' => [
                                    'view' => function ($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['/practice-engineers/view','id'=>$model->id], ['class' => 'btn btn-default btn-xs']);
                                    },

                                    'update' => function ($url, $model) {
                                        return Html::a('<i class="fa fa-wrench"></i>', ['/practice-engineers/update','id'=>$model->id], ['class' => 'btn btn-success btn-xs',]);
                                    },
                                    'delete' => function ($url, $model) {
                                        return Html::a('<i class="fa fa-power-off"></i>', ['/practice-engineers/delete','id'=>$model->id], [
                                        'class' => 'btn btn-danger btn-xs',
                                        'data' => [
                                            'confirm' => Yii::t('app', 'Da li ste sigurni da želite da obrišete firmu?'),
                                            'method' => 'post',
                                        ],
                                    ]);
                                    },
                                  ],
                                  
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>


