<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectBuildingDoorwinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Project Building Doorwins');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-building-doorwin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Project Building Doorwin'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'pos_no',
            'pos_type',
            'type',
            'name',
            // 'project_id',
            // 'description:ntext',
            // 'width',
            // 'height',
            // 'frame',
            // 'sash',
            // 'opening_type',
            // 'material',
            // 'metal',
            // 'note',
            // 'scale',
            // 'file_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
