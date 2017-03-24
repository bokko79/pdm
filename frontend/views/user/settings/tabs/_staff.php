
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
        <div class="head ">Inženjeri firme
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Novi inženjer firme', ['/practice-engineers/create', 'PracticeEngineersSearch[practice_id]' => $model->engineer_id], ['class' => 'btn btn-primary btn-sm']) ?></div>
        </div>
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