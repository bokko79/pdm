<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\widgets\Alert;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;

/* @var $this yii\web\View */
/* @var $model common\models\Projects */

$this->title = 'Pozovi kolegu';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-bullhorn"></i> <?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <p>Unesite e-mail adresu koleginice/kolege i na taj način je/ga pozovite da se pridruži masterplan.rs mreži.</p>
                <?php $form = kartik\widgets\ActiveForm::begin([
                    'id' => 'form-invite',
                    'type' => ActiveForm::TYPE_VERTICAL,
                    //'enableAjaxValidation' => true,
                    //'enableClientValidation' => true,
                    //'fullSpan' => 7,      
                    //'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
                    //'options' => ['enctype' => 'multipart/form-data'],
                ]); ?>                

                <?= $form->field($model, 'email') ?>   

                <?= Html::submitButton('Pošalji poziv!', ['class' => 'btn btn-success btn-block shadow']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>