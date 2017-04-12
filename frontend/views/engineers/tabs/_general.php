
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
        <div class="head">Osnovni podaci</div>
        
    </div>
    
    <div class="secondary-context">
       <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                //'id',
                'name',
                'expertees.name',
                'phone',
                'email:email',
            ],
        ]) ?>      

    </div>
</div>