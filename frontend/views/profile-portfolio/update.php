<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProfilePortfolio */

$this->title = Yii::t('app', 'Izmeni {modelClass}: ', [
    'modelClass' => 'podatak portfolia',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Portfolio profila'), 'url' => ['/user/settings/portfolio-setup']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Izmeni');
?>
<div class="profile-portfolio-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
