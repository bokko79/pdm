<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model common\models\ProjectBuildingStoreyParts */

$this->title = Yii::t('app', 'Podešavanje {modelClass}: ', [
    'modelClass' => 'jedinice',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Jedinice'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

    <h1><?= Html::encode($this->title) ?></h1>
<?php 
	if($model->projectBuildingStorey->projectBuilding->project->work!='adaptacija'):
			$this->render('_form', [
		        'model' => $model,
		    ]); ?>
<?php else: ?>
<?php
$form = kartik\widgets\ActiveForm::begin([
    //'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 12,      
   	'formConfig' => ['labelSpan' => 4, 'deviceSize' => ActiveForm::SIZE_SMALL],
    'options' => ['enctype' => 'multipart/form-data'],
]);

$items = [
    [
        'label'=>'Opšti podaci',
        'content'=>$this->render('form_tabs/_general', ['model'=>$part['existing'], 'model_new'=>$part['new'], 'form'=>$form]),
        'active'=>true
    ],
    [
        'label'=>'Dispozija i funkcija',
        'content'=>$this->render('form_tabs/_function', ['model'=>$architecture['existing'], 'model_new'=>$architecture['new'], 'form'=>$form]),
    ],
    [
        'label'=>'Položaj i oblik',
        'content'=>$this->render('form_tabs/_position', ['model'=>$architecture['existing'], 'model_new'=>$architecture['new'], 'form'=>$form]),
    ],
    [
        'label'=>'Arhitektonsko rešenje',
        'content'=>$this->render('form_tabs/_architecture', ['model'=>$architecture['existing'], 'model_new'=>$architecture['new'], 'form'=>$form]),
    ], 
    [
        'label'=>'Zidovi i platna',
        'content'=>$this->render('form_tabs/_walls', ['model'=>$structure['existing'], 'model_new'=>$structure['new'], 'form'=>$form]),
    ],
    [
        'label'=>'Ploče i međuspratne konstrukcije',
        'content'=>$this->render('form_tabs/_slabs', ['model'=>$structure['existing'], 'model_new'=>$structure['new'], 'form'=>$form]),
    ],
    [
        'label'=>'Krov, stepenište i ostalo',
        'content'=>$this->render('form_tabs/_roof', ['model'=>$structure['existing'], 'model_new'=>$structure['new'], 'form'=>$form]),
    ],
    [
        'label'=>'Spoljašnja obrada',
        'content'=>$this->render('form_tabs/_external', ['model'=>$materials['existing'], 'model_new'=>$materials['new'], 'form'=>$form]),
    ],
    [
        'label'=>'Unutrašnja obrada',
        'content'=>$this->render('form_tabs/_interior', ['model'=>$materials['existing'], 'model_new'=>$materials['new'], 'form'=>$form]),
    ],
    [
        'label'=>'Stolarija, bravarija i limarija',
        'content'=>$this->render('form_tabs/_doorwin', ['model'=>$materials['existing'], 'model_new'=>$materials['new'], 'form'=>$form]),
    ],
    [
        'label'=>'Nameštaj i sanitarije',
        'content'=>$this->render('form_tabs/_furniture', ['model'=>$materials['existing'], 'model_new'=>$materials['new'], 'form'=>$form]),
    ],
    [
        'label'=>'Izolacije',
        'content'=>$this->render('form_tabs/_insulations', ['model'=>$insulations['existing'], 'model_new'=>$insulations['new'], 'form'=>$form]),
    ],
    [
        'label'=>'Instalacije',
        'content'=>$this->render('form_tabs/_services', ['model'=>$services['existing'], 'model_new'=>$services['new'], 'form'=>$form]),
    ],
    ];
    
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <?php
                echo kartik\tabs\TabsX::widget([
                    'items'=>$items,
                    'position'=>TabsX::POS_LEFT,
                    'encodeLabels'=>false,
                    'containerOptions'=>[
                        'style' => 'width:100%;min-height:570px;',
                    ],
                ]);
            ?>
        </div>  
    </div>
    <div class="row"">

        <div class="col-md-offset-6">
        	<hr>
            <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj', ['class' => 'btn btn-success btn-lg']) ?>
        </div>        
    </div>
</div>


<?php ActiveForm::end(); ?>

<?php endif; ?>