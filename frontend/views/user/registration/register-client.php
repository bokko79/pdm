<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

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
use kartik\datecontrol\DateControl;
use kartik\label\LabelInPlace;

/**
 * @var yii\web\View              $this
 * @var dektrium\user\models\User $user
 * @var dektrium\user\Module      $module
 */

$this->title = Yii::t('user', 'Registracija investitora');
$this->params['breadcrumbs'][] = $this->title;

$config = ['template'=>"{input}\n{error}\n{hint}"]; // config to deactivate label for ActiveField
?>

<div class="row">
    <?php $form = kartik\widgets\ActiveForm::begin([
        'id' => 'form-horizontal',
        'type' => ActiveForm::TYPE_VERTICAL,
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        //'fullSpan' => 7,      
        //'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
        //'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>
    <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?>
                    <p class="text-center" style="float:right">
                        <?= Html::a(Yii::t('user', 'Već imate nalog? Login!'), ['/user/security/login']) ?>
                    </p>
                </h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                    <?php if(\Yii::$app->user->isGuest): ?>
                        <h5 style="margin-bottom:20px;">Podaci naloga</h5>
                        <?= $form->field($model, 'email', $config)->widget(LabelInPlace::classname(),[
                                    'type' => LabelInPlace::TYPE_HTML5,
                                    'defaultIndicators'=>false,
                                    'options' => ['type' => 'email', 'class'=>'form-control']
                                ]) ?>
                        <?= $form->field($model, 'username', $config)->widget(LabelInPlace::classname(), ['defaultIndicators'=>false,]) ?>
                        <?php if ($module->enableGeneratingPassword == false): ?>
                                    <?= $form->field($model, 'password', $config)->widget(LabelInPlace::classname(),[
                                    'type' => LabelInPlace::TYPE_HTML5,
                                    'defaultIndicators'=>false,
                                    'options' => ['type' => 'password', 'class'=>'form-control']
                                ]) ?>
                                <?php endif ?>
                                        
                        
                        
                        <hr>
                    <?php endif; ?>
                        <h5 style="margin-bottom:20px;">Opšti podaci</h5>
                        <?= $form->field($client, 'type')->radioList([ 'individual' => 'Fizičko lice', 'company' => 'Pravno lice/Preduzeće', ], []) ?> <br>

                        <?= $form->field($client, 'name', $config)->widget(LabelInPlace::classname(), ['defaultIndicators'=>false,]) ?>

                        <?= $form->field($client, 'contact_person', $config)->widget(LabelInPlace::classname(), ['defaultIndicators'=>false,])->hint('Ukoliko je investitor pravno lice, navesti ime odgovornog lica.') ?>
                        <hr>
                        <h5 style="margin-bottom:20px;">Kontakt podaci</h5>
                        <?= $form->field($client, 'phone', $config)->widget(LabelInPlace::classname(), ['defaultIndicators'=>false,]) ?>
                    </div>
                    <div class="col-md-6 col-sm-6" style="border-left:1px solid #ddd;">
                        <h5 style="margin-bottom:20px;">Adresa</h5>
                        <?= $form->field($location, 'street', $config)->widget(LabelInPlace::classname(), ['defaultIndicators'=>false,]) ?>
                        <?= $form->field($location, 'number', $config)->widget(LabelInPlace::classname(), ['defaultIndicators'=>false,]) ?>
                        <?= $form->field($location, 'city_id')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map(\common\models\Cities::find()->all(), 'id', 'town'),
                                'options' => ['placeholder' => 'Izaberite...'],
                                'language' => 'sr-Latn',
                                'changeOnReset' => false,           
                            ]) ?>
                            <hr>
                         
                        <h5 style="margin-bottom:20px;">Poslovni podaci</h5>   

                        <?= $form->field($client, 'tax_no', $config)->widget(LabelInPlace::classname(),[
                                    'type' => LabelInPlace::TYPE_HTML5,
                                    'defaultIndicators'=>false,
                                    'options' => ['type' => 'number', 'class'=>'form-control']
                                ]) ?>
                        <?= $form->field($client, 'company_no', $config)->widget(LabelInPlace::classname(),[
                                    'type' => LabelInPlace::TYPE_HTML5,
                                    'defaultIndicators'=>false,
                                    'options' => ['type' => 'number', 'class'=>'form-control']
                                ]) ?>
                        <?= $form->field($client, 'account_no', $config)->widget(LabelInPlace::classname(), ['defaultIndicators'=>false,]) ?>
                        <?= $form->field($client, 'bank', $config)->widget(LabelInPlace::classname(), ['defaultIndicators'=>false,]) ?>

                        <hr>     
                               
                        <?= '<small style="margin:20px; display:block;">'.Html::a('Klikom na dugme "Registracija investitora", slažem se sa Uslovima korišćenja.', Url::to(), ['data-toggle'=>'modal', 'data-backdrop'=>false,  'data-target'=>'#terms']).'</small>' ?>

                        <?= Html::submitButton('Registracija investitora', ['class' => 'btn btn-success btn-block shadow']) ?>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    
    </div>     
</div>


<?php
\yii\bootstrap\Modal::begin([
    'header' => '<h2>Masterplan Uslovi korišćenja</h2>',
    'id'=>'terms',
]);

echo 'Opšti uslovi korišćenja websajta.';

\yii\bootstrap\Modal::end();