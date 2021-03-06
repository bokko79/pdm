<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
?>
<div class="table-responsive container-fluid">
    <div class="row">       
        <div class="col-sm-12">
            <p class="bg-info" style="padding:20px;"><?= Html::a(c($model->storey), ['/project-building/storeys', 'id' => $model->id]) ?> ne sadrži nijednu celinu/jedinicu. Izaberite koje celine sadrži.</p>
            <?php $form = kartik\widgets\ActiveForm::begin([
                'id' => 'form-horizontal',
                'type' => ActiveForm::TYPE_HORIZONTAL,
                'action' => ['/project-building-storeys/generate-parts', 'id'=>$model->id],
                'fullSpan' => 7,      
                'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
                'options' => ['enctype' => 'multipart/form-data'],
            ]); ?>


                <?= $form->field($model, 'stan')->input('number', ['min'=>0, 'max'=>16, 'style'=>'width:40%'])->hint('Unesite broj stambenih jedinica, npr. apartmana, stanova, hotelskih soba, koje ova etaža ima.') ?>

                <?= $form->field($model, 'biz')->input('number', ['min'=>0, 'max'=>16, 'style'=>'width:40%'])->hint('Unesite broj poslovnih jedinica, npr. lokala, kancelarija, restorana, ordinacija, učionica itd, koje ova etaža ima.') ?>


                <?= $form->field($model, 'whole')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'md']]) ?>
<?php /*
                <?= $form->field($model, 'posl')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'md']]) ?>

                <?= $form->field($model, 'common')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'md']]) ?>

                <?= $form->field($model, 'garage')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'md']]) ?>

                <?= $form->field($model, 'tech')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'md']]) ?>

                <?= $form->field($model, 'external')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'md']]) ?> 
 */ ?>               
                <div class="row" style="margin:20px;">
                    <div class="col-md-offset-3">
                        <?= Html::submitButton('Generiši', ['class' => 'btn btn-primary']) ?>
                    </div>        
                </div>


            <?php ActiveForm::end(); ?>
        </div>        
    </div>            
</div>
