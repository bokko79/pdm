<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ListView;
/* @var $this yii\web\View */
/* @var $searchModel common\models\RequestsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Zahtevi investitora');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card_container record-full transparent no-shadow grid-item fadeInUp animated" id="">
    <div class="primary-context  normal">
        <div class="head">
            <h1 style="display: inline;"><i class="fa fa-question-circle"></i> <?= Html::encode($this->title) ?></h1>
            <div class="action-area normal-case">
                <?= (\Yii::$app->user->can('client')) ? Html::a(Yii::t('app', 'Napravi zahtev'), ['create'], ['class' => 'btn btn-success shadow']) : null ?>
                <div style="width: ;">
</div>
            </div>
        </div>
        <div class="subhead">Lista zahteva investitora.</div>
    </div>              
</div>
<hr>

<?php /* Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'client_id',
            'building_id',
            'location_id',
            'object_type',
            // 'work',
            // 'object_area',
            // 'phase',
            // 'lot_area',
            // 'description:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end();*/ ?>

 <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_request',
            'itemOptions' => [],
        ]) ?>

