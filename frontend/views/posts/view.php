<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Posts */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Info'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9">
            <div class="card_container record-full grid-item fadeInUp animated" id="">
                <div class="primary-context inverted normal" style="background: #ff6000; border-bottom:3px solid #000">
                    <div class="head colos"><i class="fa fa-newspaper-o"></i> <?= c($model->title) ?></div>
                    <div class="subhead"><?= $model->subtitle ?></div>
                </div>
                <div class="secondary-context post-style">  
                    <?= $model->content ?>
                </div>
                <div class="action-area right">
                    <?= Html::a('<i class="fa fa-arrow-circle-right"></i> Sledeći', Url::to(['/posts/view', 'id'=>$model->next_post]), ['class' => 'btn btn-default btn-sm']) ?>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            
        </div>
    </div>
    
</div>
            

    <?php /* DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'profile_id',
            'file_id',
            'category_id',
            'lang_code',
            'title',
            'subtitle',
            'content:ntext',
            'excerpt',
            'type',
            'status',
            'comment_status',
            'next_post',
            'time',
            'update_time',
        ],
    ]) */ ?>

