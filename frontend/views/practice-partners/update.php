<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PracticeEngineers */

$this->title = Yii::t('app', 'Podešavanje {modelClass}: ', [
    'modelClass' => 'zaposlenog u firmi',
]) . $model->id;
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Zaposleni u firmi'), 'url' => ['practices/view', 'id' => $model->practice_id]];
//$this->params['breadcrumbs'][] = ['label' => $model->engineer->name. '@'.$model->practice->name, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = Yii::t('app', 'Izmeni');
$this->params['page_title'] = 'Firma';
?>
<div class="container-fluid listed">
    <div class="row" style="">

        <div class="index w300">
            <?= $this->render('_practice_partners') ?>
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