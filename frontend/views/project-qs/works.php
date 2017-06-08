<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use kartik\editable\Editable;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProjectQsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = c($work->name);

$this->params['page_title'] = 'Predmer';
$this->params['page_title_2'] = $this->title;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Predmer i predračun radova projekta'), 'url' => ['index', 'ProjectQs[project_id]'=>$model->id]];
$this->params['breadcrumbs'][] = $this->title;

$this->params['project'] = $model;
$projectQs->pagination->pageSize=200;
?>


          <div class="card_container record-full grid-item fadeInUp animated-not no-margin" id="">
            <div class="primary-context gray normal">
                <div class="head"><i class="fa fa-file"></i> <?= Html::encode($this->title) ?> <i class="fa this-one fa-arrow-circle-right"></i>
                <div class="subaction">
                <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Dodaj/izbaci poziciju', Url::to(['/project-qs/positions', 'id'=>$work->id, 'project'=>$model->id]), [/*'data-toggle'=>'modal', 'data-backdrop'=>false, 'data-target'=>'#work-modal'.$work->id.'_'.$model->id,*/ 'class'=>'btn btn-success shadow']) ?>
                    </div>
                </div>
                <div class="subhead">Delovi projektne tehničke dokumentacije.</div>
            </div>
            <div class="secondary-context">
              <?php
                  $gridColumns = [
                      ['class' => 'kartik\grid\SerialColumn'],
                      [
                          'class'=>'kartik\grid\EditableColumn',
                          'attribute'=>'name',
                          'noWrap' => false,
                          'contentOptions' => [
                              'style'=>'max-width:250px; min-height:100px; overflow: hidden; word-wrap: break-word;'
                          ],
                          'editableOptions'=> function ($model, $key, $index) {
                              return [
                                  'header'=>'Naziv',
                                  'inputType'=>\kartik\editable\Editable::INPUT_TEXTAREA,
                                  'size'=>'lg',
                                  'placement' => 'top',              
                              ];
                          }
                      ], 
                      [
                          'class'=>'kartik\grid\EditableColumn',
                          'attribute'=>'action',
                          'width'=>'50px',
                          'hAlign'=>'right',
                          'noWrap' => false,
                          'contentOptions' => [
                              'style'=>'max-width:150px; min-height:100px; overflow: hidden; word-wrap: break-word;'
                          ],
                          'editableOptions'=> function ($model, $key, $index) {
                              return [
                                  'header'=>'Opis pozicije',
                                  'inputType'=>\kartik\editable\Editable::INPUT_TEXTAREA,
                                  'size'=>'lg',
                                  'placement' => 'left',              
                              ];
                          }
                      ],
                      [
                          'label'=>'Cena (€)',
                          'format' => 'raw',
                          'hAlign'=>'right',
                          //'pageSummary'=>true,
                          'value'=>function ($data) {
                              return $data->position->price;
                          },
                      ],
                      [
                          'label'=>'Jed.mere',
                          'format' => 'raw',
                          //'hAlign'=>'right',
                          //'pageSummary'=>true,
                          'value'=>function ($data) {
                              return $data->position->units;
                          },
                      ],
                      [
                          'class'=>'kartik\grid\EditableColumn',
                          'attribute'=>'qty',
                          'hAlign'=>'right',
                          //'pageSummary'=>true,
                          'editableOptions'=> function ($model, $key, $index) {
                              return [
                                  'header'=>'Količina',
                                  'size'=>'',
                                  'placement' => 'top',              
                              ];
                          }
                      ],
                      [
                          'label'=>'Ukupna cena',
                          'format' => 'raw',
                          'hAlign'=>'right',
                          'pageSummary'=>true,
                          'value'=>function ($data) {
                              return $data->position->price*$data->qty;
                          },
                      ],
                      [
                          'class' => 'kartik\grid\ActionColumn',
                          'template' => '{delete}',
                          'header' => '',
                          'width'=>'30px',
                          'buttons' => [                              
                              'delete' => function ($url, $model, $key) {
                                  return Html::a('<i class="fa fa-times"></i>', $url, ['class'=>'btn btn-danger btn-xs', 'data'=>['method'=>'post', 'confirm'=>'Da li ste sigurni da želite da obrišete poziciju? Proces ne može biti vraćen.']]);
                              },                
                          ],
                          'urlCreator' => function ($action, $model, $key, $index) {
                             
                              if ($action === 'delete') {
                                  $url = ['/project-qs/delete', 'id'=>$model->id];
                                  return $url;
                              }

                          },
                      ],
                  ];
                      echo GridView::widget([
                          'id' => 'grid',
                          'dataProvider'=>$projectQs,
                          //'filterModel'=>$searchModel,
                          'columns'=>$gridColumns,
                          'containerOptions'=>['style'=>'overflow: auto'], // only set when $responsive = false
                          'headerRowOptions'=>['class'=>'kartik-sheet-style'],
                          'filterRowOptions'=>['class'=>'kartik-sheet-style'],
                          'pjax'=>true, // pjax is set to always true for this demo
                          // set your toolbar
                          'toolbar'=> [
                              ['content'=>
                                  Html::a('<i class="glyphicon glyphicon-plus"></i>', Url::to(), ['data-toggle'=>'modal', 'data-backdrop'=>false, 'data-target'=>'#storey-modal'.$model->id, 'class'=>'btn btn-success']) . ' '.
                                  Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['', 'id'=>$model->id], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')])
                              ],
                              '{toggleData}',
                          ],
                          'striped'=>true,
                          'condensed'=>true,
                          'responsive'=>true,
                          'hover'=>true,
                          'showPageSummary'=>true,
                          /*'panel'=>[
                              'type'=>GridView::TYPE_DEFAULT,
                              'heading'=>'',
                          ],*/
                      ]);
                  ?>
            </div>
          </div>


<?php
Modal::begin([
    'id'=>'work-modal'.$work->id.'_'.$model->id,
    'size'=>Modal::SIZE_LARGE,
    'class'=>'overlay-modal',
    'header'=> '<h3>'.c($work->name).': Podkategorije i pozicije kategorije radova</h3>',
]); ?>
    <div id="loading"><i class="fa fa-cog fa-spin fa-3x gray-color"></i></div>
<?php Modal::end(); ?>  

