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

$this->title = Yii::t('user', 'Registracija inženjera: Opšti podaci');
$this->params['breadcrumbs'][] = $this->title;

$config = ['template'=>"{input}\n{error}\n{hint}"]; // config to deactivate label for ActiveField
?>
<?= $this->render('_steps') ?>

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
                    'options' => ['enctype' => 'multipart/form-data'],
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
                <h6 style="margin:10px 0;">Osnovni podaci inženjera</h6>
                <?= $form->field($engineer, 'name', $config)->widget(LabelInPlace::classname(), ['defaultIndicators'=>false,])->hint('Vaše puno ime i prezime.') ?>

                <?= $form->field($engineer, 'phone', $config)->widget(LabelInPlace::classname(), ['defaultIndicators'=>false,])->hint('Kontakt telefon inženjera.') ?>

                <?= $form->field($engineer, 'expertees_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(\common\models\Expertees::find()->all(), 'id', 'name'),
                        'options' => ['placeholder' => 'Izaberite...'],
                        'language' => 'sr-Latn',
                        'changeOnReset' => false,           
                    ])->hint('Stečeno stručno zvanje inženjera.') ?>

                <?= $form->field($engineer, 'signatureFile')->widget(FileInput::classname(), [
                        'options' => [/*'multiple' => true,*/ 'accept' => 'image/*'],
                        'pluginOptions' => [
                            'previewFileType' => 'any',
                            'showCaption' => false,
                            'showUpload' => false,
                            'browseClass' => 'btn btn-info btn-block shadow',
                            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                            'browseLabel' =>  Yii::t('app', 'Prikačite svoj potpis'),
                            'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                            'resizeImage'=> true,
                            'maxImageWidth'=> 60,
                            'maxImageHeight'=> 60,
                            'resizePreference'=> 'width',
                        ],
                    ])->hint('Prikačite svoj skenirani potpis u .jpg ili .png formatu.') ?>

            <div class="expertees_part" style="display:none">
                <?php /* $form->field($engineer_licence, 'licence_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(\common\models\Licences::find()->all(), 'id', 'fullname'),
                        'options' => ['placeholder' => 'Izaberite...'],
                        'language' => 'sr-Latn',
                        'changeOnReset' => false,           
                    ]) ?>

                <?= $form->field($engineer_licence, 'no', $config)->widget(LabelInPlace::classname(), ['defaultIndicators'=>false,])->hint('Broj licence.') */ ?>

                <?php /* $form->field($engineer_licence, 'stampFile')->widget(FileInput::classname(), [
                    'options' => ['accept' => 'image/*'],
                    'pluginOptions' => [
                        'previewFileType' => 'any',
                        'showCaption' => false,
                        'showUpload' => false,
                        'browseClass' => 'btn btn-info shadow',
                        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                        'browseLabel' =>  Yii::t('app', 'Izaberite dokument'),
                        'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                        'resizeImage'=> true,
                        'maxImageWidth'=> 60,
                        'maxImageHeight'=> 60,
                        'resizePreference'=> 'width',
                    ],
                ])->hint('Prikačite skenirani licencni pečat inženjera u .jpg ili .png formatu.') ?>

                <?= $form->field($engineer_signature, 'docFile')->widget(FileInput::classname(), [
                    'options' => ['accept' => 'image/*'],
                    'pluginOptions' => [
                        'previewFileType' => 'any',
                        'showCaption' => false,
                        'showUpload' => false,
                        'browseClass' => 'btn btn-info shadow',
                        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                        'browseLabel' =>  Yii::t('app', 'Izaberite dokument'),
                        'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                        'resizeImage'=> true,
                        'maxImageWidth'=> 60,
                        'maxImageHeight'=> 60,
                        'resizePreference'=> 'width',
                    ],
                ])->hint('Prikačite skenirani potpis inženjera u .jpg ili .png formatu.') */ ?>
            </div>

                <hr>

                <?= $form->field($model, 'practice_join')->radioList([0 => 'Direktor, u svojoj firmi',  1 => 'Zaposlen/partner postojeće firme', ], ['prompt' => 'Izaberite...'])->hint('Ukoliko ste direktor firme, izaberite "Direktor, u svojoj firmi" i napravi profil firme u sledećem koraku registracije. Ukoliko ste zaposleni ili partner, izaberite "zaposleni/partner" i izaberite već registrovanu firmu iz liste.') ?>
