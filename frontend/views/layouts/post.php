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
    
        <?php // $this->render('header/_subheader') ?> 
        <?= $this->render('header/_postheader', ['model'=>$model]) ?>
                
        
    <div class="container" style="padding-top:280px;">
        <div class="row">
            <div class="col-sm-12">

                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
    </div>

<?php $this->endContent(); // HTML ?>