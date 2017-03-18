<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\QsPositions */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Qs Positions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qs-positions-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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
            'subwork.name',
            'name',
            [                      // the owner name of the model
                'label' => 'opis pozicije',
                'format' => 'raw',
                'value' => \yii\helpers\StringHelper::truncate($model->action->action,150),
            ],
            
            [                      // the owner name of the model
                'label' => 'units',
                'format' => 'raw',
                'value' => $model->units,
            ],
            'price',
            'subtext:ntext',
        ],
    ]) ?>

</div>
