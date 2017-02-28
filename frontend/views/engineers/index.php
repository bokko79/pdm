<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\EngineersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Inženjeri');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="engineers-index">

    <h1><i class="fa fa-user-circle-o"></i> <?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Kreiraj inženjera'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
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
<?php Pjax::end(); ?></div>
