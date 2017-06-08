<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Info');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="container-fluid">
    <div class="row">
    <?php /*
        <div class="col-sm-3">
            <?= $this->render('_menu', [
                    //'model' => $model,  
                ]) ?>        
        </div> */ ?>
        <div class="col-sm-12">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<div class="grid js-masonry overflow-hidden" data-masonry-options='{ "columnWidth": ".card_container.record-25", "itemSelector": ".grid-item", "gutter": 15 }' style="margin-top:20px;">

            
        
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_post',
            //'options' => ['style' => 'right:0', 'class' => 'grid'],
            //'itemOptions' => ['class' => 'item'],
            'summary' => false,
            //'layout' => '{items}<div style="visibility:hidden;">{pager}</div>',
        ]) ?>
</div>
        </div>
    </div>
    
</div>
