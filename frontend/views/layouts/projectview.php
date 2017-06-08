<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

$model = isset($this->params['project']) ? $this->params['project'] : [];
?>
<?php $this->beginContent('@frontend/views/layouts/html/html.php'); ?>

<div class="wrap">
    
        <?= $this->render('header/_subheader') ?> 
	<div class="container">
    
        <div class="row">
            <div class="col-sm-12">
                <?= Breadcrumbs::widget([
                    'homeLink' => ['label' => 'Početna', 'url' => \Yii::$app->user->can('updateOwnProject', ['project'=>$model]) ? '/user/security/home' : Yii::$app->getHomeUrl()],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'encodeLabels' => false,
                ]) ?>
            </div>
        </div>
        <?php // $this->render('header/_headerview', ['model'=>$model]) ?>
                
        
        <div class="row">
            <div class="col-sm-12">
                
                <?= $content ?>
                	
            </div>
        </div>
    </div>
</div>

<?php $this->endContent(); // HTML ?>
