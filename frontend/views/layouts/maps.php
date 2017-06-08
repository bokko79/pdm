<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\GeoAsset;
use common\widgets\Alert;

GeoAsset::register($this);

$model = isset($this->params['project']) ? $this->params['project'] : [];
$user = Yii::$app->user->identity;
?>
<?php $this->beginContent('@frontend/views/layouts/html/html_maps.php'); ?>

<div class="wrap">

    <?= $this->render('navbar/_project_navbar') ?>
        
    <div class="container dashboard" style="">
    	<div class="row">           
    		<?= $this->render('partial/breadcrumbs', ['model'=>$model]) ?>
    		
    		<div class="col-sm-12 project-container" style="">
            
                <?= $this->render('dashboard/title', ['model'=>$user]) ?>
    			
        		<div class="card_container record-full grid-item main-card-container" id="" style="">        			

        			<div class="content-row" style="">

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

<?php $this->endContent(); // HTML ?>
