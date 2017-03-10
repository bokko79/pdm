<?php

namespace common\models;

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * This is the model class for table "project_volumes".
 *
 * @property string $id
 * @property string $project_id
 * @property string $volume_id
 * @property string $practice_id
 * @property string $engineer_id
 * @property string $engineer_licence_id
 * @property string $number
 * @property string $name
 * @property string $code
 * @property string $control_practice_id
 * @property string $control_engineer_id
 * @property string $control_engineer_licence_id
 * @property string $control_text
 * @property string $time
 *
 * @property Projects $project
 * @property Volumes $volume
 * @property Practices $practice
 * @property Engineers $engineer
 * @property Practices $controlPractice
 * @property Engineers $controlEngineer
 * @property EngineerLicences $engineerLicence
 * @property EngineerLicences $controlEngineerLicence
 */
class ProjectVolumes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_volumes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'volume_id', 'practice_id', 'engineer_licence_id', 'code'], 'required'],
            [['project_id', 'volume_id', 'practice_id', 'engineer_id', 'engineer_licence_id', 'control_practice_id', 'control_engineer_id', 'control_engineer_licence_id', 'time'], 'integer'],
            [['number'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 64],
            [['code', 'control_code'], 'string', 'max' => 20],
            [['control_text'], 'string'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['volume_id'], 'exist', 'skipOnError' => true, 'targetClass' => Volumes::className(), 'targetAttribute' => ['volume_id' => 'id']],
            [['practice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Practices::className(), 'targetAttribute' => ['practice_id' => 'id']],
            [['engineer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Engineers::className(), 'targetAttribute' => ['engineer_id' => 'id']],
            [['control_practice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Practices::className(), 'targetAttribute' => ['control_practice_id' => 'id']],
            [['control_engineer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Engineers::className(), 'targetAttribute' => ['control_engineer_id' => 'id']],
            [['engineer_licence_id'], 'exist', 'skipOnError' => true, 'targetClass' => EngineerLicences::className(), 'targetAttribute' => ['engineer_licence_id' => 'id']],
            [['control_engineer_licence_id'], 'exist', 'skipOnError' => true, 'targetClass' => EngineerLicences::className(), 'targetAttribute' => ['control_engineer_licence_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'project_id' => Yii::t('app', 'Projekat'),
            'volume_id' => Yii::t('app', 'Sveska (deo projekta)'),
            'practice_id' => Yii::t('app', 'Odgovorni projektant'),
            'engineer_id' => Yii::t('app', 'Odgovorni/glavni projektant'),
            'engineer_licence_id' => Yii::t('app', 'Licenca odgovornog projektanta'),
            'number' => Yii::t('app', 'Redni broj sveske'),
            'name' => Yii::t('app', 'Naziv sveske (dela projekta)'),
            'code' => Yii::t('app', 'Broj projektne dokumentacije (dela projekta)'),
            'control_practice_id' => Yii::t('app', 'Vršilac tehničke kontrole'),
            'control_engineer_id' => Yii::t('app', 'Odgovorno lice vršioca tehničke kontrole'),
            'control_engineer_licence_id' => Yii::t('app', 'Licenca vršioca tehničke kontrole'),
            'control_text' => Yii::t('app', 'Rezime izveštaja o tehničkoj kontroli'),
            'control_code' => Yii::t('app', 'Broj tehničke kontrole'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVolume()
    {
        return $this->hasOne(Volumes::className(), ['id' => 'volume_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPractice()
    {
        return $this->hasOne(Practices::className(), ['id' => 'practice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEngineer()
    {
        // return $this->hasOne(Engineers::className(), ['id' => 'engineer_id']);
        return $this->engineerLicence ? $this->engineerLicence->engineer : null;
    } 

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControlPractice()
    {
        return $this->hasOne(Practices::className(), ['id' => 'control_practice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControlEngineer()
    {
        //return $this->hasOne(Engineers::className(), ['id' => 'control_engineer_id']);
        return $this->controlEngineerLicence ? $this->controlEngineerLicence->engineer : null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEngineerLicence()
    {
        return $this->hasOne(EngineerLicences::className(), ['id' => 'engineer_licence_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControlEngineerLicence()
    {
        return $this->hasOne(EngineerLicences::className(), ['id' => 'control_engineer_licence_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectVolumeDrawings()
    {
        return $this->hasMany(ProjectVolumeDrawings::className(), ['project_volume_id' => 'id'])->orderBy('CAST(number AS INTEGER)');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintProject()
    {
        return 'Projekat nije kreiran? ' .\yii\helpers\Html::a('Dodaj novi projekat', \yii\helpers\Url::to(['/projects/create']));
    }   

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintPractice()
    {
        return 'Projektant nije na listi? ' .\yii\helpers\Html::a('Dodaj novog projektanta', \yii\helpers\Url::to(['/practices/create']));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintEngineer()
    {
        return 'Odgovorni/glavni projektant nije na listi? ' .\yii\helpers\Html::a('Dodaj novog projektanta', \yii\helpers\Url::to(['/engineers/create']));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintControlPractice()
    {
        return 'Ovaj podatak je obavezan samo za Izvod iz projekta u fazi PGD. Vršilac tehničke kontrole nije na listi? ' .\yii\helpers\Html::a('Dodaj novog vršioca', \yii\helpers\Url::to(['/practices/create']));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintControlEngineer()
    {
        return 'Ovaj podatak je obavezan samo za Izvod iz projekta u fazi PGD. Odgovorno lice vršioca tehničke kontrole nije na listi? ' .\yii\helpers\Html::a('Dodaj novog projektanta', \yii\helpers\Url::to(['/engineers/create']));
    } 

    /**
     * @return \yii\db\ActiveQuery
     */
    public function dataReqs()
    {  
        $content = '';
        $project = $this->project;
        $phase = $project->phase;
        //$type = $project->type;
        $building = $project->projectBuilding;
        //$class = $building->class;      
        //if($this->volume_id==1){ // ako je glavna sveska
            // general requirements
            // project 
            if($project->phase==null or $project->name==null or $project->code==null or $project->work==null){
                $content .= '<i class="fa fa-exclamation-circle"></i> Osnovni podaci projekta nisu navedeni (faza, naziv, vrsta radova i/ili broj tehničke dokumentacije). '.Html::a('<i class="fa fa-wrench"></i> Podešavanje', Url::to(['/projects/update', 'id'=>$project->id]), ['target'=>'_blank']). '<br>';
                //return false;
            }
            if(!$project->location){
                $content .= '<i class="fa fa-exclamation-circle"></i> Lokacija projekta nije podešena. '.Html::a('<i class="fa fa-wrench"></i> Podešavanje', Url::to(['/projects/update', 'id'=>$project->id]), ['target'=>'_blank']). '<br>';
                //return false;
            } else {
                if(!$project->location->city){
                    $content .= '<i class="fa fa-exclamation-circle"></i> Lokacija mora sadržati bar grad. '.Html::a('<i class="fa fa-wrench"></i> Podešavanje', Url::to(['/projects/update', 'id'=>$project->id]), ['target'=>'_blank']). '<br>';
                    //return false;
                }
                if(!$project->location->locationLots){
                    $content .= '<i class="fa fa-exclamation-circle"></i> Lokacija mora sadržati broj parcele. '.Html::a('<i class="fa fa-wrench"></i> Podešavanje', Url::to(['/projects/update', 'id'=>$project->id]), ['target'=>'_blank']). '<br>';
                    //return false;
                }
                if(!$project->location->county0){
                    $content .= '<i class="fa fa-exclamation-circle"></i> Lokacija mora sadržati katastarsku opštinu. '.Html::a('<i class="fa fa-wrench"></i> Podešavanje', Url::to(['/projects/update', 'id'=>$project->id]), ['target'=>'_blank']). '<br>';
                    //return false;
                }
            }
            // volume
            if($this->number==null or $this->name==null or $this->code==null){
                $content .= '<i class="fa fa-exclamation-circle"></i> Osnovni podaci dela projekta nisu navedeni (redni broj, naziv i/ili broj tehničke dokumentacije). '.Html::a('<i class="fa fa-wrench"></i> Podešavanje', Url::to(['/project-volumes/update', 'id'=>$this->id]), ['target'=>'_blank']). '<br>';
                //return false;
            }

            // investitor
            if(!$project->projectClients){
                $content .= '<i class="fa fa-exclamation-circle"></i> Investitor projekta nije naveden. '.Html::a('<i class="fa fa-plus-circle"></i> Odredi projektnog investitora', Url::to(['/project-clients/create', 'ProjectClients[project_id]'=>$project->id]), ['target'=>'_blank']). '<br>';
                //return false;
            } else {
                // podaci investitora nedostaju
                if($project->client->type=='company' and !$project->client->stamp){
                    $content .= '<i class="fa fa-exclamation-circle"></i> Nedostaje pečat investitora. '.Html::a('<i class="fa fa-wrench"></i> Dodaj pečat investitora', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$this->practice->id, 'LegalFilesSearch[entity]'=>'client', 'LegalFilesSearch[type]'=>'company_stamp']), ['target'=>'_blank']). '<br>';
                    //return false;
                }
                if(!$project->client->signature){
                    $content .= '<i class="fa fa-exclamation-circle"></i> Nedostaje potpis investitora. '.Html::a('<i class="fa fa-wrench"></i> Dodaj potpis investitora', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$this->practice->id, 'LegalFilesSearch[entity]'=>'client', 'LegalFilesSearch[type]'=>'signature']), ['target'=>'_blank']). '<br>';
                    //return false;
                }
                if(!$project->client->location->city){
                    $content .= '<i class="fa fa-exclamation-circle"></i> Adresa investitora mora sadržati bar grad. '.Html::a('<i class="fa fa-wrench"></i> Podešavanje', Url::to(['/clients/update', 'id'=>$project->client_id]), ['target'=>'_blank']). '<br>';
                    //return false;
                }
                if(!$project->client->type=='company' and $project->client->contact_person){
                    $content .= '<i class="fa fa-exclamation-circle"></i> Odgovorno lice investitora mora biti navedeno. '.Html::a('<i class="fa fa-wrench"></i> Podešavanje', Url::to(['/clients/update', 'id'=>$project->client_id]), ['target'=>'_blank']). '<br>';
                    //return false;
                }
            }
            // projektant
            if(!$this->practice){
                $content .= '<i class="fa fa-exclamation-circle"></i> Projektant nije naveden. '.Html::a('<i class="fa fa-wrench"></i> Odredi projektanta', Url::to(['/project-volumes/update', 'id'=>$this->id]), ['target'=>'_blank']). '<br>';
                //return false;
            } else {
                // podaci projektanta
                if(!$this->practice->stamp){
                    $content .= '<i class="fa fa-exclamation-circle"></i> Nedostaje pečat projektanta. '.Html::a('<i class="fa fa-wrench"></i> Dodaj pečat projektanta', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$this->practice->id, 'LegalFilesSearch[entity]'=>'practice', 'LegalFilesSearch[type]'=>'company_stamp']), ['target'=>'_blank']). '<br>';
                    //return false;
                }
                if(!$this->practice->signature){
                    $content .= '<i class="fa fa-exclamation-circle"></i> Nedostaje potpis odgovornog licenca projektanta. '.Html::a('<i class="fa fa-wrench"></i> Dodaj potpis odgovornog lica projektanta', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$this->practice->id, 'LegalFilesSearch[entity]'=>'practice', 'LegalFilesSearch[type]'=>'signature']), ['target'=>'_blank']). '<br>';
                    //return false;
                }
                if(!$this->practice->location->city){
                    $content .= '<i class="fa fa-exclamation-circle"></i> Adresa projektanta mora sadržati bar grad. '.Html::a('<i class="fa fa-wrench"></i> Podešavanje', Url::to(['/practices/update', 'id'=>$this->practice_id]), ['target'=>'_blank']). '<br>';
                    //return false;
                }
                if(!$this->practice->director){
                    $content .= '<i class="fa fa-exclamation-circle"></i> Odgovorno lice projektanta nije navedeno. '.Html::a('<i class="fa fa-wrench"></i> Podešavanje', Url::to(['/practices/update', 'id'=>$this->practice_id]), ['target'=>'_blank']). '<br>';
                    //return false;
                }
            }
            // glavni projektant
            if(!$this->engineer){
                $content .= '<i class="fa fa-exclamation-circle"></i> Glavni projektant nije naveden. '.Html::a('<i class="fa fa-wrench"></i> Odredi glavnog projektanta', Url::to(['/project-volumes/update', 'id'=>$this->id]), ['target'=>'_blank']). '<br>';
                //return false;
            } else {
                // podaci glavnog projektanta
                // licenca
                if(!$this->engineer_licence_id){
                    $content .= '<i class="fa fa-exclamation-circle"></i> Licenca glavnog projektanta ne postoji. '.Html::a('<i class="fa fa-wrench"></i> Dodaj licence glavnog projektanta', Url::to(['/engineer-licences/create', 'EngineerLicences[engineer_id]'=>$this->engineer->id]), ['target'=>'_blank']). '<br>';
                    //return false;
                } else {
                    // podaci licence broj i pecat
                    if(!$this->engineerLicence->no or !$this->engineerLicence->stamp){
                        $content .= '<i class="fa fa-exclamation-circle"></i> Licenca glavnog projektanta nije podešena. '.Html::a('<i class="fa fa-wrench"></i> Podešavanje licencnog paketa glavnog projektanta', Url::to(['/engineer-licences/update', 'id'=>$this->engineer_licence_id]), ['target'=>'_blank']). '<br>';
                        //return false;
                    }
                }
            }
        //}
        $content ? \Yii::$app->session->setFlash('danger', $content) : null;
        //return false;
    }  

    /**
     * @return \yii\db\ActiveQuery
     */
    public function dataReqsGlavnaSveska()
    {  
        $content = '';
        $project = $this->project;
        $phase = $project->phase;
        //$type = $project->type;
        $building = $project->projectBuilding;
        //$class = $building->class;      
        if($this->volume_id==1){ // ako je glavna sveska
            // project 
            if($project->phase==null or $project->name==null or $project->code==null or $project->work==null){
                $content .= '<i class="fa fa-exclamation-circle"></i> Osnovni podaci projekta nisu navedeni (faza, naziv, vrsta radova i/ili broj tehničke dokumentacije). '.Html::a('<i class="fa fa-wrench"></i> Podešavanje', Url::to(['/projects/update', 'id'=>$project->id]), ['target'=>'_blank']). '<br>';
                //return false;
            }  
            // u pio fazi, mora biti izvodjac i strucni nadzor, i svi moraju imati licence i pecate
            // ako nije idr, mora imati projektni zadatak
            // za sve projekte i elaborate, mora imati unete projektante, odg lice i pecat, potpis i br licence
            // osnovni podaci o lokaciji i objektu:
                // tip objekta, klasa 
                // prostorni plan
                // parcele
                // priključci na infrastrukturu: u IDR projektovani, u IDR, PGD dati, u PIO ostvareni
                // ako nije IDR, lokacijski uslovi i saglasnoti

            // osnovni podaci o objektu
                // ProjectLot->area, green_area_reg, green_area
                // gross_area_part, ako je član 145.
                // grossArea, grossAboveArea, grossBelowArea, netArea, pr->netArea, pr->gross_area, occupancy, spratnost, projectBuildingHeights, absoluteHeight, absoluteLevel, storey_height()given, ridge_orientation, roof_pitch, 
                // projectBuildingMaterials->facade, projectBuildingMaterials->roofing
        }
        $content ? \Yii::$app->session->setFlash('danger', $content) : null;
        //return false;
    }  
}
