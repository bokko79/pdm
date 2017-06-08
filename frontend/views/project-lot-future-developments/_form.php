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
?>

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 10,      
    'formConfig' => ['labelSpan' => 4, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

    <?php /* $form->field($model, 'project_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Projects::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false, 
            'disabled' => true,         
        ]) */ ?>

    <?= $form->field($model, 'building_type_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\BuildingTypes::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textArea(['rows' => 6]) ?>

    <div class="row" style="margin:20px 0;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Sačuvaj izmene', ['class' => !$model->isNewRecord ? 'btn btn-success shadow' : 'btn btn-block btn-primary shadow']) ?>
            <?= (!$model->isNewRecord) ? Html::a(Yii::t('app', 'Ukloni'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Da li želite da ukonite predviđeni objekat na parceli?'),
                    'method' => 'post',
                ],
            ]) : null ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>


<?php if($project->setup_status=='future_devs'): ?>

    <?php $form = kartik\widgets\ActiveForm::begin([
        'id' => 'step-form',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'fullSpan' => 10,      
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>

        <div class="row" style="margin:50px 0 0;">
            
            <div class="col-md-offset-6 col-md-6">
                <p>Kada završite unos predviđenih objekata na parceli, pređite na sledeći korak. Ukoliko ih nema, odmah pređite na sledeći korak.</p>
                <?= Html::submitButton('Sledeći korak <i class="fa fa-arrow-right fa-lg"></i>', ['class' => 'btn btn-success shadow btn-block btn-lg', 'name' => 'step_form', 'value' => 'next_step']) ?>
            </div>            
        </div>
    <?php ActiveForm::end(); ?>
<?php endif; ?>
