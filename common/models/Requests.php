<?php

namespace common\models;

use Yii;
use yii\imagine\Image;

/**
 * This is the model class for table "requests".
 *
 * @property string $id
 * @property string $client_id
 * @property string $building_id
 * @property string $location_id
 * @property string $object_type
 * @property string $work
 * @property string $object_area
 * @property string $phase
 * @property string $lot_area
 * @property string $description
 *
 * @property RequestComments[] $requestComments
 * @property RequestFiles[] $requestFiles
 * @property Clients $client
 * @property BuildingTypes $building
 * @property Locations $location
 */
class Requests extends \yii\db\ActiveRecord
{
    public $docFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'requests';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['client_id', 'building_id', 'location_id', 'work', 'object_area', 'phase'], 'required'],
            [['client_id', 'building_id', 'location_id', 'time'], 'integer'],
            [['object_type', 'work', 'phase', 'description', 'status'], 'string'],
            [['object_area', 'lot_area'], 'number'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['client_id' => 'user_id']],
            [['building_id'], 'exist', 'skipOnError' => true, 'targetClass' => BuildingTypes::className(), 'targetAttribute' => ['building_id' => 'id']],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::className(), 'targetAttribute' => ['location_id' => 'id']],
            [['object_type'], 'required', 'when' => function ($model) {
                                                return $model->work == 'adaptacija';
                                            }, 'whenClient' => "function (attribute, value) {
                                                return $('#work-id').val() == 'adaptacija';
                                            }"],
            [['docFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif, pdf'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'client_id' => Yii::t('app', 'Investitor'),
            'building_id' => Yii::t('app', 'Vrsta objekta'),
            'location_id' => Yii::t('app', 'Adresa'),
            'object_type' => Yii::t('app', 'Vrsta objekta/jedinice'),
            'work' => Yii::t('app', 'Vrsta radova'),
            'object_area' => Yii::t('app', 'Površina objekta'),
            'phase' => Yii::t('app', 'Vrsta projekta'),
            'lot_area' => Yii::t('app', 'Površina parcele'),
            'description' => Yii::t('app', 'Opis zahteva'),
        ];
    }

    public function uploadFiles()
    {
        if ($this->validate()) {
           
            $fileName = $this->id . '_' . time();            
            if($this->docFile->extension!='pdf'){
                $this->docFile->saveAs('images/request_files/'. $fileName . '1.' . $this->docFile->extension); 
            } else {
                $this->docFile->saveAs('images/request_files/'. $fileName . '.' . $this->docFile->extension);
            }        
            
            $image = new \common\models\Files();
            $image->name = $fileName . '.' . $this->docFile->extension;
            $image->type = ($this->docFile->extension!='pdf') ? 'jpg' : 'pdf';
            $image->time = time();
            
            if($this->docFile->extension!='pdf'){
                $thumb = 'images/request_files/'.$fileName.'1.'.$this->docFile->extension;
                Image::thumbnail($thumb, 800, 640)->save(\Yii::getAlias('images/request_files/'.$fileName.'.'.$this->docFile->extension), ['quality' => 80]); 
                unlink(\Yii::getAlias($thumb));
            }  
            $image->save();

            if($image->save()){
                $this->docFile = null;
                return $image->id;
            }
            
            return false;
        }
        return false;        
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestComments()
    {
        return $this->hasMany(RequestComments::className(), ['request_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestFiles()
    {
        return $this->hasMany(RequestFiles::className(), ['request_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['user_id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuilding()
    {
        return $this->hasOne(BuildingTypes::className(), ['id' => 'building_id']);
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
    public function getPhaseGen()
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
    public function getTypeOfWork()
    {
        $work = null;
        switch($this->work){
            case 'nova_gradnja':
                $work = 'izgradnja';
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
    public function getTypeOfWorkGen()
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
    public function getObject()
    {
        $type = null;
        switch($this->object_type){
            case 'building':
                $type = 'objekat';
                break;
            case 'stan':
                $type = 'stambena jedinica';
                break;
            case 'biz':
                $type = 'poslovni prostor';
                break;
            default:
                $type = 'jedinica';
                break;
        }
        return $type;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectGen()
    {
        $type = null;
        switch($this->object_type){
            case 'building':
                $type = 'objekta';
                break;
            case 'stan':
                $type = 'stambene jedinice';
                break;
            case 'biz':
                $type = 'poslovnog prostora';
                break;
            default:
                $type = 'jedinice';
                break;
        }
        return $type;
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
    public function getHintBuilding()
    {
        return 'Klasifikacija zgrada prema Pravilniku o klasifikaciji objekata.';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFullname()
    {
        return $this->typeOfWork. ' '.$this->objectGen.': '.$this->building->name;
    }
}
