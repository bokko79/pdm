<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Clients */

$this->title = Yii::t('app', 'Dodavanje novog investitora');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Investitori'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clients-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'location' => $location,
    ]) ?>

</div>
