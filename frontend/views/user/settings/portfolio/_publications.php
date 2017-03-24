<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;

?>

<div class="card_container record-full grid-item fadeInUp animated" id="">
    <div class="primary-context gray normal">
        <div class="head button_to_show_secondary">Publikacije / izdanja
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj publikaciju', Url::to(['/profile-portfolio/create', 'ProfilePortfolio[profile_id]'=>$model->user_id, 'ProfilePortfolio[profile_type]'=>'engineer', 'ProfilePortfolio[portfolio_type]'=>'publication']), ['class' => 'btn btn-primary btn-sm']) ?></div>
        </div>                           
    </div>
    <div class="secondary-context ">
        <?php if($publications = $model->publications){
            foreach($publications as $publication){
                echo $this->render('../_portfolio', ['model'=>$publication]);
            }
        } ?>                
    </div>
</div>