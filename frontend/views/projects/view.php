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

$this->title = \yii\helpers\StringHelper::truncate($model->name, 50) . ($model->work!='adaptacija' ? ' ('.(($model->projectBuilding) ? $model->projectBuilding->spratnost : $model->projectExBuilding->spratnost).')' : null);

if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])){
  $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Moji projekti'), 'url' => ['/user/security/home']];
  //$this->params['breadcrumbs'][] = $model->code. ': '.$this->title;
  //$this->params['breadcrumbs'][] = $this->title;
} else {
  $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projekti'), 'url' => ['index']];
  //$this->params['breadcrumbs'][] = $this->title;
}
  
$this->params['project'] = $model;

$formatter = \Yii::$app->formatter;


/*
$items = [    
    [
        'label'=>'Opšti podaci',
        'content'=>$this->render('tabs/_general', ['model'=>$model]),
        'active'=>true
    ],    
    [
        'label'=>'Investitori',
        'content'=>$this->render('tabs/_clients', ['model'=>$model]),
    ],
    [
        'label'=>'Dokumenti i podloge',
        'content'=>$this->render('tabs/_docs', ['model'=>$model]),
    ],
    [
        'label'=>'<i class="fa fa-envelope-o"></i> Poruke',
        'content'=>$this->render('tabs/_todo', ['model'=>$model]),
    ],
    /*[
        'label'=>'Tehnička dokumentacija',
        'content'=>$this->render('tabs/_volumes', ['model'=>$model]),
    ],
];*/

$building = $model->projectBuilding ? $model->projectBuilding : $model->projectExBuilding;

$coord = new LatLng(['lat' => $model->location->lat, 'lng' => $model->location->lng]);
$map = new Map([
    'center' => $coord,
    'zoom' => 15,
    
]);

$map->width = '100%';
$map->height = '400';


