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


<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3">
        <h5><i class="fa fa-filter"></i> Filter</h5><br>
        <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div class="col-sm-9">
        <h1><i class="fa fa-shield"></i> <?= $this->title ?></h1>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_practice',
            'itemOptions' => [],
        ]) ?>
    </div>
 </div>
</div>
