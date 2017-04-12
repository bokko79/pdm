<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\GeoAsset;
use common\widgets\Alert;

GeoAsset::register($this);

$model = isset($this->params['project']) ? $this->params['project'] : [];
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script src="https://use.fontawesome.com/f6ceb1ff95.js"></script>
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCKwIZE-aiLFaqHRxnhI5w5fR-60dl1GMI&amp;libraries=places&amp;language=hr"></script>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    
        <?= $this->render('header/_subheader') ?> 
        <?= $this->render('header/_header', ['model'=>$model]) ?>
                
        
        <hr style="margin:5px 0 30px;">
        <div class="row">
            <div class="col-sm-12">

                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left"><?= Html::img('/images/logo2-small.png', ['style'=>'width:100px; margin-right:20px;']) ?>Masterplan ARC d.o.o. &copy; <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
