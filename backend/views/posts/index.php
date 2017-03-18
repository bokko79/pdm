<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Posts'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'profile_id',
            //'file_id',
            'category.category',
            //'lang_code',
            [
               'attribute'=>'title',
               'format' => 'raw',
               'value'=>function ($data) {
                    return Html::a($data->title, ['/posts/update', 'id'=>$data->id]);
                },
            ],
             'title',
             'subtitle',
            // 'content:ntext',
            // 'excerpt',
            // 'type',
            // 'status',
            // 'comment_status',
            // 'next_post',
            // 'time',
            // 'update_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