// Lets add a marker now
$marker = new Marker([
    'position' => $coord,
    'title' => 'My Home Town',
]);
// Add marker to the map
$map->addOverlay($marker);
?>

	<div class="row">

		<div class="col-sm-6">
			<div class="card_container record-full grid-item fadeInUp bordered animated-not" id="" style="float: none;">
			<?php if($model->slike): ?>
      		
	        	<div class="secondary-context no-padding">
				    <?php 
				        $fotorama = \metalguardian\fotorama\Fotorama::begin(
				          [
				            'options' => [
				                'loop' => true,
				                'hash' => true,
				                'allowfullscreen' => true,
				                'width' => '100%',
				                'minwidth' => '400',
				                'maxwidth' => '570',
				                'minheight' => '240',
				                'maxheight' => '100%',
				                //'height' => '456',
				                'ratio' => 1.25/1,
				                'nav' => false,
				                //'fit' => 'cover',
				            ],
				            //'tagName' => 'span',
				            'useHtmlData' => false,
				            'htmlOptions' => [
				                'style'=>'',
				                'class'=>'card-width-cover'
				            ],
				          ]
				        );  ?>
				        <?php foreach ($model->projectImages as $media): ?>
				            <?= $media->file->type=='jpg' ? Html::img('@web/images/projects/'.$model->year.'/'.$model->id.'/'.$media->file->name) : null ?>
				        <?php endforeach; ?>
				        <?php $fotorama->end(); ?>
				</div>

			<?php else: ?>
				<?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>


	        	<div class="secondary-context">
	        		<div class="head thin lower">
						<div class="subhead uppercase hint">Galerija projekta
							<div class="subaction">
								<?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
								<?= Html::a('<i class="fa fa-ellipsis-v"></i>', Url::to(['/project-files/create', 'ProjectFiles[project_id]'=>$model->id, 'ProjectFiles[type]'=>'drugo']), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>
								<?php endif; ?>
							</div>                    
						</div>
					</div>
	        		<p>Ovaj projekat trenutno nema nijednu sliku/fotografiju/render u galeriji.</p>
	        		<p><?= Html::a('<i class="fa fa-image"></i> Uredite galeriju projekta, postavite slike.', Url::to(['/project-files/create', 'ProjectFiles[project_id]'=>$model->id, 'ProjectFiles[type]'=>'drugo']), ['class' => '', 'style' => '']) ?></p>
				</div>
			


				<?php endif; ?>
			<?php endif; ?>
				<div class="secondary-context">
					<div class="head second regular">
						<div class="subhead uppercase hint" style="margin-bottom: 5px;">Lokacija

						<?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
					    	<div class="subaction">
					      		<?= Html::a('<i class="fa fa-ellipsis-v"></i>', Url::to(['/project-lot/location', 'id'=>$model->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>                   
				    		</div>
					  	<?php endif; ?>
					  	</div>

					  	<?= $model->location->getLotAddress(true) ?>
					</div>
				</div>
				<div class="secondary-context cont no-padding">
					<div class="media-screen no-margin" id="gmap0-map-canvas">                   
						<?php $map->display() ?>
					</div>
				</div>
			</div>

	      	<div class="card_container record-full grid-item fadeInUp bordered animated-not" id="" style="">

	    	<?php // sveske ?>    
	      		<div class="secondary-context">
					<div class="head thin lower">
						<div class="subhead uppercase hint">Sveske projekta
							<div class="subaction">
								<?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
								<?= Html::a('<i class="fa fa-ellipsis-v"></i>', Url::to(['/project-volumes/index', 'ProjectVolumes[project_id]'=>$model->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>
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
					                <?= Html::a('<i class="fa fa-download"></i>', ['/site/'.$sveska, 'id'=>$model->id, 'volume'=>$projectVolume->id], ['class' => 'btn btn-link', 'style' => 'color:#999', 'target'=>'_blank']) ?>
					                <?php else: ?>
					                <?= Html::a('<i class="fa fa-download"></i>', Url::to(), ['data-toggle'=>'modal', 'data-backdrop'=>false,  'data-target'=>'#secret-code', 'class' => 'btn btn-link', 'style' => 'color:#999']) ?>
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
				
				<hr style="margin:0">

	    	<?php // sveske ?>    
	      		<div class="secondary-context">
					<div class="head thin second">
						<div class="subhead uppercase hint">Predmer i predračun radova
							<div class="subaction">
								<?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
								<?= Html::a('<i class="fa fa-ellipsis-v"></i>', Url::to(['/project-qs/index', 'ProjectQs[project_id]'=>$model->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>                   
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
				                <?= Html::a('<i class="fa fa-download"></i>', ['/site/predmer', 'id'=>$model->id], ['class' => 'btn btn-link', 'style' => 'color:#999', 'target'=>'_blank']) ?>
				            	<?php else: ?>
					                <?= Html::a('<i class="fa fa-download"></i>', Url::to(), ['data-toggle'=>'modal', 'data-backdrop'=>false,  'data-target'=>'#secret-code', 'class' => 'btn btn-link', 'style' => 'color:#999']) ?>
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
								<?= Html::a('<i class="fa fa-plus-circle"></i>', Url::to(['/project-files/create', 'ProjectFiles[project_id]'=>$model->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>                   
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
					                <?= Html::a('<i class="fa fa-download"></i>', ['/site/download', 'path'=>'/images/projects/'.$model->year.'/'.$model->id.'/'.$projectFile->file->name], ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>
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



  		<div class="col-sm-6" style="">   	

    		<div class="card_container record-full grid-item fadeInUp bordered animated-not" id="" style="">

	    	<?php // projekat ?>
				<div class="secondary-context aliceblue" style="">
			        <div class="head colos">
						<div class="subhead uppercase hint" style="margin-bottom: 5px;">Projekat
						<?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
				            <div class="subaction">
								<?= Html::a('<i class="fa fa-cogs fa-2x"></i>', Url::to(['/projects/update', 'id'=>$model->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>                   
				            </div> 
						<?php endif; ?>
						</div>
						<div class="subhead" style="margin-bottom:10px;">
							<div class="label label-default fs_12 regular"><?= ($model->type=='project' ? $model->code : '') ?></div>
                                <div class="label label-<?= $model->status=='active' ? 'success' : 'danger' ?> fs_12 regular"><?= $model->status=='active' ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>' ?></div>
                                <div class="label label-<?= $model->visible ? 'success' : 'default' ?> fs_12 regular"><?= $model->visible ? '<i class="fa fa-eye"></i>' : '<i class="fa fa-eye-slash"></i>' ?></div>							
						</div>                  
			            <?= $model->name ?>	
			            <div class="subhead"><?= $model->projectTypeOfWorks ?><?= ($model->type=='project') ? ' | faza: '. $model->projectPhase : null ?></div>			          
					</div>
					<div class="row" style="margin:16px 0 0; font-size: 105%; font-weight: ">
		            	<div class="col-xs-4 center">
		            		<i class="fa fa-clone fa-lg gray-color"></i><br><?= $building->grossArea ?> m<sup>2</sup>
		            	</div>
		            	
		            	<div class="col-xs-4 center">
		            		<i class="fa fa-calendar fa-lg gray-color"></i><br><?= $model->start_date ? $formatter->asDate($model->start_date, "php: M y.") : '--' ?> - <?= $model->end_date ? $formatter->asDate($model->end_date, 'php: M y.') : '--' ?>
		            	</div>
		            	<div class="col-xs-4 center">
		            		<i class="fa fa-money fa-lg gray-color"></i><br><?= $building->cost ? $formatter->asDecimal($building->cost) : 0 ?> RSD
		            	</div>
		            </div>
				</div>

				<hr style="margin:0">
	      		
				<?php // Client ?>			
				<div class="secondary-context">
					<div class="head lower regular">
						<div class="subhead uppercase hint" style="margin-bottom: 5px;">
	          			<?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
	            			<div class="subaction">
	              				<?= Html::a('<i class="fa fa-plus-circle"></i>', Url::to(['/project-clients/create', 'ProjectClients[project_id]'=>$model->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>                   
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

	      	<?php // Projektant ?>
	      		
	      		<div class="secondary-context cont">
					<div class="head lower regular">
						<div class="subhead uppercase hint" style="margin-bottom:5px;">Projektant</div>              
	      				<?= Html::a($model->practice->name, Url::to(['/practices/view', 'id'=>$model->practice_id]), ['class' => '', 'style' => 'color:']) ?>
	    			</div>
			        <div class="head regular second"> 
			          	<?= Html::a($model->engineer->name, Url::to(['/engineers/view', 'id'=>$model->engineer_id]), ['class' => '', 'style' => 'color:']) ?>, <?= $model->engineer->expertees->short ?>
			        </div>              
	  			</div>


	      	<?php // Objekat ?>
				<div class="secondary-context gray">
					<div class="head">
						<div class="subhead uppercase hint" style="margin-bottom: 5px;">Objekat
							<?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
							<div class="subaction">
								<?= Html::a('<i class="fa fa-cogs fa-2x"></i>', Url::to(['/project-building/view', 'id'=>$building->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>                   
							</div>  
							<?php endif; ?>
						</div>                  
						<?= (\Yii::$app->user->can('updateOwnProject', ['project'=>$model])) ? Html::a($building->name. ' ' .$building->storey, Url::to(['/project-building/view', 'id'=>$building->id]), ['class' => '']) : $building->name. ' ' .$building->storey ?>
						<p>Klasa: <?= $model->building->fullClass ?> | tip: <?= $building->type ?></p>
					</div>              
				</div>
				<div class="secondary-context">
					<table class="table-striped">
						<tr>
							<th class="" style="padding:0px 10px; width:40%; font-size: 90%">Spratnost:</th><td><?= $building->spratnost ?></td>
						</tr>
						<tr>
							<th class="" style="padding:0px 10px; font-size: 90%">Neto površina:</th><td><?= $building->netArea ?> m<sup>2</sup></td>
						</tr>
						<tr>
							<th class="" style="padding:0px 10px; font-size: 90%">Bruto površina:</th><td><?= $building->grossArea ?> m<sup>2</sup></td>
						</tr>
						<tr>
							<th class="" style="padding:0px 10px; font-size: 90%">Broj stanova:</th><td><?= $building->brStanova ?></td>
						</tr>
						<tr>
							<th class="" style="padding:0px 10px; font-size: 90%">Broj poslovnih prostora:</th><td><?= $building->brPoslProstora ?></td>
						</tr>
					</table>
				</div>

				<hr style="margin:0">

			<?php if($stanovi = $building->stanovi): ?>
			<?php // Jedinice ?>
				<div class="secondary-context ">
					<div class="head">
						<div class="subhead uppercase hint" style="margin-bottom: 5px;">Jedinice objekta
							<?php if(\Yii::$app->user->can('updateOwnProject', ['project'=>$model])): ?>
							<div class="subaction">
								<?= Html::a('<i class="fa fa-cogs fa-2x"></i>', Url::to(['/project-building-storeys/index', 'id'=>$model->id]), ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>                   
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
					                <?= Html::a('<i class="fa fa-cog"></i>', ['/project-building-storey-parts/view', 'id'=>$stan->id], ['class' => 'btn btn-link', 'style' => 'color:#999']) ?>
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

      	<div class="col-sm-3" style="float:left;">   	


	                    Drugi projekti projektanta
	               
	        <?php echo ListView::widget([
	                      'dataProvider' => $dataProvider,
	                      'itemView' => '_project_short',
	                      'layout' => '{items}',
	                  ]); ?>
	      	
      
      	</div>
	</div>


<?php
\yii\bootstrap\Modal::begin([
    'header' => '<h2>Podestnik projekta</h2>',
    'id'=>'todolist',
]);

echo 'Napravi podsetnik.';

\yii\bootstrap\Modal::end();


\yii\bootstrap\Modal::begin([
    'header' => '<h2>Pristup skrivenom sadržaju projekta</h2>',
    'id'=>'secret-code',
]); ?>

	 <p>Uskoro dostupno imaocu tajnog koda...</p>

<?php /* $form = ActiveForm::begin([
        'id' => 'secret-form',
    ]) ?>

	<?= $form->field($model, 'secret'); ?>

    <?= Html::submitButton(
        Yii::t('user', 'Preuzmi sadržaj'),
        ['class' => 'btn btn-primary btn-block shadow']
    ) ?>

    <?php ActiveForm::end(); */  ?>
<?php
\yii\bootstrap\Modal::end();