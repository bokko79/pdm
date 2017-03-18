<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
?>
<hr>
<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 7,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

    <?= $form->field($model, 'subwork_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\QsSubworks::find()->all(), 'id', 'fullname'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'action_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\QsActions::find()->all(), 'id', 'action'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>
<?php if($model->isNewRecord): ?>
    <?= $form->field($model, 'act')->textarea(['rows' => 4]) ?>
<?php endif; ?>
    <?= $form->field($model, 'unit')->input('number', ['style'=>'width:40%']) ?>

    <?= $form->field($model, 'price', [
                'addon' => ['prepend' => ['content'=>'€']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'subtext')->textarea(['rows' => 6]) ?>

<hr>
    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Izmeni', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
