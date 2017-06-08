<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
use kartik\widgets\DepDrop;
use kartik\checkbox\CheckboxX;
use kartik\datecontrol\DateControl;
use wbraganca\dynamicform\DynamicFormWidget;

$location->lot = ($model->location) ? $model->location->locationLots[0]->lot : null;
//$model->year = date('Y');
?>

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'project-dynamic-form-id',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 10,      
    'formConfig' => ['labelSpan' => 4, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data', 'style'=>'margin-top:0 !important;'],
    //'enableAjaxValidation' => true,
    'enableClientValidation' => true,
]); ?>

<?php if(!$model->isNewRecord): ?>
    <?php
        //$model->status = $model->status=='active' ? 1 : 0;
        $model->visible = $model->visible ? 1 : 0;
         ?>
    <?= $form->field($model, 'status')->radioButtonGroup([ 'active' => 'Aktivan', 'deleted' => 'Obrisan', ], ['style'=>'z-index:0']) ?>
    <?= $form->field($model, 'visible')->widget(SwitchInput::classname(), [
            'containerOptions' => ['style'=>'margin:0'],
             'pluginOptions'=>[
                'handleWidth'=>60,
                'onText'=>'Prikaži',
                'offText'=>'Sakrij'
            ]

        ])->hint('Ukoliko je čekirano, prezentacija projekta će biti  u Listi projekata, dostupna svim korisnicima za pregled, a vidljivi će biti samo osnovni podaci projekta (ime, slike, projektant i investitor).') ?> 
    
<?php endif; ?>
<h5 class="col-md-offset-3 margin-20">Osnovni podaci<hr></h5>

<?php /* DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 10, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $clients[0],
        'formId' => 'project-dynamic-form-id',
        'formFields' => [
            'client_id',
        ],
    ]); ?>
<div class="container-items">
    <button type="button" class="add-item btn btn-default btn-sm col-md-offset-8"><i class="fa fa-plus"></i> Dodaj investitora</button>
    <div class="clearfix"></div>
    <?php foreach ($clients as $index => $client): ?>
    <div class="item"><!-- widgetBody -->
        
        <?= $form->field($client, '['.$index.']client_id', [
                'addon' => [
                    'append' => [
                        'content' => '<button type="button" class="pull- remove-item btn btn-danger " style="float:left;"><i class="fa fa-times"></i></button>', 
                        'asButton' => true
                    ]
                ]
            ])->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\common\models\Clients::find()->where('practice_id='.Yii::$app->user->id)->orderBy('name ASC')->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Izaberite investitora'],
                'language' => 'sr-Latn',
                'changeOnReset' => false,           
            ])->hint($model->hintClient)  ?>
        
        <div class="clearfix"></div>
    </div>
    <?php endforeach; ?>
</div>         
<?php DynamicFormWidget::end(); */ ?>

                

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->hint('Unesite naziv projekta. Npr: Izgradnja stambeno-poslovnog objekta') ?>

    <?= $form->field($model, 'client_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\common\models\Clients::find()->where('practice_id='.Yii::$app->user->id)->orderBy('name ASC')->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Izaberite investitora'],
                'language' => 'sr-Latn',
                'changeOnReset' => false,           
            ])->hint($model->hintClient)  ?>

<?php if($model->type!='presentation'): ?>
    <?= $form->field($model, 'code')->textInput(['maxlength' => true])->hint('Broj tehničke dokumentacije je obično broj elaborata koji se određuje u okviru Vašeg preduzeća, npr. E-01/2011, gde "E" označava elaborat, "01" je redni broj elaborata, a "2011" godina u kojoj je započeta izrada projekta.') ?>    
<?php endif; ?>
    <?= $form->field($model, 'building_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Buildings::find()->all(), 'id', 'fullname'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,
        ])->hint($model->hintBuilding) ?>



    <?= $form->field($model, 'work')->dropDownList([ 'nova_gradnja' => 'Nova gradnja', 'rekonstrukcija' => 'Rekonstrukcija', 'adaptacija' => 'Adaptacija', 'sanacija' => 'Sanacija', 'promena_namene' => 'Promena namene', 'dogradnja' => 'Dogradnja', 'ozakonjenje' => 'Ozakonjenje', 'odrzavanje' => 'Održavanje', 'ostalo' => 'Ostalo', ], ['prompt'=>'Izaberite vrstu radova...', 'disabled' => $model->isNewRecord ? false : true, 'id'=>'work-id'])->hint($model->hintWork) ?>

