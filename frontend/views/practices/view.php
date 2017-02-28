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


    <h1><i class="fa fa-shield"></i> <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Izmeni'), ['update', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?php /* Html::a(Yii::t('app', 'Obriši'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Da li ste sigurni da želite da obrišete firmu?'),
                'method' => 'post',
            ],
        ]) */?>
    </p>
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
                            <div class="head">Memorandum zaglavlje</div>
                            <?php if(!$model->memo): ?><div class="subhead"><?= Html::a('Dodaj memorandum zaglavlje', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->id, 'LegalFilesSearch[entity]'=>'practice', 'LegalFilesSearch[type]'=>'memo-header']), ['class' => 'btn btn-success btn-sm']) ?></div><?php endif; ?>
                        </div>
                        <div class="secondary-context">
                            <?= ($model->memo) ? Html::img('/images/legal_files/visual/'.$model->memo) .'<br>'.Html::a('Izmeni', Url::to(['/legal-files/update', 'id'=>$model->memoID->id]), ['class' => 'btn btn-default btn-sm']) : null ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="card_container record-full grid-item fadeInUp animated" id="" style="height:300px;">
                        <div class="primary-context gray normal">
                            <div class="head major">Rešenje APR</div>
                            <div class="subhead"><?= ($model->apr) ? Html::a('Izmeni', Url::to(['/legal-files/update', 'id'=>$model->aprID->id]), ['class' => 'btn btn-default btn-sm']) : null ?></div>
                            <?php if(!$model->apr): ?><div class="subhead"><?= Html::a('Dodaj rešenje APR', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->id, 'LegalFilesSearch[entity]'=>'practice', 'LegalFilesSearch[type]'=>'apr']), ['class' => 'btn btn-success btn-sm']) ?></div><?php endif; ?>
                        </div>
                        <div class="secondary-context">
                            <?= ($model->apr) ? Html::a('APR pdf', ['/site/download', 'path'=>'/images/legal_files/docs/'.$model->apr]) : null ?>
                        </div>
                    </div>                                  
                </div>
                <div class="col-sm-4">                     
                    <div class="card_container record-full grid-item fadeInUp animated" id="" style="height:300px;">
                        <div class="primary-context gray normal">
                            <div class="head major">Pečat</div>
                            <div class="subhead"><?= ($model->stamp) ? Html::a('Izmeni', Url::to(['/legal-files/update', 'id'=>$model->stampID->id]), ['class' => 'btn btn-default btn-sm']) : null ?></div>
                            <?php if(!$model->stamp): ?><div class="subhead"><?= Html::a('Dodaj pečat', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->id, 'LegalFilesSearch[entity]'=>'practice', 'LegalFilesSearch[type]'=>'company_stamp']), ['class' => 'btn btn-success btn-sm']) ?></div><?php endif; ?>
                        </div>
                        <div class="secondary-context">
                            <?= ($model->stamp) ? Html::img('/images/legal_files/stamps/'.$model->stamp, ['style'=>'max-height:180px;']) : null ?>
                        </div>
                    </div>           
                </div>
                <div class="col-sm-4">
                    <div class="card_container record-full grid-item fadeInUp animated" id="" style="height:300px;">
                        <div class="primary-context gray normal">
                            <div class="head major">Potpis ovl. lica</div>
                            <div class="subhead"><?= ($model->signature) ? Html::a('Izmeni', Url::to(['/legal-files/update', 'id'=>$model->signatureID->id]), ['class' => 'btn btn-default btn-sm']) : null ?></div>
                            <?php if(!$model->signature): ?><div class="subhead"><?= Html::a('Dodaj potpis ovlašćenog lica', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->id, 'LegalFilesSearch[entity]'=>'practice', 'LegalFilesSearch[type]'=>'signature']), ['class' => 'btn btn-success btn-sm']) ?></div><?php endif; ?>
                        </div>
                        <div class="secondary-context">
                            <?= ($model->signature) ? Html::img('/images/legal_files/signatures/'.$model->signature, ['style'=>'max-height:180px;']) : null ?>
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
                    <div class="head">Projekti</div>
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
                    <div class="head">Inženjeri firme</div>
                    <div class="subhead"><?= Html::a('Dodaj inženjera firme', ['/practice-engineers/create', 'PracticeEngineersSearch[practice_id]' => $model->id], ['class' => 'btn btn-success btn-sm']) ?></div>
                </div>
                <div class="secondary-context">
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
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>

