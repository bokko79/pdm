<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Clients */

$this->title = Yii::t('app', 'Podešavanje {modelClass}: ', [
    'modelClass' => 'investitora',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Moji investitori'), 'url' => ['/user/settings/practice-setup', '#'=>'w5-tab2']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Podešavanje');
?>
<div class="clients-update">

    

    

</div>

<div class="row">
    <div class="col-md-3">
        <?= $this->render('../user/settings/_menu') ?>
    </div>
    <div class="col-md-9">
    	<h1><?= Html::encode($this->title) ?></h1>
        <?= $this->render('_form', [
        'model' => $model,
        'location' => $location,
    ]) ?>
    </div>
</div>
