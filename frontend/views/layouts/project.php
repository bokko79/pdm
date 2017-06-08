<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\GeoAsset;
use common\widgets\Alert;
use yii\bootstrap\Modal;

GeoAsset::register($this);

$model = isset($this->params['project']) ? $this->params['project'] : [];
$building = isset($this->params['building']) ? $this->params['building'] : null;
$unit = isset($this->params['part']) ? $this->params['part'] : null;
$user = Yii::$app->user->identity;
?>
<?php $this->beginContent('@frontend/views/layouts/html/html.php'); ?>

<div class="wrap">
    
	<?= $this->render('navbar/_project_navbar') ?>
        
    <div class="container dashboard" style="">
    	<div class="row">           
    		<?= $this->render('partial/breadcrumbs', ['model'=>$model]) ?>
    		
    		<div class="col-sm-12 project-container">   			

                <?= $this->render('dashboard/title', ['model'=>$user]) ?>
    			
        		<div class="card_container record-full grid-item main-card-container" id="" style="">
        			
        			<?php // $this->render('project/title', ['model'=>$model]) ?>

        			<div class="content-row" style="">
                        <?php // $this->render('project/switch_menu', ['model'=>$model]) ?>
                        <?php if($model->setup_status==''): ?>
                        <?= $this->render('header/_projectheader', ['model'=>$model]) ?>
                        <?php else: ?>
                        <?= $this->render('header/_projectheader_setup', ['model'=>$model]) ?>
                        <?php endif; ?>

        				<div class="main-container" style="">        
					    	<div class="main-content" style="">
					        	<?= $content ?>
					        </div>		                    
		                </div>
		            </div>
		        </div> 
		    </div>
        </div>            
    </div>
</div>

<?php
if($building){
  foreach($building->projectBuildingStoreys as $storey){
    if($storey->projectBuildingStoreyParts){
            Modal::begin([
                'id'=>'storey-parts-modal'.$storey->id,
                'size'=>Modal::SIZE_LARGE,
                'class'=>'overlay_modal',
                'header'=> '<h3>Celine/jedinice sprata</h3>',
            ]); ?>
                <div id="loading"><i class="fa fa-cog fa-spin fa-3x gray-color"></i></div>
            <?php Modal::end();
        } else {
            Modal::begin([
                'id'=>'init-storey-parts-modal'.$storey->id,
                'size'=>Modal::SIZE_LARGE,
                'class'=>'overlay_modal',
                'header'=> '<h3>Celine/jedinice sprata</h3>',
            ]); ?>
                <div id="loading"><i class="fa fa-cog fa-spin fa-3x gray-color"></i></div>
            <?php Modal::end();
        } 
    }
}
 ?>  
<?php
if($unit){
    Modal::begin([
        'id'=>'init-rooms-modal'.$unit->id,
        'size'=>Modal::SIZE_LARGE,
        'class'=>'overlay_modal',
        'header'=> '<h3>Prostorije</h3>',
    ]); ?>
        <div id="loading"><i class="fa fa-cog fa-spin fa-3x gray-color"></i></div>
    <?php Modal::end(); 
}
?>

<?php $this->endContent(); // HTML ?>
