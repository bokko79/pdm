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

$this->title = Yii::t('user', 'Registracija');
$this->params['breadcrumbs'][] = $this->title;

$config = ['template'=>"{input}\n{error}\n{hint}"]; // config to deactivate label for ActiveField
?>

<div class="row">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <?php $form = kartik\widgets\ActiveForm::begin([
                    'id' => 'form-horizontal',
                    'type' => ActiveForm::TYPE_VERTICAL,
                    'enableAjaxValidation' => true,
                    'enableClientValidation' => true,
                    //'fullSpan' => 7,      
                    //'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
                    //'options' => ['enctype' => 'multipart/form-data'],
                ]); ?>

                

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
                <?= $form->field($engineer, 'name', $config)->widget(LabelInPlace::classname(), ['defaultIndicators'=>false,]) ?>

                <?= $form->field($engineer, 'title', $config)->widget(LabelInPlace::classname(), ['defaultIndicators'=>false,])->hint('Stečeno stručno zvanje, npr. dipl.ing.građ. ili master arhitekture. Titula se pojavljuje u tehničkoj dokumentaciji, uz ime inženjera.') ?>

                <?= $form->field($engineer, 'phone', $config)->widget(LabelInPlace::classname(), ['defaultIndicators'=>false,])->hint('Kontakt telefon inženjera.') ?>

                
                <?= $form->field($location, 'city_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(\common\models\Cities::find()->all(), 'id', 'town'),
                        'options' => ['placeholder' => 'Izaberite...'],
                        'language' => 'sr-Latn',
                        'changeOnReset' => false,           
                    ]) ?>

            <hr>     
                       
<?= '<small>'.Html::a('Klikom na dugme "Registracija", slažem se sa Uslovima korišćenja.', Url::to(), ['data-toggle'=>'modal', 'data-backdrop'=>false,  'data-target'=>'#terms']).'</small>' ?>

                <?= Html::submitButton('Registracija', ['class' => 'btn btn-success btn-block shadow']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <p class="text-center">
            <?= Html::a(Yii::t('user', 'Već imate nalog? Login!'), ['/user/security/login']) ?>
        </p>
    </div>
</div>


<?php
\yii\bootstrap\Modal::begin([
    'header' => '<h2>Masterplan Uslovi korišćenja</h2>',
    'id'=>'terms',
]);

echo 'Opšti uslovi korišćenja websajta.';

\yii\bootstrap\Modal::end();