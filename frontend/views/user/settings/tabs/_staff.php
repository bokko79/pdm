
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
                        return Html::a($data->engineer->name, ['/engineers/view', 'id' => $data->engineer_id]);
                    },
                ],
                'position',
                'status',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '',
                      'template' => '{update}{confirm}{delete}',
                      'buttons' => [
                        'view' => function ($url, $model) {
                            return $model->position!='direktor' ? Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['/practice-engineers/view','id'=>$model->id], ['class' => 'btn btn-default btn-xs']) : null;
                        },

                        'update' => function ($url, $model) {
                            return $model->position!='direktor' ? Html::a('<i class="fa fa-wrench"></i>', ['/practice-engineers/update','id'=>$model->id], ['class' => 'btn btn-success btn-xs','style' => 'margin-left:10px;',]) : null;
                        },
                        'confirm' => function ($url, $model) {
                            return $model->position!='direktor' and $model->status!='joined' ? Html::a('<i class="fa fa-check-circle"></i>', ['/practice-engineers/confirm','id'=>$model->id], ['class' => 'btn btn-info btn-xs','style' => 'margin-left:10px;',]) : null;
                        },
                        'delete' => function ($url, $model) {
                            return $model->position!='direktor' ? Html::a('<i class="fa fa-times"></i>', ['/practice-engineers/delete','id'=>$model->id], [
                            'class' => 'btn btn-danger btn-xs',
                            'style' => 'margin-left:10px;',
                            'data' => [
                                'confirm' => Yii::t('app', 'Da li ste sigurni da želite da izbacite inženjera?'),
                                'method' => 'post',
                            ],
                        ]) : null;
                        },
                      ],
                      
                ],
            ],
        ]); ?>
    </div>
</div>