<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
use yii\widgets\ListView;

$formatter = \Yii::$app->formatter;
$formatter->locale = 'sr-Latn';

/* @var $this yii\web\View */
/* @var $model common\models\Requests */

$this->title = $model->fullname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Zahtevi'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-sm-5">
        <div class="card_container record-full grid-item fadeInUp animated" id="card_container" style="float:none;">    <div class="primary-context">
                <div class="head">
                    <?= c($model->fullname) ?>
                </div>
                <div class="subhead"> 
                    
                    <?= $formatter->asDate($model->time, 'php:n. mm Y. H:i') ?>
                </div>
            </div>        
            <div class="media-area" style="">                
                <div class="image">
                    <?= ($model->requestFiles) ? Html::img('/images/request_files/'.$model->requestFiles[0]->file->name, ['style'=>'']) : null ?>                    
                </div>
                <div class="primary-context in-media dark">
                    <div class="head"><?= '<i class="fa fa-user-circle"></i> @'.$model->client->user->username ?></div>
                </div>
            </div>
            <div class="primary-context">
                <div class="head">
                    
                    
                    <div class="action-area normal-case">
                        <?= (1==1) ? Html::a('<i class="fa fa-cogs"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) : null ?>
                    </div>
                </div>
                <div class="subhead"> 
                    
                    <?= $formatter->asDate($model->time, 'php:n. mm Y. H:i') ?>
                </div>
            </div> 
            <div class="secondary-context">
                <?= c($model->description) ?>
            </div>
            
        </div>
    </div>
    <div class="col-sm-7">
        <?= Html::a('<i class="fa fa-comment"></i> Pošalji komentar', Url::to(), ['class' => 'btn btn-default btn-lg', 'style' => 'float:right; margin:20px; ', 'data-toggle'=>'modal', 'data-backdrop'=>false,  'data-target'=>'#comment-modal']) ?>
        <?= ListView::widget([
                    'dataProvider' => $comments,
                    'itemView' => '_comment',
                    'itemOptions' => [],
                ]) ?>

                <hr>



    </div>


</div>

<?php \yii\bootstrap\Modal::begin([
        'id'=>'comment-modal',
        //'size'=>\yii\bootstrap\Modal::SIZE_SMALL,
        'class'=>'overlay_modal',
        'header'=> '<h3>Pošalji komentar</h3>',
    ]); ?>
    <?php $form = kartik\widgets\ActiveForm::begin([
            'id' => 'form-horizontal',
            'type' => ActiveForm::TYPE_VERTICAL,
            //'fullSpan' => 7,      
            //'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
            //'options' => ['enctype' => 'multipart/form-data'],
            //'enableAjaxValidation' => true,
            'enableClientValidation' => true,
        ]); ?>

            

            <?= $form->field($comment, 'body')->textarea(['rows' => 6, 'placeholder'=>'Imate komentar na ovaj zahtev? Napišite ovde i pošaljite.'])->label('') ?>

            <div class="row" style="margin:0 20px 20px; float:right">
                
                    <?= Html::submitButton('Pošalji komentar', ['class' => 'btn btn-success shadow']) ?>
                     
            </div>
<hr> 
        <?php ActiveForm::end(); ?> 
<?php \yii\bootstrap\Modal::end();
?>

        
