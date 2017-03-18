<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;
use kartik\widgets\TouchSpin;
use kartik\select2\Select2;

$project_qs = $project->projectQs;
$p = [];
foreach ($project_qs as $pqs) {
	if($pqs->work_id == $work->id){
		$p[] = $pqs->position_id;
	}
}
$model->position_id = $p;
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
<?php $form = kartik\widgets\ActiveForm::begin([
			    'id' => 'form-vertical',
			    'method' => 'post',
			    'action' => '/project-qs/create',
			    'type' => ActiveForm::TYPE_VERTICAL,
			]); ?>
			
<?php if($subworks = $work->qsSubworks){
		foreach($subworks as $subwork){ ?>
			<div class="card_container record-full grid-item no-margin" id="">
				<div class="primary-context gray normal">
					<div class="head thin lower button_to_show_secondary"><?= c($subwork->name) ?> <i class="fa this-one fa-arrow-circle-right"></i>
						<div class="action-area normal-case"></div>
					</div>
				</div>
				<div class="secondary-context none">
				<?php if($positions = $subwork->qsPositions){
						$pos = ArrayHelper::map($positions, 'id', 'name');
						echo $form->field($model, 'position_id')->checkboxList($pos, ['unselect'=>null, 'class'=>'column2 multiselect'])->label(false);	
					} ?>
					<div class="float-right" style="margin:30px;">
			            <?= Html::submitButton(Yii::t('app', '<i class="fa fa-save"></i> Sačuvaj'), ['class' => 'btn btn-success shadow']) ?>
			        </div>
				</div>
			</div>

<?php
		}
		echo yii\helpers\Html::activeHiddenInput($model, 'project_id', ['value'=>$project->id]);
	} ?>
 			<div class="float-right" style="margin:30px;">
	            <?= Html::submitButton(Yii::t('app', '<i class="fa fa-save"></i> Sačuvaj'), ['class' => 'btn btn-success shadow']) ?>
	        </div>
			<?php ActiveForm::end(); ?>         
        </div>
    </div>
</div>