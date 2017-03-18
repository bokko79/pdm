<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\RegulationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Stručna i zakonska regulativa');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regulations-index">

    <h1><?= Html::encode($this->title) ?></h1>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
               'attribute'=>'name',
               'format' => 'raw',
               'value'=>function ($data) {
                    return Html::a($data->name, ['/site/download', 'path'=>'/images/regulations/'.$data->id.'.pdf']);
                },
            ],
            [
               'attribute'=>'status',
               'format' => 'raw',
               'value'=>function ($data) {
                    return $data->status ? 'aktivno' : 'zastarelo';
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
        //'encodeLabels'=>true,
    ]); ?>
<?php Pjax::end(); ?></div>
