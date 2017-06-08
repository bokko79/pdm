<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
/* @var $this yii\web\View */
/* @var $searchModel common\models\EngineersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Inženjeri');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3">
        <h5><i class="fa fa-filter"></i> Filter</h5><hr>
        <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div class="col-sm-6">
        <?php
                
            echo Nav::widget([
                'options'=>['class'=>'nav nav-pills', 'style'=>'z-index:10000; margin: 0 0 0 0'],
                'encodeLabels' => false,
                'items' => [                                
                    ['label' => '<i class="fa fa-building"></i> Firme', 'url' => ['/practices/index'], 'linkOptions'=>['style'=>'']],
                    
                    // investitori projekta
                    ['label' => '<i class="fa fa-users"></i> Inženjeri', 'url' => ['/engineers/index']],

                ]
            ]);
         ?>
         <hr>
         <?= $this->render('../practices/_searchByName', ['model' => $searchModel]); ?>
        <?php echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_engineer',
            ]); ?>
    </div>
    <div class="col-sm-3">
        <?php if(Yii::$app->user->isGuest or !Yii::$app->user->engineer): ?>
            <?= $this->render('../engineers/_registerAs'); ?>
            <hr>
        <?php endif; ?>
        <div class="card_container record-full grid-item transparent fadeInUp no-shadow animated-not no-margin" id="" style="float:none;">
            <div class="primary-context no-padding">
                <div class="head lower regular">
                    Top inženjeri                   
                </div>              
            </div> 
        </div>
        <?php echo ListView::widget([
                      'dataProvider' => $dataProvider,
                      'itemView' => '_engineer_short',
                      'layout' => '{items}',
                  ]); ?>
    </div>
 </div>
</div>
    <?php /*
<div class="card_container record-full transparent no-shadow grid-item fadeInUp animated" id="">
    <div class="primary-context  normal">
        <div class="head">
            <h1 style="display: inline;"><i class="fa fa-user-circle-o"></i> <?= Html::encode($this->title) ?></h1>
            <div class="action-area normal-case">
                <?= !\Yii::$app->user->can('engineer') ? Html::a(Yii::t('app', '<i class="fa fa-sign-in"></i> Registruj se kao inženjer'), ['/user/registration/register'], ['class' => 'btn btn-default' ]) : null ?>
            </div>
        </div>
        <div class="subhead">Lista registrovanih inženjera i projektanata.</div>
    </div>              
</div>
<hr>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
               'attribute'=>'name',
               'format' => 'raw',
               'value'=>function ($data) {
                    return Html::a($data->name, ['/engineers/view', 'id'=>$data->user_id]);
                },
            ],
            'expertees.name',
            'phone',
            'email:email',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>*/