<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);

$model = isset($this->params['profile']) ? $this->params['profile'] : [];
?>
<?php $this->beginContent('@frontend/views/layouts/html/html.php'); ?>

<div class="wrap">
    
	<?= $this->render('navbar/_dashboard_navbar') ?>
        
    <div class="container dashboard" style="">
    	<div class="row">  
            <div class="col-sm-12">         
        		<?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'encodeLabels' => false,
                ]) ?>
            </div>
    		<div class="col-sm-12 dashboard-container" style="">
                
    			<?= $this->render('dashboard/title', ['model'=>$model]) ?>

        		<div class="card_container record-full grid-item main-card-container" id="" style="">       			

        			<div class="content-row" style="">

        				<?= $this->render('header/_dashboardheader', ['model'=>$model]) ?>

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
