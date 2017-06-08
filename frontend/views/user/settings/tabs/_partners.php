
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
        <div class="head ">Partneri firme
            <div class="subaction"><?= Html::a('<i class="fa fa-plus-circle"></i> Novi partner firme', ['/practices'], ['class' => 'btn btn-primary btn-sm']) ?></div>
        </div>
    </div>
    <div class="secondary-context">
        <?= GridView::widget([
            'dataProvider' => $practicePartners,
            'columns' => [
                [
                    'label'=>'Partner',
                    'format' => 'raw',
                    'value'=>function ($data) {
                        return Yii::$app->user->id!=$data->partner_id ? Html::a($data->partner->name, ['/practices/view', 'id' => $data->partner_id]) : Html::a($data->practice->name, ['/practices/view', 'id' => $data->practice_id]);
                    },
                ],
                'status',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '',
                      'template' => '{update}{confirm}{delete}',
                      'buttons' => [
                        'update' => function ($url, $model) {
                            return Html::a('<i class="fa fa-wrench"></i>', ['/practice-partners/update','id'=>$model->id], ['class' => 'btn btn-success btn-xs','style' => 'margin-left:10px;',]);
                        },
                        'confirm' => function ($url, $model) {
                            return ($model->status!='partner' and Yii::$app->user->id==$model->partner_id) ? Html::a('<i class="fa fa-check-circle"></i>', ['/practice-partners/confirm','id'=>$model->id], ['class' => 'btn btn-info btn-xs','style' => 'margin-left:10px;',]) : null;
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<i class="fa fa-times"></i>', ['/practice-partners/delete','id'=>$model->id], [
                            'class' => 'btn btn-danger btn-xs',
                            'style' => 'margin-left:10px;',
                            'data' => [
                                'confirm' => Yii::t('app', 'Da li ste sigurni da želite da izbacite firmu iz svojih partnera?'),
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