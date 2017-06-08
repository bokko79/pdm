<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
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
        <?= Breadcrumbs::widget([
            'homeLink' => ['label' => 'Početna', 'url' => !\Yii::$app->user->isGuest ? '/user/security/home' : Yii::$app->getHomeUrl()],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'encodeLabels' => false,
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<?php $this->endContent(); // HTML ?>
