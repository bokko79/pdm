<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\ListView;
use common\widgets\Alert;
use yii\bootstrap\Nav;
use yii\widgets\ActiveForm;
use kartik\tabs\TabsX;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;

/* @var $this yii\web\View */
/* @var $model common\models\Projects */

$title = $model->code. ': '.\yii\helpers\StringHelper::truncate($model->name, 50) . ($model->work!='adaptacija' ? ' ('.(($model->projectBuilding) ? $model->projectBuilding->spratnost : $model->projectExBuilding->spratnost).')' : null);

$this->params['page_title'] = 'Summary';

$this->title = Yii::t('app', 'Rezime projekta: ') . $title;

$this->params['breadcrumbs'][] = ['label' => '<i class="fa fa-bars"></i> Rezime projekta', 'url' => null];
  
$this->params['project'] = $model;

$formatter = \Yii::$app->formatter;


$building = $model->projectBuilding ? $model->projectBuilding : $model->projectExBuilding;


?>
<div class="card_container record-full grid-item fadeInUp no-shadow animated-not" id="" style="">

    	<?php // projekat ?>
			<div class="primary-context gray bottom-bordered normal" style="">
		        <div class="head colos">
					<div class="subaction">
							<?= Html::a('<i class="fa fa-cogs fa-3x"></i>', Url::to(['/projects/update', 'id'=>$model->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>                   
			            </div>                
		            Rezime projekta		          
				</div>					
			</div>
			
		</div>

<div class="container-fluid full">
	<div class="row">	

  		<div class="col-sm-7" style="">   	

    		<div class="card_container record-full grid-item fadeInUp no-shadow transparent animated-not" id="" style="">
    			<?php // Client ?>			
				<div class="secondary-context cont">
					<div class="head lower regular">
						<div class="subhead uppercase hint" style="margin-bottom: 5px;">
	          			<?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
	            			<div class="subaction">
	              				<?= Html::a('<i class="fa fa-plus fa-lg"></i>', Url::to(['/project-clients/create', 'ProjectClients[project_id]'=>$model->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>                   
	            			</div>
	          			<?php endif; ?>
	          			Investitor/i
	          			</div>
	          			<?php if($projectClients = $model->projectClients){
	            			foreach($projectClients as $projectClient)
	            			{
	              				$client = $projectClient->client;
	              				echo '<div style="padding-top:5px;">'.((\Yii::$app->user->can('updateOwnProject', ['project'=>$model])) ? Html::a($client->name, Url::to(['/project-clients/update', 'id'=>$projectClient->id]), ['class' => '', 'style'=>'color:;']) : $client->name) . ', <small class="hint" style="font-size:70%">'.$client->location->city->town. '</small></div>';
	            			}
	          			} ?>

	        		</div>              
	      		</div>

	    		<?php // lokacija ?>	      		
				<div class="secondary-context">
					<div class="head second regular">
						<div class="subhead uppercase hint" style="margin-bottom: 5px;">Lokacija i parcela

						<?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
					    	<div class="subaction">
					      		<?= Html::a('<i class="fa fa-ellipsis-v fa-lg"></i>', Url::to(['/project-lot/location', 'id'=>$model->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>                   
				    		</div>
					  	<?php endif; ?>
					  	</div>

					  	<?= $model->location->getLotAddress(true) ?>
					</div>
				</div>




	      	<?php // Objekat postojeće stanje ?>
	      	<?php if($ExBuilding = $model->projectExBuilding): ?>
	      		<div class="secondary-context gray">
					<div class="head">
						<div class="subhead uppercase hint" style="margin-bottom: 5px;">Objekat - postojeće stanje
							<?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
							<div class="subaction">
								<?= Html::a('<i class="fa fa-ellipsis-v fa-lg"></i>', Url::to(['/project-building/view', 'id'=>$ExBuilding->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>                   
							</div>  
							<?php endif; ?>
						</div>                  
						<?= (\Yii::$app->user->can('updateOwnProject', ['project'=>$model])) ? Html::a($ExBuilding->name. ' ' .$ExBuilding->storey, Url::to(['/project-building/view', 'id'=>$ExBuilding->id]), ['class' => '']) : $ExBuilding->name. ' ' .$ExBuilding->storey ?>
						<p>Klasa: <?= $model->building->fullClass ?> | tip: <?= $ExBuilding->type ?></p>
					</div>              
				</div>

				<hr style="margin:0">

				<div class="secondary-context">
					<table class="table-hover">

						<tr>
							<th class="" style="padding:0px 10px; font-size: 90%; width:40%">Neto površina:</th><td><?= $ExBuilding->netArea ?> m<sup>2</sup></td>
						</tr>
						<tr>
							<th class="" style="padding:0px 10px; font-size: 90%">Bruto površina:</th><td><?= $ExBuilding->grossArea ?> m<sup>2</sup></td>
						</tr>
						<tr>
							<th class="" style="padding:0px 10px; font-size: 90%">Broj stanova:</th><td><?= $ExBuilding->brStanova ?></td>
						</tr>
						<tr>
							<th class="" style="padding:0px 10px; font-size: 90%">Broj poslovnih prostora:</th><td><?= $ExBuilding->brPoslProstora ?></td>
						</tr>
					</table>
				</div>

				<hr style="margin:0">

				<div class="secondary-context gray">
					<div class="head">
						<div class="subhead uppercase hint" style="margin-bottom: 5px;">Spratnost postojećeg objekta
							<?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
							<div class="subaction">
								<?= Html::a('<i class="fa fa-ellipsis-v fa-lg"></i>', Url::to(['/project-building/view', 'id'=>$ExBuilding->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>                   
							</div>  
							<?php endif; ?>
						</div>                  
						<?= $ExBuilding->spratnost ?>
					</div>              
				</div>

				<hr style="margin:0">
	      	<?php endif; ?>

	      	<?php // Objekat postojeće stanje ?>
	      	<?php if($NewBuilding = $model->projectBuilding): ?>
	      		<div class="secondary-context gray">
					<div class="head">
						<div class="subhead uppercase hint" style="margin-bottom: 5px;">Objekat - predviđeno stanje
							<?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
							<div class="subaction">
								<?= Html::a('<i class="fa fa-ellipsis-v fa-lg"></i>', Url::to(['/project-building/view', 'id'=>$NewBuilding->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>                   
							</div>  
							<?php endif; ?>
						</div>                  
						<?= (\Yii::$app->user->can('updateOwnProject', ['project'=>$model])) ? Html::a($NewBuilding->name. ' ' .$NewBuilding->storey, Url::to(['/project-building/view', 'id'=>$NewBuilding->id]), ['class' => '']) : $NewBuilding->name. ' ' .$NewBuilding->storey ?>
						<p>Klasa: <?= $model->building->fullClass ?> | tip: <?= $NewBuilding->type ?></p>
					</div>              
				</div>

				<hr style="margin:0">

				<div class="secondary-context">
					<table class="table-hover">

						<tr>
							<th class="" style="padding:0px 10px; font-size: 90%; width:40%">Neto površina:</th><td><?= $NewBuilding->netArea ?> m<sup>2</sup></td>
						</tr>
						<tr>
							<th class="" style="padding:0px 10px; font-size: 90%">Bruto površina:</th><td><?= $NewBuilding->grossArea ?> m<sup>2</sup></td>
						</tr>
						<tr>
							<th class="" style="padding:0px 10px; font-size: 90%">Broj stanova:</th><td><?= $NewBuilding->brStanova ?></td>
						</tr>
						<tr>
							<th class="" style="padding:0px 10px; font-size: 90%">Broj poslovnih prostora:</th><td><?= $NewBuilding->brPoslProstora ?></td>
						</tr>
					</table>
				</div>

				<hr style="margin:0">

				<div class="secondary-context gray">
					<div class="head">
						<div class="subhead uppercase hint" style="margin-bottom: 5px;">Spratnost predviđenog objekta
							<?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
							<div class="subaction">
								<?= Html::a('<i class="fa fa-ellipsis-v fa-lg"></i>', Url::to(['/project-building/view', 'id'=>$NewBuilding->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>                   
							</div>  
							<?php endif; ?>
						</div>                  
						<?= $NewBuilding->spratnost ?>
					</div>              
				</div>

				<hr style="margin:0">
	      	<?php endif; ?>
				

			<?php if($stanovi = $building->stanovi): ?>
			<?php // Jedinice ?>
				<div class="secondary-context ">
					<div class="head">
						<div class="subhead uppercase hint" style="margin-bottom: 5px;">Nekretnine objekta
							<?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
							<div class="subaction">
								<?= Html::a('<i class="fa fa-ellipsis-v fa-lg"></i>', Url::to(['/project-building-storeys/index', 'id'=>$model->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>                   
							</div>  
							<?php endif; ?>
						</div>                  
					</div>
				<?php 
					foreach($stanovi as $stan)
						{ ?>
							<div class="header-context">
								<div class="avatar round">
					                <i class="fa fa-home fa-3x gray-color"></i>       
					            </div>
					            <div class="subaction">
					                <?= Html::a('<i class="fa fa-ellipsis-v fa-lg"></i>', ['/project-building-storey-parts/view', 'id'=>$stan->id], ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>
					            </div>
					            <div class="title" style="float:none; margin-left: 32px; ">
					                <div class="head second"><?= Html::a($stan->name.' '.$stan->mark, Url::to(['/project-building-storey-parts/view', 'id'=>$stan->id]), ['class' => '']) ?></div>
					                <div class="subhead"><?= $stan->structure ?> | <?= $stan->netArea ?> m<sup>2</sup></div> 
					            </div>
					        </div>
						<?php 		
					
						} ?>             
				</div>
			<?php endif; ?>	
    		</div>     
      	</div>

      	<div class="col-sm-5">

      		<?= Html::a(Yii::t('app', '<i class="fa fa-image"></i> Prezentacija projekta'), ['/projects/view', 'id'=>$model->id], ['class' => 'btn btn-danger btn-block']) ?>

	      	<div class="card_container record-full grid-item fadeInUp bordered animated-not" id="" style="margin-top:20px;">

	    	<?php // sveske ?>    
	      		<div class="secondary-context">
					<div class="head thin lower">
						<div class="subhead uppercase hint">Sveske projekta
							<div class="subaction">
								<?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
								<?= Html::a('<i class="fa fa-ellipsis-v fa-lg"></i>', Url::to(['/project-volumes/index', 'ProjectVolumes[project_id]'=>$model->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>
								<?php endif; ?>
							</div>                    
						</div>
					</div> 
				</div>
					<?php if($projectVolumes = $model->projectVolumes){
						foreach($projectVolumes as $projectVolume)
						{ 
							if($projectVolume->volume_id==1) { 
							    $sveska = 'glavna-sveska'; 
							  } elseif($projectVolume->volume_id==17) { 
							    $sveska = 'izvod'; 
							  } elseif($projectVolume->volume_id==19) { 
							    $sveska =  'ozakonjenje'; 
							  } else { 
							    $sveska = 'projekat'; 
							  }  ?>
							<div class="header-context cont">
								<div class="avatar ">
					                <i class="fa fa-file-pdf-o fa-3x gray-color"></i>       
					            </div>
					            <div class="subaction">
					            	<?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
					                <?= Html::a('<i class="fa fa-download fa-2x"></i>', ['/site/'.$sveska, 'id'=>$model->id, 'volume'=>$projectVolume->id], ['class' => 'btn btn-link', 'style' => 'color:#999', 'target'=>'_blank']) ?>
					                <?php else: ?>
					                <?= Html::a('<i class="fa fa-download  fa-2x"></i>', Url::to(), ['data-toggle'=>'modal', 'data-backdrop'=>false,  'data-target'=>'#secret-code', 'class' => 'btn btn-link', 'style' => 'color:#999']) ?>
					            	<?php endif; ?>
					            </div>
					            <div class="title" style="float:none; margin-left: 32px; ">
					                <div class="head second regular"><?= (\Yii::$app->user->can('updateOwnProject', ['project'=>$model])) ? Html::a($projectVolume->number.'. '.$projectVolume->name, Url::to(['/project-volumes/view', 'id'=>$projectVolume->id]), ['class' => '']) : $projectVolume->number.'. '.$projectVolume->name ?></div>
					                <div class="subhead"><?= $projectVolume->engineer->name ?></div> 
					            </div>
					        </div>
					<?php
						}
					} ?>  
			</div>           
				
			<div class="card_container record-full grid-item fadeInUp bordered animated-not" id="" style="">

	    	<?php // sveske ?>    
	      		<div class="secondary-context">
					<div class="head thin second">
						<div class="subhead uppercase hint">Predmer i predračun radova
							<div class="subaction">
								<?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
								<?= Html::a('<i class="fa fa-ellipsis-v fa-lg"></i>', Url::to(['/project-qs/index', 'ProjectQs[project_id]'=>$model->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>                   
								<?php endif; ?>
							</div>                    
						</div>
					</div>
				</div> 
				<?php if($model->projectQs){ ?>
						<div class="header-context cont">
							<div class="avatar">
				                <i class="fa fa-file-pdf-o fa-3x gray-color"></i>       
				            </div>
				            <div class="subaction">
				                <?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
				                <?= Html::a('<i class="fa fa-download fa-2x"></i>', ['/site/predmer', 'id'=>$model->id], ['class' => 'btn btn-link', 'style' => 'color:#999', 'target'=>'_blank']) ?>
				            	<?php else: ?>
					                <?= Html::a('<i class="fa fa-download fa-2x"></i>', Url::to(), ['data-toggle'=>'modal', 'data-backdrop'=>false,  'data-target'=>'#secret-code', 'class' => 'btn btn-link', 'style' => 'color:#999']) ?>
					            	<?php endif; ?>
				            </div>
				            <div class="title" style="float:none; margin-left: 32px; ">
				                <div class="head second regular"><?= (\Yii::$app->user->can('updateOwnProject', ['project'=>$model])) ? Html::a('Predmer radova projekta', Url::to(['/project-qs/index', 'ProjectQs[project_id]'=>$model->id]), ['class' => '']) : 'Predmer radova projekta' ?></div>
				                <div class="subhead"><?= $formatter->format($model->getProjectTotalPrice(), ['decimal',2]) ?></div>
				            </div>
				        </div>
					
				<?php } ?>          
				

			</div>

			<?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
			<div class="card_container record-full grid-item fadeInUp bordered animated-not" id="" style="">

				<div class="secondary-context">
					<div class="head thin second">
						<div class="subhead uppercase hint">Dokumenti projekta             
							<div class="subaction">
								<?= Html::a('<i class="fa fa-plus fa-lg"></i>', Url::to(['/project-files/create', 'ProjectFiles[project_id]'=>$model->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>                   
							</div>
						</div> 
					</div>
				</div>

				<?php if($projectFiles = $model->projectFiles){
					foreach($projectFiles as $projectFile)
					{
						if($projectFile->type!='drugo')
						{ ?>
							<div class="header-context cont">
								<div class="avatar ">
					                <i class="fa fa-file-pdf-o fa-3x gray-color"></i>       
					            </div>
					            <div class="subaction">
					                <?= Html::a('<i class="fa fa-download fa-2x"></i>', ['/site/download', 'path'=>'/images/projects/'.$model->year.'/'.$model->id.'/'.$projectFile->file->name], ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>
					            </div>
					            <div class="title" style="float:none; margin-left: 32px; ">
					                <div class="head second regular"><?= Html::a(\yii\helpers\StringHelper::truncate($projectFile->name, 32), Url::to(['/project-files/update', 'id'=>$projectFile->id]), ['class' => '']) ?></div>
					                <div class="subhead"><?= $projectFile->document ?></div> 
					            </div>
					        </div>
					<?php
						} 		
				
					} 				
					
				} else {
					echo '<div class="secondary-context cont">Ovaj projekat nema prikačenih dokumenata.</div>';
				} ?>
				
    		</div>     
    		
  			<?php endif; ?>
  		</div>

	</div>
</div>