<?php /*
            <div class="new_practice" style="display:none">
                <?= $form->field($practice, 'name', $config)->widget(LabelInPlace::classname(), ['defaultIndicators'=>false,]) ?>

                <?php /* $form->field($practice_signature, 'docFile')->widget(FileInput::classname(), [
                    'options' => ['accept' => 'image/*'],
                    'pluginOptions' => [
                        'previewFileType' => 'any',
                        'showCaption' => false,
                        'showUpload' => false,
                        'browseClass' => 'btn btn-info shadow',
                        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                        'browseLabel' =>  Yii::t('app', 'Izaberite dokument'),
                        'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                        'resizeImage'=> true,
                        'maxImageWidth'=> 60,
                        'maxImageHeight'=> 60,
                        'resizePreference'=> 'width',
                    ],
                ])->hint('Prikačite skenirani potpis direktora preduzeća u .jpg ili .png formatu.') ?>

                <?= $form->field($practice_stamp, 'docFile')->widget(FileInput::classname(), [
                    'options' => ['accept' => 'image/*'],
                    'pluginOptions' => [
                        'previewFileType' => 'any',
                        'showCaption' => false,
                        'showUpload' => false,
                        'browseClass' => 'btn btn-info shadow',
                        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                        'browseLabel' =>  Yii::t('app', 'Izaberite dokument'),
                        'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                        'resizeImage'=> true,
                        'maxImageWidth'=> 60,
                        'maxImageHeight'=> 60,
                        'resizePreference'=> 'width',

                    ],
                ])->hint('Prikačite skenirani pečat preduzeća u .jpg ili .png formatu.')  ?>

                <hr>
Adresa
                

                <?= $form->field($location, 'street', $config)->widget(LabelInPlace::classname(), ['defaultIndicators'=>false,]) ?>
                <?= $form->field($location, 'number', $config)->widget(LabelInPlace::classname(), ['defaultIndicators'=>false,]) ?>
                <?= $form->field($location, 'city_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(\common\models\Cities::find()->all(), 'id', 'town'),
                        'options' => ['placeholder' => 'Izaberite...'],
                        'language' => 'sr-Latn',
                        'changeOnReset' => false,           
                    ]) ?>



            </div> */ ?>
            <div class="join_practice" style="display:none">
                <?= $form->field($model, 'practice_id')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(\common\models\Practices::find()->all(), 'engineer_id', 'name'),
                        'options' => ['placeholder' => 'Izaberite...'],
                        'language' => 'sr-Latn',
                        'changeOnReset' => false,           
                    ])->hint('Izaberite firmu u kojoj ste zaposleni ili čiji ste partner. Ukoliko firma nije na listi, molimo Vas posavetujete direktora navedene firme o registraciji na masterplan.rs, a zatim se nakon uspešne registracije prijavite se kao zaposleni/partner te firme.') ?>
            </div>

               

            <hr>     
                


<?= '<small style="display:block; margin:20px;">'.Html::a('Klikom na dugme "Registracija", slažem se sa Uslovima korišćenja.', Url::to(), ['data-toggle'=>'modal', 'data-backdrop'=>false,  'data-target'=>'#terms']).'</small>' ?>

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
    'header' => '<h2>Uslovi korišćenja</h2>',
    'id'=>'terms',
]);

echo 'Opšti uslovi korišćenja websajta masterplan.rs u izradi.';

\yii\bootstrap\Modal::end();