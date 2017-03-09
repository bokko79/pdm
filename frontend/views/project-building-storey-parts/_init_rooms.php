<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
use kartik\widgets\TouchSpin;
use kartik\select2\Select2;
use softark\duallistbox\DualListbox;

?>

<?php $form = kartik\widgets\ActiveForm::begin([
	'id' => 'form-horizontal',
	'action' => ['/project-building-storey-parts/view', 'id'=>$model->id],
	'type' => ActiveForm::TYPE_VERTICAL,
]); ?>         
    <div>
    	<?php echo $form->field($model, 'room_to_add')->widget(DualListbox::className(),[
	        'items' => ArrayHelper::map(\common\models\RoomTypes::find()->all(), 'id', 'name'),
	        'options' => [
		        'multiple' => true,
		        'size' => 10,
		    ],
		    'id' => 'test'.$model->id,
	        'clientOptions' => [
	            'moveOnSelect' => true,
	            'preserveSelectionOnMove' => false,
	            'selectedListLabel' => 'Izabrane prostorije',
	            'nonSelectedListLabel' => 'Dostupne prostorije',

	        ],
	    ]) ?>		
    
    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton('Sačuvaj', ['class' => 'btn btn-success']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>