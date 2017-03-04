<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Projects */

$this->title = Yii::t('app', 'Kreiraj novi projekat');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projekti'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'location' => $location,
    ]) ?>

