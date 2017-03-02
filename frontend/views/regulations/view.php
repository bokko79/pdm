<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Regulations */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Regulations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="regulations-view">

    <h1><?= Html::encode($this->title) ?></h1>


        <?= Html::a('Preuzmi', ['/site/download', 'path'=>'/images/regulations/'.$model->id.'.pdf'], ['class' => 'btn btn-primary']) ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'text:ntext',
            'status',
        ],
    ]) ?>

</div>
