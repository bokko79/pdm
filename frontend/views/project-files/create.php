<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectFiles */

$this->title = Yii::t('app', 'Create Project Files');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Files'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-files-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
