<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'Baza', 
            'items' => [
                ['label' => 'Nadležni organi', 'url' => ['/authorities/index']],
                ['label' => 'Gradovi', 'url' => ['/cities/index']],
                ['label' => 'Katastarske opštine', 'url' => ['/counties/index']],
                ['label' => 'Objekti', 'url' => ['/buildings/index']],
                ['label' => 'Namene zgrada', 'url' => ['/building-types/index']],
            ],
        ],
        ['label' => 'Dokumenti', 
            'items' => [
                ['label' => 'Volumes', 'url' => ['/volumes/index']],
                ['label' => 'Phase Volumes', 'url' => ['/phase-volumes/index']],
                ['label' => 'Insets', 'url' => ['/insets/index']],
                ['label' => 'Phase Volumes Insets', 'url' => ['/phase-volume-insets/index']],
            ],
        ],
        ['label' => 'Članci', 
            'items' => [
                ['label' => 'Posts', 'url' => ['/posts/index']],
                ['label' => 'Post Categories', 'url' => ['/post-categories/index']],
            ],
        ],
        ['label' => 'Predmer', 
            'items' => [
                ['label' => 'Podkategorije', 'url' => ['/qs-subworks/index']],
                ['label' => 'Akcije', 'url' => ['/qs-actions/index']],
                ['label' => 'Pozicije', 'url' => ['/qs-positions/index']],
            ],
        ],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
