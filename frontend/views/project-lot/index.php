<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectLotSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Project Lots');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-lot-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Project Lot'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'project_id',
            'conditions',
            'width',
            'length',
            'disposition:ntext',
            // 'type',
            // 'area',
            // 'ground_level',
            // 'road_level',
            // 'underwater_level',
            // 'ground:ntext',
            // 'access:ntext',
            // 'ownership:ntext',
            // 'adjacent_border:ntext',
            // 'services:ntext',
            // 'description:ntext',
            // 'note:ntext',
            // 'legal:ntext',
            // 'green_area_reg',
            // 'green_area',
            // 'occupancy_reg',
            // 'built_index_reg',
            // 'parking:ntext',
            // 'parking_spaces',
            // 'parking_disabled',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
