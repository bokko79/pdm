<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Practices */

$this->title = Yii::t('app', 'Kreiraj firmu');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Firme'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['page_title'] = 'Firma';
?>
<div class="container-fluid">
    <div class="row">

        	<div class="card_container record-full grid-item fadeInUp no-shadow transparent no-margin animated-not" id="">
                <div class="primary-context normal">
                    <div class="head"><?= Html::encode($this->title) ?>
                        <div class="subaction"></div>
                    </div>
                    
                    <div class="subhead">Podešavanje podataka moje firme.</div>
                </div>    
                <div class="secondary-context">

    			    <?= $this->render('_form', [
    			        'model' => $model,
    			        'location' => $location,
    			    ]) ?>

    			</div>                   
            </div>


    </div>
</div>