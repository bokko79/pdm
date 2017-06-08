<?php

/*
 * C01 - Dashboard Home page.
 *
 * This file is part of the Servicemapp project.
 *
 * (c) Servicemapp project <http://github.com/bokko79/servicemapp>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\bootstrap\Modal;
use common\widgets\Alert;

/* @var $this yii\web\View */

$this->title = 'Projekti: '.$model->username;
$formatter = \Yii::$app->formatter;
$this->params['page_title'] = 'Projekat';
$this->params['breadcrumbs'][] = $this->title;
$this->params['profile'] = $model;

?>
<div class="card_container record-full grid-item fadeInUp no-shadow no-margin animated-not" id="">
  <div class="primary-context normal aliceblue bottom-bordered">
    <div class="head colos">
      <div class="subaction">
        <?= Html::a('<i class="fa fa-plus fa-2x"></i>', Url::to(['/projects/create', 'type'=>'project']), ['class' => 'btn btn-link']) ?>
        <?= Html::a('<i class="fa fa-life-saver fa-2x"></i>', null, ['class' => 'btn btn-link button_to_show_secondary']) ?>
      </div>
      <i class="fa fa-copy"></i> Moji projekti
    </div>
    <div class="subhead">Projekti na kojima učestvujem kao glavni projektant, odgovorni projektant, vršilac tehničke kontrole, saradnik projektanta, vršilac stručnog nadzora, odgovorni izvođač.</div>
  </div>  
  <div class="primary-context aliceblue bottom-bordered" style="display: none;">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-5 text">
          <h5>Upravljanje učesnicima projekta</h5>
          <h6>Nova sveska projekta.</h6>
          <p>Nova sveska projekta.</p>
          <h6>Podešavanje sveske projekta.</h6>
          <p>Podešavanje sveske projekta.</p>
          <h6>Uklanjanje sveske projekta.</h6>
          <p>Uklanjanje sveske projekta.</p>
        </div>
        <div class="col-sm-7">
          <p><iframe src="//www.youtube.com/embed/sDYVYgiGW3c" width="100%" height="314" allowfullscreen="allowfullscreen"></iframe></p>
        </div>
      </div>
    </div>        
  </div>
</div>
    
<div class="container-fluid listed">
    <div class="row">
        <div class="index">
            <button type="button" class="navbar-toggle navbar-toggle-sidebar-inside" data-toggle="collapse" data-target="#navbar-collapser" aria-expanded="true">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="card_container record-full grid-item no-margin no-padding no-shadow hidden-md" id="navbar-collapser">
              <div class="primary-context gray">   
                  <div class="head third">
                    <div class="subaction"><a href="#" class="float-right button_to_show_secondary"><i class="fa fa-search fa-lg"></i></a></div>
                    <i class="fa fa-filter"></i> Filter   
                  </div>      
              </div>
              <div class="primary-context gray low-margin top-bordered" style="display: none;">   
                  <?php echo $this->render('tabs/_projectSearch', ['model' => $searchModel, 'project' => $model]); ?>          
              </div>
              <div class="secondary-context no-padding">        
                  <?php echo ListView::widget([
                      'dataProvider' => $projects,
                		'itemView' => 'tabs/_indexed_project',
                      'itemOptions' => ['tag'=>'ul', 'class'=>'index-menu'],
                      'summary' => '',
                      'emptyText' => '<ul class="index-menu"><li>Nije pronađen nijedan projekat.</li></ul>',
                  ]); ?>        
              </div>                
            </div>       
        </div>
        <div class="content full">
        	<?php if($projects->getTotalCount()>0): ?>
 			<?php echo $this->render('tabs/_display_project', ['model' => $displayed_project]); ?>
           	<?php else: ?>
	            <a href="/projects/create">
	            <table style="height:220px; border: 5px dashed #7a9ebb;  color: #999;">           
	                <tr>
	                    <td style="text-align:center; width:100%; vertical-align:middle;">
	                            <p class="small">Nije pronađen nijedan aktivan projekat.</p>
	                            <p style="font-size:24px;"><i class="fa fa-plus-circle" ></i></p>
	                            <div style="font-size:18px;">Kreirajte novi projekat</div>
	                        
	                    </td>
	                </tr>            
	            </table>
	            </a>
		    <?php endif; ?>

        </div>
    </div>
</div>
<?php /*
<div class="container-fluid ">
    <div class="row" style="">
		<?= $this->render('tabs/_projects_index', ['model'=>$model->engineer, 'projects'=>$projects, 'searchModel'=>$searchModel]) ?>       
    </div>
</div> */ ?>