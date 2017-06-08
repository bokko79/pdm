<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
use kartik\checkbox\CheckboxX;
?>

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 10,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>


    <?php /* $form->field($model, 'project_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Projects::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false, 
            'disabled' => true,         
        ]) */ ?>

    <?= $form->field($model, 'client_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Clients::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,         
        ])->hint($model->hintClient) ?>

    <?php // $form->field($model, 'status')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'sm']]) ?>

    <div class="row" style="margin:20px 0;">
        <div class="col-md-offset-3 col-md-7">
            <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus fa-lg"></i> Dodaj investitora' : '<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => !$model->isNewRecord ? 'btn btn-success shadow' : 'btn btn-primary btn-block shadow']) ?>
            <?php if(count($project->projectClients)>1): ?>
            <?= (!$model->isNewRecord) ? Html::a(Yii::t('app', '<i class="fa fa-times"></i> Ukloni'), ['delete', 'id' => $model->id], [
	            'class' => 'btn btn-danger',
	            'data' => [
	                'confirm' => Yii::t('app', 'Da li ste sigurni da želite da uklonite ovog investitora sa projekta? Postupak ne može biti vraćen.'),
	                'method' => 'post',
	            ],
	        ]) : null ?>
            <?php endif; ?>
        </div>        
    </div>
<?php ActiveForm::end(); ?>

<?php if($project->setup_status=='clients' and $project->projectClients): ?>

    <?php $form = kartik\widgets\ActiveForm::begin([
        'id' => 'step-form',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'fullSpan' => 10,      
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

        <div class="row" style="margin:50px 0 0;">
            
            <div class="col-md-offset-6 col-md-6">
                <p>Kada završite unos investitora, pređite na sledeći korak.</p>
                <?= Html::submitButton('Sledeći korak <i class="fa fa-arrow-right fa-lg"></i>', ['class' => 'btn btn-success shadow btn-block btn-lg', 'name' => 'step_form', 'value' => 'next_step']) ?>
            </div>            
        </div>
    <?php ActiveForm::end(); ?>
    
<?php endif; ?>

