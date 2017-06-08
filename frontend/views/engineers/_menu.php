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
//$user = Yii::$app->user->identity;
//$model = Yii::$app->user->engineer!=null ? Yii::$app->user->engineer : $user;
?>

<div class="">

    <div class="card_container record-full grid-item fadeInUp animated" id="card_container" >
        
            <div class="media-area" style="height:262px !important;">                
                <div class="image">
                    <?= ($model->user->aFile) ? Html::img('/images/profiles/'.$model->user->aFile->name, ['style'=>'max-height:262px;']) : Html::img('/images/no_pic_image.png', ['style'=>'max-height:262px;']) ?>                    
                </div>
                <div class="primary-context in-media dark">
                    <div class="head major thin"><?= '<i class="fa fa-user-circle"></i> @'.$model->user->username ?></div>
                </div>
            </div>
            <div class="primary-context">
                <div class="head">
                    <?= $model->name ?></div>
                <div class="subhead">
                    <?= $model->expertees->name ?>
                </div>
                <?php if(!Yii::$app->user->isGuest and Yii::$app->user->engineer and Yii::$app->user->engineer->practice): ?>
                <?= Html::a('Ubaci inženjera u svoju firmu', Url::to(['/practice-engineers/create', 'PracticeEngineersSearch[practice_id]'=>Yii::$app->user->id, 'PracticeEngineersSearch[engineer_id]'=>$model->user_id]), ['class'=>'btn btn-warning btn-block', 'style'=>'margin-top:20px;']) ?>
                <?php endif; ?>
            </div>
            <hr style="margin:0">
            <div class="secondary-context gray">
                <div class="head thin second">
                  <div class="subhead uppercase hint" style="margin-bottom: 5px;">Kontakt
                  </div>              
                  
                </div>
                <div class="muted">
                    <table>
                      <tr>
                        <td style="padding:3px"><i class="fa fa-at"></i></td><td style="padding:3px"><?= $model->email ?></td>
                      </tr>
                      <tr>
                        <td style="padding:3px"><i class="fa fa-phone"></i></td><td style="padding:3px"><?= $model->phone ?: 'Nije uneto.' ?></td>
                      </tr>
                    </table>
                </div>
              </div>
              
			<hr style="margin:0">
            <div class="secondary-context">
                <div class="head second">
                  <div class="subhead uppercase hint" style="margin-bottom: 5px;">Licence</div>  
                </div>           
                   
                <?php if($licences = $model->engineerLicences){
                        foreach($licences as $licence){
                           echo '<div class="head second">'.(Yii::$app->user->can('updateOwnEngineerProfile', ['engineer'=>$model]) ? Html::a($licence->no, Url::to(['/engineer-licences/update', 'id'=>$licence->id]), []) : $licence->no). '</div><div class="subhead">'.$licence->licence->name.'</div>'; 
                        }
                    } else {
                      '<p>Nije unet nijedan licencni paket.</p>'; 
                    } ?>
            </div>
			<hr style="margin:0">
            <div class="secondary-context">
                <div class="head second">
                  <div class="subhead uppercase hint" style="margin-bottom: 5px;">Firme</div>  
                </div>           
                  <?php if($practices = $model->practiceEngineers){
                        foreach($practices as $practice){
                           echo '<div class="head second">'.Html::a($practice->practice->name, Url::to(['/practices/view', 'id'=>$practice->practice_id]), []). '</div><div class="subhead fs_11">@'.$practice->position.' ['.$practice->status.']</div>'; 
                        }
                    } ?>
            </div>
       
    </div>
</div>
