<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingCharacteristics */

$this->title = Yii::t('app', 'Unesi karakteristike objekta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Karakteristike objekta'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-building-characteristics-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
