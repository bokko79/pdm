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
        <div class="head button_to_show_secondary">Reference
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj referencu', Url::to(['/profile-portfolio/create', 'ProfilePortfolio[profile_id]'=>$model->user_id, 'ProfilePortfolio[profile_type]'=>'engineer', 'ProfilePortfolio[portfolio_type]'=>'reference']), ['class' => 'btn btn-primary btn-sm']) ?></div>
        </div>                           
    </div>
    <div class="secondary-context ">
        <?php if($references = $model->references){
            foreach($references as $reference){
                echo $this->render('../_portfolio', ['model'=>$reference]);
            }
        } ?>                
    </div>
</div>