<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Requests */

$this->title = Yii::t('app', 'Pošaljite upit');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Zahtevi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <h1><?= Html::encode($this->title) ?></h1>

    <p class="hint">
    	Želite da obavite građevinske radove ili dobijete potrebne informacije za Vašu situaciju?<br>Napravite besplatan zahtev i pošaljite upit mreži inženjera i stručnjaka, koji će Vam se u najkraćem roku obratiti sa mogućim rešenjem.
    </p>
    <hr>

    <?= $this->render('_form', [
        'model' => $model,
        'location' => $location,
    ]) ?>


