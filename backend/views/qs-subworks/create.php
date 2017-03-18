<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\QsSubworks */

$this->title = Yii::t('app', 'Create Qs Subworks');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Qs Subworks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qs-subworks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
