<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\EngineerLicences */

$this->title = Yii::t('app', 'Kreiraj licencni paket inženjera: '. $model->engineer->name);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Licencni paketi inženjera'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="engineer-licences-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
