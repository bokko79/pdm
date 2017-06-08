
<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use common\widgets\Alert;
use yii\bootstrap\Nav;
use yii\widgets\ListView;

?>


<div class="card_container record-full grid-item fadeInUp no-shadow transparent no-margin animated-not" id="">
    <div class="primary-context normal">
        <div class="head colos">
        <div class="subaction">
            <?= (\Yii::$app->user->can('engineer')) ? Html::a(Yii::t('app', '<i class="fa fa-plus fa-2x"></i> Novi projekat'), ['/projects/create', 'type'=>'project'], ['class' => 'btn btn-link']) : null ?> 
            <?= (\Yii::$app->user->can('engineer')) ? Html::a(Yii::t('app', '<i class="fa fa-plus fa-2x"></i> Nova prezentacija'), ['/projects/create', 'type'=>'presentation'], ['class' => 'btn btn-link']) : null ?> 
            <?= Html::a(Yii::t('app', '<i class="fa fa-search fa-2x"></i>'), null, ['class' => 'btn btn-link show-search']) ?>
                  </div>
                  Moji projekti
        </div>
        <div class="subhead">Projekti na kojima učestvujem kao glavni projektant, odgovorni projektant, vršilac tehničke kontrole, saradnik projektanta, vršilac stručnog nadzora, odgovorni izvođač.</div>
        
    </div>
    <div class="secondary-context searchContainer" style="display:none;">
        <?= $this->render('_projectSearch', ['model' => $searchModel]); ?>
    </div>
    <div class="secondary-context no-padding" style=" padding-left:16px !important;">
        <?php if($projects->getTotalCount()>0): ?>
        <div class="table-responsive">            
            <?php echo ListView::widget([
                'dataProvider' => $projects,
                'itemView' => '_project_short',
          //'itemOptions' => ['style'=>'float:left;'],

            ]); /*?>
            <?= GridView::widget([
                'dataProvider' => $projects,
                //'filterModel' => $searchModel,
                'columns' => [
                    [
                        'label'=>'Avatar projekta',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return $data->avatar;
                        },
                    ],
                    [
                        'attribute'=>'code',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::a($data->code, ['/projects/view', 'id' => $data->id]);
                        },
                        'contentOptions' => ['style'=>'width:80px; min-height:100px; overflow: auto; word-wrap: break-word;'],
                    ],
                    [
                        'label'=>'Naziv projekta',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::a(\yii\helpers\StringHelper::truncate($data->name, 30), ['/projects/view', 'id' => $data->id]);
                        },
                    ],
                    
                    [
                        'label'=>'Lokacija',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return $data->location->fullAddress;
                        },
                        'contentOptions' => ['style'=>'max-width:250px; min-height:100px; overflow: auto; word-wrap: break-word;'],
                    ],
                    [
                        'label'=>'Projektant',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::a($data->practice->name, ['practices/view', 'id' => $data->practice_id]);
                        },
                    ],
                    [
                        'label'=>'Investitor',
                        'format' => 'raw',
                        'value'=>function ($data) {
                            return Html::a($data->client->name, ['/clients/view', 'id' => $data->client_id]);
                        },
                    ],
                ],
            ]); */?>    
        </div>
        <?php else: ?>
            <a href="/projects/create">
            <table style="height:220px; border: 5px dashed #7a9ebb;  color: #999;">           
                <tr>
                    <td style="text-align:center; width:100%; vertical-align:middle;">
                            <p class="small">Trenutno nemate nijedan aktivan projekat.</p>
                            <p style="font-size:24px;"><i class="fa fa-plus-circle" ></i></p>
                            <div style="font-size:18px;">Kreirajte novi projekat</div>
                        
                    </td>
                </tr>            
            </table>
            </a>
    <?php endif; ?>
    </div>
</div>