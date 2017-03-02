<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PhaseVolumes */

$this->title = Yii::t('app', 'Create Phase Volumes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Phase Volumes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phase-volumes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
