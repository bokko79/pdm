<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel common\models\LocationLotsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Katastarske parcele projekta';

$this->params['page_title'] = 'Lokacija';
$this->params['page_title_2'] = 'Katastarske parcele';

$this->params['breadcrumbs'][] = ['label' => '<i class="fa fa-map-marker"></i> Lokacija projekta', 'url' => ['/project-lot/view', 'id' => $project->id]];
$this->params['breadcrumbs'][] = $this->title;

$this->params['project'] = $project; /*
?>
<div class="location-lots-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Dodaj katastarsku parcelu'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'location_id',
            'lot',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div> */ ?>

<div class="card_container record-full grid-item fadeInUp no-shadow no-margin animated-not" id="">
    <div class="primary-context normal aliceblue bottom-bordered">
        <div class="head colos">
            <div class="subaction">
                <?= Html::a('<i class="fa fa-plus fa-2x"></i> Građevinska', Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$project->location_id, 'LocationLots[type]'=>'object']), ['class' => 'btn btn-link']) ?>
                <?= Html::a('<i class="fa fa-life-saver fa-2x"></i>', null, ['class' => 'btn btn-link button_to_show_secondary']) ?>
            </div>
            <i class="fa fa-th-large"></i> Katastarske parcele projekta
        </div>
        <div class="subhead">Upravljanje katastarskim parcelama projekta.</div>
    </div>  
    <div class="primary-context aliceblue bottom-bordered" style="display: none;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5 text">
                    <h5>Upravljanje investitorima projekta</h5>
                    <h6>Novi investitor projekta.</h6>
                    <p>Novi investitor projekta.</p>
                    <h6>Podešavanje investitora projekta.</h6>
                    <p>Podešavanje investitora projekta.</p>
                    <h6>Uklanjanje investitora projekta.</h6>
                    <p>Uklanjanje investitora projekta.</p>
                </div>
                <div class="col-sm-7">
                    <p><iframe src="//www.youtube.com/embed/sDYVYgiGW3c" width="100%" height="314" allowfullscreen="allowfullscreen"></iframe></p>
                </div>
            </div>
        </div>
            
    </div>
</div>


<div class="container-fluid">
    <div class="row" style="display: table">

        <div class="index w300">
            <?= $this->render('../project-lot/tabs/_lots_index', [
                    'model' => $project->projectLot,
                ]) ?>
        </div>


        <div class="content view w300" style="">

            <?php if(!$project->location->locationLots): ?>
                <a href="<?= Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$project->location_id, 'LocationLots[type]'=>'object']) ?>">
                    <table style="height:220px; border: 5px dashed #7a9ebb;  color: #999; width:80%; margin: 20px auto;">           
                        <tr>
                            <td style="text-align:center; width:100%; vertical-align:middle; padding:20px">
                                    <p class="small">Trenutno nema podataka o građevinskim parcelama projekta.</p>
                                    <p style="font-size:24px;"><i class="fa fa-plus-circle" ></i></p>
                                    <div style="font-size:18px;">Dodajte građevinsku parcelu</div>
                                
                            </td>
                        </tr>            
                    </table>
                </a>
            <?php endif; ?>
            <?php if(!$project->location->serviceLots): ?>
                <a href="<?= Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$project->location_id, 'LocationLots[type]'=>'service']) ?>">
                    <table style="height:220px; border: 5px dashed #7a9ebb;  color: #999; width:80%; margin: 20px auto;">           
                        <tr>
                            <td style="text-align:center; width:100%; vertical-align:middle; padding:20px">
                                    <p class="small">Trenutno nema podataka o parcelama preko kojih je predmetna građevinska parcela priključena na infrastrukturu.</p>
                                    <p style="font-size:24px;"><i class="fa fa-plus-circle" ></i></p>
                                    <div style="font-size:18px;">Dodajte parcelu instalacija</div>
                                
                            </td>
                        </tr>            
                    </table>
                </a>
            <?php endif; ?>
            <?php if(!$project->location->accessLots): ?>
                <a href="<?= Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$project->location_id, 'LocationLots[type]'=>'access']) ?>">
                    <table style="height:220px; border: 5px dashed #7a9ebb;  color: #999; width:80%; margin: 20px auto;">           
                        <tr>
                            <td style="text-align:center; width:100%; vertical-align:middle; padding:20px">
                                    <p class="small">Trenutno nema podataka o parcelama preko kojih se predmetnoj građevinskoj parceli pristupa sa javnih saobraćajnica.</p>
                                    <p style="font-size:24px;"><i class="fa fa-plus-circle" ></i></p>
                                    <div style="font-size:18px;">Dodajte parcelu pristupa</div>
                                
                            </td>
                        </tr>            
                    </table>
                </a>
            <?php endif; ?>
            <?php if($project->setup_status!='' and $project->location->locationLots and $project->location->serviceLots and $project->location->accessLots): ?>
                  <div class="card_container record-full grid-item no-margin no-padding no-shadow">
                    <div class="primary-context bordered text aliceblue">
                      <p>Kada završite unos katastarskih parcela projekta, pređite na sledeći korak.</p>
                      <?php $form = kartik\widgets\ActiveForm::begin([
                          'id' => 'step-form-volumes',
                          'type' => ActiveForm::TYPE_HORIZONTAL,
                          'fullSpan' => 10,      
                          'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
                          'options' => ['enctype' => 'multipart/form-data'],
                      ]); ?>
                        <div class="row" style="margin:50px 0 0;">                
                          <div class="col-md-12">                            
                            <?= Html::submitButton('Sledeći korak <i class="fa fa-arrow-circle-right"></i>', ['class' => 'btn btn-success shadow btn-block btn-lg', 'name' => 'step_form', 'value' => 'next_step']) ?>
                          </div>            
                        </div>
                      <?php ActiveForm::end(); ?>
                    </div>
                  </div>
            <?php endif; ?>
               
        </div>
    </div>

</div>



