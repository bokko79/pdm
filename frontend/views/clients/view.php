<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Clients */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Moji investitori'), 'url' => ['/user/settings/practice-setup', '#'=>'w9-tab2']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['page_title'] = 'Firma';
?>

<div class="container-fluid listed">
    <div class="row" style="">

        <div class="index w300">
            <?= $this->render('_clients', ['model'=>$model->practice]) ?>
        </div>

        <div class="content view w300" style="">
            <div class="card_container record-full grid-item fadeInUp no-shadow transparent no-margin animated-not" id="">
                <div class="primary-context normal">
                    <div class="head"><?= Html::encode($this->title) ?>
                        <div class="subaction"><?= Html::a('<i class="fa fa-cogs"></i> Podešavanje', ['update', 'id' => $model->id], ['class' => 'btn btn-success shadow']) ?></div>
                    </div>
                    
                    <div class="subhead">Moj investitor. Detalji.</div>
                </div>    
                <div class="secondary-context">

                        <div class="row">
                            <div class="col-sm-12">
                                <?= DetailView::widget([
                                    'model' => $model,
                                    'attributes' => [
                                       // 'practice.name',
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
                                    'options' => ['class'=>'table table-hover']
                                ]) ?>
                            </div>
                            <div class="col-sm-12">
                                <div class="card_container record-full grid-item fadeInUp animated" id="">
                                    <div class="primary-context gray normal">
                                        <div class="head button_to_show_secondary">Rešenje APR</div>
                                        <?php if(!$model->apr): ?><div class="subhead"><?= Html::a('Dodaj rešenje APR', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->id, 'LegalFilesSearch[entity]'=>'client', 'LegalFilesSearch[type]'=>'apr']), ['class' => 'btn btn-primary btn-block btn-sm shadow']) ?></div><?php endif; ?>
                                    </div>
                                    <div class="secondary-context none">
                                        <?= ($model->apr) ? Html::a('APR pdf', ['/site/download', 'path'=>'/images/legal_files/docs/'.$model->apr]) .'<br>'.Html::a('Izmeni', Url::to(['/legal-files/update', 'id'=>$model->aprID->id]), ['class' => 'btn btn-default  btn-block btn-sm shadow']) : null ?>
                                    </div>
                                </div>

                                <div class="card_container record-full grid-item fadeInUp animated" id="">
                                    <div class="primary-context gray normal">
                                        <div class="head button_to_show_secondary">Potpis ovlašćenog lica</div>
                                        <?php if(!$model->signature): ?><div class="subhead"><?= Html::a('Dodaj potpis ovlašćenog lica', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->id, 'LegalFilesSearch[entity]'=>'client', 'LegalFilesSearch[type]'=>'signature']), ['class' => 'btn btn-primary btn-block btn-sm shadow']) ?></div><?php endif; ?>
                                    </div>
                                    <div class="secondary-context none">
                                        <?= ($model->signature) ? Html::img('/images/legal_files/signatures/'.$model->signature) .'<br>'.Html::a('Izmeni', Url::to(['/legal-files/update', 'id'=>$model->signatureID->id]), ['class' => 'btn btn-default btn-block btn-sm shadow']) : null ?>
                                    </div>
                                </div>

                                <div class="card_container record-full grid-item fadeInUp animated" id="">
                                    <div class="primary-context gray normal">
                                        <div class="head button_to_show_secondary">Pečat</div>
                                        <?php if(!$model->stamp): ?><div class="subhead"><?= Html::a('Dodaj pečat', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->id, 'LegalFilesSearch[entity]'=>'client', 'LegalFilesSearch[type]'=>'company_stamp']), ['class' => 'btn btn-primary btn-block btn-sm shadow']) ?></div><?php endif; ?>
                                    </div>
                                    <div class="secondary-context none">
                                        <?= ($model->stamp) ? Html::img('/images/legal_files/stamps/'.$model->stamp) .'<br>'.Html::a('Izmeni', Url::to(['/legal-files/update', 'id'=>$model->stampID->id]), ['class' => 'btn btn-default btn-block btn-sm shadow']) : null ?>
                                    </div>
                                </div>            
                            </div>
                            <div class="col-sm-12">
                                <h3>Projekti</h3>
                                <?= GridView::widget([
                                    'dataProvider' => $projects,
                                    'columns' => [
                                        /*[
                                            'label'=>'Naziv projekta',
                                            'format' => 'raw',
                                            'value'=>function ($data) {
                                                return Html::a($data->name, ['projects/view', 'id' => $data->id]);
                                            },
                                        ],*/
                                        'code',
                                        //'projectPhase',
                                        'projectTypeOfWorks',
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
                                        /*[
                                            'label'=>'Glavni projektant',
                                            'format' => 'raw',
                                            'value'=>function ($data) {
                                                return Html::a($data->engineer->name, ['engineers/view', 'id' => $data->engineer_id]);
                                            },
                                        ],*/
                                    ],
                                ]); ?>
                            </div>
                        </div>
                   
                </div>  
            </div>                 
        </div>
    </div>        
</div>
