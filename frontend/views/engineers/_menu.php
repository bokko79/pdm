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

    <div class="card_container record-full grid-item fadeInUp animated" id="card_container" style="float:none;">
        
            <div class="media-area" style="height:262px !important;">                
                <div class="image">
                    <?= (Yii::$app->user->engineer!=null and $model->aFile) ? Html::img('/images/profiles/'.$model->aFile->name, ['style'=>'max-height:262px;']) : Html::img('/images/no_pic_image.png', ['style'=>'max-height:262px;']) ?>                    
                </div>
                <div class="primary-context in-media dark">
                    <div class="head major thin"><?= '<i class="fa fa-user-circle"></i> @'.$user->username ?></div>
                </div>
            </div>
            <div class="primary-context">
                <div class="head">
                    <?= $model->name ?></div>
                <div class="subhead">
                    <?= $model->expertees->name ?>
                </div>
            </div>
			<hr style="margin:0">
            <div class="secondary-context">
                <div class="head thin second">
                  <div class="subhead uppercase hint" style="margin-bottom: 5px;">Firme inženjera</div>              
                  <?php if($practices = $model->practiceEngineers){
                        foreach($practices as $practice){
                            echo '<div class="head second thin">'.Html::a($practice->practice->name, Url::to(['/practices/view', 'id'=>$practice->practice_id]), []). '</div><div class="subhead">@'.$practice->position.' ['.$practice->status.']</div>'; 
                        }
                    } ?> 
                </div>
            </div>
			<hr style="margin:0">
            <div class="secondary-context">
                
            </div>
       
    </div>
</div>
