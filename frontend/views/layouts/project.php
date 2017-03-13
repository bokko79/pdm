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
        ['label' => '<i class="fa fa-article"></i> Info',
            'items' => [
                ['label' => '<i class="fa fa-bookmark"></i> Pomoć', 'url' => ['/posts']],                
            ],
        ],
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
        $menuItems[] = ['label' => 'Login', 'url' => ['/user/login']];
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
        <div class="row">
            <div class="col-sm-12">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
               <div class="card_container record-full grid-item transparent no-shadow no-margin fadeInUp animated" id="">
                    <div class="primary-context normal">
                        <div class="head grand thin"><i class="fa fa-file-powerpoint-o"></i> <?= \yii\helpers\StringHelper::truncate($model->name, 50) . ($model->work!='adaptacija' ? ' ('.(($model->projectBuilding) ? $model->projectBuilding->spratnost : $model->projectExBuilding->spratnost).')' : null) ?>
                    
                        </div>
                        <div class="subhead">Podaci projekta.</div>
                    </div>
                </div> 
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <?php
                    echo Nav::widget([
                        'options'=>['class'=>'nav nav-pills', 'style'=>'z-index:10000'],
                        'encodeLabels' => false,
                        'items' => [                                
                            (Yii::$app->request->getUrl() == Url::toRoute(['/projects/view?id='.$model->id])) ? 
                            ['label' => '<i class="fa fa-home"></i> '.$model->code, 'url' =>['/projects/view', 'id'=>$model->id]] : 
                            ['label' => '<i class="fa fa-home"></i> '.$model->code, 'items' => [
                                ['label' => '<i class="fa fa-home"></i> '.$model->code, 'url' => ['/projects/view', 'id'=>$model->id]],
                                '<li class="divider"></li>',
                                ['label' => 'Investitori projekta', 'url' => ['/projects/view', 'id'=>$model->id, '#'=>'w1-tab1']],
                                ['label' => 'Dokumenti projekta', 'url' => ['/projects/view', 'id'=>$model->id, '#'=>'w1-tab2']],                                
                                //'<li class="divider"></li>',
                                //'<li class="dropdown-header">Tehnička dokumentacija</li>',
                                //['label' => 'Sveske', 'url' => ['/projects/view', 'id'=>$model->id, '#'=>'w1-tab3'], 'linkOptions'=>['style'=>'']],
                            ]],
                            // tehnička dokumentacija
                            ['label' => '<i class="fa fa-book"></i> Sveske', 'url' => ['/project-volumes/index', 'ProjectVolumes[project_id]'=>$model->id], 'active'=>Yii::$app->request->getUrl() == Url::toRoute(['/project-volumes/index?ProjectVolumes%5Bproject_id%5D='.$model->id])],
                            '<li class="divider-vertical"></li>',
                            // parcela
                            ['label' => '<i class="fa fa-map-marker"></i> Lokacija', 'url' => ['/project-lot/view', 'id'=>$model->id]],
                            // objekat
                            ['label' => '<i class="fa fa-home"></i> Objekat', 'items' => [
                                ($model->work!='nova_gradnja') ? '<li class="dropdown-header">Postojeće stanje</li>' : '',
                                ($model->work!='nova_gradnja') ? ['label' => $model->projectExBuilding->name. ' (postojeće stanje)', 'url' => ['/project-building/view', 'id'=>$model->projectExBuilding->id]] : '',
                                ($model->work!='nova_gradnja') ? ['label' => 'Površine', 'url' => ['/project-building-storeys/index', 'id'=>$model->projectExBuilding->id, '#'=>'w10-tab1']] : '',                       

                                ($model->work!='nova_gradnja') ? '<li class="divider"></li>' : '',
                                ($model->work!='nova_gradnja') ? '<li class="dropdown-header">Predviđeno stanje</li>' : '',
                                ($model->projectBuilding) ? ['label' => $model->projectBuilding->name. ' (predviđeno stanje)', 'url' => ['/project-building/view', 'id'=>$model->projectBuilding->id]] : '',
                                ($model->projectBuilding) ? ['label' => 'Površine', 'url' => ['/project-building-storeys/index', 'id'=>$model->projectBuilding->id, '#'=>'w10-tab1']] : '',

                            ], 'active'=>(($model->projectExBuilding and Yii::$app->request->getUrl() == Url::toRoute(['/project-building/view?id='.$model->projectExBuilding->id])) or ($model->projectBuilding and Yii::$app->request->getUrl() == Url::toRoute(['/project-building/view?id='.$model->projectBuilding->id])))],


                            // jedinice
                            ($model->work=='adaptacija') ?
                            ['label' => '<i class="fa fa-key"></i> '.c($model->projectUnit->fullType), 'items' => [
                                '<li class="dropdown-header">Postojeće stanje</li>',
                                ['label' => c($model->projectExUnit->fullType). ' (postojeće stanje)', 'url' => ['/project-building-storey-parts/view', 'id'=>$model->projectExUnit->id]],
                                '<li class="divider"></li>',                                 
                                '<li class="dropdown-header">Predviđeno stanje</li>',
                                ['label' => c($model->projectUnit->fullType). ' (predviđeno stanje)', 'url' => ['/project-building-storey-parts/view', 'id'=>$model->projectUnit->id]],
                            ], 'active'=>(Yii::$app->request->getUrl() == Url::toRoute(['/project-building-storey-parts/view?id='.$model->projectUnit->id]) or Yii::$app->request->getUrl() == Url::toRoute(['/project-building-storey-parts/view?id='.$model->projectExUnit->id]))] : '',
                          
                            ['label' => '<i class="fa fa-calculator"></i> Predmer', 'url' => ['/project-building-storeys/index', 'id'=>$model->id, 'visible'=>($model->work!='promena_namene' or $model->work!='ozakonjenje')]],
                            
                        ]
                    ]);
                ?>
            </div>
        </div>
                
        
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
