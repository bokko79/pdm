<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Insets */

$this->title = Yii::t('app', 'Create Insets');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Insets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="insets-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
