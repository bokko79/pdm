<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Clients */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Investitori'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><i class="fa fa-building"></i> <?= Html::encode($this->title) ?>

        <?= Html::a(Yii::t('app', 'Izmeni'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
    </h1>

<div class="container">
    <div class="row">
        <div class="col-sm-7">
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
                    'type',
                    'contact_person',
                    'tax_no',
                    'company_no',
                    'account_no',
                    'bank',
                ],
            ]) ?>
        </div>
        <div class="col-sm-5">             
           
        </div>
        <div class="col-sm-4">
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">Rešenje APR</div>
                    <?php if(!$model->apr): ?><div class="subhead"><?= Html::a('Dodaj rešenje APR', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->id, 'LegalFilesSearch[entity]'=>'client', 'LegalFilesSearch[type]'=>'apr']), ['class' => 'btn btn-success btn-sm']) ?></div><?php endif; ?>
                </div>
                <div class="secondary-context">
                    <?= ($model->apr) ? Html::a('APR pdf', ['/site/download', 'path'=>'/images/legal_files/docs/'.$model->apr]) .'<br>'.Html::a('Izmeni', Url::to(['/legal-files/update', 'id'=>$model->aprID->id]), ['class' => 'btn btn-default btn-sm']) : null ?>
                </div>
            </div>

            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">Potpis ovlašćenog lica</div>
                    <?php if(!$model->signature): ?><div class="subhead"><?= Html::a('Dodaj potpis ovlašćenog lica', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->id, 'LegalFilesSearch[entity]'=>'client', 'LegalFilesSearch[type]'=>'signature']), ['class' => 'btn btn-success btn-sm']) ?></div><?php endif; ?>
                </div>
                <div class="secondary-context">
                    <?= ($model->signature) ? Html::img('/images/legal_files/signatures/'.$model->signature) .'<br>'.Html::a('Izmeni', Url::to(['/legal-files/update', 'id'=>$model->signatureID->id]), ['class' => 'btn btn-default btn-sm']) : null ?>
                </div>
            </div>

            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context gray normal">
                    <div class="head">Pečat</div>
                    <?php if(!$model->stamp): ?><div class="subhead"><?= Html::a('Dodaj pečat', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->id, 'LegalFilesSearch[entity]'=>'client', 'LegalFilesSearch[type]'=>'company_stamp']), ['class' => 'btn btn-success btn-sm']) ?></div><?php endif; ?>
                </div>
                <div class="secondary-context">
                    <?= ($model->stamp) ? Html::img('/images/legal_files/stamps/'.$model->stamp) .'<br>'.Html::a('Izmeni', Url::to(['/legal-files/update', 'id'=>$model->stampID->id]), ['class' => 'btn btn-default btn-sm']) : null ?>
                </div>
            </div>            
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h3>Projekti</h3>
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
                    'projectPhase',
                    'projectTypeOfWorks',
                    [
                        'label'=>'Lokacija',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::a($data->location->city->town, ['projects/view', 'id' => $data->id]);
                        },
                    ],
                    [
                        'label'=>'Projektant',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::a($data->practice->name, ['practices/view', 'id' => $data->practice_id]);
                        },
                    ],
                    [
                        'label'=>'Glavni projektant',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::a($data->engineer->name, ['engineers/view', 'id' => $data->engineer_id]);
                        },
                    ],
                    [
                        'label'=>'Investitor',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::a($data->client->name, ['clients/view', 'id' => $data->client_id]);
                        },
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>

