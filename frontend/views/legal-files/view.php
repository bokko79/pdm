<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\LegalFiles */

$this->title = $model->docType;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $entity->name.': Pravni dokumenti'), 'url' => [$model->entity.'s/view', 'id'=>$entity->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="legal-files-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
<div class="container">
    <div class="row">
        <div class="col-sm-7">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'docType',
                    'entity',
                    'entity_id',
                    'file.id',
                    'value',
                ],
            ]) ?>
        </div>
        <div class="col-sm-5">
            <?php 
            if ($model->file) {
                if($model->file->type!='pdf'){
                    echo Html::img('/images/legal_files/'.$model->folder.'/'.$model->file->name);
                } else {
                    echo Html::a('Download file', ['/site/download', 'path'=>'/images/legal_files/'.$model->folder.'/'.$model->file->name]);
                }   
            } else {
                echo $model->value;
            } ?>
        </div>
    </div>
</div>
