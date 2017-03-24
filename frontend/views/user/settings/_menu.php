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
$model = Yii::$app->user->engineer!=null ? Yii::$app->user->engineer : Yii::$app->user->client;
?>

<div class="">

    <div class="card_container record-full grid-item fadeInUp animated" id="card_container" style="float:none;">
        <a href="<?= Url::to(['/user/security/home', 'username'=>$user->username]) ?>">
            <div class="media-area" style="height:180px !important;">                
                <div class="image">
                    <?= (Yii::$app->user->client==null and $model->cFile) ? Html::img('/images/profiles/'.$model->cFile->name, ['style'=>'max-height:180px;']) : Html::img('/images/profiles/back.jpg', ['style'=>'max-height:180px;']) ?>                    
                </div>
                <div class="primary-context in-media dark">
                    <div class="head"><?= '<i class="fa fa-user-circle"></i> @'.$user->username ?></div>
                </div>
            </div>
            <div class="primary-context">
                <div class="head">
                     <?= (Yii::$app->user->client==null) ? '<div class="label label-success fs_11 thin"><i class="fa fa-check"></i> '.$model->title.'</div>' : '<div class="label label-success fs_11 thin"><i class="fa fa-check"></i> investitor</div>' ?>
                    
                    <div class="action-area normal-case">
                        <?= Html::a('<i class="fa fa-sign-out"></i>', Url::to(['/site/logout']), ['class' =>  'btn btn-default btn-sm shadow', 'data'=>['method'=>'post']]) ?>
                    </div>
                </div>
                
            </div>
            <div class="secondary-context">
                <?= Menu::widget([
            'options' => [
                'class' => 'nav nav-pills nav-stacked',
            ],
            'items' => [
                ['label' => Yii::t('user', 'Početna'), 'url' => ['/user/security/home', 'username'=>$user->username]],
                ['label' => Yii::t('user', 'Nalog'), 'url' => ['/user/settings/account']],
                ['label' => Yii::t('user', 'Moji podaci (inženjer)'), 'url' => ['/engineers/update', 'id'=>$user->id], 'visible' => Yii::$app->user->engineer!=null],
                ['label' => Yii::t('user', 'Investitor'), 'url' => ['/clients/update', 'id'=>$user->id], 'visible' => Yii::$app->user->client!=null],
                ['label' => Yii::t('user', 'Moje licence'), 'url' => ['/user/settings/licence-setup'], 'visible' => Yii::$app->user->engineer!=null],
                ['label' => Yii::t('user', 'Moji dokumenti'), 'url' => ['/user/settings/document-setup'], 'visible' => Yii::$app->user->engineer!=null],
                ['label' => Yii::t('user', 'Moji dokumenti'), 'url' => ['/user/settings/document-client'], 'visible' => Yii::$app->user->client!=null],
                ['label' => Yii::t('user', 'Moja firma'), 'url' => ['/user/settings/practice-setup'], 'visible' => Yii::$app->user->engineer!=null],
                ['label' => Yii::t('user', 'Moj portfolio'), 'url' => ['/user/settings/portfolio-setup'], 'visible' => Yii::$app->user->engineer!=null],
                
            ],
        ]) ?>
            </div>
        </a>
    </div>
</div>
