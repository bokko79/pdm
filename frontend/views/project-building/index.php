<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectBuildingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Objekat projekta');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-building-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'project_id',
            'building_id',
            'name',
            'type',
            // 'building_line_dist',
            // 'lot_area',
            // 'green_area_reg',
            // 'green_area',
            // 'gross_area_part',
            // 'gross_area',
            // 'gross_area_above',
            // 'gross_area_below',
            // 'gross_built_area',
            // 'net_area',
            // 'ground_floor_area',
            // 'occupancy_area',
            // 'occupancy_reg',
            // 'occupancy',
            // 'built_index_reg',
            // 'built_index',
            // 'storey',
            // 'storey_height',
            // 'units_total',
            // 'parking_total',
            // 'facade_material:ntext',
            // 'ridge_orientation',
            // 'roof_pitch',
            // 'roof_material:ntext',
            // 'characteristics:ntext',
            // 'cost',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
