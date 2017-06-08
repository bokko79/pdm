<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\EngineerLicences */

$this->title = Yii::t('app', 'Novi licencni paket inženjera');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inženjer'). $model->engineer->name, 'url' => ['engineers/view', 'id'=>$model->engineer_id]];
//$this->params['breadcrumbs'][] = $this->title;
$this->params['page_title'] = 'Inženjer';
?>

<div class="container-fluid listed">
    <div class="row" style="">

        <div class="index w300">
            <?= $this->render('_engineer_licences') ?>
        </div>

        <div class="content view w300" style="">

                <h4><?= $this->title ?></h4>
                <hr style="margin: 10px 0 40px">
                <?= $this->render('_form', [
                    'model' => $model,
                ]) ?>

               
        </div>
    </div>

</div>

