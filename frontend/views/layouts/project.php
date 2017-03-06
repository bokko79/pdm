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
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <script src="https://use.fontawesome.com/f6ceb1ff95.js"></script>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    

    <?php
    NavBar::begin([
        'brandLabel' => Html::img('/images/logo2-small.png', ['style'=>'width:150px;']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => '<i class="fa fa-file"></i> Projekti', 'url' => ['/projects'], 'visible'=>!Yii::$app->user->isGuest],
        
        //['label' => 'Help', 'url' => ['/site/contact']],
        ['label' => '<i class="fa fa-database"></i> Baza podataka', 'visible'=>!Yii::$app->user->isGuest,
            'items' => [
                ['label' => '<i class="fa fa-shield"></i> Firme', 'url' => ['/practices']],
                ['label' => '<i class="fa fa-user-circle-o"></i> Inženjeri', 'url' => ['/engineers']],
                ['label' => '<i class="fa fa-building"></i> Investitori', 'url' => ['/clients']],
                '<hr>',
                ['label' => '<i class="fa fa-file"></i> Dokumenti projekata', 'url' => ['/project-files']],
                ['label' => '<i class="fa fa-file-o"></i> Ostali dokumenti', 'url' => ['/legal-files']],
            ],
        ],
    ];
    if (Yii::$app->user->isGuest) {
        //$menuItems[] = ['label' => 'Registracija', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Odjava (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
        'encodeLabels' => false,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <div class="card_container record-full grid-item transparent no-shadow no-margin fadeInUp animated" id="">
            <div class="primary-context normal">
                <div class="head grand thin"><i class="fa fa-file-powerpoint-o"></i> <?= $model->code. ': '.$model->name. ' ('.$model->projectBuilding->spratnost.')' ?>
                <div class="action-area normal-case"><?= Html::a('<i class="fa fa-cog"></i> Podesi', Url::to(['/projects/update', 'id'=>$model->id]), ['class' => 'btn btn-success btn-sm']) ?>
                            <?= Html::a($model->status=='deleted' ? Yii::t('app', 'Aktiviraj') : Yii::t('app', '<i class="fa fa-power-off"></i>'), ['activate', 'id' => $model->id], ['class' => 'btn btn-danger btn-sm']) ?>
                    </div>
                </div>
                <div class="subhead">Podaci projekta.</div>
            </div>
        </div>
        <?php
            echo Nav::widget([
                'options'=>['class'=>'nav nav-pills', 'style'=>'z-index:10000'],
                'encodeLabels' => false,
                'items' => [
                    ['label' => '<i class="fa fa-home"></i> '.$model->code, 'url' => ['/projects/view', 'id'=>$model->id]],
                   /* ['label' => '<i class="fa fa-user-circle-o"></i> Investitori', 'url' => ['/project-clients/view', 'id'=>$model->id]],*/
                   /* ['label' => '<i class="fa fa-file"></i> Dokumenti', 'url' => '#'],*/
                    ['label' => '<i class="fa fa-map-marker"></i> Parcela', 'url' => ['/project-lot/view', 'id'=>$model->id]],
                    ['label' => '<i class="fa fa-building"></i> Objekat', 'url' => ['/project-building/view', 'id'=>$model->id]],
                    ['label' => '<i class="fa fa-bars"></i> Prostori objekta', 'url' => ['/project-building/storeys', 'id'=>$model->id]],
                    ['label' => '<i class="fa fa-pencil"></i> Opis objekta', 'items' => [
                        '<li class="dropdown-header">Tehnički opis</li>',
                        ['label' => 'Arhitektonsko rešenje', 'url' => ['/project-building-characteristics/update', 'id'=>$model->id]],
                        ['label' => 'Konstrukcija', 'url' => ['/project-building-structure/update', 'id'=>$model->id]],
                        ['label' => 'Materijalizacija', 'url' => ['/project-building-materials/update', 'id'=>$model->id]],
                        ['label' => 'Izolacija', 'url' => ['/project-building-insulations/update', 'id'=>$model->id]],
                        ['label' => 'Instalacije', 'url' => ['/project-building-services/update', 'id'=>$model->id]],
                        '<li class="divider"></li>',
                        '<li class="dropdown-header">Numerička dokumentacija</li>',
                        ['label' => '<i class="fa fa-calculator"></i> Predmer i predračun', 'url' => '#'],
                        ['label' => '<i class="fa fa-calendar"></i> Šeme stolarije i bravarije', 'url' => '#'], 
                    ]],
                    
                ]
            ]);
        ?>
        <hr style="margin:5px 0 30px;">
        <?= Alert::widget() ?>
        <?= $content ?>
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
