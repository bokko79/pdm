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
        <div class="head button_to_show_secondary">Kursevi / predavanja / radionice
            <div class="action-area normal-case"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj kurs', Url::to(['/profile-portfolio/create', 'ProfilePortfolio[profile_id]'=>$model->user_id, 'ProfilePortfolio[profile_type]'=>'engineer', 'ProfilePortfolio[portfolio_type]'=>'course']), ['class' => 'btn btn-primary btn-sm']) ?></div>
        </div>                           
    </div>
    <div class="secondary-context ">
        <?php if($courses = $model->courses){
            foreach($courses as $course){
                echo $this->render('../_portfolio', ['model'=>$course]);
            }
        } ?>                
    </div>
</div>