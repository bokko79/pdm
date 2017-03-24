
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
        <div class="head">Dokumenti
        <div class="action-area"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj dokument', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->user_id, 'LegalFilesSearch[entity]'=>'engineer']), ['class' => 'btn btn-primary btn-sm']) ?></div>
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
                        return Html::a($data->docType, ['legal-files/update', 'id' => $data->id, 'LegalFiles[type]'=>$data->type]);
                    },
                ],
                [
                    'label'=>'Dokument',
                    'format' => 'raw',
                    'value'=>function ($data) {
                        return $data->file ? Html::img('/images/legal_files/'.$data->folder.'/'.$data->file->name, ['style'=>'width:150px;']) : null;
                    },
                ],
                //'value',
            ],
        ]); ?>
    </div>
</div>