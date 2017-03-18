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
        <div class="col-sm-3">
            <?= $this->render('_menu', [
                    //'model' => $model,  
                ]) ?>        
        </div>
        <div class="col-sm-9">
        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_post',
            //'options' => ['style' => 'right:0', 'class' => 'list-view'],
            'itemOptions' => ['class' => 'imte'],
        ]) ?>
        </div>
    </div>
    
</div>
