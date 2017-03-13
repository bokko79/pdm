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

if(!$model->name){$model->name = $model->storey;}
?>

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 7,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

<hr>
<h3>Osnovni podaci</h3>

    <?= $form->field($model, 'project_building_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\ProjectBuilding::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false, 
            'disabled' => true,         
        ]) ?>    

    <?= $form->field($model, 'storey')->dropDownList([ 'podrum' => 'Podrum', 'suteren' => 'Suteren', 'galerija' => 'Galerija', 'prizemlje' => 'Prizemlje', 'sprat' => 'Sprat', 'povucenisprat' => 'Povucenisprat', 'potkrovlje' => 'Potkrovlje', 'mansarda' => 'Mansarda', 'tavan' => 'Tavan', 'krov' => 'Krov', ], ['prompt' => '', 'disabled' => true,]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<?php if(!$model->sameAs): ?>
<hr>
<h3>Dimenzije</h3>

    <?= $form->field($model, 'gross_area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'height', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%']) ?>
<?php endif; ?>
    <?= $form->field($model, 'level', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%', 'disabled' => $model->storey=='prizemlje' ? true : false]) ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Izmeni', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= (!$model->isNewRecord and !$model->copies and $model->storey!='prizemlje') ? Html::a(Yii::t('app', 'Ukloni'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Da li ste sigurni da želite da obrišete celu etažu, sa svim prostorijama?'),
                    'method' => 'post',
                ],
            ]) : null ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
