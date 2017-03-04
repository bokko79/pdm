<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\EngineerLicences */

$this->title = Yii::t('app', 'Novi licencni paket inženjera');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inženjer'). $model->engineer->name, 'url' => ['engineers/view', 'id'=>$model->engineer_id]];
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

