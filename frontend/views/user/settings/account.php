<?php

/*
 * C112 - Dashboard Setup Account page.
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
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use kartik\switchinput\SwitchInput;
use kartik\widgets\FileInput;

/**
 * @var $this  yii\web\View
 * @var $form  yii\widgets\ActiveForm
 * @var $model dektrium\user\models\SettingsForm
 */

$this->title = Yii::t('user', 'Podešavanje korisničkog naloga');
//$this->params['breadcrumbs'][] = $this->title;
$this->params['page_title'] = 'Profil';

?>
<div class="container-fluid">
<div class="row">

       <div class="card_container record-full grid-item fadeInUp no-shadow transparent no-margin animated-not" id="">
            <div class="primary-context normal">
                <div class="head"><?= Html::encode($this->title) ?>
                    <div class="subaction"></div>
                </div>
                
                <div class="subhead">Podešavanje korisničkih podataka.</div>
            </div>    
            <div class="secondary-context">
        
            
                <?php $form = kartik\widgets\ActiveForm::begin([
                    'id' => 'form-horizontal',
                    'type' => ActiveForm::TYPE_HORIZONTAL,
                    'fullSpan' => 10,      
                    'formConfig' => ['labelSpan' => 4, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
                    'options' => ['enctype' => 'multipart/form-data'],
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                ]); ?>
         

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'username') ?>
                
                <?= $form->field($model, 'new_password')->passwordInput() ?>
  
                <?= $form->field($model, 'theme')->widget(SwitchInput::classname(), [
                    'containerOptions' => ['style'=>'margin:0'],
                     'pluginOptions'=>[
                        'handleWidth'=>60,
                        'onText'=>'Svetlo',
                        'offText'=>'Tamno'
                    ]
                ]) ?> 
                <hr>
                <?= $user->aFile ? '<div class="col-md-offset-4"> Vaša trenutna profilna slika:<br><br>'.Html::img('/images/profiles/'.$user->aFile->name, ['style'=>'width:150px; margin:0 0 20px;']).'</div>' : null ?>
                <?= $form->field($model, 'avatarFile')->widget(FileInput::classname(), [
                        'options' => [/*'multiple' => true,*/ 'accept' => 'image/*'],
                        'pluginOptions' => [
                            'previewFileType' => 'any',
                            'showCaption' => false,
                            'showUpload' => false,
                            'browseClass' => 'btn btn-info shadow btn-block',
                            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                            'browseLabel' =>  Yii::t('app', 'Prikačite profilnu sliku'),
                            'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                            'resizeImage'=> true,
                            'maxImageWidth'=> 60,
                            'maxImageHeight'=> 60,
                            'resizePreference'=> 'width',
                        ],
                    ]) ?>
                <hr />

                <?= $form->field($model, 'current_password')->passwordInput() ?>
                <hr />
                <div class="form-group">
                    <div class="col-lg-offset-4 col-lg-6">
                        <?= Html::submitButton(Yii::t('user', 'Sačuvaj izmene'), ['class' => 'btn btn-block btn-success']) ?><br>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            
            </div>                   
        </div>

    </div>
</div>
