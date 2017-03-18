<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\QsActions */

$this->title = Yii::t('app', 'Create Qs Actions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Qs Actions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qs-actions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
