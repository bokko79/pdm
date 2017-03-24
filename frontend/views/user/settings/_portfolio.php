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

/** @var dektrium\user\models\User $user */
?>


    <div class="card_container record-full grid-item fadeInUp top-bordered transparent no-shadow animated" id="card_container" style="float:none;">
        <div class="primary-context">
            <div class="head major regular">
                 
                <?= $model->title ?>
                <div class="action-area normal-case"><?= Html::a('<i class="fa fa-pencil"></i>', Url::to(['/profile-portfolio/update', 'id'=>$model->id]), ['class' => 'btn btn-default btn-sm']) ?></div>
                
            </div>
            <div class="subhead">
                <?= $model->company ?><br>
                <span><?= $model->start_month. ' '.$model->start_year ?> - <?= $model->end_month. ' '.$model->end_year ?></span> <?= ($model->current) ? '<div class="label label-success fs_11 thin"><i class="fa fa-check"></i> aktivan</div>' : null ?>
            </div>
        </div>
        <div class="secondary-context">
                <?= $model->summary ?>
        </div>
    </div>
