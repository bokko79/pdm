<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingClasses */

$this->title = Yii::t('app', 'Create Project Building Classes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Building Classes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-building-classes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
