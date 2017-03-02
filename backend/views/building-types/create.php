<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BuildingTypes */

$this->title = Yii::t('app', 'Create Building Types');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Building Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="building-types-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
