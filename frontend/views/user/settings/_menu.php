<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

/** @var dektrium\user\models\User $user */
$user = Yii::$app->user->identity;
$model = Yii::$app->user->engineer!=null ? Yii::$app->user->engineer : $user;
?>

<div class="">

    <div class="card_container record-full grid-item fadeInUp animated-not" id="card_container" style="float:none;">
        
            <div class="media-area" style="height:262px !important;">                
                <div class="image">
                    <?= (Yii::$app->user->engineer!=null and $model->aFile) ? Html::img('/images/profiles/'.$model->aFile->name, ['style'=>'max-height:262px;']) : Html::img('/images/no_pic_image.png', ['style'=>'max-height:262px;']) ?>                    
                </div>
                <div class="primary-context in-media dark">
                    <div class="head major thin"><?= '<i class="fa fa-user-circle"></i> @'.$user->username ?></div>
                </div>
            </div>
            <div class="primary-context">
                <div class="head second thin">
                    <?= $model->name ?>
                    <div class="action-area normal-case">
                        <div class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-default "><i class="fa fa-ellipsis-v"></i></a>
                            <?php
                                echo \yii\bootstrap\Dropdown::widget([
                                    'encodeLabels' => false,
                                    'items' => [
                                        '<li class="dropdown-header uppercase">Podešavanja</li>',
                                        ['label' => Yii::t('user', 'Moji podaci (inženjer)'), 'url' => ['/engineers/update', 'id'=>$user->id], 'visible' => Yii::$app->user->engineer!=null],
                                        ['label' => Yii::t('user', 'Moje licence'), 'url' => ['/user/settings/licence-setup'], 'visible' => Yii::$app->user->engineer!=null],
                                        //['label' => Yii::t('user', 'Moji dokumenti'), 'url' => ['/user/settings/document-setup'], 'visible' => Yii::$app->user->engineer!=null],
                                        
                                        ['label' => Yii::t('user', 'Moj portfolio'), 'url' => ['/user/settings/portfolio-setup'], 'visible' => Yii::$app->user->engineer!=null],
                                        '<hr>',
                                        ['label' => Yii::t('user', 'Podešavanje naloga'), 'url' => ['/user/settings/account']],
                                        '<hr>',
                                        ['label' => '<i class="fa fa-sign-out"></i> '.Yii::t('user', 'Odjava'), 'url' => ['/site/logout'], 'options'=>['style'=>'background:#efefef'], 'linkOptions'=>['data'=>['method'=>'post']]],                                        
                                    ],
                                    'options' => [
                                        'class' => 'dropdown-menu-right',
                                    ],
                                ]);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="subhead">
                    <?= (Yii::$app->user->engineer!=null) ? '<div class="fs_11 thin"><i class="fa fa-check"></i> '.$model->expertees->name.'</div>' : '<div class="label label-success fs_11 thin"><i class="fa fa-check"></i> user</div>' ?>
                </div>
            </div>
			<hr style="margin:0">
            <div class="secondary-context">
                <div class="head thin second">
                  <div class="subhead uppercase hint" style="margin-bottom: 5px;">Moje firme
                    <div class="action-area normal-case">
                        <div class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-default"><i class="fa fa-ellipsis-v"></i></a>
                            <?php
                                echo \yii\bootstrap\Dropdown::widget([
                                    'items' => [
                                        
                                        ['label' => Yii::t('user', 'Moja firma'), 'url' => ['/user/settings/practice-setup'], 'visible' => Yii::$app->user->engineer!=null],
                                        ['label' => Yii::t('user', 'Investitori firme'), 'url' => ['/user/settings/practice-setup'], 'visible' => Yii::$app->user->engineer!=null],
                                    ],
                                    'options' => [
                                        'class' => 'dropdown-menu-right',
                                    ],
                                ]);
                            ?>
                        </div>               
                    </div>
                  </div>              
                  <?php if($practices = $model->practiceEngineers){
                        foreach($practices as $practice){
                            echo '<div class="head second thin">'.Html::a($practice->practice->name, Url::to(['/practices/view', 'id'=>$practice->practice_id]), []). '</div><div class="subhead">@'.$practice->position.' ['.$practice->status.']</div>'; 
                        }
                    } ?> 
                </div>
            </div>
			<hr style="margin:0">
            <div class="secondary-context">
                <?= Menu::widget([
            'options' => [
                'class' => 'nav nav-pills nav-stacked',
            ],
            'items' => [
                ['label' => Yii::t('user', 'Moji projekti'), 'url' => ['/user/security/home', 'username'=>$user->username]],
                //['label' => Yii::t('user', 'Nalog'), 'url' => ['/user/settings/account']],
                //['label' => Yii::t('user', 'Moji podaci (inženjer)'), 'url' => ['/engineers/update', 'id'=>$user->id], 'visible' => Yii::$app->user->engineer!=null],
                //['label' => Yii::t('user', 'Investitor'), 'url' => ['/clients/update', 'id'=>$user->id], 'visible' => Yii::$app->user->client!=null],
                //['label' => Yii::t('user', 'Moje licence'), 'url' => ['/user/settings/licence-setup'], 'visible' => Yii::$app->user->engineer!=null],
                //['label' => Yii::t('user', 'Moji dokumenti'), 'url' => ['/user/settings/document-setup'], 'visible' => Yii::$app->user->engineer!=null],
                //['label' => Yii::t('user', 'Moji dokumenti'), 'url' => ['/user/settings/document-client'], 'visible' => Yii::$app->user->client!=null],
                //['label' => Yii::t('user', 'Moja firma'), 'url' => ['/user/settings/practice-setup'], 'visible' => Yii::$app->user->engineer!=null],
                //['label' => Yii::t('user', 'Moj portfolio'), 'url' => ['/user/settings/portfolio-setup'], 'visible' => Yii::$app->user->engineer!=null],
                
            ],
        ]) ?>
            </div>
       
    </div>
</div>
