<?php

/*
 * C01 - Dashboard Home page.
 *
 * This file is part of the Servicemapp project.
 *
 * (c) Servicemapp project <http://github.com/bokko79/servicemapp>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use common\widgets\Alert;

/* @var $this yii\web\View */

$this->title = 'Home: '.$model->username;
$formatter = \Yii::$app->formatter;
$this->params['page_title'] = 'Profil';
$this->params['profile'] = $model;

?>
<div class="container-fluid">
	<div class="row">

	        <?= Alert::widget() ?>        
	        <?= $this->render('tabs/_projects', ['model'=>$model->engineer, 'projects'=>$projects, 'searchModel'=>$searchModel]) ?>
	    

	</div>
</div>