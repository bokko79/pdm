<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;
use yii\widgets\ListView;

$formatter = \Yii::$app->formatter;


/* @var $this yii\web\View */
/* @var $model common\models\Posts */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Info'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <div class="col-sm-9">
            <div class="card_container record-full grid-item fadeInUp animated-not" id="">


                <?php if($model->file): ?>
            <div class="media-area">                
                <div class="image">
                    <?= Html::img('@web/images/posts/'.$model->file->name) ?>                   
                </div>
            </div>
        <?php endif; ?>

            <div class="primary-context">
                <div class="subhead"><?= $model->user->username ?></div>
                <div class="head colos"><?= Html::encode(c($model->title)) ?></div>
                <div class="subhead"><?= $formatter->asDate($model->time, 'php: F Y.') ?></div>
            </div>
            <div class="secondary-context cont">
                <div class="head hint"><i class="fa fa-newspaper-o"></i> <?= Html::encode(c($model->subtitle)) ?></div>
            </div>
            <div class="secondary-context">
                <div><?= HtmlPurifier::process($model->excerpt) ?></div>
                <?= $formatter->asDate($model->time, 'php: F Y.') ?>
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
            <?php if(Yii::$app->user->isGuest or !Yii::$app->user->engineer): ?>
                <?= $this->render('../engineers/_registerAs'); ?>
                <hr>
            <?php endif; ?>
            <div class="card_container record-full grid-item transparent fadeInUp no-shadow animated-not no-margin" id="" style="float:none;">
                <div class="primary-context   no-padding">
                    <div class="head lower regular">
                        Ostali članci
                    </div>              
                </div> 
            </div>
            <?php echo ListView::widget([
                          'dataProvider' => $posts,
                          'itemView' => '_post_short',
                          'layout' => '{items}',
                      ]); ?>
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

