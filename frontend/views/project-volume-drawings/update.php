<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectVolumeDrawings */

$this->title = Yii::t('app', 'Podešavanje {modelClass}: ', [
    'modelClass' => 'crteža sveske',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sveska'), 'url' => ['/project-volumes/view', 'id'=>$model->project_volume_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Podešavanje');
?>
<div class="project-volume-drawings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'storeys' => $storeys,
    ]) ?>

</div>
