<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Authorities */

$this->title = Yii::t('app', 'Create Authorities');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Authorities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authorities-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
