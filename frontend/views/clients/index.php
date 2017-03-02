<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ClientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Investitori');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clients-index">

    <h1><i class="fa fa-building"></i> <?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app', 'Dodaj investitora'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'name',
                 'format' => 'raw',
                'value'=>function ($data) {
                        return Html::a($data->name, ['/clients/view', 'id'=>$data->id]);
                },
            ],
            'location.city.town',
            'phone',
            'email:email',
            // 'type',
            'contact_person',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
