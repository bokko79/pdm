<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;

$model = \common\models\Practices::findOne(Yii::$app->user->id);
?>
<div class="card_container record-full grid-item no-margin no-padding no-shadow" id="existing">
    <div class="primary-context gray normal">
        <div class="head third">
            <div class="subaction"><?= Html::a('<i class="fa fa-plus fa-2x"></i>', Url::to(['/practice-partners/create', 'PracticePartnersSearch[practice_id]'=>$model->engineer_id]), ['class' => 'btn btn-link']) ?></div>
            Partneri firme
        </div>
        <div class="subhead">Lista partnera moje firme.
        </div>
    </div>
    <div class="secondary-context no-padding">
        <ul class="index-menu">
        <?php if($practicePartners = $model->fullPracticePartners){
            foreach($practicePartners as $partner){
                $practicePartner = \common\models\PracticePartners::find()->where('(practice_id='.$model->engineer_id. ' and partner_id='.$partner->engineer_id.') or (practice_id='.$partner->engineer_id. ' and partner_id='.$model->engineer_id.')')->one();
                echo '<li>'.Html::a($partner->name.'<div class="subtext">'.$partner->location->city->town.'</div>', Url::to(['/practice-partners/update', 'id'=>$practicePartner->id]), ['class' => '', 'style'=>'']).'</li>';
            }
        } else {
            echo '<li>Nije unet nijedan partner.</li>';
            } ?>
        </ul>
    </div>
</div>