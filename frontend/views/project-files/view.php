<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectFiles */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dokumenti projekata'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><i class="fa fa-file"></i> <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Izmeni'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Obriši'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'project_id',
            'type',
            'number',
            'date',
            'file_id',
            'name',
        ],
    ]) ?>

    <?php if($model->file): ?>
    <?= ($model->file and $model->file->type!='pdf') ? Html::img('/images/projects/files/'.$model->file->name, ['style'=>'max-height:260px;']) : Html::a('Preuzmi PDF dokumenta '. $model->name, ['/site/download', 'path'=>'/images/projects/files/'.$model->file->name]); ?>
    <?php endif; ?>
