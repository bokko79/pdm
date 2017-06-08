<?php

/*
 * B05 - Email Setup page.
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
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;

/**
 * @var $this  yii\web\View
 * @var $form  yii\widgets\ActiveForm
 * @var $model dektrium\user\models\SettingsForm
 */

$this->title = Yii::t('user', 'Moje licence');
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row">
    <div class="col-md-3" style="z-index:1">
        <?= $this->render('_menu') ?>
    </div>
    <div class="col-md-9">
        <div class="card_container record-full transparent grid-item fadeInUp no-shadow animated-not" id="">
            <div class="primary-context normal">
                <div class="head colos"><?= Html::encode($this->title) ?>
                <div class="subaction"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj licencni paket', Url::to(['/engineer-licences/create', 'EngineerLicences[engineer_id]'=>$model->user_id]), ['class' => 'btn btn-primary shadow']) ?></div></div>
                
                <div class="subhead">Licencni paketi inžerenja. Paket podrazumeva broj licence, kao i kopiju, potvrdu i lični pečat.</div>
            </div>    
            <div class="secondary-context">
                <?= GridView::widget([
                    'dataProvider' => $engineerLicences,
                    'columns' => [
                        [
                            'label'=>'Broj licence',
                            'format' => 'raw',
                            'value'=>function ($data) {
                                return Html::a($data->no, ['/engineer-licences/update', 'id' => $data->id]);
                            },
                        ],

                        [
                            'label'=>'Kopija licence',
                            'format' => 'raw',
                            'value'=>function ($data) {
                                return $data->copy ? Html::img('/images/legal_files/licences/'.$data->copy->name, ['style'=>'width:150px;']) : null;
                            },
                        ],
                        [
                            'label'=>'Potvrda licence',
                            'format' => 'raw',
                            'value'=>function ($data) {
                                return $data->conf ? Html::img('/images/legal_files/licences/'.$data->conf->name, ['style'=>'width:150px;']) : null;
                            },
                        ],
                        [
                            'label'=>'Pečat licence',
                            'format' => 'raw',
                            'value'=>function ($data) {
                                return $data->stamp ? Html::img('/images/legal_files/licences/'.$data->stamp->name, ['style'=>'width:150px;']) : null;
                            },
                        ],
                    ],
                    'summary' => false,
                ]); ?>
            </div>                   
        </div>
    </div>
</div>