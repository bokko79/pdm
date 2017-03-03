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

    <?= $form->field($model, 'project_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Projects::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false, 
            'disabled' => true,         
        ]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'gradjevinska' => 'Gradjevinska', 'javna' => 'Javna', 'poljoprivredna' => 'Poljoprivredna', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'conditions')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'sm']]) ?>

<hr>
<h4>Dimenzije parcele</h4>
    <?= $form->field($model, 'width', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'length', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'green_area_reg', [
                'addon' => ['prepend' => ['content'=>'%']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%']) ?>
    <?= $form->field($model, 'green_area', [
                'addon' => ['prepend' => ['content'=>'m<sup>2</sup>']]])->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'occupancy_reg', [
                'addon' => ['prepend' => ['content'=>'%']]])->input('number', ['max'=>100, 'min'=>0, 'step'=>0.01, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'built_index_reg')->input('number', ['step'=>0.01, 'min'=>0, 'style'=>'width:40%']) ?>    

    <?= $form->field($model, 'parking_spaces')->input('number', ['min'=>0, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'parking_disabled')->input('number', ['min'=>0, 'style'=>'width:40%']) ?>

<hr>
<h4>Visinske kote</h4>    

    <?= $form->field($model, 'ground_level', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'road_level', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%']) ?>

    <?= $form->field($model, 'underwater_level', [
                'addon' => ['prepend' => ['content'=>'m']]])->input('number', ['step'=>0.01, 'style'=>'width:40%']) ?>

<hr>
<h4>Opis parcele</h4> 
    
    <?= $form->field($model, 'description')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'sr',
        'clientOptions' => [
            'plugins' => [
               "insertdatetime media table contextmenu paste" 
            ],
            'convert_fonts_to_spans' => true,
            'paste_as_text' => true,
            'menubar' => false,
            'statusbar' => false,
            'toolbar' => "undo redo | bold italic | bullist numlist outdent indent"
        ]
    ]) ?>
    
    <?= $form->field($model, 'disposition')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'sr',
        'clientOptions' => [
            'plugins' => [
               "insertdatetime media table contextmenu paste" 
            ],
            'convert_fonts_to_spans' => true,
            'paste_as_text' => true,
            'menubar' => false,
            'statusbar' => false,
            'toolbar' => "undo redo | bold italic | bullist numlist outdent indent"
        ]
    ]) ?>

    <?= $form->field($model, 'ownership')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'sr',
        'clientOptions' => [
            'plugins' => [
               "insertdatetime media table contextmenu paste" 
            ],
            'convert_fonts_to_spans' => true,
            'paste_as_text' => true,
            'menubar' => false,
            'statusbar' => false,
            'toolbar' => "undo redo | bold italic | bullist numlist outdent indent"
        ]
    ]) ?>

    <?= $form->field($model, 'ground')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'sr',
        'clientOptions' => [
            'plugins' => [
               "insertdatetime media table contextmenu paste" 
            ],
            'convert_fonts_to_spans' => true,
            'paste_as_text' => true,
            'menubar' => false,
            'statusbar' => false,
            'toolbar' => "undo redo | bold italic | bullist numlist outdent indent"
        ]
    ]) ?>

    <?= $form->field($model, 'access')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'sr',
        'clientOptions' => [
            'plugins' => [
               "insertdatetime media table contextmenu paste" 
            ],
            'convert_fonts_to_spans' => true,
            'paste_as_text' => true,
            'menubar' => false,
            'statusbar' => false,
            'toolbar' => "undo redo | bold italic | bullist numlist outdent indent"
        ]
    ]) ?>

    <?= $form->field($model, 'parking')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'sr',
        'clientOptions' => [
            'plugins' => [
               "insertdatetime media table contextmenu paste" 
            ],
            'convert_fonts_to_spans' => true,
            'paste_as_text' => true,
            'menubar' => false,
            'statusbar' => false,
            'toolbar' => "undo redo | bold italic | bullist numlist outdent indent"
        ]
    ]) ?>    

    <?= $form->field($model, 'adjacent_border')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'sr',
        'clientOptions' => [
            'plugins' => [
               "insertdatetime media table contextmenu paste" 
            ],
            'convert_fonts_to_spans' => true,
            'paste_as_text' => true,
            'menubar' => false,
            'statusbar' => false,
            'toolbar' => "undo redo | bold italic | bullist numlist outdent indent"
        ]
    ]) ?>

    <?= $form->field($model, 'services')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'sr',
        'clientOptions' => [
            'plugins' => [
               "insertdatetime media table contextmenu paste" 
            ],
            'convert_fonts_to_spans' => true,
            'paste_as_text' => true,
            'menubar' => false,
            'statusbar' => false,
            'toolbar' => "undo redo | bold italic | bullist numlist outdent indent"
        ]
    ]) ?>    

    <?= $form->field($model, 'note')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'sr',
        'clientOptions' => [
            'plugins' => [
               "insertdatetime media table contextmenu paste" 
            ],
            'convert_fonts_to_spans' => true,
            'paste_as_text' => true,
            'menubar' => false,
            'statusbar' => false,
            'toolbar' => "undo redo | bold italic | bullist numlist outdent indent"
        ]
    ]) ?>

    <?= $form->field($model, 'legal')->widget(TinyMce::className(), [
        'options' => ['rows' => 6],
        'language' => 'sr',
        'clientOptions' => [
            'plugins' => [
               "insertdatetime media table contextmenu paste" 
            ],
            'convert_fonts_to_spans' => true,
            'paste_as_text' => true,
            'menubar' => false,
            'statusbar' => false,
            'toolbar' => "undo redo | bold italic | bullist numlist outdent indent"
        ]
    ]) ?>    

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Izmeni', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
