<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProfilePortfolio */

$this->title = Yii::t('app', 'Dodaj portfolio profila');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Portfolio profila'), 'url' => ['/user/settings/portfolio-setup']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

