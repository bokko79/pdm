<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\PostsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-search" style="margin:0 0 20px 0">

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_INLINE,
    'fullSpan' => 12,      
    //'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    //'options' => ['enctype' => 'multipart/form-data'],
    //'enableAjaxValidation' => true,
    'enableClientValidation' => true,
    'action' => ['index'],
        'method' => 'get',
]); ?>


    <?php // $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(\common\models\PostCategories::find()->all(), 'id', 'category'), ['prompt' => 'Kategorija']) ?>

    <?php  echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'subtitle') ?>

    <?php  echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'excerpt') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'comment_status') ?>

    <?php // echo $form->field($model, 'next_post') ?>

    <?php // echo $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Traži'), ['class' => 'btn btn-primary shadow']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default shadow']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
