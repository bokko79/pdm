<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PracticeEngineers */

$this->title = Yii::t('app', 'Dodavanje zaposlenog u firmi');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Zaposleni u firmi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="practice-engineers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
