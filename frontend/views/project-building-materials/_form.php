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
    'fullSpan' => 12,      
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

    <?= $form->field($model, 'foundation')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'wall_external')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'wall_bearing')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'wall_internal')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'facade')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'flooring')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'ceiling')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'door')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'window')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'tinwork')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'stair')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'woodwork')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'steelwork')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'roof')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'light')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'sanitary')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'electrical')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'plumbing')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'hvac')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'chimney')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'furniture')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'kitchen')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'bathroom')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'lift')->widget(TinyMce::className(), [
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

    <?= $form->field($model, 'roofing')->widget(TinyMce::className(), [
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
        ],
    ]) ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Izmeni', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
