<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PracticeEngineers */

$this->title = Yii::t('app', 'Izmeni {modelClass}: ', [
    'modelClass' => 'zaposlenog u firmi',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Zaposleni u firmi'), 'url' => ['practices/view', 'id' => $model->practice_id]];
$this->params['breadcrumbs'][] = ['label' => $model->engineer->name. '@'.$model->practice->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Izmeni');
?>
<div class="practice-engineers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
