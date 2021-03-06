<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "projects".
 *
 * @property string $id
 * @property string $user_id
 * @property string $client_id
 * @property string $building_id
 * @property string $location_id
 * @property string $practice_id
 * @property string $engineer_id
 * @property string $control_practice_id
 * @property string $control_engineer_id
 * @property string $builder_practice_id
 * @property string $builder_engineer_id
 * @property string $supervision_practice_id
 * @property string $supervision_engineer_id
 * @property string $name
 * @property string $code
 * @property string $phase
 * @property string $work
 * @property string $status
 * @property string $time
 * @property integer $year
 * @property string $type
 * @property integer $visible
 * @property string $secret
 * @property string $start_date
 * @property string $end_date
 *
 * @property ProjectBuilding $projectBuilding
 * @property ProjectBuildingCharacteristics $projectBuildingCharacteristics
 * @property ProjectBuildingClasses[] $projectBuildingClasses
 * @property ProjectBuildingHeights[] $projectBuildingHeights
 * @property ProjectBuildingInsulations $projectBuildingInsulations
 * @property ProjectBuildingMaterials $projectBuildingMaterials
 * @property ProjectBuildingParts[] $projectBuildingParts
 * @property ProjectBuildingServices $projectBuildingServices
 * @property ProjectBuildingStoreys[] $projectBuildingStoreys
 * @property ProjectBuildingStructure $projectBuildingStructure
 * @property ProjectClients[] $projectClients
 * @property ProjectFiles[] $projectFiles
 * @property ProjectLot $projectLot
 * @property ProjectLotExistingBuildings[] $projectLotExistingBuildings
 * @property ProjectLotFutureDevelopments[] $projectLotFutureDevelopments
 * @property ProjectVolumes[] $projectVolumes
 * @property Clients $client
 * @property Practices $controlPractice
 * @property Engineers $controlEngineer
 * @property Locations $location
 * @property Buildings $building
 * @property Practices $practice
 * @property Engineers $engineer
 * @property User $user
 */
class Projects extends \yii\db\ActiveRecord
{
    public $storey;
    public $part_type;

    public $address;

