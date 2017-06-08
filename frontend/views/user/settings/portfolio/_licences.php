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
        <div class="head button_to_show_secondary">Licence
            <div class="subaction"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj licencu', Url::to(['/profile-portfolio/create', 'ProfilePortfolio[profile_id]'=>$model->user_id, 'ProfilePortfolio[profile_type]'=>'engineer', 'ProfilePortfolio[portfolio_type]'=>'licence']), ['class' => 'btn btn-primary']) ?></div>
        </div>                           
    </div>
    <div class="secondary-context ">
        <?php if($licences = $model->portfolioLicences){
            foreach($licences as $licence){
                echo $this->render('../_portfolio', ['model'=>$licence]);
            }
        } ?>                
    </div>
</div>