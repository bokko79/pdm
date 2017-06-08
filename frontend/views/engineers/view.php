<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use kartik\tabs\TabsX;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model common\models\Engineers */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inženjeri'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['profile'] = $model;
     
$items = [
    [
        'label'=>'<i class="fa fa-shield"></i> Profil',
        'content'=>$this->render('tabs/_general', ['model'=>$model]),
        'active'=>true
    ],    
    [
        'label'=>'<i class="fa fa-file-powerpoint-o"></i> Projekti',
        'content'=>$this->render('tabs/_projects', ['model'=>$model, 'projects'=>$projects]),
    ],
    [
        'label'=>'<i class="fa fa-user-circle-o"></i> Portfolio',
        'content'=>$this->render('tabs/_portfolio', ['model'=>$model]),
    ],
    [
        'label'=>'<i class="fa fa-file-text"></i> Dokumenti',
        'content'=>$this->render('tabs/_docs', ['model'=>$model, 'engineerFiles'=>$engineerFiles]),
    ],
     [
        'label'=>'<i class="fa fa-tags"></i> Licence',
        'content'=>$this->render('tabs/_licences', ['model'=>$model, 'engineerLicences' => $engineerLicences]),
    ],
];
?>
<div class="row" style="margin-top:20px;">
    <div class="col-md-3" style="z-index:1">
        <?= $this->render('_menu', ['model'=>$model, 'projects'=>$projects]) ?>
    </div>
    <div class="col-md-6">
        <div class="card_container record-full grid-item fadeInUp no- animated-not " id="">
          <div class="secondary-context">
            <div class="head major">
              <div class="subhead uppercase hint" style="margin-bottom: 5px;">O meni</div>        
              <hr>                       
            </div>  
            
            <div class="card_container record-full grid-item fadeInUp transparent no-shadow animated-not" id="card_container">
               
                <div class="secondary-context cont">
                    <?= $model->about ?>  
                </div>
            </div>           
          </div>
            <?php if($experiences = $model->experiences): ?>
            <div class="secondary-context">
                <div class="head major">
                    <div class="subhead uppercase hint" style="margin-bottom: 5px;">Radno iskustvo</div>                               
                </div>
                <?php foreach($experiences as $experience){
                        echo $this->render('../user/settings/_portfolio', ['model'=>$experience]);
                    } ?>
            </div>
            <?php endif; ?>
            <?php if($educations = $model->educations): ?>
            <div class="secondary-context">
                <div class="head major">
                    <div class="subhead uppercase hint" style="margin-bottom: 5px;">Obrazovanje</div>                               
                </div>
                <?php foreach($educations as $education){
                        echo $this->render('../user/settings/_portfolio', ['model'=>$education]);
                    } ?>
            </div>
            <?php endif; ?>
        </div> 
        
        <div class="card_container record-full grid-item top-bordered transparent no-shadow animated-not " id="">
            <div class="primary-context">
                <div class="head">
                    <div class="subaction"><?= Html::a('<i class="fa fa-bars"></i> Svi', Url::to(['/projects/index', 'ProjectsSearch[engineer_id]'=>$model->user_id]), ['class' => 'btn btn-default btn-sm']) ?></div>
                  Projekti     
                  
                </div>
            </div>
        </div>
        <?php echo ListView::widget([
              'dataProvider' => $projects,
              'itemView' => '_project',
              'layout' => '{items}',
          ]); ?>
        
        <?php /* (Yii::$app->user->client!=null) ? $this->render('tabs/_requests', ['model'=>$model->client, 'requests'=>$requests]) : null */ ?>
    </div>
    <div class="col-md-3" style="z-index:1">
         <?php if(Yii::$app->user->isGuest or !Yii::$app->user->engineer): ?>
            <?= $this->render('../engineers/_registerAs'); ?>
            <hr>
        <?php endif; ?>
        <div class="card_container record-full grid-item transparent fadeInUp no-shadow animated-not no-margin" id="" style="float:none;">
            <div class="primary-context  no-padding">
                <div class="head lower regular">
                    Slični inžejeri                
                </div>              
            </div> 
        </div>
        <?php echo ListView::widget([
                  'dataProvider' => $engineers,
                  'itemView' => '_engineer_short',
                  'layout' => '{items}',
              ]); ?>
    </div>
</div>