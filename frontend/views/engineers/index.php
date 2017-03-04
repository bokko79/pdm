<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\EngineersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Projektanti');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card_container record-full transparent no-shadow grid-item fadeInUp animated" id="">
    <div class="primary-context  normal">
        <div class="head"><h1 style="display: inline;"><i class="fa fa-user-circle-o"></i> <?= Html::encode($this->title) ?></h1>
        <div class="action-area normal-case"><?= Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Novi projektant'), ['create'], ['class' => 'btn btn-success' ]) ?>
            </div>
        </div>
        <div class="subhead">Lista registrovanih inženjera i projektanata.</div>
    </div>              
</div>
<hr>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
               'attribute'=>'name',
               'format' => 'raw',
               'value'=>function ($data) {
                    return Html::a($data->name, ['/engineers/view', 'id'=>$data->id]);
                },
            ],
            'title',
            'phone',
            'email:email',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
