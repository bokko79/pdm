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

$location->lot = ($model->location) ? $model->location->locationLots[0]->lot : null;
$model->year = date('Y');
?>

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 7,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data', 'style'=>'margin-top:0 !important;'],
    //'enableAjaxValidation' => true,
    'enableClientValidation' => true,
]); ?>

<?php if(!$model->isNewRecord): ?>
    <?php
        //$model->status = $model->status=='active' ? 1 : 0;
        $model->visible = $model->visible ? 1 : 0;
         ?>
    <?= $form->field($model, 'status')->radioList([ 'active' => 'Aktivan', 'deleted' => 'Obrisan', ], []) ?>
    <?= $form->field($model, 'visible')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'sm']])->hint('Ukoliko je čekirano, prezentacija projekta će biti  u Listi projekata, dostupna svim korisnicima za pregled, a vidljivi će biti samo osnovni podaci projekta (ime, slike, projektant i investitor).') ?> 
    
<?php endif; ?>
<h3 class="col-md-offset-3 margin-20">Osnovni podaci<hr></h3>
    <?= $form->field($model, 'client_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Clients::find()->where('practice_id='.Yii::$app->user->id)->orderBy('name ASC')->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite glavnog investitora'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint($model->hintClient) ?>        

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->hint('Unesite naziv projekta. Npr: Izgradnja stambeno-poslovnog objekta') ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>    

    <?= $form->field($model, 'building_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Buildings::find()->all(), 'id', 'fullname'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,
        ])->hint($model->hintBuilding) ?>



    <?= $form->field($model, 'work')->dropDownList([ 'nova_gradnja' => 'Nova gradnja', 'rekonstrukcija' => 'Rekonstrukcija', 'adaptacija' => 'Adaptacija', 'sanacija' => 'Sanacija', 'promena_namene' => 'Promena namene', 'dogradnja' => 'Dogradnja', 'ozakonjenje' => 'Ozakonjenje', 'odrzavanje' => 'Održavanje', 'ostalo' => 'Ostalo', ], ['prompt'=>'Izaberite vrstu radova...', 'disabled' => $model->isNewRecord ? false : true, 'id'=>'work-id'])->hint($model->hintWork) ?>

<?php if($model->isNewRecord): ?>
    <?= $form->field($model, 'phase')->widget(DepDrop::classname(), [                 
                'options'=>['id'=>'phase-id'],
                'pluginOptions'=>[
                    'depends'=>['work-id'],
                    'placeholder'=>'Izaberite vrstu projekta...',
                    'url'=>Url::to(['/projects/phases'])
                ]
            ])->hint($model->hintPhase) ?>
<?php else: ?>
    <?php // $form->field($model, 'phase')->dropDownList([ 'gnp' => 'Generalni plan (GNP)', 'idr' => 'Idejno rešenje (IDR)', 'idp' => 'Idejni projekat (IDP)', 'pgd' => 'Projekat za građevinsku dozvolu (PGD)', 'pzi' => 'Projekat za izvođenje PZI', 'pio' => 'Projekat izvedenog objekta (PIO)', 'tkp' => 'Tehnička kontrola (TK)', ], [])->hint($model->hintPhase) ?>
    <?= $form->field($model, 'phase')->dropDownList(ArrayHelper::map(common\models\Projects::phases($model->work), 'id', 'name'), [])->hint($model->hintPhase) ?>
<?php endif; ?>
            <div class="adaptacija_part" style="display:none">
                <?= $form->field($model, 'storey')->dropDownList([ 'suteren' => 'Suteren', 'galerija' => 'Galerija', 'prizemlje' => 'Prizemlje', 'sprat' => 'Sprat', 'povucenisprat' => 'Povucenisprat', 'potkrovlje' => 'Potkrovlje', 'mansarda' => 'Mansarda'], ['prompt' => ''])->hint('Etaža na kojoj se nalazi predmetna jedinica koja se adaptira.') ?>
                <?= $form->field($model, 'part_type')->dropDownList([ 'stan' => 'Stan', 'biz' => 'Poslovni prostor - lokal', ], ['prompt' => ''])->hint('Vrsta jedinice koja se adaptira.') ?>
            </div>
