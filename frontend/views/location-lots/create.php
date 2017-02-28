<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LocationLots */

$this->title = Yii::t('app', 'Dodaj katastarsku parcelu');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Katastarske parcele'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-lots-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
