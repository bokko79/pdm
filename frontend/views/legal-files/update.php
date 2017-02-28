<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LegalFiles */

$this->title = Yii::t('app', 'Izmeni {modelClass}: ', [
    'modelClass' => 'pravni dokument',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $entity->name.': Pravni dokumenti'), 'url' => [$model->entity.'s/view', 'id'=>$entity->id]];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Izmeni');
?>
<div class="legal-files-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
