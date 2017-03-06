<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\EngineerLicencesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Licencni paketi inženjera');
$this->params['breadcrumbs'][] = ['label' => $engineer->name, 'url' => ['/engineers/view', 'id' => $engineer->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card_container record-full transparent no-shadow grid-item fadeInUp animated" id="">
    <div class="primary-context  normal">
        <div class="head"><h1 style="display: inline;"><i class="fa fa-user-circle-o"></i> <?= Html::encode($this->title) ?></h1>
        <div class="action-area normal-case"><?= Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Novi licencni paket inženjera'), ['create', 'EngineerLicences[engineer_id]'=>$engineer->id], ['class' => 'btn btn-primary' ]) ?>
            </div>
        </div>
        <div class="subhead">Lista licencnih paketa inženjera.</div>
    </div>              
</div>
<hr>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9">
            <?php Pjax::begin(); ?>    <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'label'=>'Inženjer',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::a($data->engineer->name, ['/engineers/view', 'id' => $data->engineer_id]);
                        },
                    ],
                    'type',
                    'no',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        <?php Pjax::end(); ?>
        </div>
        <div class="col-sm-3">
            <?php if($engineerLicences = $engineer->engineerLicences){
                        foreach($engineerLicences as $engineerLicence){?>
                <div class="card_container record-full grid-item fadeInUp animated" id="">
                    <div class="primary-context gray normal">
                        <div class="head button_to_show_secondary">Licenca  <?= $engineerLicence->no ?></div>                         
                        <div class="subhead"></div>
                    </div>
                    <div class="secondary-context none">
                    <?php                                
                            echo Html::a('Podesi licencni paket', Url::to(['/engineer-licences/update', 'id'=>$engineerLicence->id]), ['class' => 'btn btn-success btn-sm right']).'<hr>';
                            echo $engineerLicence->copy ? Html::img('/images/legal_files/licences/'.$engineerLicence->copy->name) : null;
                            echo $engineerLicence->conf ? Html::img('/images/legal_files/licences/'.$engineerLicence->conf->name) : null;
                            echo $engineerLicence->stamp ? Html::img('/images/legal_files/licences/'.$engineerLicence->stamp->name) : null; ?>
                       
                    </div>
                </div>
                <?php  }
                    } ?>
        </div>
    </div>
    
</div>


            
                    
