<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Clients */

$this->title = Yii::t('app', 'Izmeni {modelClass}: ', [
    'modelClass' => 'invetitora',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Investitori'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Izmeni');
?>
<div class="clients-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'location' => $location,
    ]) ?>

</div>
