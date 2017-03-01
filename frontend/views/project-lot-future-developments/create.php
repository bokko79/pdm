<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectLotFutureDevelopments */

$this->title = Yii::t('app', 'Create Project Lot Future Developments');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Project Lot Future Developments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-lot-future-developments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
