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

    <div class="card_container record-full grid-item fadeInUp animated-not bordered" id="card_container" style="float:none; color:#555;">
        <a href="<?= Url::to(['/home']) ?>" style="color:#555;">    
            <div class="header-context">                
                <div class="avatar round">
                    <?= ($model->aFile) ? Html::img('/images/profiles/'.$model->aFile->name, ['style'=>'']) : Html::img('/images/no_pic_image.png', ['style'=>'']) ?>       
                </div>
                <div class="title">
                    <div class="head lower"><?= $user->username ?></div>
                    <div class="subhead"><?= (Yii::$app->user->engineer!=null) ? '<div class="fs_12 regular label label-warning"><i class="fa fa-mortar-board"></i> '.$model->expertees->short.'</div>' : '<div class="label label-success fs_11 thin"><i class="fa fa-check"></i> user</div>' ?></div> 
                </div>
                <div class="subaction">
                    <div class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-link" style="color:#999"><i class="fa fa-ellipsis-v"></i></a>
                            <?php
                                echo \yii\bootstrap\Dropdown::widget([
                                    'encodeLabels' => false,
                                    'items' => [
                                        ['label' => '<i class="fa fa-cog"></i> '.Yii::t('user', 'Podešavanje naloga'), 'url' => ['/user/settings/account']],
                                        '<hr>',
                                        ['label' => '<i class="fa fa-sign-out"></i> '.Yii::t('user', 'Odjava'), 'url' => ['/site/logout'], 'options'=>['style'=>''], 'linkOptions'=>['data'=>['method'=>'post']]],                                        
                                    ],
                                    'options' => [
                                        'class' => 'dropdown-menu-right',
                                    ],
                                ]);
                            ?>
                        </div>
                </div>
            </div>
        </a>
            <?php if(Yii::$app->user->engineer): ?>
            <hr style="margin:0">
            <div class="secondary-context gray">
                <div class="head major">
                    <?= $model->name ?>
                    <div class="subaction">
                        <div class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-link" style="color:#999"><i class="fa fa-ellipsis-v"></i></a>
                            <?php
                                echo \yii\bootstrap\Dropdown::widget([
                                    'encodeLabels' => false,
                                    'items' => [
                                        '<li class="dropdown-header uppercase">Podešavanja</li>',
                                        ['label' => Yii::t('user', 'Moji podaci (inženjer)'), 'url' => ['/engineers/update', 'id'=>$user->id], 'visible' => Yii::$app->user->engineer!=null],
                                        ['label' => Yii::t('user', 'Moje licence'), 'url' => ['/user/settings/licence-setup'], 'visible' => Yii::$app->user->engineer!=null],
                                        ['label' => Yii::t('user', 'Moj portfolio'), 'url' => ['/user/settings/portfolio-setup'], 'visible' => Yii::$app->user->engineer!=null],
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
                    <?= (Yii::$app->user->engineer!=null) ? '<div class="fs_13"><i class="fa fa-check"></i> '.$model->expertees->name.'</div>' : '<div class="label label-success fs_11 thin"><i class="fa fa-check"></i> user</div>' ?>
                </div>
            </div>
            <div class="secondary-context cont gray">                             
                <div class="subhead">
                    <?= '<div class="fs_13">'.$user->email.'</div>' ?>
                    <?= (Yii::$app->user->engineer!=null) ? '<div class="fs_13"><i class="fa fa-phone"></i> '.($model->phone ?: 'Nije unet').'</div>' : '<div class="label label-success fs_11 thin"><i class="fa fa-check"></i> user</div>' ?>
                </div>
            </div>
            <?php endif; ?>
			<?php if(Yii::$app->user->engineer and $practice = $model->practice): ?>
            <div class="secondary-context gray cont">
                
                <div class="head second">
                    <div class="subhead hint">
                        direktor @
                    </div>
                    <div class="subaction">
                        <div class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-link" style="color:#999"><i class="fa fa-ellipsis-v"></i></a>
                            <?php
                                echo \yii\bootstrap\Dropdown::widget([
                                    'items' => [
                                        
                                        ['label' => Yii::t('user', 'Moja firma'), 'url' => ['/user/settings/practice-setup'], 'visible' => Yii::$app->user->engineer!=null],
                                        ['label' => Yii::t('user', 'Inženjeri firme'), 'url' => ['/user/settings/practice-setup', '#'=>'w9-tab1'], 'visible' => Yii::$app->user->engineer!=null],
                                        ['label' => Yii::t('user', 'Investitori firme'), 'url' => ['/user/settings/practice-setup', '#'=>'w9-tab2'], 'visible' => Yii::$app->user->engineer!=null],                                        
                                        ['label' => Yii::t('user', 'Partneri firme'), 'url' => ['/user/settings/practice-setup', '#'=>'w9-tab3'], 'visible' => Yii::$app->user->engineer!=null],
                                        ['label' => Yii::t('user', 'Podešavanje firme'), 'url' => ['/practices/update', 'id'=>$user->id], 'visible' => Yii::$app->user->engineer!=null],
                                    ],
                                    'options' => [
                                        'class' => 'dropdown-menu-right',
                                    ],
                                ]);
                            ?>
                        </div>
                    </div>     
                    <?= Html::a($practice->name, Url::to(['/practices/view', 'id'=>$practice->engineer_id]), []) ?>      
                    <div class="subhead hint">
                        <?= $practice->location->fullAddress ?>
                    </div>         
                </div>             
                
                    
            </div>
            <?php endif; ?>
            <?php if(Yii::$app->user->engineer and !Yii::$app->user->engineer->practice): ?>
                <?php $practice = Yii::$app->user->engineer->practiceEngineers[0]->practice; ?>
            <div class="secondary-context gray cont">
                
                <div class="head second">
                    <div class="subhead hint">
                        zaposleni @
                    </div>
                    <div class="subaction">
                        
                    </div>
                    <?= Html::a($practice->name, Url::to(['/practices/view', 'id'=>$practice->engineer_id]), []) ?>      
                    <div class="subhead hint">
                        <?= $practice->location->fullAddress ?>
                    </div>         
                </div>             
                
                    
            </div>
            <?php endif; ?>
			<hr style="margin:0">
            <div class="secondary-context">
                <?= Menu::widget([
            'options' => [
                'class' => 'nav nav-pills nav-stacked',
            ],
            'items' => [
                ['label' => Yii::t('user', 'Projekti'), 'url' => ['/user/security/home', 'username'=>$user->username]],
                //['label' => Yii::t('user', 'Članci'), 'url' => ['/user/security/home', 'username'=>$user->username]],
                //['label' => Yii::t('user', 'Zahtevi'), 'url' => ['/user/security/home', 'username'=>$user->username]],
                //['label' => Yii::t('user', 'Oglasi'), 'url' => ['/user/security/home', 'username'=>$user->username]],
                
            ],
        ]) ?>
            </div>
            <?php if(Yii::$app->user->engineer and $licences = $model->engineerLicences): ?>
            <hr style="margin:0">
            <div class="secondary-context gray">
                <div class="head second">
                  
                    <div class="subaction">
                        <div class="dropdown">
                            <a href="#" data-toggle="dropdown" class="dropdown-toggle btn btn-link" style="color:#999"><i class="fa fa-ellipsis-v"></i></a>
                            <?php
                                echo \yii\bootstrap\Dropdown::widget([
                                    'items' => [
                                        
                                         ['label' => Yii::t('user', 'Podešavanje licenci'), 'url' => ['/user/settings/licence-setup'], 'visible' => Yii::$app->user->engineer!=null],
                                    ],
                                    'options' => [
                                        'class' => 'dropdown-menu-right',
                                    ],
                                ]);
                            ?>
                        </div>               
                    </div>
                  <div class="subhead uppercase hint" style="margin-bottom: 5px;">Moje licence</div>              
                  <?php foreach($licences as $licence){
                            echo '<div class="">'.Html::a($licence->no, Url::to(['/engineer-licences/update', 'id'=>$licence->id]), []). '</div><div class="subhead hint">'.$licence->licence->name.'</div>'; 
                        
                    } ?> 
                </div>
            </div>
            <?php endif; ?>
            <?php if(Yii::$app->user->engineer and Yii::$app->user->engineer->practice and $practices = $model->practiceEngineers): ?>
            <hr style="margin:0">
            <div class="secondary-context gray">
                <div class="head second">
                  
                    <div class="subaction">
                        <div class="subaction">                        
                            <a href="<?= Url::to(['/user/settings/practice-setup', '#'=>'w9-tab1']) ?>" class="btn btn-link" style="color:#999"><i class="fa fa-ellipsis-v"></i></a>
                        </div>                                     
                    </div>
                    <div class="subhead uppercase hint" style="margin-bottom: 5px;">Inženjeri firme</div>              
                  <?php foreach($practices as $practice){
                            echo '<div class="head second">'.Html::a($practice->engineer->name, Url::to(['/engineers/view', 'id'=>$practice->engineer_id]), []). '</div><div class="subhead hint">@'.$practice->position.' ['.$practice->status.']</div>';                         
                    } ?> 
                </div>
            </div>            
            <?php endif; ?>
            <?php if(Yii::$app->user->engineer and Yii::$app->user->engineer->practice and $practices = $model->practice->practicePartners): ?>
            <hr style="margin:0">
            <div class="secondary-context gray">
                <div class="head second">                  
                    <div class="subaction">                        
                        <a href="<?= Url::to(['/user/settings/practice-setup', '#'=>'w9-tab3']) ?>" class="btn btn-link" style="color:#999"><i class="fa fa-ellipsis-v"></i></a>
                    </div>
                    <div class="subhead uppercase hint" style="margin-bottom: 5px;">Partneri firme</div>              
                  <?php foreach($practices as $practice){
                            echo $practice->practice_id!=Yii::$app->user->id ? '<div class="head second">'.Html::a($practice->practice->name, Url::to(['/practices/view', 'id'=>$practice->practice_id]), []). '</div><div class="subhead hint">['.$practice->status.']</div>' : '<div class="head second">'.Html::a($practice->partner->name, Url::to(['/practices/view', 'id'=>$practice->partner_id]), []). '</div><div class="subhead hint">['.$practice->status.']</div>';                         
                    } ?> 
                </div>
            </div>            
            <?php endif; ?>
    </div>
</div>