<?php if($model->isNewRecord): ?>
    <?php if($model->type!='presentation'): ?>
    <?= $form->field($model, 'phase')->widget(DepDrop::classname(), [                 
                'options'=>['id'=>'phase-id'],
                'pluginOptions'=>[
                    'depends'=>['work-id'],
                    'placeholder'=>'Izaberite vrstu projekta...',
                    'url'=>Url::to(['/projects/phases'])
                ]
            ])->hint($model->hintPhase) ?>
    <?php endif; ?>
<?php else: ?>
    <?php // $form->field($model, 'phase')->dropDownList([ 'gnp' => 'Generalni plan (GNP)', 'idr' => 'Idejno rešenje (IDR)', 'idp' => 'Idejni projekat (IDP)', 'pgd' => 'Projekat za građevinsku dozvolu (PGD)', 'pzi' => 'Projekat za izvođenje PZI', 'pio' => 'Projekat izvedenog objekta (PIO)', 'tkp' => 'Tehnička kontrola (TK)', ], [])->hint($model->hintPhase) ?>
    <?= $form->field($model, 'phase')->dropDownList(ArrayHelper::map(common\models\Projects::phases($model->work), 'id', 'name'), [])->hint($model->hintPhase) ?>
<?php endif; ?>
            <div class="adaptacija_part" style="display:none">
                <?= $form->field($model, 'storey')->dropDownList([ 'suteren' => 'Suteren', 'galerija' => 'Galerija', 'prizemlje' => 'Prizemlje', 'sprat' => 'Sprat', 'povucenisprat' => 'Povucenisprat', 'potkrovlje' => 'Potkrovlje', 'mansarda' => 'Mansarda'], ['prompt' => ''])->hint('Etaža na kojoj se nalazi predmetna jedinica koja se adaptira.') ?>
                <?= $form->field($model, 'part_type')->dropDownList([ 'stan' => 'Stan', 'biz' => 'Poslovni prostor - lokal', ], ['prompt' => ''])->hint('Vrsta jedinice koja se adaptira.') ?>
            </div>
<?php if($model->type=='presentation'): ?>
    <?= $form->field($model, 'start_date')->widget(DateControl::classname(), [
                            'language' => 'rs-latin',
                            'type' => 'date',
                            'options'=> [
                                'type'=>2,
                                'size' => 'lg',
                                'pickerButton'=>['title'=>'Izaberite datum'],
                                'pluginOptions' => [                        
                                    'autoclose' => true,
                                    'todayHighlight' => true,
                                    //'startDate'=>date('Y-m-d'),                      
                                ],
                            ],                                
                    ]) ?> 
    <?= $form->field($model, 'end_date')->widget(DateControl::classname(), [
                            'language' => 'rs-latin',
                            'type' => 'date',
                            'options'=> [
                                'type'=>2,
                                'size' => 'lg',
                                'pickerButton'=>['title'=>'Izaberite datum'],
                                'pluginOptions' => [                        
                                    'autoclose' => true,
                                    'todayHighlight' => true,
                                    //'startDate'=>date('Y-m-d'),                      
                                ],
                            ],                                
                    ]) ?>  
