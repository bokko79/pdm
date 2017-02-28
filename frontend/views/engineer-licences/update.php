<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\EngineerLicences */

$this->title = Yii::t('app', 'Izmeni {modelClass}: ', [
    'modelClass' => 'licencni paket inženjera',
]) . $model->engineer->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Licencni paketi inženjera'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Izmeni');
?>
<div class="engineer-licences-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
