<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
use kartik\widgets\DepDrop;

$model->code = $model->code ?: $model->project->code;
/*$model->practice_id = $model->practice_id ?: $model->project->practice_id;
$model->engineer_id = $model->engineer_id ?: $model->project->engineer_id;
$model->control_practice_id = $model->control_practice_id ?: $model->project->control_practice_id;
$model->control_engineer_id = $model->control_engineer_id ?: $model->project->control_engineer_id;*/
?>

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 10,      
    'formConfig' => ['labelSpan' => 4, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data', 'style'=>'margin-top:0px !important;'],
]); ?>

<h6 class="col-md-offset-4">Osnovni podaci</h6>
<hr>
    <?php /* $form->field($model, 'project_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Projects::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,       
            'disabled' => true,    
        ]) */ ?>

    <?= $form->field($model, 'volume_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Volumes::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

<hr>
<h6 class="col-md-offset-4">Projektant</h6>
<hr>
    <?= $form->field($model, 'practice_id')->widget(Select2::classname(), [
            //'data' => ArrayHelper::map(\common\models\PracticeEngineers::find()->innerJoin('practices as p')->where('practice_engineers.engineer_id='.Yii::$app->user->id.' and status="joined"')->all(), 'practice.engineer_id', 'practice.name'),
            'data' => ArrayHelper::map(Yii::$app->user->practice->availablePractices, 'engineer_id', 'name'),
            'options' => ['placeholder' => 'Izaberite...', 'id'=>'cat-id'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,
            'pluginOptions'=>['allowClear'=>true],
        ])->hint($model->hintPractice) ?>

    <?php /* $form->field($model, 'engineer_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Engineers::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint($model->hintEngineer) */ ?>

    <?= $form->field($model, 'engineer_licence_id')->widget(DepDrop::classname(), [
                'data'=> ($model->isNewRecord) ? [] : [$model->engineer_id=>$model->engineer->name],
                'options'=>['id'=>'subcat-id'],
                'pluginOptions'=>[
                    'depends'=>['cat-id'],
                    'placeholder'=>'Izaberi...',
                    'url'=>Url::to(['/project-volumes/engineers'])
                ]
            ])->hint($model->hintEngineer) ?>

    <?php /* $form->field($model, 'engineer_licence_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\EngineerLicences::find()->all(), 'id', 'fullname'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint($model->hintEngineer) */ ?>
<?php 
    if($model->volume and $model->project->type=='project' and $model->project->phase=='pgd'){
        if ($model->volume->type=='projekat' and $model->volume_id!=1) { ?>
<hr>
<h6 class="col-md-offset-4">Tehnička kontrola</h6>
<hr>
    <?= $form->field($model, 'control_practice_id')->widget(Select2::classname(), [
            //'data' => ArrayHelper::map(\common\models\PracticeEngineers::find()->innerJoin('practices as p')->where('practice_engineers.engineer_id='.Yii::$app->user->id.' and status="joined"')->all(), 'practice.engineer_id', 'practice.name'),
            'data' => ArrayHelper::map(Yii::$app->user->practice->availablePractices, 'engineer_id', 'name'),
            'options' => ['placeholder' => 'Izaberite...', 'id'=>'catcont-id'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint($model->hintControlPractice) ?>

    <?php /* $form->field($model, 'control_engineer_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Engineers::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint($model->hintControlEngineer) */ ?>  

    <?= $form->field($model, 'control_engineer_licence_id')->widget(DepDrop::classname(), [
                'data'=> ($model->isNewRecord) ? [] : ($model->control_engineer_licence_id ? [$model->control_engineer_licence_id=>$model->controlEngineer->name] : []),
                'options'=>['id'=>'subcatcont-id'],
                'pluginOptions'=>[
                    'depends'=>['catcont-id'],
                    'placeholder'=>'Izaberi...',
                    'url'=>Url::to(['/project-volumes/control-engineers'])
                ]
            ])->hint($model->hintEngineer) ?>

    <?php /* $form->field($model, 'control_engineer_licence_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\EngineerLicences::find()->all(), 'id', 'fullname'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint($model->hintEngineer) */ ?>  

    <?php // $form->field($model, 'control_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'control_text')->textArea(['rows' => 6])->hint('Rezime izveštaja o tehničkoj kontroli, izrađen od strane vršioca tehničke kontrole ') ?>
<?php }
} ?>

    <div class="row" style="margin:20px 0;">
        <div class="col-md-offset-4 col-md-6">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Sačuvaj izmene', ['class' => !$model->isNewRecord ? 'btn btn-success shadow' : 'btn btn-block btn-primary shadow']) ?>
            <?= (!$model->isNewRecord) ? Html::a(Yii::t('app', 'Ukloni'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Da li želite da ukonite svesku?'),
                    'method' => 'post',
                ],
            ]) : null ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>