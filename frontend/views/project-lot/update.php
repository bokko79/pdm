<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
use dosamigos\tinymce\TinyMce;
use kartik\checkbox\CheckboxX;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectLot */

$this->title = 'Podešavanje parcele projekta';

$this->params['page_title'] = 'Lokacija';
$this->params['page_title_2'] = 'Parcela';

$this->params['breadcrumbs'][] = ['label' => '<i class="fa fa-map-marker"></i> Lokacija projekta', 'url' => ['/project-lot/view', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = $this->title;

$this->params['project'] = $model->project;
?>

<div class="card_container record-full grid-item fadeInUp no-shadow no-margin animated-not no-float" id="">
    <div class="primary-context normal aliceblue bottom-bordered">
        <div class="head colos">
            <div class="subaction">
                <?= Html::a('<i class="fa fa-life-saver fa-2x"></i>', null, ['class' => 'btn btn-link button_to_show_secondary']) ?>
            </div>
            <i class="fa fa-stop"></i> Parcela projekta
        </div>
        <div class="subhead">Upravljanje podacima predmetnih parcela projekta.</div>
    </div>  
    <div class="primary-context aliceblue bottom-bordered" style="display: none;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5">
                    <h5>Kreiranje novog projekta</h5>
                    <p>Uputstvo za kreiranje novog projekta.</p>
                </div>
                <div class="col-sm-7">
                    <p><iframe src="//www.youtube.com/embed/sDYVYgiGW3c" width="100%" height="314" allowfullscreen="allowfullscreen"></iframe></p>
                </div>
            </div>
        </div>
            
    </div>
</div>



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


