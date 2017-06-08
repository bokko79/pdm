<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

$formatter = \Yii::$app->formatter;
/*
?>
<div class="header-wrapper profile" style="<?= $model->cFile ? 'background: url(\'/images/profiles/'.$model->cFile->name.'\');' : 'background: url(\'/images/profiles/back.jpg\');' ?> background-size: cover;">
 */ 

$check_engineers = [];
$check_partners = [];
if(!Yii::$app->user->isGuest and Yii::$app->user->engineer){
  if(Yii::$app->user->engineer->practiceEngineers){
    foreach (Yii::$app->user->engineer->practiceEngineers as $key => $value) {
      $check_engineers[] = $value->practice_id;
    }
  }

  if(Yii::$app->user->engineer->practice and Yii::$app->user->engineer->practice->practicePartners){
    foreach (Yii::$app->user->engineer->practice->practicePartners as $key => $value) {
      $check_partners[] = Yii::$app->user->id==$value->practice_id ? $value->partner_id : $value->practice_id;
    }
  }
}
?>   

    

<div class="container" style="margin-top:0px;">
    <div class="row">
            <div class="col-sm-12" style="padding:20px;">
                <?= Breadcrumbs::widget([
                    'homeLink' => ['label' => 'Početna', 'url' => !\Yii::$app->user->isGuest ? '/user/security/home' : Yii::$app->getHomeUrl()],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'encodeLabels' => false,
                ]) ?>
            </div>
        </div>
    <div class="row">
        <div class="col-sm-12">

            <div class="card_container record-full bordred fadeInUp animated-not" id="card_container" style="background: #;">
                <div class="secondary-context">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="">
                                <?= ($model->aFile) ? Html::img('/images/profiles/'.$model->aFile->name, ['style'=>'height:160px; width:160px;  max-height:160px;']) : Html::img('/images/profiles/back.jpg', ['style'=>'height:160px; width:160px; max-height:160px;']) ?>
                            </div>
                        </div>
                    
                        <div class="col-sm-6">
                            <div class="title" style="padding:0; float:none;">
                                <div class="head large" style="margin: 10px 0 10px; line-height: 22px; color:; text-shadow:">
                                    <?= c($model->name) ?> <?= (1==1) ? '<div class="label label-success fs_11 thin"><i class="fa fa-check"></i></div>' : null ?>
                                    
                                </div>
                                <div class="subhead" style="line-height: 32px; margin-bottom:10px;">
                                    <?= \yii\helpers\StringHelper::truncate($model->about, 220) ?>
                                </div>
                                <?= Html::a(Yii::t('app', '<i class="fa fa-envelope"></i> Kontakt'), null, ['href' => 'mailto:'.$model->email, 'class' => 'btn btn-default btn-sm' ]) ?>
                                <?php // Html::a(Yii::t('app', '<i class="fa fa-user-circle"></i> Direktor'), ['/engineers/view', 'id' => $model->engineer_id], ['class' => 'btn btn-info btn-sm' ]) ?>

            
                                <?php if(!Yii::$app->user->isGuest and Yii::$app->user->engineer and !Yii::$app->user->engineer->practice and !in_array($model->engineer_id, $check_engineers) and Yii::$app->user->id!=$model->engineer_id): ?>
                                    <?= Html::a('<i class="fa fa-plus-circle"></i> Postani inženjer firme', Yii::$app->user->isGuest ? Url::to(['/user/register']) : Url::to(['/practice-engineers/create', 'PracticeEngineersSearch[practice_id]'=>$model->engineer_id, 'PracticeEngineersSearch[engineer_id]'=>\Yii::$app->user->id, 'PracticeEngineersSearch[status]'=>'to_join']), ['class' => 'btn btn-success btn-sm ']) ?>
                                <?php endif; ?>
                                  <?php if(!Yii::$app->user->isGuest and Yii::$app->user->engineer and Yii::$app->user->engineer->practice and !in_array($model->engineer_id, $check_partners) and Yii::$app->user->id!=$model->engineer_id): ?> 
                                    
                                        <?= Html::a('<i class="fa fa-plus-circle"></i> Postani partner firme', Yii::$app->user->isGuest ? Url::to(['/user/register']) : Url::to(['/practice-partners/create', 'PracticePartners[practice_id]'=>\Yii::$app->user->id, 'PracticePartners[partner_id]'=>$model->engineer_id, 'PracticePartners[status]'=>'invited']), ['class' => 'btn btn-danger btn-sm ']) ?>  
                                  
                                  <?php endif; ?> 
                            </div>
                        </div>
                        <div class="col-sm-4" style="border-left: 1px solid #ddd; height:160px">
                            
                            <table style="color:#444;">
                                <tr>
                                    <td style="width:50%; padding:10px; font-weight:700;">Lokacija:</td><td style="padding:10px;"><?= $model->location->city->town ?></td>
                                </tr>
                                <tr>
                                    <td style="width:50%; padding:10px; font-weight:700;">Broj projekata:</td><td style="padding:10px;"><?= count($model->projectVolumes) ?></td>
                                </tr>
                                <tr>
                                    <td style="width:50%; padding:10px; font-weight:700;">Broj zaposlenih:</td><td style="padding:10px;"><?= count($model->practiceEngineers) ?></td>
                                </tr>
                                <tr>
                                    <td style="width:50%; padding:10px; font-weight:700;">Član od:</td><td style="padding:10px;"><?= $formatter->asDate($model->engineer->user->created_at, 'php: F Y.') ?></td>
                                </tr>
                            </table>
                        </div>
                    </div> 
                                     
                </div>
            </div>
        
        </div>
    </div>
</div>

<?php /*
</div> */ ?>