<?php

/*
 * B05 - Email Setup page.
 *
 * This file is part of the Servicemapp project.
 *
 * (c) Servicemapp project <http://github.com/bokko79/servicemapp>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\tabs\TabsX;
/**
 * @var $this  yii\web\View
 * @var $form  yii\widgets\ActiveForm
 * @var $model dektrium\user\models\SettingsForm
 */

$this->title = Yii::t('user', 'Moj portfolio');
//$this->params['breadcrumbs'][] = $this->title;

$this->params['page_title'] = 'Inženjer';

$items = [
        [
            'label'=>'Iskustvo',
            'content'=>$this->render('portfolio/_experiences', ['model'=>$model]),
            'active'=>true
        ],
        [
            'label'=>'Obrazovanje',
            'content'=>$this->render('portfolio/_educations', ['model'=>$model]),
        ],
        [
            'label'=>'Sertifikati',
            'content'=>$this->render('portfolio/_certificates', ['model'=>$model]),
        ],
        [
            'label'=>'Licence',
            'content'=>$this->render('portfolio/_licences', ['model'=>$model]),
        ],
        [
            'label'=>'Izdanja',
            'content'=>$this->render('portfolio/_publications', ['model'=>$model]),
        ],
        [
            'label'=>'Patenti',
            'content'=>$this->render('portfolio/_patents', ['model'=>$model]),
        ],
        [
            'label'=>'Projekti',
            'content'=>$this->render('portfolio/_projects', ['model'=>$model]),
        ],
        [
            'label'=>'Kursevi',
            'content'=>$this->render('portfolio/_courses', ['model'=>$model]),
        ],
        [
            'label'=>'Ref',
            'content'=>$this->render('portfolio/_references', ['model'=>$model]),
        ],
    ];
?>


<div class="container-fluid full">
    <div class="row">
        <div class="card_container record-full grid-item fadeInUp no-shadow transparent no-margin animated-not" id="">
            <div class="primary-context  normal">
                <div class="head colos"><?= Html::encode($this->title) ?>
                
                </div>
                
            </div>    
            <div class="secondary-context">


                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12" style="min-height:300px;">
                            <?php
                                echo kartik\tabs\TabsX::widget([
                                    'items'=>$items,
                                    'position'=>TabsX::POS_ABOVE,
                                    'encodeLabels'=>false,
                                ]);
                            ?>
                        </div>  
                    </div>
                </div>
            </div>                   
        </div>
                       
    </div>
</div>