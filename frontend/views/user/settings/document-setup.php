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

$this->title = Yii::t('user', 'Moji dokumenti');
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<div class="row">
    <div class="col-md-3">
        <?= $this->render('_menu') ?>
    </div>
    <div class="col-md-9">
        <div class="">
                <div class="card_container record-full grid-item fadeInUp animated" id="">
                    <div class="primary-context gray normal">
                        <div class="head colos thin"><?= Html::encode($this->title) ?>
                        <div class="action-area"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj dokument', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->user_id, 'LegalFilesSearch[entity]'=>'engineer']), ['class' => 'btn btn-primary btn-sm']) ?></div>
                        </div>
                        <div class="subhead"></div>
                    </div>
                    
                    <div class="secondary-context">
                        <?= GridView::widget([
                            'dataProvider' => $engineerFiles,
                            'columns' => [
                                [
                                    'label'=>'Vrsta dokumenta',
                                    'format' => 'raw',
                                    'value'=>function ($data) {
                                        return Html::a($data->docType, ['/legal-files/update', 'id' => $data->id, 'LegalFiles[type]'=>$data->type]);
                                    },
                                ],
                                [
                                    'label'=>'Dokument',
                                    'format' => 'raw',
                                    'value'=>function ($data) {
                                        return $data->file ? Html::img('/images/legal_files/'.$data->folder.'/'.$data->file->name, ['style'=>'width:150px;']) : null;
                                    },
                                ],
                                //'value',
                            ],
                        ]); ?>
                    </div>
                </div>


        </div>
    </div>
</div>