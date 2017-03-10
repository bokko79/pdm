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

if($rooms = $model->projectBuildingStoreyPartRooms){
	foreach($rooms as $room){
		$model->room_to_add[] = $room->room_type_id;
	}
}
?>

<?php $form = kartik\widgets\ActiveForm::begin([
	'id' => 'form-horizontal',
	'action' => ['/project-building-storey-parts/view', 'id'=>$model->id],
	'type' => ActiveForm::TYPE_VERTICAL,
]); ?>         

	<div class="row box">
		<div class="col-sm-6">
			<div class="box1">
				<h5>Dostupne prostorije:</h5>
				<hr>
				<ul class="column3" style="">
					<?php foreach(\common\models\RoomTypes::find()->all() as $roomtype){
						echo '<li class="'.$roomtype->id.'" id="'.$roomtype->name.'">'.$roomtype->name.'</li>';
					} ?>
				</ul>
			</div>
		</div>
		<div class="col-sm-6">			
			<div class="box2">
				<h5>Izabrane prostorije:</h5>
				<hr>
				<div class="removeAllButton"><i class="fa fa-refresh"></i> Resetuj</div>
				<?= Html::submitButton('Sačuvaj', ['class' => 'btn btn-success', 'style'=>'float:right; margin-bottom:20px;', 'onclick'=>'(function ( $event ) { $(".form-control option").prop("selected", true); })();']) ?>				
				
				<?php echo $form->field($model, 'room_to_add[]')->dropDownList(($model->projectBuildingStoreyPartRooms) ? ArrayHelper::map(\common\models\ProjectBuildingStoreyPartRooms::find()->where('project_building_storey_part_id='.$model->id)->all(), 'room_type_id', 'name') : [], ['multiple' => true, 'size'=>20,]); ?>
			</div>

		</div>
	</div>		

<?php ActiveForm::end(); ?>