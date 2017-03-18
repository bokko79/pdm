<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\QsPositions */

$this->title = Yii::t('app', 'Create Qs Positions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Qs Positions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qs-positions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
