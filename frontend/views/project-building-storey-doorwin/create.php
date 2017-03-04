<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingStoreyDoorwin */

$this->title = Yii::t('app', 'Create Project Building Storey Doorwin');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Building Storey Doorwins'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-building-storey-doorwin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
