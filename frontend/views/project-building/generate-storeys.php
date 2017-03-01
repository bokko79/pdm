<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;

$this->title = Yii::t('app', 'Generator spratova objekta: ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => $model->building->class, 'url' => ['view', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Generator spratova objekta');
?>

<h1><?= Html::encode($this->title) ?></h1>


<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 7,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

<hr>
<h4>Krovište</h4>
    <?= $form->field($model, 'tavan')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'sm']]) ?>
    <?= $form->field($model, 'mansarda')->input('number', ['style'=>'width:40%']) ?>
    <?= $form->field($model, 'potkrovlje')->input('number', ['style'=>'width:40%']) ?>
<hr>
<h4>Spratovi</h4>
    <?= $form->field($model, 'povucenisprat')->input('number', ['style'=>'width:40%']) ?>
    <?= $form->field($model, 'sprat')->input('number', ['style'=>'width:40%']) ?>
    <?= $form->field($model, 'galerija')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'sm']]) ?>
    
<hr>
<h4>Podzemne etaže</h4>
    <?= $form->field($model, 'suteren')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'sm']]) ?>
    <?= $form->field($model, 'podrum')->input('number', ['style'=>'width:40%']) ?>
    
    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton('Generiši spratove objekta', ['class' => 'btn btn-success']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
