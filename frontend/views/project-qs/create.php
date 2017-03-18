<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectQs */

$this->title = Yii::t('app', 'Create Project Qs');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Qs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-qs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
