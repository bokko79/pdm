<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Project Documentation Manager';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>PDM</h1>

        <p class="lead">Upravljanje građevinskom<br> projektno-tehničkom dokumentacijom.</p>

        <p><?= Html::a(Yii::t('app', 'Projekti'), ['/projects'], ['class' => 'btn btn-lg btn-info']) ?>
            
            <?= Html::a(Yii::t('app', 'Novi projekat'), ['/projects/create'], ['class' => 'btn btn-lg btn-default']) ?>
        </p>
    
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Stručno</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Lako</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Po propisima</h2>

                <p>PDM je izrađen po važećoj stručnoj i pravnoj regulativi i propisima, koji važe na teritoriji Republike Srbije.</p>

                <p><?= Html::a(Yii::t('app', 'Regulativa'), ['/regulations'], ['class' => 'btn btn-default']) ?></p>
            </div>
        </div>

    </div>
</div>
