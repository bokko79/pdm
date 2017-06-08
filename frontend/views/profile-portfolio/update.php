<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProfilePortfolio */

$this->title = Yii::t('app', 'Izmeni {modelClass}: ', [
    'modelClass' => 'podatak portfolia',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Portfolio profila'), 'url' => ['/user/settings/portfolio-setup']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Izmeni');

$this->params['page_title'] = 'Inženjer';
?>
<div class="container-fluid full">
	<div class="row">
	    <h4><?= Html::encode($this->title) ?></h4>

	    <?= $this->render('_form', [
	        'model' => $model,
	    ]) ?>
    </div>
</div>
