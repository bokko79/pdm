<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Projects */

$this->title = Yii::t('app', 'Izmeni {modelClass}: ', [
    'modelClass' => 'projekat',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projekti'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Izmeni');
$this->params['project'] = $model;
?>
<div class="projects-update">

    <?php /* <h1><?= Html::encode($this->title) ?></h1> */?>

    <?= $this->render('_form', [
        'model' => $model,
        'location' => $location,
    ]) ?>

</div>
