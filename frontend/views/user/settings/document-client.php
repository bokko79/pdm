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
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;
use kartik\tabs\TabsX;

/**
 * @var $this  yii\web\View
 * @var $form  yii\widgets\ActiveForm
 * @var $model dektrium\user\models\SettingsForm
 */

$this->title = Yii::t('user', 'Moji dokumenti');
$this->params['breadcrumbs'][] = $this->title;

$items = [
        [
            'label'=>'Rešenje APR-a',
            'content'=>$this->render('tabs/_apr', ['model'=>$model]),
            'active'=>true
        ],
        [
            'label'=>'Pečat preduzeća',
            'content'=>$this->render('tabs/_stamp', ['model'=>$model]),
        ],
        [
            'label'=>'Potpis ovlašćenog lica',
            'content'=>$this->render('tabs/_signature', ['model'=>$model]),
        ],
    ];

?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row">
    <div class="col-md-3">
        <?= $this->render('_menu') ?>
    </div>
    <div class="col-md-9">
        <div class="card_container record-full grid-item fadeInUp animated" id="">
            <div class="primary-context gray normal">
                <div class="head colos thin"><?= Html::encode($this->title) ?>
                
                </div>
                
            </div>    
            <div class="secondary-context">


                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12" style="min-height:;">
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