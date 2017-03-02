<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PhaseVolumeInsets */

$this->title = Yii::t('app', 'Create Phase Volume Insets');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Phase Volume Insets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phase-volume-insets-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
