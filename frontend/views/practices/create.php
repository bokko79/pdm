<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Practices */

$this->title = Yii::t('app', 'Kreiraj firmu');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Firme'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="practices-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'location' => $location,
    ]) ?>

</div>
