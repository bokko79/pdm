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
            <div class="subaction"><?= Html::a('<i class="fa fa-plus fa-2x"></i>', Url::to(['/practice-engineers/create', 'PracticeEngineersSearch[practice_id]'=>$model->engineer_id]), ['class' => 'btn btn-link']) ?></div>
            Inženjeri firme
        </div>
        <div class="subhead">Lista inžernjera moje firme.
        </div>
    </div>
    <div class="secondary-context no-padding">
        <ul class="index-menu">
        <?php if($practiceEngineers = $model->practiceEngineers){
            foreach($practiceEngineers as $practiceEngineer){
                echo '<li>'.Html::a($practiceEngineer->engineer->name.'<div class="subtext">'.$practiceEngineer->engineer->title.'</div>', Url::to(['/practice-engineers/update', 'id'=>$practiceEngineer->id]), ['class' => '', 'style'=>'']).'</li>';
            }
        } else {
            echo '<li>Nije unet nijedan inženjer.</li>';
            } ?>
        </ul>
    </div>
</div>