<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

// AppAsset::register($this);

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
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet">
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA0gGAstlLLw1uVSUraxDKtRYDDGObfmmg&amp;libraries=places&amp;language=hr"></script>
    <?php $this->head() ?>
</head>
<body class="<?= (!\Yii::$app->user->isGuest and \Yii::$app->user->theme) ? '' : 'dark-theme' ?>">
<?php $this->beginBody() ?>

	<?= $content ?>

	<?= $this->render('../partial/footer.php') ?>

<?php $this->endBody() ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-49522735-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
<?php $this->endPage() ?>