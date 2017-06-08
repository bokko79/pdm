<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PracticeEngineers */

$this->title = Yii::t('app', 'Dodavanje zaposlenog/saradnika u firmi');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Zaposleni u firmi'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

$this->params['page_title'] = 'Firma';
?>

<div class="container-fluid listed">
    <div class="row" style="">

        <div class="index w300">
            <?= $this->render('_practice_engineers') ?>
        </div>

        <div class="content view w300" style="">

                <h4><?= $this->title ?></h4>
                <hr style="margin: 10px 0 40px">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>

               
        </div>
    </div>

</div>

