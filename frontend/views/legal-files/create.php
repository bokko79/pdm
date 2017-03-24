<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LegalFiles */

$this->title = Yii::t('app', 'Kreiranje dokumenata');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', $entity->name.': Pravni dokumenti'), 'url' => [$model->entity.'s/view', 'id'=>Yii::$app->user->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="legal-files-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
