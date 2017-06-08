<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\editable\Editable;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuilding */

$this->title = c($modelCheck->name) . ': ' . $modelCheck->state;

$this->params['page_title'] = 'Objekat';

$this->params['breadcrumbs'][] = '<i class="fa fa-home"></i> '.$this->title;

$this->params['project'] = $modelCheck->project;

?>



<div class="card_container record-full grid-item fadeInUp no-shadow no-margin animated-not" id="">
    <div class="primary-context normal aliceblue bottom-bordered">
        <div class="head colos">
            <div class="subaction">
                <?= Html::a('<i class="fa fa-life-saver fa-2x"></i>', null, ['class' => 'btn btn-link button_to_show_secondary']) ?>
            </div>
            <i class="fa fa-home"></i> Objekat
        </div>
        <div class="subhead">Upravljanje podacima predmetnog objekta.</div>
    </div>  
    <div class="primary-context aliceblue bottom-bordered" style="display: none;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5 text">
                    <h5>Upravljanje dokumentima projekta</h5>
                    <h6>Dodavanje dokumenta projekta.</h6>
                    <p>Novi dokument projekta.</p>
                    <h6>Podešavanje dokumenta projekta.</h6>
                    <p>Podešavanje dokumenta projekta.</p>
                    <h6>Uklanjanje dokumenta projekta.</h6>
                    <p>Uklanjanje dokumenta projekta.</p>
                </div>
                <div class="col-sm-7">
                    <p><iframe src="//www.youtube.com/embed/KP4Ed3xJ0t8" width="100%" height="314" allowfullscreen="allowfullscreen"></iframe></p>
                </div>
            </div>
        </div>          
    </div>
</div>

<div class="container-fluid">
    <div class="row">
            
    <?php
        if($modelCheck->project->work=='dogradnja' or $modelCheck->project->work=='sanacija' or $modelCheck->project->work=='rekonstrukcija'){

            echo $this->render('tabs/_general', ['modelCheck'=>$modelCheck, 'model'=>$model, 'model_new'=>$model_new]);
            echo $this->render('tabs/_characteristics', ['modelCheck'=>$modelCheck, 'model'=>$model, 'model_new'=>$model_new]);
            echo $this->render('tabs/_structure', ['modelCheck'=>$modelCheck, 'model'=>$model, 'model_new'=>$model_new]);
            echo $this->render('tabs/_materials', ['modelCheck'=>$modelCheck, 'model'=>$model, 'model_new'=>$model_new]);
            echo $this->render('tabs/_insulations', ['modelCheck'=>$modelCheck, 'model'=>$model, 'model_new'=>$model_new]);
            echo $this->render('tabs/_services', ['modelCheck'=>$modelCheck, 'model'=>$model, 'model_new'=>$model_new]);

        } else if($modelCheck->project->work=='adaptacija') {

            echo $this->render('tabs/_general', ['modelCheck'=>$modelCheck, 'model'=>$model]);
            echo $this->render('tabs/_characteristics', ['modelCheck'=>$modelCheck, 'model'=>$model]);

        } else {
            echo $this->render('tabs/_general', ['modelCheck'=>$modelCheck, 'model'=>$model]);
            echo $this->render('tabs/_characteristics', ['modelCheck'=>$modelCheck, 'model'=>$model]);
            echo $this->render('tabs/_structure', ['modelCheck'=>$modelCheck, 'model'=>$model]);
            echo $this->render('tabs/_materials', ['modelCheck'=>$modelCheck, 'model'=>$model]);
            echo $this->render('tabs/_insulations', ['modelCheck'=>$modelCheck, 'model'=>$model]);
            echo $this->render('tabs/_services', ['modelCheck'=>$modelCheck, 'model'=>$model]);
        }
    ?>

    </div>
</div>