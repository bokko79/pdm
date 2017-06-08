<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

//$location->lot = ($model->location) ? $model->location->locationLots[0]->lot : null;
$this->title = 'Adresa lokacije projekta';

$this->params['page_title'] = 'Lokacija';
$this->params['page_title_2'] = 'Podešavanje adrese';

$this->params['breadcrumbs'][] = ['label' => '<i class="fa fa-map-marker"></i> Lokacija projekta', 'url' => ['/project-lot/view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => 'Adresa lokacije projekta', 'url' => null];

$this->params['project'] = $model;

$location->lot = $location->locationLots[0]->lot;
?>

<div class="card_container record-full grid-item fadeInUp no-shadow no-margin animated-not no-float" id="">
  <div class="primary-context normal aliceblue bottom-bordered">
    <div class="head colos">
      <div class="subaction">
        <?= Html::a('<i class="fa fa-life-saver fa-2x"></i>', null, ['class' => 'btn btn-link button_to_show_secondary']) ?>
      </div>
      <i class="fa fa-map-marker"></i> Adresa projekta
    </div>
    <div class="subhead">Podešavanje adrese projekta.</div>
  </div>  
  <div class="primary-context aliceblue bottom-bordered" style="display: none;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-5 text">
          <h5>Upravljanje učesnicima projekta</h5>
          <h6>Nova sveska projekta.</h6>
          <p>Nova sveska projekta.</p>
          <h6>Podešavanje sveske projekta.</h6>
          <p>Podešavanje sveske projekta.</p>
          <h6>Uklanjanje sveske projekta.</h6>
          <p>Uklanjanje sveske projekta.</p>
        </div>
        <div class="col-sm-7">
          <p><iframe src="//www.youtube.com/embed/sDYVYgiGW3c" width="100%" height="314" allowfullscreen="allowfullscreen"></iframe></p>
        </div>
      </div>
    </div>        
  </div>
</div>

<div class="container-fluid full" style="">
    <div class="row">

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 10,      
    'formConfig' => ['labelSpan' => 4, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data', 'style'=>'margin-top:0 !important;'],
    //'enableAjaxValidation' => true,
    'enableClientValidation' => true,
]); ?>

    <?= $form->field($model, 'address') ?> 
    <div id="my_map_location" class="col-md-6 col-md-offset-4" style="height:360px; margin-bottom:20px;"></div>

<?php // HQ ?>
<?= yii\helpers\Html::activeHiddenInput($location, 'lat', ['data-geo'=>'lat', 'id'=>'hidden-geo-input']) ?>
<?= yii\helpers\Html::activeHiddenInput($location, 'lng', ['data-geo'=>'lng', 'id'=>'hidden-geo-input']) ?>

    <?= $form->field($location, 'street')->textInput(['maxlength' => true]) ?>
    <?= $form->field($location, 'number')->textInput(['maxlength' => true]) ?>
    <?= $form->field($location, 'city_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Cities::find()->all(), 'id', 'town', 'city'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>
    <?= $form->field($location, 'lot')->textInput(['maxlength' => true]) ?>
    <?= $form->field($location, 'county_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Counties::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>    
        
<input type="hidden" id="control_input_lat" value="<?= $location->lat ?>">
<input type="hidden" id="control_input_lng" value="<?=  $location->lng ?>">

    

    <?php if($model->setup_status=='address' and $location->lat!=''): ?>
        <div class="col-md-offset-4 col-md-8">
      <div class="card_container record-full grid-item no-margin no-padding no-shadow">
        <div class="primary-context bordered text aliceblue">
          <p>Kada završite podešavanje adrese projekta, pređite na sledeći korak.</p>          
            <div class="row" style="margin:50px 0 0;">                
              <div class="col-md-12">                            
                <?= Html::submitButton('Sledeći korak <i class="fa fa-arrow-circle-right"></i>', ['class' => 'btn btn-success shadow btn-block btn-lg', 'name' => 'step_form', 'value' => 'next_step']) ?>
              </div>            
            </div>
        </div>
      </div>
      </div>
    <?php else: ?>
        <div class="row" style="margin:20px 0;">
            <div class="col-md-offset-4 col-md-6">
                <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Sačuvaj izmene', ['class' => !$model->isNewRecord ? 'btn btn-success btn-block shadow' : 'btn btn-primary btn-block shadow']) ?>
            </div>        
        </div>
    <?php endif; ?>

<?php ActiveForm::end(); ?>
    </div>
</div>

