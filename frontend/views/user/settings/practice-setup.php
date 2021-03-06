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

$this->title = $practice->name;
$this->params['breadcrumbs'][] = $this->title;
if($practice){
    $items = [
        [
            'label'=>'<i class="fa fa-shield"></i> Podaci firme',
            'content'=>$this->render('tabs/_general', ['model'=>$practice]),
            'active'=>true
        ],        
       /* [
            'label'=>'<i class="fa fa-tags"></i> Inženjeri',
            'content'=>$this->render('tabs/_staff', ['model'=>$practice, 'practiceEngineers' => $practiceEngineers]),
        ],
        [
            'label'=>'<i class="fa fa-tags"></i> Investitori',
            'content'=>$this->render('tabs/_clients', ['model'=>$practice, 'clients' => $clients, 'dataProvider' => $dataProvider]),
        ],
        [
            'label'=>'<i class="fa fa-tags"></i> Partneri',
            'content'=>$this->render('tabs/_partners', ['model'=>$practice, 'practicePartners' => $practicePartners]),
        ],*/
        [
            'label'=>'<i class="fa fa-user-circle-o"></i> Portfolio',
            'content'=>$this->render('tabs/_portfolio', ['model'=>$practice]),
        ],
        [
            'label'=>'<i class="fa fa-file-text"></i> Dokumenti',
            'content'=>$this->render('tabs/_docs', ['model'=>$practice]),
        ],
    ];
} else {
    $items = [];
}
    
$this->params['page_title'] = 'Firma';
?>

<div class="container-fluid">
    <div class="row">

        <div class="card_container record-full grid-item fadeInUp no-shadow transparent no-margin animated-not" id="">
            <?php /*
            <div class="primary-context normal">
                <div class="head colos"><?= Html::encode($this->title) ?>
                <div class="subaction"><?= Html::a('<i class="fa fa-cogs"></i> Podešavanje detalja firme', Url::to(['/practices/update', 'id'=>$model->user_id]), ['class' => 'btn btn-success shadow']) ?></div></div>
                
                <div class="subhead">Pregled i podešavanje detalja moje firme.</div>
            </div>    */ ?>
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
    