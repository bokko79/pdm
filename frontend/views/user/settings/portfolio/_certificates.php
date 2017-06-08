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
        <div class="head button_to_show_secondary">Sertifikati
            <div class="subaction"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj sertifikat', Url::to(['/profile-portfolio/create', 'ProfilePortfolio[profile_id]'=>$model->user_id, 'ProfilePortfolio[profile_type]'=>'engineer', 'ProfilePortfolio[portfolio_type]'=>'certificate']), ['class' => 'btn btn-primary']) ?></div>
        </div>                           
    </div>
    <div class="secondary-context ">
        <?php if($certificates = $model->certificates){
            foreach($certificates as $certificate){
                echo $this->render('../_portfolio', ['model'=>$certificate]);
            }
        } ?>                
    </div>
</div>