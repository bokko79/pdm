<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Practices */

$this->title = Yii::t('app', 'Izmeni {modelClass}: ', [
    'modelClass' => 'firmu',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Firme'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->engineer_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Izmeni');
?>
<div class="practices-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'location' => $location,
    ]) ?>

</div>
