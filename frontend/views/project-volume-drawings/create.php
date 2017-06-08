<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectVolumeDrawings */

$this->title = 'Dodavanje crteža sveske';

$this->params['page_title'] = 'Sveske';
$this->params['page_title_2'] = c($model->projectVolume->name);
$this->params['page_title_3'] = 'Crteži';
$this->params['page_title_4'] = 'Novi crtež';

$this->params['volume'] = $model->projectVolume;

$this->params['breadcrumbs'][] = ['label' => '<i class="fa fa-book"></i> Sveske projekta', 'url' => ['/project-volumes', 'ProjectVolumes[project_id]' => $model->projectVolume->project_id]];
$this->params['breadcrumbs'][] = ['label' => $model->projectVolume->number. '. '.$model->projectVolume->name, 'url' => ['/project-volumes/view', 'id' => $model->project_volume_id]];
$this->params['breadcrumbs'][] = ['label' => 'Crteži sveske', 'url' => ['/project-volume-drawings/index', 'ProjectVolumeDrawings[project_volume_id]' => $model->project_volume_id]];
$this->params['breadcrumbs'][] = $this->title;

$this->params['project'] = $model->projectVolume->project;
?>


    <?= $this->render('_form', [
        'model' => $model,
        'storeys' => $storeys,
    ]) ?>

