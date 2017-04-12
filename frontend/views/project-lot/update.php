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

$this->title = Yii::t('app', 'Podešavanje {modelClass} ', [
    'modelClass' => 'parcele projekta',
]) . $model->project->code;
$this->params['breadcrumbs'][] = ['label' => 'Parcela@'.$model->project->name, 'url' => ['/project-lot/view', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Podešavanje');

$this->params['project'] = $model->project;

?>
<h1 class="col-md-offset-3"><?= Html::encode($this->title) ?></h1>
<?php /* 
    

    $this->render('_form', [
        'model' => $model,
    ]) */ ?>


<?php
$form = kartik\widgets\ActiveForm::begin([
    //'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 10,      
   	'formConfig' => ['labelSpan' => 4, 'deviceSize' => ActiveForm::SIZE_SMALL],
    'options' => ['enctype' => 'multipart/form-data', /*'style'=>'margin-top:0px !important;'*/],
]);

$items = [
    [
        'label'=>'Opšti podaci parcele',
        'content'=>$this->render('form_tabs/_general', ['model'=>$model, 'form'=>$form]),
        'active'=>true
    ],
    [
        'label'=>'Dimenzije parcele',
        'content'=>$this->render('form_tabs/_dimensions', ['model'=>$model, 'form'=>$form]),
    ],
    [
        'label'=>'Urbanistički parametri',
        'content'=>$this->render('form_tabs/_urbanism', ['model'=>$model, 'form'=>$form]),
    ],
    [
        'label'=>'Visinske kote',
        'content'=>$this->render('form_tabs/_levels', ['model'=>$model, 'form'=>$form]),
    ],
    [
        'label'=>'Opis parcele',
        'content'=>$this->render('form_tabs/_description', ['model'=>$model, 'form'=>$form]),
    ],
    ];
    
?>

<div class="container-fluid">
    <div class="row"">

        <div class="col-md-offset-9 col-md-3 right">
            <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj', ['class' => 'btn btn-success  btn-sm']) ?>
        </div>        
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php
                echo kartik\tabs\TabsX::widget([
                    'items'=>$items,
                    'position'=>TabsX::POS_LEFT,
                    'encodeLabels'=>false,
                    'containerOptions'=>[
                        'style' => 'width:100%;',
                    ],
                ]);
            ?>
        </div>  
    </div>
    <div class="row"">

        <div class="col-md-offset-6 col-md-4">
        	<hr>
            <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj', ['class' => 'btn btn-success btn-block btn-lg']) ?>
        </div>        
    </div>
</div>


<?php ActiveForm::end(); ?>