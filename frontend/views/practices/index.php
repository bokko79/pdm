<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PracticesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Firme');
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><i class="fa fa-shield"></i>  <?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Kreiraj novu firmu'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
               'label'=>'Naziv firme',
               'format' => 'raw',
               'value'=>function ($data) {
                    return Html::a($data->name, ['/practices/view', 'id'=>$data->id]);
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
<?php Pjax::end(); ?></div>