    public $exchange = 124.5;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'projects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'user_id', 'client_id', 'building_id', 'practice_id', 'engineer_id', 'work'], 'required'],
            [['client_id', 'building_id', 'location_id', 'practice_id', 'engineer_id', 'control_practice_id', 'control_engineer_id', 'builder_practice_id', 'builder_engineer_id', 'supervision_practice_id', 'supervision_engineer_id', 'time', 'year', 'visible'], 'integer'],
            [['code'], 'unique', 'targetAttribute' => 'code'],
            [['phase', 'work', 'status', 'type', 'setup_status'], 'string'],
            [['address'], 'safe'],
            [['start_date', 'end_date'], 'safe'],
            [['name'], 'string', 'max' => 128],
            [['code'], 'string', 'max' => 20],
            [['secret'], 'string', 'max' => 6],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['client_id' => 'id']],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::className(), 'targetAttribute' => ['location_id' => 'id']],
            [['building_id'], 'exist', 'skipOnError' => true, 'targetClass' => Buildings::className(), 'targetAttribute' => ['building_id' => 'id']],
            [['practice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Practices::className(), 'targetAttribute' => ['practice_id' => 'engineer_id']],
            [['engineer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Engineers::className(), 'targetAttribute' => ['engineer_id' => 'user_id']],
            [['control_practice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Practices::className(), 'targetAttribute' => ['control_practice_id' => 'engineer_id']],
            [['control_engineer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Engineers::className(), 'targetAttribute' => ['control_engineer_id' => 'user_id']],
            [['builder_practice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Practices::className(), 'targetAttribute' => ['builder_practice_id' => 'engineer_id']],
            [['builder_engineer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Engineers::className(), 'targetAttribute' => ['builder_engineer_id' => 'user_id']],
            [['supervision_practice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Practices::className(), 'targetAttribute' => ['supervision_practice_id' => 'engineer_id']],
            [['supervision_engineer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Engineers::className(), 'targetAttribute' => ['supervision_engineer_id' => 'user_id']],
            [['storey', 'part_type'], 'required', 'when' => function ($model) {
                                                return $model->work == 'adaptacija';
                                            }, 'whenClient' => "function (attribute, value) {
                                                return $('#work-id').val() == 'adaptacija';
                                            }"],
            [['exchange'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Naziv projekta'),
            'code' => Yii::t('app', 'Broj tehničke dokumentacije'),
            'client_id' => Yii::t('app', 'Glavni investitor'),
            'building_id' => Yii::t('app', 'Klasa objekta'),
            'location_id' => Yii::t('app', 'Adresa'),
            'work' => Yii::t('app', 'Vrsta radova'),
            'projectPhase' => Yii::t('app', 'Vrsta projekta'),
            'projectTypeOfWorks' => Yii::t('app', 'Vrsta radova'),
            'phase' => Yii::t('app', 'Vrsta projekta'),
            'practice_id' => Yii::t('app', 'Projektant'),
            'engineer_id' => Yii::t('app', 'Glavni projektant'),
            'control_practice_id' => Yii::t('app', 'Vršilac tehničke kontrole'),
            'control_engineer_id' => Yii::t('app', 'Odgovorno lice vršioca tehničke kontrole'),
            'builder_practice_id' => Yii::t('app', 'Odgovorni izvođač radova'),
            'builder_engineer_id' => Yii::t('app', 'Odgovorno lice izvođača radova'),
            'supervision_practice_id' => Yii::t('app', 'Stručni nadzor'),
            'supervision_engineer_id' => Yii::t('app', 'Odgovorno lice stručnog nadzora'),
            'time' => Yii::t('app', 'Datum'),
            'type' => Yii::t('app', 'Tip'),
            'visible' => Yii::t('app', 'Vidljivost'),
            'secret' => Yii::t('app', 'Secret'),
            'start_date' => Yii::t('app', 'Datum početka projekta'),
            'end_date' => Yii::t('app', 'Datum završetka projekta'),
            'year' => Yii::t('app', 'Godina'),

            'storey' => Yii::t('app', 'Etaža jedinice'),
            'part_type' => Yii::t('app', 'Vrsta jedinice'),
        ];
    }    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildings()
    {
        return $this->hasMany(ProjectBuilding::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuilding()
    {
        return \common\models\ProjectBuilding::find()->where('project_id='.$this->id .' and mode="new"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectExBuilding()
    {
        return \common\models\ProjectBuilding::find()->where('project_id='.$this->id .' and mode="existing"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectUnits()
    {
        return $this->projectExBuilding ? $this->projectExBuilding->projectBuildingStoreys[0]->projectBuildingStoreyParts : null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectUnit()
    {
        $u = '';
        if($units = $this->projectUnits){
            foreach($units as $unit){
                if($unit->mode=='new'){
                    $u = $unit;
                    break;
                }
            }
        }
        return $u ?: false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectExunit()
    {
        $u = '';
        if($units = $this->projectUnits){
            foreach($units as $unit){
                if($unit->mode=='existing'){
                    $u = $unit;
                    break;
                }
            }
        }
        return $u ?: false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectClients()
    {
        return $this->hasMany(ProjectClients::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectFiles()
    {
        return $this->hasMany(ProjectFiles::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectImages()
    {
        return $this->hasMany(ProjectImages::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectLot()
    {
        return $this->hasOne(ProjectLot::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectLotExistingBuildings()
    {
        return $this->hasMany(ProjectLotExistingBuildings::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectLotFutureDevelopments()
    {
        return $this->hasMany(ProjectLotFutureDevelopments::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectQs()
    {
        return $this->hasMany(ProjectQs::className(), ['project_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectVolumes()
    {
        return $this->hasMany(ProjectVolumes::className(), ['project_id' => 'id'])->orderBy('number ASC');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Locations::className(), ['id' => 'location_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuilding()
    {
        return $this->hasOne(Buildings::className(), ['id' => 'building_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPractice()
    {
        return $this->hasOne(Practices::className(), ['engineer_id' => 'practice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEngineer()
    {
        return $this->hasOne(Engineers::className(), ['user_id' => 'engineer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControlPractice()
    {
        return $this->hasOne(Practices::className(), ['engineer_id' => 'control_practice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControlEngineer()
    {
        return $this->hasOne(Engineers::className(), ['user_id' => 'control_engineer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuilderPractice()
    {
        return $this->hasOne(Practices::className(), ['engineer_id' => 'builder_practice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuilderEngineer()
    {
        return $this->hasOne(Engineers::className(), ['user_id' => 'builder_engineer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupervisionPractice()
    {
        return $this->hasOne(Practices::className(), ['engineer_id' => 'supervision_practice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSupervisionEngineer()
    {
        return $this->hasOne(Engineers::className(), ['user_id' => 'supervision_engineer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvatar($w=160, $h=120)
    {
        return $this->projectImages ? \yii\helpers\Html::img('@web/images/projects/'.$this->year.'/'.$this->id.'/'.$this->projectImages[0]->file->name, ['style'=>'width:'.$w.'px; max-height:'.$h.'px;']) : \yii\helpers\Html::img('@web/images/no_pic_image.png');
    }    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectPhase()
    {
        $phase = null;
        switch($this->phase){
            case 'gnp':
                $phase = 'Generalni projekat (GNP)';
                break;
            case 'idr':
                $phase = 'Idejno rešenje (IDR)';
                break;
            case 'idp':
                $phase = 'Idejni projekat (IDP)';
                break;
            case 'pgd':
                $phase = 'Projekat za građevinsku dozvolu (PGD)';
                break;
            case 'pzi':
                $phase = 'Projekat za izvođenje (PZI)';
                break;
            case 'pio':
                $phase = 'Projekat izvedenog objekta (PIO)';
                break;
            default:
                $phase = 'Tehnička kontrola projekta (TKP)';
                break;
        }
        return $phase;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectPhaseGen()
    {
        $phase = null;
        switch($this->phase){
            case 'gnp':
                $phase = 'generalnog projekta (GNP)';
                break;
            case 'idr':
                $phase = 'idejnog rešenja (IDR)';
                break;
            case 'idp':
                $phase = 'idejnog projekta (IDP)';
                break;
            case 'pgd':
                $phase = 'projekta za građevinsku dozvolu (PGD)';
                break;
            case 'pzi':
                $phase = 'projekta za izvođenje (PZI)';
                break;
            case 'pio':
                $phase = 'projekta izvedenog objekta (PIO)';
                break;
            default:
                $phase = 'tehničke kontrole projekta (TKP)';
                break;
        }
        return $phase;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectTypeOfWorks()
    {
        $work = null;
        switch($this->work){
            case 'nova_gradnja':
                $work = 'nova gradnja';
                break;
            case 'rekonstrukcija':
                $work = 'rekonstrukcija';
                break;
            case 'adaptacija':
                $work = 'adaptacija';
                break;
            case 'sanacija':
                $work = 'sanacija objekta';
                break;
            case 'promena_namene':
                $work = 'promena namene objekta';
                break;
            case 'dogradnja':
                $work = 'dogradnja objekta';
                break;
            case 'ozakonjenje':
                $work = 'ozakonjenje';
                break;
            case 'odrzavanje':
                $work = 'investiciono održavanje';
                break;
            default:
                $work = 'ostalo';
                break;
        }
        return $work;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectTypeOfWorksGen()
    {
        $work = null;
        switch($this->work){
            case 'nova_gradnja':
                $work = 'izgradnju';
                break;
            case 'rekonstrukcija':
                $work = 'rekonstrukciju';
                break;
            case 'adaptacija':
                $work = 'adaptaciju';
                break;
            case 'sanacija':
                $work = 'sanaciju';
                break;
            case 'promena_namene':
                $work = 'promenu namene';
                break;
            case 'dogradnja':
                $work = 'dogradnju';
                break;
            case 'ozakonjenje':
                $work = 'ozakonjenje';
                break;
            case 'odrzavanje':
                $work = 'investiciono održavanje';
                break;
            default:
                $work = 'ostalo';
                break;
        }
        return $work;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheckIfNewBuilding()
    {
        $work = null;
        switch($this->work){
            case 'nova_gradnja':
                $work = true;
                break;
            case 'rekonstrukcija':
                $work = true;
                break;
            case 'adaptacija':
                $work = false;
                break;
            case 'sanacija':
                $work = true;
                break;
            case 'promena_namene':
                $work = false;
                break;
            case 'dogradnja':
                $work = true;
                break;
            case 'ozakonjenje':
                $work = false;
                break;
            case 'odrzavanje':
                $work = true;
                break;
            default:
                $work = true;
                break;
        }
        return $work;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheckIfExistingBuilding()
    {
        $work = null;
        switch($this->work){
            case 'nova_gradnja':
                $work = false;
                break;
            case 'rekonstrukcija':
                $work = true;
                break;
            case 'adaptacija':
                $work = true;
                break;
            case 'sanacija':
                $work = true;
                break;
            case 'promena_namene':
                $work = true;
                break;
            case 'dogradnja':
                $work = true;
                break;
            case 'ozakonjenje':
                $work = true;
                break;
            case 'odrzavanje':
                $work = true;
                break;
            default:
                $work = true;
                break;
        }
        return $work;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintPhase()
    {
        return 'Koja faza Vam treba?<br>Ako želite da dobijete lokacijske uslove - IDR<br>
        Ako imate lokacijske uslove i želite da počnete sa gradnjom - PGD';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintWork()
    {
        return 'Koja vrsta radova se obavlja?';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintPractice()
    {
        return 'Projektant nije na listi? ' .\yii\helpers\Html::a('Dodaj novog projektanta', \yii\helpers\Url::to(['/practices/create']), ['target'=>'_blank']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintEngineer()
    {
        return 'Odgovorni/glavni projektant nije na listi? ' .\yii\helpers\Html::a('Dodaj novog projektanta', \yii\helpers\Url::to(['/engineers/create']), ['target'=>'_blank']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintControlPractice()
    {
        return 'Ovaj podatak je obavezan samo za Izvod iz projekta u fazi PGD. Vršilac tehničke kontrole nije na listi? ' .\yii\helpers\Html::a('Dodaj novog vršioca', \yii\helpers\Url::to(['/practices/create']), ['target'=>'_blank']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintControlEngineer()
    {
        return 'Ovaj podatak je obavezan samo za Izvod iz projekta u fazi PGD. Odgovorno lice vršioca tehničke kontrole nije na listi? ' .\yii\helpers\Html::a('Dodaj novog projektanta', \yii\helpers\Url::to(['/engineers/create']), ['target'=>'_blank']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintBuilderPractice()
    {
        return 'Ovaj podatak je obavezan samo za Izvod iz projekta u fazi PGD. Izvođač radova nije na listi? ' .\yii\helpers\Html::a('Dodaj novog izvođača radova', \yii\helpers\Url::to(['/practices/create']), ['target'=>'_blank']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintBuilderEngineer()
    {
        return 'Ovaj podatak je obavezan samo za Izvod iz projekta u fazi PGD. Odgovorno lice izvođača radova nije na listi? ' .\yii\helpers\Html::a('Dodaj odgovorno lice izvođača', \yii\helpers\Url::to(['/engineers/create']), ['target'=>'_blank']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintSupervisionPractice()
    {
        return 'Ovaj podatak je obavezan samo za Projekat izvedenog objekta PIO. Vršilac stručnog nadzora nije na listi? ' .\yii\helpers\Html::a('Dodaj novog vršioca', \yii\helpers\Url::to(['/practices/create']), ['target'=>'_blank']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintSupervisionEngineer()
    {
        return 'Ovaj podatak je obavezan samo za Izvod iz projekta u fazi PGD. Odgovorno lice vršioca stručnog nadzora nije na listi? ' .\yii\helpers\Html::a('Dodaj novog projektanta', \yii\helpers\Url::to(['/engineers/create']), ['target'=>'_blank']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintClient()
    {
        return 'Investitor nije na listi? ' .\yii\helpers\Html::a('Dodaj novog investitora', \yii\helpers\Url::to(['/clients/create']), ['target'=>'_blank']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintBuilding()
    {
        return 'Klasifikacija zgrada prema Pravilniku o klasifikaciji objekata.';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheckIfElaborat()
    {
        if($projectVolumes = $this->projectVolumes){
            foreach($projectVolumes as $projectVolume){
                if($projectVolume->volume->type=='elaborat'){
                    return true;
                    break;
                }
            }
        }
        return false;
    }    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrElaborata()
    {
        return \common\models\ProjectVolumes::find()->where('project_id='.$this->id.' and (volume_id="13" or volume_id="14" or volume_id="15")')->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProstorniplan()
    {
        return \common\models\ProjectFiles::find()->where('project_id='.$this->id.' and type="prostorniplan"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLokacijskiUslovi()
    {
        return \common\models\ProjectFiles::find()->where('project_id='.$this->id.' and type="uslovi"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaglasnosti()
    {
        return \common\models\ProjectFiles::find()->where('project_id='.$this->id.' and type="saglasnost"')->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInformacijaOLokaciji()
    {
        return \common\models\ProjectFiles::find()->where('project_id='.$this->id.' and type="informacija"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKopijaPlana()
    {
        return \common\models\ProjectFiles::find()->where('project_id='.$this->id.' and type="plana"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getListNepokretnosti()
    {
        return \common\models\ProjectFiles::find()->where('project_id='.$this->id.' and type="svojina"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGeodetski()
    {
        return \common\models\ProjectFiles::find()->where('project_id='.$this->id.' and type="geodetski"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResenjeOOdobrenjuRadova()
    {
        return \common\models\ProjectFiles::find()->where('project_id='.$this->id.' and type="odobrenje"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGraDozvola()
    {
        return \common\models\ProjectFiles::find()->where('project_id='.$this->id.' and type="dozvola"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKATPlan()
    {
        return \common\models\ProjectFiles::find()->where('project_id='.$this->id.' and type="katplan"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpotrebnaDozvola()
    {
        return \common\models\ProjectFiles::find()->where('project_id='.$this->id.' and type="upotrebna"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResenjeOObelezavanjuParcele()
    {
        return \common\models\ProjectFiles::find()->where('project_id='.$this->id.' and type="obelparcele"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPotvrdaOFormiranjuParcele()
    {
        return \common\models\ProjectFiles::find()->where('project_id='.$this->id.' and type="formparcele"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrijavaRadova()
    {
        return \common\models\ProjectFiles::find()->where('project_id='.$this->id.' and type="prijava"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaglasnostVlasnika()
    {
        return \common\models\ProjectFiles::find()->where('project_id='.$this->id.' and type="vlasnici"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKatastarVodova()
    {
        return \common\models\ProjectFiles::find()->where('project_id='.$this->id.' and type="vodovi"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjekatPreparcelacije()
    {
        return \common\models\ProjectFiles::find()->where('project_id='.$this->id.' and type="preparcelacija"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEnergetskaDozvola()
    {
        return \common\models\ProjectFiles::find()->where('project_id='.$this->id.' and type="energetska"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUplatnice()
    {
        return \common\models\ProjectFiles::find()->where('project_id='.$this->id.' and type="uplatnica"')->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUgovori()
    {
        return \common\models\ProjectFiles::find()->where('project_id='.$this->id.' and type="ugovor"')->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZalbe()
    {
        return \common\models\ProjectFiles::find()->where('project_id='.$this->id.' and type="zalba"')->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResenja()
    {
        return \common\models\ProjectFiles::find()->where('project_id='.$this->id.' and type="resenje"')->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSlike()
    {
        return \common\models\ProjectImages::find()->where('project_id='.$this->id)->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTehnickaKontrola()
    {
        return \common\models\ProjectVolumes::find()->where('project_id='.$this->id.' and volume_id=18')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getPhasesOfWork($work)
    {
        $phases = [];
        switch($work){
            case 'nova_gradnja':
                $phases = ['idr', 'pgd', 'pzi', 'pio'];
                break;
            case 'rekonstrukcija':
                $phases = ['idr', 'pgd', 'pzi', 'pio'];
                break;
            case 'adaptacija':
                $phases = ['idp'];
                break;
            case 'sanacija':
                $phases = ['idr', 'pgd', 'pzi', 'pio'];
                break;
            case 'promena_namene':
                $phases = ['idp'];
                break;
            case 'dogradnja':
                $phases = ['idr', 'pgd', 'pzi', 'pio'];
                break;
            case 'ozakonjenje':
                $phases = ['idp'];
                break;
            case 'odrzavanje':
                $phases = ['idp'];
                break;
            default:
                $phases = ['gnp', 'idr', 'idp', 'pgd', 'pzi', 'pio'];
                break;
        }
        return $phases;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function getProjectPhaseFullname($phase_name)
    {
        $phase = null;
        switch($phase_name){
            case 'gnp':
                $phase = 'Generalni projekat (GNP)';
                break;
            case 'idr':
                $phase = 'Idejno rešenje (IDR)';
                break;
            case 'idp':
                $phase = 'Idejni projekat (IDP)';
                break;
            case 'pgd':
                $phase = 'Projekat za građevinsku dozvolu (PGD)';
                break;
            case 'pzi':
                $phase = 'Projekat za izvođenje (PZI)';
                break;
            case 'pio':
                $phase = 'Projekat izvedenog objekta (PIO)';
                break;
            default:
                $phase = 'Tehnička kontrola projekta (TKP)';
                break;
        }
        return $phase;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public static function phases($work)
    {
        $res = \common\models\Projects::getPhasesOfWork($work);            
        foreach($res as $key=>$r){
            $out[$key]['id'] = $r;
            $out[$key]['name'] =\common\models\Projects::getProjectPhaseFullname($r);
        }
        return $out;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjekatArhitekture()
    {
        $arh = \common\models\ProjectVolumes::find()->where('project_id='.$this->id.' and volume_id=2')->one();
        return $arh ? $arh : null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectQsWorks()
    {
        $pqw = [];

        $works = \common\models\QsWorks::find()->all();
        foreach($works as $work){
            if(count($work->posOfProject($this->id))>0){
                $pqw[] = $work;
            }                           
        }
        return $pqw;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectDistinctWorks()
    {
        return \common\models\ProjectQs::find()->select('work_id')->where('project_id='.$this->id)->distinct()->orderBy('work_id')->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectDistinctSubworks($work)
    {
        return \common\models\ProjectQs::find()->select('subwork_id')->where('project_id='.$this->id. ' and work_id='.$work)->distinct()->orderBy('work_id, subwork_id')->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectDistinctPositions($subwork)
    {
        return \common\models\ProjectQs::find()->where('project_id='.$this->id. ' and subwork_id='.$subwork)->distinct()->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectWorkPositions($work)
    {
        return \common\models\ProjectQs::find()->where('project_id='.$this->id. ' and work_id='.$work)->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectWorkTotalPrice($work)
    {
        $total = 0;
        if($this->getProjectWorkPositions($work)){
            foreach ($this->getProjectWorkPositions($work) as $key => $pos) {
                $total += ($pos->position->price*$this->exchange*$pos->qty);
            }
        }
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectTotalPrice()
    {
        $total = 0;
        if($t = $this->getProjectDistinctWorks()){
            foreach ($t as $woo) {
                $total += $this->getProjectWorkTotalPrice($woo->work_id);
            }
        }
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSetupRedirect()
    {
        $setup = [];
        $type = $this->type;
        $presentation = $type=='presentation' ? true : false;
        $building = $this->projectBuilding ?: $this->projectExBuilding;
        switch($this->setup_status){
            case 'clients':
                $setup = '/project-clients/create?ProjectClients[project_id]='.$this->id; // project-clients
                break;
            case 'docs':
                $setup = '/project-files/create?ProjectFiles[project_id]='.$this->id; // project-files
                break;
            case 'pics':
                $setup = '/project-images/create?ProjectImages[project_id]='.$this->id; // project-images
                break;
            case 'volumes':
                $setup = '/project-volumes/index?ProjectVolumesSearch[project_id]='.$this->id; // project-volumes
                break;
            case 'address':
                $setup = '/project-lot/location?id='.$this->id; // project-lot/location
                break;
            case 'project_lot':
                $setup = '/project-lot/update?id='.$this->id; // project-lot
                break;
            case 'lots':
                $setup = '/location-lots/index?LocationLots[project_id]='.$this->id; // location-lots
                break;
            case 'existing_buildings':
                $setup = '/project-lot-existing-buildings/index?id='.$this->id; // project-lot-existing-buildings
                break;
            case 'future_devs':
                $setup = '/project-lot-future-developments/index?id='.$this->id; // project-lot-future-developments
                break;
            case 'building':
                $setup = '/project-building/update?id='.$building->id; // project-building
                break;
            case 'storeys_ex':
                $setup = '/project-building/storeys?id='.$this->projectExBuilding->id; // project-building-storeys/index
                break;
            /*case 'units_ex_init':
                $setup = ''; // project-building-storey-parts/init
                break;*/
            case 'units_ex':
                $setup = ''; // project-building-storey-parts/index
                break;
            /*case 'rooms_ex_init':
                $setup = ''; // project-building-storey-part-rooms/init
                break;*/
            case 'rooms_ex':
                $setup = ''; // project-building-storey-part-rooms/index
                break;
            case 'storeys_new':
                $setup = '/project-building/storeys?id='.$this->projectBuilding->id; // project-building-storeys/index
                break;
            /*case 'units_new_init':
                $setup = ''; // project-building-storey-parts/init
                break;*/
            case 'units_new':
                $setup = ''; // project-building-storey-parts/index
                break;
            /*case 'rooms_new_init':
                $setup = ''; // project-building-storey-part-rooms/init
                break;*/
            case 'rooms_new':
                $setup = ''; // project-building-storey-part-rooms/index
                break;
            case 'classes':
                $setup = '/project-building-classes/index?ProjectBuildingClasses[project_building_id]='.$building->id; // project-building-classes
                break;
            case 'heights':
                $setup = '/project-building-heights/index?ProjectBuildingHeights[project_building_id]='.$building->id; // project-building-heights
                break;
            default:
                $setup = '';
                break;
        }
        return $setup;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSetupStep()
    {
        $setup = null;
        $type = $this->type;
        $presentation = $type=='presentation' ? true : false;
        switch($this->setup_status){
            case 'clients':
                $setup = 2; // project-clients
                break;
            case 'docs':
                $setup = 3; // project-files
                break;
            case 'pics':
                $setup = 4; // project-images
                break;
            case 'volumes':
                $setup = 5; // project-volumes
                break;
            case 'address':
                $setup = 6; // project-lot/location
                break;
            case 'project_lot':
                $setup = 7; // project-lot
                break;
            case 'lots':
                $setup = 8; // location-lots
                break;
            case 'existing_buildings':
                $setup = 9; // project-lot-existing-buildings
                break;
            case 'future_devs':
                $setup = 10; // project-lot-future-developments
                break;
            case 'building':
                $setup = 11; // project-building
                break;            
            /*case 'storeys_ex_init':
                $setup = 12; // project-building-storeys/init
                break;*/
            case 'storeys_ex':
                $setup = 13; // project-building-storeys/index
                break;
            /*case 'units_ex_init':
                $setup = 14; // project-building-storey-parts/init
                break;*/
            case 'units_ex':
                $setup = 15; // project-building-storey-parts/index
                break;
            /*case 'rooms_ex_init':
                $setup = 16; // project-building-storey-part-rooms/init
                break;*/
            case 'rooms_ex':
                $setup = 17; // project-building-storey-part-rooms/index
                break;
            /*case 'storeys_new_init':
                $setup = 18; // project-building-storeys/init
                break;*/
            case 'storeys_new':
                $setup = 19; // project-building-storeys/index
                break;
           /* case 'units_new_init':
                $setup = 20; // project-building-storey-parts/init
                break;*/
            case 'units_new':
                $setup = 21; // project-building-storey-parts/index
                break;
            /*case 'rooms_new_init':
                $setup = 22; // project-building-storey-part-rooms/init
                break;*/
            case 'rooms_new':
                $setup = 23; // project-building-storey-part-rooms/index
                break;
            case 'classes':
                $setup = 24; // project-building-classes
                break;
            case 'heights':
                $setup = 25; // project-building-heights
                break;
            default:
                $setup = 1;
                break;
        }
        return $setup;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSetupIcon($step)
    {
        if($this->setupStep>$step){
            return '<i class="fa fa-check fa-lg green"></i>';
        } elseif($this->setupStep==$step) {

            return '<i class="fa fa-play fa-lg white"></i>';
        } else {
            return '<i class="fa fa-step-forward fa-lg hint"></i>';
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSetupCheck($step)
    {
        if($this->setupStep>$step){
            return 'is-done';
        } elseif($this->setupStep==$step) {
            return 'current';
        }
        return null;        
    }
}
