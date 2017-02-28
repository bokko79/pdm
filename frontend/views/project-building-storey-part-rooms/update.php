<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingStoreyPartRooms */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Project Building Storey Part Rooms',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Building Storey Part Rooms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="project-building-storey-part-rooms-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
