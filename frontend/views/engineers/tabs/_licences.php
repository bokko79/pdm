
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;

?>

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

                [
                    'label'=>'Kopija licence',
                    'format' => 'raw',
                    'value'=>function ($data) {
                        return $data->copy ? Html::img('/images/legal_files/licences/'.$data->copy->name, ['style'=>'width:150px;']) : null;
                    },
                ],
                [
                    'label'=>'Potvrda licence',
                    'format' => 'raw',
                    'value'=>function ($data) {
                        return $data->conf ? Html::img('/images/legal_files/licences/'.$data->conf->name, ['style'=>'width:150px;']) : null;
                    },
                ],
                [
                    'label'=>'Pečat licence',
                    'format' => 'raw',
                    'value'=>function ($data) {
                        return $data->stamp ? Html::img('/images/legal_files/licences/'.$data->stamp->name, ['style'=>'width:150px;']) : null;
                    },
                ],
            ],
            'summary' => false,
        ]); ?>
    </div>            
</div>