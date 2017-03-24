<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ListView;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PracticesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Firme');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card_container record-full transparent no-shadow grid-item fadeInUp animated" id="">
    <div class="primary-context  normal">
        <div class="head">
            <h1 style="display: inline;"><i class="fa fa-shield"></i> <?= Html::encode($this->title) ?></h1>
            <div class="action-area normal-case">
                <?= (\Yii::$app->user->can('engineer') and \Yii::$app->user->engineer and \Yii::$app->user->engineer->practice) ? Html::a(Yii::t('app', '<i class="fa fa-plus-circle"></i> Nova firma'), ['create'], ['class' => 'btn btn-success' ]) : null ?>
                <div style="width: ;">
   <?php echo $this->render('_search', ['model' => $searchModel]); ?> 
</div>
            </div>
        </div>
        <div class="subhead">Lista registrovanih preduzeća.</div>
    </div>              
</div>
<hr>

<?php /* Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
               'label'=>'Naziv firme',
               'format' => 'raw',
               'value'=>function ($data) {
                    return Html::a($data->name, ['/practices/view', 'id'=>$data->engineer_id]);
                },
            ],
            'name',
            'location_id',
            'phone',
            'email:email',
            'engineer.name',
            // 'fax',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); */ ?>


        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_practice',
            'itemOptions' => [],
        ]) ?>
