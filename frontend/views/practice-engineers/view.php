<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\PracticeEngineers */

$this->title = $model->engineer->name. '@'.$model->practice->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Zaposleni u firmi'), 'url' => ['practices/view', 'id' => $model->practice_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="practice-engineers-view">

    <h2><?= Html::encode($this->title) ?></h2>

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
            'practice.name',
            'engineer.name',
            'position',
            'status',
        ],
    ]) ?>

</div>
