<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Volumes */

$this->title = Yii::t('app', 'Create Volumes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Volumes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="volumes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
