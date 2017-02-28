<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingStoreyParts */

$this->title = Yii::t('app', 'Create Project Building Storey Parts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Building Storey Parts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-building-storey-parts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
