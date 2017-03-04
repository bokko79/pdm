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

<div class="card_container record-full transparent no-shadow grid-item fadeInUp animated" id="">
    <div class="primary-context  normal">
        <div class="head"><h1 style="display: inline;"><i class="fa fa-building"></i> <?= Html::encode($this->title) ?></h1>
        <div class="action-area normal-case"><?= Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Novi investitor'), ['create'], ['class' => 'btn btn-success' ]) ?>
            </div>
        </div>
        <div class="subhead">Lista registrovanih investitora.</div>
    </div>              
</div>
<hr>

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
