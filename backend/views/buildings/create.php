<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Buildings */

$this->title = Yii::t('app', 'Create Buildings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Buildings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buildings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
