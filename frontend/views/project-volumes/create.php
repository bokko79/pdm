<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectVolumes */

$this->title = Yii::t('app', 'Dodavanje sveske (dela projekta)');
$this->params['breadcrumbs'][] = ['label' => 'Sveske projekta '.$model->project->code, 'url' => ['/project-volumes/index', 'ProjectVolumes[project_id]' => $model->project_id]];
?>
<div class="project-volumes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
