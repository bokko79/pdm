<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Clients */

$this->title = Yii::t('app', 'Novi investitor');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Moji investitori'), 'url' => ['/user/settings/practice-setup', '#'=>'w9-tab2']];
$this->params['breadcrumbs'][] = $this->title;

$this->params['page_title'] = 'Firma';
?>

<div class="container-fluid listed">
    <div class="row" style="">

        <div class="index w300">
            <?= $this->render('_clients', ['model'=>\common\models\Practices::findOne(Yii::$app->user->id)]) ?>
        </div>

        <div class="content view w300" style="">

                <h4><?= $this->title ?></h4>
                <hr style="margin: 10px 0 40px">
                <?= $this->render('_form', [
                    'model' => $model,
                    'location' => $location,
                ]) ?>

               
        </div>
    </div>

</div>