<?php endif; ?>
<hr>
<h5 class="col-md-offset-3 margin-20">Lokacija projekta<hr></h5>  

    <?= $form->field($location, 'street')->textInput(['maxlength' => true]) ?>
    <?= $form->field($location, 'number')->textInput(['maxlength' => true]) ?>
    <?= $form->field($location, 'city_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Cities::find()->all(), 'id', 'town', 'city'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>
    <?= $form->field($location, 'lot')->textInput(['maxlength' => true]) ?>
    <?= $form->field($location, 'county_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Counties::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>    

<hr>
<h5 class="col-md-offset-3 margin-20">Projektanti<hr></h5>

     <?= $form->field($model, 'practice_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\PracticeEngineers::find()->innerJoin('practices as p')->where('practice_engineers.engineer_id='.Yii::$app->user->id)->all(), 'practice.engineer_id', 'practice.name'),
            //'data' => ArrayHelper::map(Yii::$app->user->practice->availableEngineers, 'engineer_id', 'name'),
            'options' => ['placeholder' => 'Izaberite...', 'id'=>'cat-id'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint('') ?>

    <?= $form->field($model, 'engineer_id')->widget(DepDrop::classname(), [
                'data'=> ($model->isNewRecord) ? [] : [$model->engineer_id=>$model->engineer->name],
                'options'=>['id'=>'subcat-id'],
                'pluginOptions'=>[
                    'depends'=>['cat-id'],
                    'placeholder'=>'Izaberite...',
                    'url'=>Url::to(['/projects/engineers'])
                ]
            ]) ?>

<?php if($model->type=='presentation'): ?>
<hr>
<h5 class="col-md-offset-3 margin-20">Izvođač radova<hr></h5>
    <?= $form->field($model, 'builder_practice_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Practices::find()->all(), 'engineer_id', 'name'),
            'options' => ['placeholder' => 'Izaberite...', 'id'=>'catbuild-id'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,
            'pluginOptions'=>['allowClear'=>true],
        ]) ?>

    <?= $form->field($model, 'builder_engineer_id')->widget(DepDrop::classname(), [
                'data'=> ($model->builder_engineer_id!='') ? [$model->builder_engineer_id=>$model->builderEngineer->name] : [],
                'options'=>['id'=>'subcatbuild-id'],
                'pluginOptions'=>[
                    'depends'=>['catbuild-id'],
                    'placeholder'=>'Izaberi...',
                    'url'=>Url::to(['/projects/builder-engineers'])
                ]
            ]) ?>
<?php endif; ?>

<?php if(!$model->isNewRecord): ?>
    <?php if($model->phase=='pgd'): ?>
<hr>
<h5 class="col-md-offset-3 margin-20">Tehnička kontrola<hr></h5>
    <?= $form->field($model, 'control_practice_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Practices::find()->all(), 'engineer_id', 'name'),
            'options' => ['placeholder' => 'Izaberite...', 'id'=>'catcont-id'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,
            'pluginOptions'=>['allowClear'=>true],
        ]) ?>

        <?= $form->field($model, 'control_engineer_id')->widget(DepDrop::classname(), [
                'data'=> ($model->control_engineer_id!='') ? [$model->control_engineer_id=>$model->controlEngineer->name] : [],
                'options'=>['id'=>'subcatcont-id'],
                'pluginOptions'=>[
                    'depends'=>['catcont-id'],
                    'placeholder'=>'Izaberi...',
                    'url'=>Url::to(['/projects/control-engineers'])
                ]
            ])->hint($model->hintControlEngineer) ?>
    <?php endif; ?>
    <?php if($model->phase=='pio'): ?>
<hr>
<h5 class="col-md-offset-3 margin-20">Izvođač radova<hr></h5>
    <?= $form->field($model, 'builder_practice_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Practices::find()->all(), 'engineer_id', 'name'),
            'options' => ['placeholder' => 'Izaberite...', 'id'=>'catbuild-id'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,
            'pluginOptions'=>['allowClear'=>true],
        ]) ?>

    <?= $form->field($model, 'builder_engineer_id')->widget(DepDrop::classname(), [
                'data'=> ($model->builder_engineer_id!='') ? [$model->builder_engineer_id=>$model->builderEngineer->name] : [],
                'options'=>['id'=>'subcatbuild-id'],
                'pluginOptions'=>[
                    'depends'=>['catbuild-id'],
                    'placeholder'=>'Izaberi...',
                    'url'=>Url::to(['/projects/builder-engineers'])
                ]
            ]) ?>

<hr>
<h5 class="col-md-offset-3 margin-20">Stručni nadzor<hr></h5>
    <?= $form->field($model, 'supervision_practice_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Practices::find()->all(), 'engineer_id', 'name'),
            'options' => ['placeholder' => 'Izaberite...', 'id'=>'catsuper-id'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,  
            'pluginOptions'=>['allowClear'=>true],
        ]) ?>

    <?= $form->field($model, 'supervision_engineer_id')->widget(DepDrop::classname(), [
                'data'=> ($model->supervision_engineer_id!='') ? [$model->supervision_engineer_id=>$model->supervisionEngineer->name] : [],
                'options'=>['id'=>'subcatsupervision-id'],
                'pluginOptions'=>[
                    'depends'=>['catsuper-id'],
                    'placeholder'=>'Izaberi...',
                    'url'=>Url::to(['/projects/supervision-engineers'])
                ]
            ]) ?>
    <?php endif; ?>
<?php endif; ?>
<hr>
<?php // $form->field($model, 'year')->input('number', ['style'=>'width:50%'])->hint('Godina izrade projekta.') ?>

    <div class="row" style="margin:20px 0;">
        <div class="col-md-offset-4 col-md-6">
            <?= Html::submitButton($model->isNewRecord ? 'Započni projekat i pređi na sledeći korak <i class="fa fa-arrow-circle-right"></i>' : 'Sačuvaj izmene', ['class' => !$model->isNewRecord ? 'btn btn-success shadow' : 'btn btn-primary btn-block shadow btn-lg']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
