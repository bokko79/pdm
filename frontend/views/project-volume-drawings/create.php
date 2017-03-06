<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectVolumeDrawings */

$this->title = Yii::t('app', 'Create Project Volume Drawings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Volume Drawings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-volume-drawings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
