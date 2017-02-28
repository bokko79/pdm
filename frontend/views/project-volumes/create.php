<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProjectVolumes */

$this->title = Yii::t('app', 'Dodaj deo projekta');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Delovi projekta'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-volumes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