<?php if(!$model->isNewRecord): ?>
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
<h3 class="col-md-offset-3 margin-20">Adresa<hr></h3>  

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
<h3 class="col-md-offset-3 margin-20">Projektanti<hr></h3>

     <?= $form->field($model, 'practice_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Practices::find()->all(), 'engineer_id', 'name'),
            'options' => ['placeholder' => 'Izaberite...', 'id'=>'cat-id'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ])->hint($model->hintPractice) ?>

    <?= $form->field($model, 'engineer_id')->widget(DepDrop::classname(), [
                'data'=> ($model->isNewRecord) ? [] : [$model->engineer_id=>$model->engineer->name],
                'options'=>['id'=>'subcat-id'],
                'pluginOptions'=>[
                    'depends'=>['cat-id'],
                    'placeholder'=>'Izaberi...',
                    'url'=>Url::to(['/projects/engineers'])
                ]
            ]) ?>


<?php if(!$model->isNewRecord): ?>
    <?php if($model->phase=='pgd'): ?>
<hr>
<h3 class="col-md-offset-3 margin-20">Tehnička kontrola<hr></h3>
    <?= $form->field($model, 'control_practice_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Practices::find()->all(), 'engineer_id', 'name'),
            'options' => ['placeholder' => 'Izaberite...', 'id'=>'catcont-id'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,
            'pluginOptions'=>['allowClear'=>true],
        ])->hint($model->hintControlPractice) ?>

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
<h3 class="col-md-offset-3 margin-20">Izvođač radova<hr></h3>
    <?= $form->field($model, 'builder_practice_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Practices::find()->all(), 'engineer_id', 'name'),
            'options' => ['placeholder' => 'Izaberite...', 'id'=>'catbuild-id'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,
            'pluginOptions'=>['allowClear'=>true],
        ])->hint($model->hintBuilderPractice) ?>

    <?= $form->field($model, 'builder_engineer_id')->widget(DepDrop::classname(), [
                'data'=> ($model->builder_engineer_id!='') ? [$model->builder_engineer_id=>$model->builderEngineer->name] : [],
                'options'=>['id'=>'subcatbuild-id'],
                'pluginOptions'=>[
                    'depends'=>['catbuild-id'],
                    'placeholder'=>'Izaberi...',
                    'url'=>Url::to(['/projects/builder-engineers'])
                ]
            ])->hint($model->hintBuilderEngineer) ?>

<hr>
<h3 class="col-md-offset-3 margin-20">Stručni nadzor<hr></h3>
    <?= $form->field($model, 'supervision_practice_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\Practices::find()->all(), 'engineer_id', 'name'),
            'options' => ['placeholder' => 'Izaberite...', 'id'=>'catsuper-id'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,  
            'pluginOptions'=>['allowClear'=>true],
        ])->hint($model->hintSupervisionPractice) ?>

    <?= $form->field($model, 'supervision_engineer_id')->widget(DepDrop::classname(), [
                'data'=> ($model->supervision_engineer_id!='') ? [$model->supervision_engineer_id=>$model->supervisionEngineer->name] : [],
                'options'=>['id'=>'subcatsupervision-id'],
                'pluginOptions'=>[
                    'depends'=>['catsuper-id'],
                    'placeholder'=>'Izaberi...',
                    'url'=>Url::to(['/projects/supervision-engineers'])
                ]
            ])->hint($model->hintSupervisionEngineer) ?>
    <?php endif; ?>
<?php endif; ?>
<hr>
<?= $form->field($model, 'year')->input('number', ['style'=>'width:50%'])->hint('Godina izrade projekta.') ?>

    <div class="row" style="margin:20px 0;">
        <div class="col-md-offset-3 col-md-4">
            <?= Html::submitButton($model->isNewRecord ? 'Kreiraj' : 'Izmeni', ['class' => $model->isNewRecord ? 'btn btn-success shadow' : 'btn btn-primary btn-block shadow']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
