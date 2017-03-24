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
$this->params['profile'] = $model;

?>



<div class="row">
    <div class="col-md-3">
        <?= $this->render('../settings/_menu') ?>
    </div>
    <div class="col-md-9">
        <?php // $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>
        <?= Alert::widget() ?>
        <?= $this->render('tabs/_projects', ['model'=>$model->engineer, 'projects'=>$projects]) ?>
        <?= (Yii::$app->user->client!=null) ? $this->render('tabs/_requests', ['model'=>$model->client, 'requests'=>$requests]) : null ?>
    </div>
</div>



<?php Modal::begin([
        'id'=>'choose-profile-type',
        'size'=>Modal::SIZE_SMALL,
        'class'=>'overlay_modal',
        'header'=> 'choose-profile-type',
    ]); ?>
        <?= Html::a('Individual profile', Url::to(['profile/create', 'type'=>'occupation']), ['class'=>'btn btn-link']) ?>
        <br>
        <?= Html::a('Company profile', Url::to(['profile/create', 'type'=>'enterprise']), ['class'=>'btn btn-link']) ?>
<?php Modal::end();
?>