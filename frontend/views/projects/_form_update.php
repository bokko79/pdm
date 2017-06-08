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


?>

<div class="container-fluid">
    <div class="row">

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 10,      
    'formConfig' => ['labelSpan' => 4, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data', 'style'=>'margin-top:0 !important;'],
    //'enableAjaxValidation' => true,
    'enableClientValidation' => true,
]); ?>

<div class="card_container record-full grid-item fadeInUp animated-not no-shadow no-margin" id="general">
    
    <div class="primary-context normal bottom-bordered">
        <div class="head lower button_to_show_secondary">
            <div class="subaction"><i class="fa fa-caret-right fa-2x this-one"></i></div>
            Osnovni podaci</div>
        <div class="subhead">Osnovni podaci projekta.</div>
    </div>
    <div class="primary-context gray" style="display: none;">

        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->hint('Unesite naziv projekta. Npr: Izgradnja stambeno-poslovnog objekta') ?>

        <?= $form->field($model, 'code')->textInput(['maxlength' => true])->hint('Broj tehničke dokumentacije je obično broj elaborata koji se određuje u okviru Vašeg preduzeća, npr. E-01/2011, gde "E" označava elaborat, "01" je redni broj elaborata, a "2011" godina u kojoj je započeta izrada projekta.') ?>    


        <?= $form->field($model, 'work')->dropDownList([ 'nova_gradnja' => 'Nova gradnja', 'rekonstrukcija' => 'Rekonstrukcija', 'adaptacija' => 'Adaptacija', 'sanacija' => 'Sanacija', 'promena_namene' => 'Promena namene', 'dogradnja' => 'Dogradnja', 'ozakonjenje' => 'Ozakonjenje', 'odrzavanje' => 'Održavanje', 'ostalo' => 'Ostalo', ], ['prompt'=>'Izaberite vrstu radova...', 'disabled' => $model->isNewRecord ? false : true, 'id'=>'work-id'])->hint($model->hintWork) ?>

        <?= $form->field($model, 'phase')->dropDownList(ArrayHelper::map(common\models\Projects::phases($model->work), 'id', 'name'), [])->hint($model->hintPhase) ?>

                <div class="adaptacija_part" style="display:none">
                    <?= $form->field($model, 'storey')->dropDownList([ 'suteren' => 'Suteren', 'galerija' => 'Galerija', 'prizemlje' => 'Prizemlje', 'sprat' => 'Sprat', 'povucenisprat' => 'Povucenisprat', 'potkrovlje' => 'Potkrovlje', 'mansarda' => 'Mansarda'], ['prompt' => ''])->hint('Etaža na kojoj se nalazi predmetna jedinica koja se adaptira.') ?>
                    <?= $form->field($model, 'part_type')->dropDownList([ 'stan' => 'Stan', 'biz' => 'Poslovni prostor - lokal', ], ['prompt' => ''])->hint('Vrsta jedinice koja se adaptira.') ?>
                </div>

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
            
          

        <?= $form->field($model, 'year')->input('number', ['style'=>'width:50%', 'disabled'=>true])->hint('Godina izrade projekta.') ?>

        <div class="row" style="margin:20px 0;">
            <div class="col-md-offset-4 col-md-6">
                <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-success btn-block shadow']) ?>
            </div>        
        </div>
    </div>

    <div class="primary-context normal bottom-bordered"  style="display:none">
        <div class="head lower button_to_show_secondary">
            <div class="subaction"><i class="fa fa-caret-right fa-2x this-one"></i></div>
            Objekat</div>
        <div class="subhead">Klasa i namena objekta.</div>
    </div>
    <div class="primary-context gray" style="display: none;">

        <?= $form->field($model, 'building_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\common\models\Buildings::find()->all(), 'id', 'fullname'),
                'options' => ['placeholder' => 'Izaberite...'],
                'language' => 'sr-Latn',
                'changeOnReset' => false,
            ])->hint($model->hintBuilding) ?>

        <div class="row" style="margin:20px 0;">
            <div class="col-md-offset-4 col-md-6">
                <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-success btn-block shadow']) ?>
            </div>        
        </div>
    </div>

    <div class="primary-context normal bottom-bordered">
        <div class="head lower button_to_show_secondary">
            <div class="subaction"><i class="fa fa-caret-right fa-2x this-one"></i></div>
            Glavni investitor</div>
        <div class="subhead">Investitor nosilac projekta.</div>
    </div>
    <div class="primary-context gray" style="display: none;">

        <?= $form->field($model, 'client_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\common\models\Clients::find()->where('practice_id='.Yii::$app->user->id)->orderBy('name ASC')->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Izaberite glavnog investitora'],
                'language' => 'sr-Latn',
                'changeOnReset' => false,           
            ])->hint($model->hintClient) ?>        
        <div class="row" style="margin:20px 0;">
            <div class="col-md-offset-4 col-md-6">
                <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-success btn-block shadow']) ?>
            </div>        
        </div>
    </div>

    <div class="primary-context normal bottom-bordered">
        <div class="head lower button_to_show_secondary"><div class="subaction"><i class="fa fa-caret-right fa-2x this-one"></i></div>Projektant</div>
        <div class="subhead">Glavni i odgovorni projektant.</div>
    </div>
    <div class="primary-context gray" style="display: none;">

         <?= $form->field($model, 'practice_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(\common\models\PracticeEngineers::find()->innerJoin('practices as p')->where('practice_engineers.engineer_id='.Yii::$app->user->id)->all(), 'practice.engineer_id', 'practice.name'),
                'options' => ['placeholder' => 'Izaberite...', 'id'=>'cat-id'],
                'language' => 'sr-Latn',
                'changeOnReset' => false,
                'pluginOptions'=>['allowClear'=>true],
            ])->hint('') ?>

        <?= $form->field($model, 'engineer_id')->widget(DepDrop::classname(), [
                    'data'=> ($model->isNewRecord) ? [] : [$model->engineer_id=>$model->engineer->name],
                    'options'=>['id'=>'subcat-id'],
                    'pluginOptions'=>[
                        'depends'=>['cat-id'],
                        'placeholder'=>'Izaberi...',
                        'url'=>Url::to(['/projects/engineers'])
                    ]
                ]) ?>
        <div class="row" style="margin:20px 0;">
            <div class="col-md-offset-4 col-md-6">
                <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-success btn-block shadow']) ?>
            </div>        
        </div>
    </div>



    <?php if($model->phase=='pgd'): ?>

    <div class="primary-context normal bottom-bordered">
        <div class="head lower button_to_show_secondary"><div class="subaction"><i class="fa fa-caret-right fa-2x this-one"></i></div>Tehnička kontrola</div>
        <div class="subhead">Tehnička kontrola projekta.</div>
    </div>
    <div class="primary-context gray" style="display: none;">

        <?= $form->field($model, 'control_practice_id')->widget(Select2::classname(), [
                //'data' => ArrayHelper::map(\common\models\PracticeEngineers::find()->innerJoin('practices as p')->where('practice_engineers.engineer_id='.Yii::$app->user->id)->all(), 'practice.engineer_id', 'practice.name'),
                'data' => ArrayHelper::map(Yii::$app->user->practice->availablePractices, 'engineer_id', 'name'),
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

        <div class="row" style="margin:20px 0;">
            <div class="col-md-offset-4 col-md-6">
                <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-success btn-block shadow']) ?>
            </div>        
        </div>
    </div>
    <?php endif; ?>
    <?php if($model->phase=='pio'): ?>

    <div class="primary-context normal bottom-bordered">
        <div class="head lower button_to_show_secondary"><div class="subaction"><i class="fa fa-caret-right fa-2x this-one"></i></div>Izvođač radova</div>
        <div class="subhead">Izvođač radova projekta.</div>
    </div>
    <div class="primary-context gray" style="display: none;">

        <?= $form->field($model, 'builder_practice_id')->widget(Select2::classname(), [
                //'data' => ArrayHelper::map(\common\models\Practices::find()->all(), 'engineer_id', 'name'),
                'data' => ArrayHelper::map(Yii::$app->user->practice->availablePractices, 'engineer_id', 'name'),
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

        <div class="row" style="margin:20px 0;">
            <div class="col-md-offset-4 col-md-6">
                <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-success btn-block shadow']) ?>
            </div>        
        </div>
    </div>

    <div class="primary-context normal bottom-bordered">
        <div class="head lower button_to_show_secondary"><div class="subaction"><i class="fa fa-caret-right fa-2x this-one"></i></div>Stručni nadzor</div>
        <div class="subhead">Stručni nadzor projekta.</div>
    </div>
    <div class="primary-context gray" style="display: none;">
        <?= $form->field($model, 'supervision_practice_id')->widget(Select2::classname(), [
                //'data' => ArrayHelper::map(\common\models\Practices::find()->all(), 'engineer_id', 'name'),
                'data' => ArrayHelper::map(Yii::$app->user->practice->availablePractices, 'engineer_id', 'name'),
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
        <div class="row" style="margin:20px 0;">
            <div class="col-md-offset-4 col-md-6">
                <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-success btn-block shadow']) ?>
            </div>        
        </div>
    </div>

    <?php endif; ?>

    <div class="primary-context normal bottom-bordered">
        <div class="head lower button_to_show_secondary">
            <div class="subaction"><i class="fa fa-caret-right fa-2x this-one"></i></div>
            Status i vidljivost</div>
        <div class="subhead">Osnovni podaci projekta.</div>
    </div>
    <div class="primary-context gray" style="display: none;">

        <?php
            //$model->status = $model->status=='active' ? 1 : 0;
            $model->visible = $model->visible ? 1 : 0;
             ?>
        <?= $form->field($model, 'status')->radioButtonGroup([ 'active' => 'Aktivan', 'deleted' => 'Obrisan', ], ['style'=>'z-index:0']) ?>
        <?= $form->field($model, 'visible')->widget(SwitchInput::classname(), [
                'containerOptions' => ['style'=>'margin:0'],
                 'pluginOptions'=>[
                    'handleWidth'=>60,
                    'onText'=>'Prikazano',
                    'offText'=>'Sakriveno'
                ]

            ])->hint('Ukoliko je čekirano, prezentacija projekta će biti  u Listi projekata, dostupna svim korisnicima za pregled, a vidljivi će biti samo osnovni podaci projekta (ime, slike, projektant i investitor).') ?> 
        <div class="row" style="margin:20px 0;">
            <div class="col-md-offset-4 col-md-6">
                <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-success btn-block shadow']) ?>
            </div>        
        </div>
    </div>


    <div class="primary-context normal bottom-bordered">
        <div class="head lower button_to_show_secondary">
            <div class="subaction"><i class="fa fa-caret-right fa-2x this-one"></i></div>
            Vrsta projekta</div>
        <div class="subhead">Radna verzija ili web-prezentacija projekta.</div>
    </div>
    <div class="primary-context gray" style="display: none;">

        <?= $form->field($model, 'type')->radioButtonGroup([ 'project' => 'Radni projekat sa prezentacijom', 'presentation' => 'Prezentacija projekta', ], ['style'=>'z-index:0']) ?>
        <div class="row" style="margin:20px 0;">
            <div class="col-md-offset-4 col-md-6">
                <?= Html::submitButton('<i class="fa fa-save"></i> Sačuvaj izmene', ['class' => 'btn btn-success btn-block shadow']) ?>
            </div>        
        </div>
    </div>
        
<?php ActiveForm::end(); ?>

</div>
</div>