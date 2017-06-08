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
            [['practice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Practices::className(), 'targetAttribute' => ['practice_id' => 'engineer_id']],
            [['engineer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Engineers::className(), 'targetAttribute' => ['engineer_id' => 'user_id']],
            [['control_practice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Practices::className(), 'targetAttribute' => ['control_practice_id' => 'engineer_id']],
            [['control_engineer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Engineers::className(), 'targetAttribute' => ['control_engineer_id' => 'user_id']],
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
        return $this->hasOne(Practices::className(), ['engineer_id' => 'practice_id']);
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
        return $this->hasOne(Practices::className(), ['engineer_id' => 'control_practice_id']);
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
        return $this->hasMany(ProjectVolumeDrawings::className(), ['project_volume_id' => 'id'])->orderBy('CAST(number AS UNSIGNED)');
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
        $check = true;
        $content = ['info'=>'', 'success'=>'', 'danger'=>'', 'warning'=>''];
        $project = $this->project;
        $phase = $project->phase;
        //$type = $project->type;
        $building = $project->projectBuilding ? $project->projectBuilding : $project->projectExBuilding;
        //$class = $building->class;      
        
        // general requirements
        // project 
        if($project->phase==null or $project->name==null or $project->code==null or $project->work==null){
            $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Osnovni podaci projekta nisu navedeni (faza, naziv, vrsta radova i/ili broj tehničke dokumentacije). '.Html::a('<i class="fa fa-wrench"></i> Podešavanje.', Url::to(['/projects/update', 'id'=>$project->id]), ['target'=>'_blank']). '</p>';
            //return false;
            $check = false;
        } else {
            $content['success'] .= '<p><i class="fa fa-check-circle"></i> Osnovni podaci projekta su OK.</p>';
        }
        if(!$project->location){
            $content .= '<p><i class="fa fa-exclamation-circle"></i> Lokacija projekta nije podešena. '.Html::a('<i class="fa fa-wrench"></i> Podešavanje.', Url::to(['/projects/update', 'id'=>$project->id]), ['target'=>'_blank']). '</p>';
            //return false;
            $check = false;
        } else {
            if(!$project->location->city){
                $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Lokacija mora sadržati bar grad. '.Html::a('<i class="fa fa-wrench"></i> Podešavanje.', Url::to(['/projects/update', 'id'=>$project->id]), ['target'=>'_blank']). '</p>';
                //return false;
                $check = false;
            }
            if(!$project->location->locationLots){
                $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Lokacija mora sadržati broj parcele. '.Html::a('<i class="fa fa-wrench"></i> Podešavanje.', Url::to(['/projects/update', 'id'=>$project->id]), ['target'=>'_blank']). '</p>';
                //return false;
                $check = false;
            }
            if(!$project->location->county0){
                $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Lokacija mora sadržati katastarsku opštinu. '.Html::a('<i class="fa fa-wrench"></i> Podešavanje.', Url::to(['/projects/update', 'id'=>$project->id]), ['target'=>'_blank']). '</p>';
                //return false;
                $check = false;
            }
            if($project->location->city and $project->location->locationLots and $project->location->county0){
                $content['success'] .= '<p><i class="fa fa-check-circle"></i> Lokacija projekta je OK.</p>';
            }
        }
        // volume
        if(($this->number==null or $this->name==null or $this->code==null) and ($this->volume->type!='elaborat' and $this->volume->type!='izvod')){
            $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Osnovni podaci dela projekta nisu navedeni (redni broj, naziv i/ili broj tehničke dokumentacije). '.Html::a('<i class="fa fa-wrench"></i> Podešavanje.', Url::to(['/project-volumes/update', 'id'=>$this->id]), ['target'=>'_blank']). '</p>';
            //return false;
            $check = false;
        } else {
            $content['success'] .= '<p><i class="fa fa-check-circle"></i> Osnovni podaci ove sveske ('.$this->name.') su OK.</p>';
        }

        // investitor
        if(!$project->projectClients){
            $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Investitor projekta nije naveden. '.Html::a('<i class="fa fa-plus-circle"></i> Odredi projektnog investitora.', Url::to(['/project-clients/create', 'ProjectClients[project_id]'=>$project->id]), ['target'=>'_blank']). '</p>';
            //return false;
            $check = false;
        } else {
            // podaci investitora nedostaju
            if($project->client->type=='company' and !$project->client->stamp and ($project->phase=='idp' or $project->phase=='pgd' or $project->phase=='pzi' or $project->phase=='pio')){
                $content['info'] .= '<p><i class="fa fa-exclamation-circle"></i> Nedostaje pečat investitora. '.Html::a('<i class="fa fa-wrench"></i> Dodaj pečat investitora.', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$project->client->id, 'LegalFilesSearch[entity]'=>'client', 'LegalFilesSearch[type]'=>'company_stamp']), ['target'=>'_blank']). '</p>';
                //return false;
                $check = false;
            }
            if(!$project->client->signature){
                $content['info'] .= '<p><i class="fa fa-exclamation-circle"></i> Nedostaje potpis investitora. '.Html::a('<i class="fa fa-wrench"></i> Dodaj potpis investitora.', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$project->client->id, 'LegalFilesSearch[entity]'=>'client', 'LegalFilesSearch[type]'=>'signature']), ['target'=>'_blank']). '</p>';
                //return false;
                $check = false;
            }
            if(!$project->client->location->city){
                $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Adresa investitora mora sadržati bar grad. '.Html::a('<i class="fa fa-wrench"></i> Podešavanje.', Url::to(['/clients/update', 'id'=>$project->client_id]), ['target'=>'_blank']). '</p>';
                //return false;
                $check = false;
            }
            if($project->client->type=='company' and !$project->client->contact_person){
                $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Odgovorno lice investitora mora biti navedeno. '.Html::a('<i class="fa fa-wrench"></i> Podešavanje.', Url::to(['/clients/update', 'id'=>$project->client_id]), ['target'=>'_blank']). '</p>';
                //return false;
                $check = false;
            }
            if($project->client->type=='company' and $project->client->stamp and ($project->phase=='idp' or $project->phase=='pgd' or $project->phase=='pzi' or $project->phase=='pio') and $project->client->signature and $project->client->location->city and $project->client->contact_person){
                $content['success'] .= '<p><i class="fa fa-check-circle"></i> Podaci o investitorima projekta su OK.</p>';
            }
        }
        // projektant
        if(!$this->practice){
            $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Projektant nije naveden. '.Html::a('<i class="fa fa-wrench"></i> Odredi projektanta.', Url::to(['/project-volumes/update', 'id'=>$this->id]), ['target'=>'_blank']). '</p>';
            //return false;
            $check = false;
        } else {
            // podaci projektanta
            if($this->practice->seal==null){
                $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Nedostaje pečat projektanta. '.Html::a('<i class="fa fa-wrench"></i> Dodaj pečat projektanta.', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$this->practice->engineer_id, 'LegalFilesSearch[entity]'=>'practice', 'LegalFilesSearch[type]'=>'company_stamp']), ['target'=>'_blank']). '</p>';
                //return false;
                $check = false;
            }                
            if(!$this->practice->location){
                $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Nije navedena adresa projektanta. '.Html::a('<i class="fa fa-wrench"></i> Podešavanje.', Url::to(['/practices/update', 'id'=>$this->practice_id]), ['target'=>'_blank']). '</p>';
                //return false;
                $check = false;
            } else {
                if(!$this->practice->location->city){
                    $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Adresa projektanta mora sadržati bar grad. '.Html::a('<i class="fa fa-wrench"></i> Podešavanje.', Url::to(['/practices/update', 'id'=>$this->practice_id]), ['target'=>'_blank']). '</p>';
                    //return false;
                    $check = false;
                }
            }
            if(!$this->practice->director){
                $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Odgovorno lice projektanta nije navedeno. '.Html::a('<i class="fa fa-wrench"></i> Podešavanje.', Url::to(['/practices/update', 'id'=>$this->practice_id]), ['target'=>'_blank']). '</p>';
                //return false;
                $check = false;
            } else {
                if($this->practice->director->engSignature==null){
                    $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Nedostaje potpis odgovornog licenca projektanta. '.Html::a('<i class="fa fa-wrench"></i> Dodaj potpis odgovornog lica projektanta.', Url::to(['/engineers/update', 'id'=>$this->engineer->user_id]), ['target'=>'_blank']). '</p>';
                    //return false;
                    $check = false;
                }
            }
            if($this->practice->seal and $this->practice->director->engSignature and $this->practice->location->city and $this->practice->director){
                $content['success'] .= '<p><i class="fa fa-check-circle"></i> Podaci o projektantu su OK.</p>';
            }
        }
        // glavni projektant
        if(!$this->engineer){
            $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Glavni projektant nije naveden. '.Html::a('<i class="fa fa-wrench"></i> Odredi glavnog projektanta.', Url::to(['/project-volumes/update', 'id'=>$this->id]), ['target'=>'_blank']). '</p>';
            //return false;
            $check = false;
        } else {
            // podaci glavnog projektanta
            // licenca
            if(!$this->engineer_licence_id){
                $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Licenca glavnog projektanta ne postoji. '.Html::a('<i class="fa fa-wrench"></i> Dodaj licence glavnog projektanta.', Url::to(['/engineer-licences/create', 'EngineerLicences[engineer_id]'=>$this->engineer->user_id]), ['target'=>'_blank']). '</p>';
                //return false;
                $check = false;
            } else {
                // podaci licence broj i pecat
                if(!$this->engineerLicence->no or !$this->engineerLicence->stamp){
                    $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Licenca glavnog projektanta nije podešena. '.Html::a('<i class="fa fa-wrench"></i> Podešavanje licencnog paketa glavnog projektanta.', Url::to(['/engineer-licences/update', 'id'=>$this->engineer_licence_id]), ['target'=>'_blank']). '</p>';
                    //return false;
                    $check = false;
                } else {                    
                    $content['success'] .= '<p><i class="fa fa-check-circle"></i> Podaci o odgovornom projektantu su OK.</p>';
                }
            }
            if($this->engineer->engSignature==null){
                $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Nedostaje potpis odgovornog projektanta. '.Html::a('<i class="fa fa-wrench"></i> Dodaj potpis odgovornog projektanta.', Url::to(['/engineers/update', 'id'=>$this->engineer->user_id]), ['target'=>'_blank']). '</p>';
                //return false;
                $check = false;
            }
        }
        if($this->volume_id==1 or $this->volume_id==2){ // ako je glavna sveska
            // u pio fazi, mora biti izvodjac i strucni nadzor, i svi moraju imati licence i pecate
            // ako nije idr, mora imati projektni zadatak
            // osnovni podaci o lokaciji i objektu:
            // tip objekta, klasa 
            if(!$building->name){
                $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Naziv objekta nije naveden. '.Html::a('<i class="fa fa-wrench"></i> Odredi naziv objekta.', Url::to(['/project-building/update', 'id'=>$building->id]), ['target'=>'_blank']). '</p>';
                //return false;
                $check = false;
            }

            // tip objekta, klasa 
            if(!$building->type){
                $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Tip objekta nije naveden. '.Html::a('<i class="fa fa-wrench"></i> Odredi tip objekta.', Url::to(['/project-building/update', 'id'=>$building->id]), ['target'=>'_blank']). '</p>';
                //return false;
                $check = false;
            }
                
            // parcele
            if(!$project->location->locationLots){
                $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Katastarska parcela/e nije uneta. '.Html::a('<i class="fa fa-pencil"></i> Unesi.', Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$project->location_id, 'LocationLots[type]'=>'object']), ['target'=>'_blank']). '</p>';
                //return false;
                $check = false;
            }
                
                // priključci na infrastrukturu: u IDR projektovani, u IDR, PGD dati, u PIO ostvareni
               
                
            $content['info'] .= '<p><i class="fa fa-info-circle"></i> Proverite da li površine i prostorije objekta odgovaraju projektu. '.Html::a('<i class="fa fa-eye"></i> Površine objekta', Url::to(['/project-building-storey-part-rooms/index', 'id'=>$building->id]), ['target'=>'_blank']). '</p>';
                            

            if($project->work=='adaptacija'){
                // ako je član 145.
                if(!$building->gross_area_part){
                    $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Bruto površina dela objekta nije uneta. '.Html::a('<i class="fa fa-pencil"></i> Unesi bruto površinu dela objekta.', Url::to(['/project-building/update', 'id'=>$building->id, '#'=>'w0-tab1']), ['target'=>'_blank']). '</p>';
                    //return false;
                    $check = false;
                }
                if(!$building->storey){
                    $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Spratnost objekta nije uneta. '.Html::a('<i class="fa fa-pencil"></i> Unesi spratnost.', Url::to(['/project-building/update', 'id'=>$building->id, '#'=>'w0-tab1']), ['target'=>'_blank']). '</p>';
                    //return false;
                    $check = false;
                }
                // ako je član 145.
                $adap_arch = $building->projectBuildingCharacteristics;
                if($adap_arch->context=='' or $adap_arch->function=='' or $adap_arch->position==''){
                    $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Predmetni objekat, u kojem se nalazi predmetna jedinica, nije opisan. '.Html::a('<i class="fa fa-pencil"></i> Opiši predmetni objekat.', Url::to(['/project-building/update', 'id'=>$building->id, '#'=>'w0-tab1']), ['target'=>'_blank']). '</p>';
                    //return false;
                    $check = false;
                }

                if(!$project->projectUnit or !$project->projectExUnit){
                    $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Nije određena predmetna jedinica. '.Html::a('<i class="fa fa-pencil"></i> Odredi jedinicu.', Url::to(['/project-building/update', 'id'=>$building->id, '#'=>'w0-tab1']), ['target'=>'_blank']). '</p>';
                    $check = false;
                } else {
                    if($project->projectUnit->name==''){
                        $content['warning'] .= '<p><i class="fa fa-exclamation-circle"></i> Naziv jedinice nije unet. '.Html::a('<i class="fa fa-pencil"></i> Unesi naziv jedinice.', Url::to(['/project-building-storey-parts/update', 'id'=>$project->projectUnit->id]), ['target'=>'_blank']). '</p>';
                        $check = false;
                    }
                    if($project->projectUnit->mark==''){
                        $content['warning'] .= '<p><i class="fa fa-exclamation-circle"></i> Oznaka/broj jedinice nije unet. '.Html::a('<i class="fa fa-pencil"></i> Unesi oznaku/broj jedinice.', Url::to(['/project-building-storey-parts/update', 'id'=>$project->projectUnit->id]), ['target'=>'_blank']). '</p>';
                        $check = false;
                    }
                    if($project->projectUnit->projectBuildingStorey->name==''){
                        $content['warning'] .= '<p><i class="fa fa-exclamation-circle"></i> Naziv etaže na kojoj se nalazi jedinica nije unet. '.Html::a('<i class="fa fa-pencil"></i> Unesi naziv etaže.', Url::to(['/project-building-storeys/update', 'id'=>$project->projectUnit->project_building_storey_id]), ['target'=>'_blank']). '</p>';
                        $check = false;
                    }
                    if($rooms = $project->projectUnit->projectBuildingStoreyPartRooms){                        
                        foreach($rooms as $room){
                            if($room->net_area==0 or $room->sub_net_area==0){
                                $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Niste naveli površine prostorije '.$room->roomType->name.' predviđenog stanja jedinice. '.Html::a('<i class="fa fa-wrench"></i> Podesite površine.', Url::to(['/project-building-storey-parts/view', 'id'=>$project->projectUnit->id]), ['target'=>'_blank']). '</p>';
                                $check = false;
                            }
                        }
                    } else {
                        $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Niste naveli koje prostorije sadrži predviđeno stanje jedinice. '.Html::a('<i class="fa fa-wrench"></i> Dodajte prostorije predviđenog stanja jedinice.', Url::to(['/project-building-storey-parts/view', 'id'=>$project->projectUnit->id]), ['target'=>'_blank']). '</p>';
                        $check = false;
                    }

                    if($rooms = $project->projectExUnit->projectBuildingStoreyPartRooms){                        
                        foreach($rooms as $room){
                            if($room->net_area==0 or $room->sub_net_area==0){
                                $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Niste naveli površine prostorije '.$room->roomType->name.' postojećeg stanja jedinice. '.Html::a('<i class="fa fa-wrench"></i> Podesite površine.', Url::to(['/project-building-storey-parts/view', 'id'=>$project->projectExUnit->id]), ['target'=>'_blank']). '</p>';
                                $check = false;
                            }
                        }
                    } else {
                        $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Niste naveli koje prostorije sadrži postojeće stanje jedinice. '.Html::a('<i class="fa fa-wrench"></i> Dodajte prostorije postojećeg stanja jedinice.', Url::to(['/project-building-storey-parts/view', 'id'=>$project->projectExUnit->id]), ['target'=>'_blank']). '</p>';
                        $check = false;
                    }

                    $unit_arch = $project->projectUnit->projectBuildingStoreyPartCharacteristics;
                    $unit_stru = $project->projectUnit->projectBuildingStoreyPartStructure;
                    $unit_mate = $project->projectUnit->projectBuildingStoreyPartMaterials;
                    $unit_insu = $project->projectUnit->projectBuildingStoreyPartInsulations;
                    $unit_serv = $project->projectUnit->projectBuildingStoreyPartServices;

                    $exUnit_arch = $project->projectExUnit->projectBuildingStoreyPartCharacteristics;
                    $exUnit_stru = $project->projectExUnit->projectBuildingStoreyPartStructure;
                    $exUnit_mate = $project->projectExUnit->projectBuildingStoreyPartMaterials;
                    $exUnit_insu = $project->projectExUnit->projectBuildingStoreyPartInsulations;
                    $exUnit_serv = $project->projectExUnit->projectBuildingStoreyPartServices;                    

                    if($exUnit_arch->position=='' or $exUnit_arch->adjacent=='' or $exUnit_arch->shape=='' or $exUnit_arch->orientation==''){
                        $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Opis položaja, orjentacije i oblike postojećeg stanja predmetne jedinice nedostaje. '.Html::a('<i class="fa fa-pencil"></i> Opišite detalje predmetne jedinice', Url::to(['/project-building-storey-parts/update', 'id'=>$project->projectExUnit->id, '#'=>'w1-tab2']), ['target'=>'_blank']). '</p>';
                        $check = false;
                    }

                    if($exUnit_arch->function=='' and $exUnit_arch->access=='' and $exUnit_arch->entrance==''){
                        $content['warning'] .= '<p><i class="fa fa-exclamation-circle"></i> Opis namene, prilaza i ulaza postojećeg stanja predmetne jedinice nedostaje. '.Html::a('<i class="fa fa-pencil"></i> Opišite detalje predmetne jedinice', Url::to(['/project-building-storey-parts/update', 'id'=>$project->projectExUnit->id, '#'=>'w1-tab1']), ['target'=>'_blank']). '</p>';
                        $check = false;
                    }
                }
                //return false;
            } else {
                // prostorni plan
                if(!$project->prostorniplan and ($project->phase=='idr' or $project->phase=='idp' or $project->phase=='pgd')){
                    $content['warning'] .= '<p><i class="fa fa-exclamation-circle"></i> Prostorni plan nije unet. '.Html::a('<i class="fa fa-pencil"></i> Unesi prostorni plan.', Url::to(['/project-files/create', 'ProjectFiles[project_id]'=>$project->id, 'ProjectFiles[type]'=>'prostorniplan']), ['target'=>'_blank']). '</p>';
                    $check = false;
                    //return false;
                }

                if(!$project->lokacijskiUslovi and ($project->phase=='pgd' or $project->phase=='pzi' or $project->phase=='pio')){
                    $content['warning'] .= '<p><i class="fa fa-exclamation-circle"></i> Lokacijski uslovi nisu navedeni. '.Html::a('<i class="fa fa-pencil"></i> Unesi lokacijske uslove.', Url::to(['/project-files/create', 'ProjectFiles[project_id]'=>$project->id, 'ProjectFiles[type]'=>'uslovi']), ['target'=>'_blank']). '</p>';
                    $check = false;
                    //return false;
                }

                if(!$project->location->serviceLots){
                    $content['warning'] .= '<p><i class="fa fa-exclamation-circle"></i> Katastarska parcela infrastrukture nije uneta. '.Html::a('<i class="fa fa-pencil"></i> Unesi.', Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$project->location_id, 'LocationLots[type]'=>'service']), ['target'=>'_blank']). '</p>';
                    $check = false;
                    //return false;
                }
                if(!$project->location->accessLots){
                    $content['warning'] .= '<p><i class="fa fa-exclamation-circle"></i> Katastarska parcela pristupa nije uneta. '.Html::a('<i class="fa fa-pencil"></i> Unesi.', Url::to(['/location-lots/create', 'LocationLots[location_id]'=>$project->location_id, 'LocationLots[type]'=>'access']), ['target'=>'_blank']). '</p>';
                    //return false;
                    $check = false;
                }
                // grossArea, grossAboveArea, grossBelowArea, netArea, pr->netArea, pr->gross_area, occupancy, spratnost, projectBuildingHeights, absoluteHeight, absoluteLevel, storey_height()given, ridge_orientation, roof_pitch, 
                // osnovni podaci o objektu
                // ProjectLot->area, green_area_reg, green_area
                if(!$project->projectLot->area){
                    $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Nije navedena površina parcele. '.Html::a('<i class="fa fa-wrench"></i> Unesi površinu parcele.', Url::to(['/project-lot/update', 'id'=>$project->projectLot->project_id, '#'=>'w1-tab1']), ['target'=>'_blank']). '</p>';
                    //return false;
                    $check = false;
                }
                if(!$project->projectLot->green_area_reg){
                    $content['warning'] .= '<p><i class="fa fa-exclamation-circle"></i> Nije naveden zahtevani procenat zelenih površina za predmetnu parcelu. '.Html::a('<i class="fa fa-wrench"></i> Unesi procenat.', Url::to(['/project-lot/update', 'id'=>$project->projectLot->project_id, '#'=>'w1-tab2']), ['target'=>'_blank']). '</p>';
                    //return false;
                    $check = false;
                }
                if(!$project->projectLot->green_area){
                    $content['warning'] .= '<p><i class="fa fa-exclamation-circle"></i> Nije navedena ostvarena površina zelenih površina za predmetnu parcelu. '.Html::a('<i class="fa fa-wrench"></i> Unesi projektovanu površinu zelenih površina.', Url::to(['/project-lot/update', 'id'=>$project->projectLot->project_id, '#'=>'w1-tab2']), ['target'=>'_blank']). '</p>';
                    //return false;
                    $check = false;
                }
                if(!$project->projectLot->occupancy_reg){
                    $content['warning'] .= '<p><i class="fa fa-exclamation-circle"></i> Nije naveden zahtevani stepen zauzetosti objekta na predmetnoj parceli. '.Html::a('<i class="fa fa-wrench"></i> Unesi zahtevani stepen zauzetosti.', Url::to(['/project-lot/update', 'id'=>$project->projectLot->project_id, '#'=>'w1-tab2']), ['target'=>'_blank']). '</p>';
                    //return false;
                    $check = false;
                }
                if(!$project->projectLot->built_index_reg){
                    $content['warning'] .= '<p><i class="fa fa-exclamation-circle"></i> Nije naveden zahtevani indeks izgrađenosti za predmetnu parcelu. '.Html::a('<i class="fa fa-wrench"></i> Unesi indeks izgrađenosti.', Url::to(['/project-lot/update', 'id'=>$project->projectLot->project_id, '#'=>'w1-tab2']), ['target'=>'_blank', '#'=>'w1-tab2']). '</p>';
                    //return false;
                    $check = false;
                }

                if($building->projectBuildingStoreys){
                    foreach($building->projectBuildingStoreys as $storey){
                            

                        if($parts = $storey->projectBuildingStoreyParts){
                            if(!$storey->gross_area){
                                // Bruto površina sprata nije navedena
                                $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Bruto površina etaže '.$storey->storey.' nije navedena. '.Html::a('<i class="fa fa-wrench"></i> Unesi bruto površinu etaže.', Url::to(['/project-building-storeys/index', 'id'=>$building->id]), ['target'=>'_blank']). '</p>';
                                $check = false;
                            }
                            if(!$storey->netArea){
                                // Bruto površina sprata nije navedena
                                $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Niste naveli koje prostorije sadrži i/ili niste naveli površine prostorija jedinica etaže '.$storey->storey.'. '.Html::a('<i class="fa fa-wrench"></i> Podesite površine etaže.', Url::to(['/project-building-storeys/view', 'id'=>$storey->id]), ['target'=>'_blank']). '</p>';
                                $check = false;
                            }

                            foreach($parts as $part){
                                if($rooms = $part->projectBuildingStoreyPartRooms){
                                    foreach($rooms as $room){
                                        if($room->net_area==0 or $room->sub_net_area==0){
                                            $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Niste naveli površine prostorije '.$room->roomType->name.' jedinice '.$part->type.' etaže '.$storey->storey.'. '.Html::a('<i class="fa fa-wrench"></i> Podesite površine jedinice.', Url::to(['/project-building-storey-parts/view', 'id'=>$part->id]), ['target'=>'_blank']). '</p>';
                                            $check = false;
                                        }
                                    }
                                } else {
                                    $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Niste naveli koje prostorije sadrži jedinica '.$part->type.' etaže '.$storey->storey.'. '.Html::a('<i class="fa fa-plus-circle"></i> Dodaj prostorije jednice.', Url::to(['/project-building-storeys/view', 'id'=>$storey->id]), ['target'=>'_blank']). '</p>';
                                    $check = false;
                                }
                            }
                        } else{
                            $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Niste naveli koje celine sadrži etaža '.$storey->storey.'. '.Html::a('<i class="fa fa-plus-circle"></i> Dodaj celine.', Url::to(['/project-building-storeys/index', 'id'=>$building->id]), ['target'=>'_blank']). '</p>';
                            $check = false;
                        }
                    }
                }

                if(!$building->storey_height){
                    $content['warning'] .= '<p><i class="fa fa-exclamation-circle"></i> Spratna visina nije uneta. '.Html::a('<i class="fa fa-pencil"></i> Unesi spratnu visinu.', Url::to(['/project-building/update', 'id'=>$building->id, '#'=>'w0-tab1']), ['target'=>'_blank']). '</p>';
                    $check = false;
                    //return false;
                }
                if(!$building->ridge_orientation){
                    $content['warning'] .= '<p><i class="fa fa-exclamation-circle"></i> Orjentacija slemena objekta nije uneta. '.Html::a('<i class="fa fa-pencil"></i> Unesi orjentaciju slemena.', Url::to(['/project-building/update', 'id'=>$building->id, '#'=>'w0-tab2']), ['target'=>'_blank']). '</p>';
                    $check = false;
                    //return false;
                }
                if(!$building->roof_pitch){
                    $content['warning'] .= '<p><i class="fa fa-exclamation-circle"></i> Nagib krovnih ravni nije određen. '.Html::a('<i class="fa fa-pencil"></i> Unesi nagib krovnih ravni.', Url::to(['/project-building/update', 'id'=>$building->id, '#'=>'w0-tab2']), ['target'=>'_blank']). '</p>';
                    //return false;
                    $check = false;
                }

                if(!$building->projectBuildingHeights){
                    $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Visine delova objekta (sleme, venac i sl.) nisu navedene. '.Html::a('<i class="fa fa-wrench"></i> Unesi visine.', Url::to(['/project-building/view', 'id'=>$building->id, '#'=>'w8-tab2']), ['target'=>'_blank']). '</p>';
                    //return false;
                    $check = false;
                }

                if($building->projectBuildingMaterials->facade==''){
                    $content['warning'] .= '<p><i class="fa fa-exclamation-circle"></i> Materijalizacija fasade nije određena. '.Html::a('<i class="fa fa-pencil"></i> Unesi.', Url::to(['/project-building/update', 'id'=>$building->id, '#'=>'w0-tab10']), ['target'=>'_blank']). '</p>';
                    //return false;
                    $check = false;
                }

                if($building->projectBuildingMaterials->roofing==''){
                    $content['warning'] .= '<p><i class="fa fa-exclamation-circle"></i> Materijalizacija krova nije određena. '.Html::a('<i class="fa fa-pencil"></i> Unesi.', Url::to(['/project-building/update', 'id'=>$building->id, '#'=>'w0-tab10']), ['target'=>'_blank']). '</p>';
                    //return false;
                    $check = false;
                }

                if($building->cost==''){
                    $content['warning'] .= '<p><i class="fa fa-exclamation-circle"></i> Predračunska vrednost objekta nije uneta. '.Html::a('<i class="fa fa-pencil"></i> Unesi vrednost objekta.', Url::to(['/project-building/update', 'id'=>$building->id, '#'=>'w0-tab0']), ['target'=>'_blank']). '</p>';
                    //return false;
                    $check = false;
                }

                if($project->projectLot->parking_spaces==''){
                    $content['warning'] .= '<p><i class="fa fa-exclamation-circle"></i> Broj parking mesta nije unet. '.Html::a('<i class="fa fa-pencil"></i> Unesi broj parking mesta.', Url::to(['/project-lot/update', 'id'=>$project->projectLot->project_id, '#'=>'w1-tab2']), ['target'=>'_blank']). '</p>';
                    //return false;
                    $check = false;
                }
            }

            if(!$building->projectBuildingClasses){
                $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Klase objekta (prema Pravilniku o klasifikaciji objekata) nisu navedene. '.Html::a('<i class="fa fa-wrench"></i> Unesi klase.', Url::to(['/project-building/view', 'id'=>$building->id, '#'=>'w8-tab1']), ['target'=>'_blank']). '</p>';
                //return false;
                $check = false;
            }

            if($building->type and $project->location->locationLots and ($project->projectLot->area and $project->work!='adaptacija') and /*($building->gross_area_part and $project->work=='adaptacija') and*/ ($building->projectBuildingHeights and $project->work!='adaptacija') and $building->projectBuildingClasses){
                $content['success'] .= '<p><i class="fa fa-check-circle"></i> Osnovni podaci o objektu su OK.</p>';
            }
        }        

        
        return $content;
    }  

    /**
     * @return \yii\db\ActiveQuery
     */
    public function dataReqFlash($content)
    {  
        $content['danger'] ? \Yii::$app->session->setFlash('danger', $content['danger']) : null;
        $content['warning'] ? \Yii::$app->session->setFlash('warning', $content['warning']) : null;
        $content['info'] ? \Yii::$app->session->setFlash('info', $content['info']) : null;
        $content['success'] ? \Yii::$app->session->setFlash('success', $content['success']) : null;
        //return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function dataRequirement($content)
    {  
        if($content['danger']!='' or $content['warning']!=''){
            return false;
        }
        return true;
    }
}
