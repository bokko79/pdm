<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectLot */

$this->title = 'Parcela projekta';

$this->params['page_title'] = 'Lokacija';

$this->params['breadcrumbs'][] = ['label' => '<i class="fa fa-map-marker"></i> Lokacija projekta', 'url' => null];

$this->params['project'] = $model->project;
?>
<?php /*

        <div class="index" style="">
            <nav class="" id="myScrollspy">
                <ul class="nav nav-pills nav-stacked left" data-spy="affix" data-offset-top="180" style="top:70px;">
                    <li><a href="#location">Adresa</a></li>
                    <li><a href="#lot">Parcela</a></li>
                    <li><a href="#location-lots">Katastarske parcele</a></li>
                    <li><a href="#existing">Postojeći objekti</a></li>
                    <li><a href="#future">Predviđeni objekti</a></li>                
                </ul>  
            </nav>   

        </div> */ ?>
    
            <?= $this->render('tabs/_location', ['model'=>$model]) ?>
            <?= $this->render('tabs/_general', ['model'=>$model]) ?>
            <?php /* $this->render('tabs/_lots', ['model'=>$model]) ?>
            <?= $this->render('tabs/_existing', ['model'=>$model]) ?>
            <?= $this->render('tabs/_future', ['model'=>$model]) */ ?>



