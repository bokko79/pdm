<?php

namespace common\models;

use Yii;
use yii\imagine\Image;

/**
 * This is the model class for table "practices".
 *
 * @property string $name
 * @property string $location_id
 * @property string $phone
 * @property string $email
 * @property string $engineer_id
 * @property string $fax
 * @property string $tax_no
 * @property string $company_no
 * @property string $account_no
 * @property string $bank
 *
 * @property PracticeEngineers[] $practiceEngineers
 * @property Locations $location
 * @property Engineers $engineer
 * @property ProjectVolumes[] $projectVolumes
 */
class Practices extends \yii\db\ActiveRecord
{
    public $avatarFile;
    public $coverFile;
    public $stampFile;
    public $memoFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'practices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'location_id', 'engineer_id'], 'required'],
            [['location_id', 'engineer_id', 'tax_no', 'company_no', 'avatar', 'cover_photo', 'stamp', 'memo'], 'integer'],
            [['name'], 'string', 'max' => 128],
            [['phone', 'fax'], 'string', 'max' => 25],
            [['email'], 'string', 'max' => 64],
            [['about'], 'string'],
            [['account_no', 'bank'], 'string', 'max' => 32],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::className(), 'targetAttribute' => ['location_id' => 'id']],
            [['engineer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Engineers::className(), 'targetAttribute' => ['engineer_id' => 'user_id']],
            [['avatarFile', 'coverFile', 'stampFile', 'memoFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Naziv preduzeća'),
            'location_id' => Yii::t('app', 'Adresa'),
            'phone' => Yii::t('app', 'Telefon'),
            'email' => Yii::t('app', 'Email'),
            'engineer_id' => Yii::t('app', 'Direktor'),
            'fax' => Yii::t('app', 'Fax'),
            'tax_no' => Yii::t('app', 'PIB'),
            'company_no' => Yii::t('app', 'Matični broj'),
            'account_no' => Yii::t('app', 'Broj računa'),
            'bank' => Yii::t('app', 'Banka'),
            'avatar' => Yii::t('app', 'Dokument'),
            'cover_photo' => Yii::t('app', 'Dokument'),
            'avatarFile' => Yii::t('app', 'Logo firme'),
            'coverFile' => Yii::t('app', 'Baner slika'),
            'stampFile' => Yii::t('app', 'Pečat firme'),
            'memoFile' => Yii::t('app', 'Memorandum zaglavlje'),
            'about' => Yii::t('app', 'O firmi'),
        ];
    }

    public function uploadAvatar()
    {
        if ($this->validate()) {
           
            $fileName = $this->engineer_id . '_' . time(); 
            $thumb = 'images/profiles/'.$fileName.'1.'.$this->avatarFile->extension;

            $this->avatarFile->saveAs($thumb); 
            
            $image = new \common\models\Files();
            $image->name = $fileName . '.' . $this->avatarFile->extension;
            $image->type = 'jpg';
            $image->time = time();
            
                
            Image::thumbnail($thumb, 200, 200)->save(\Yii::getAlias('images/profiles/'.$fileName.'.'.$this->avatarFile->extension), ['quality' => 80]); 
            unlink(\Yii::getAlias($thumb));
            $image->save();

            if($image->save()){
                $this->avatarFile = null;
                return $image->id;
            }
            
            return false;
        }
        return false;        
    }

    public function uploadÇover()
    {
        if ($this->validate()) {
           
            $fileName = $this->engineer_id . '_' . time(); 
            $thumb = 'images/profiles/'.$fileName.'1.'.$this->coverFile->extension;

            $this->coverFile->saveAs($thumb); 
            
            $image = new \common\models\Files();
            $image->name = $fileName . '.' . $this->coverFile->extension;
            $image->type = 'jpg';
            $image->time = time();
            
                
            Image::thumbnail($thumb, 1200, 480)->save(\Yii::getAlias('images/profiles/'.$fileName.'.'.$this->coverFile->extension), ['quality' => 80]); 
            unlink(\Yii::getAlias($thumb));
            $image->save();

            if($image->save()){
                $this->coverFile = null;
                return $image->id;
            }
            
            return false;
        }
        return false;        
    }

    public function uploadStamp()
    {
        if ($this->validate()) {
           
            $fileName = $this->engineer_id . '_' . time(); 
            $thumb = 'images/legal_files/stamps/'.$fileName.'1.'.$this->stampFile->extension;

            $this->stampFile->saveAs($thumb); 
            
            $image = new \common\models\Files();
            $image->name = $fileName . '.' . $this->stampFile->extension;
            $image->type = 'jpg';
            $image->time = time();
            
                
            Image::thumbnail($thumb, 200, 200)->save(\Yii::getAlias('images/legal_files/stamps/'.$fileName.'.'.$this->stampFile->extension), ['quality' => 80]); 
            unlink(\Yii::getAlias($thumb));
            $image->save();

            if($image->save()){
                $this->stampFile = null;
                return $image->id;
            }
            
            return false;
        }
        return false;        
    }

    public function uploadMemo()
    {
        if ($this->validate()) {
           
            $fileName = $this->engineer_id . '_' . time(); 
            $thumb = 'images/legal_files/visual/'.$fileName.'1.'.$this->memoFile->extension;

            $this->memoFile->saveAs($thumb); 
            
            $image = new \common\models\Files();
            $image->name = $fileName . '.' . $this->memoFile->extension;
            $image->type = 'jpg';
            $image->time = time();
            
                
            Image::thumbnail($thumb, 1200, null)->save(\Yii::getAlias('images/legal_files/visual/'.$fileName.'.'.$this->memoFile->extension), ['quality' => 80]); 
            unlink(\Yii::getAlias($thumb));
            $image->save();

            if($image->save()){
                $this->memoFile = null;
                return $image->id;
            }
            
            return false;
        }
        return false;        
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPracticeEngineers()
    {
        return $this->hasMany(PracticeEngineers::className(), ['practice_id' => 'engineer_id'])->where('status="joined"');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPracticePartners()
    {
        return \common\models\PracticePartners::find()->where('practice_id='.$this->engineer_id. ' or partner_id='.$this->engineer_id)->all();
        //return $this->hasMany(PracticePartners::className(), ['practice_id' => 'engineer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFullPracticePartners()
    {
        $partners = [];
        $practicePartners = \common\models\PracticePartners::find()->where('(practice_id='.$this->engineer_id. ' or partner_id='.$this->engineer_id.') and status="partner"')->all();
        if($practicePartners){
            foreach($practicePartners as $practicePartner){
                if($practicePartner->practice->engineer_id!=$this->engineer_id){
                    $partners[] = $practicePartner->practice;
                } else {
                    $partners[] = $practicePartner->partner;
                }
            }
        }
        return $partners;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvailablePractices()
    {
        $practices = [];
        $practices[] = (!Yii::$app->user->isGuest and Yii::$app->user->engineer) ? Yii::$app->user->engineer->practice : null;
        if($pps = $this->fullPracticePartners){
            foreach($pps as $pp){
                $practices[] = $pp;
            }
        }
        return $practices;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvailableEngineers()
    {
        $engineers = [];
        $check = [];
        if($practiceEngineers = $this->practiceEngineers){
            foreach($practiceEngineers as $practiceEngineer){
                if(!in_array($practiceEngineer->engineer_id, $check)){
                    $engineers[] = $practiceEngineer->engineer;
                    $check[] = $practiceEngineer->engineer_id;
                }                
            }
        }
        if($partners = $this->fullPracticePartners){
            foreach($partners as $partner){
                if($partnerEngineers = $partner->practiceEngineers)
                    foreach($partnerEngineers as $partnerEngineer){
                        if(!in_array($partnerEngineer->engineer_id, $check)){
                            $engineers[] = $partnerEngineer->engineer;
                            $check[] = $partnerEngineer->engineer_id;
                        }                
                    }
            }                
        }
        return $engineers;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasMany(Clients::className(), ['practice_id' => 'engineer_id']);
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
    public function getEngineer()
    {
        return $this->hasOne(Engineers::className(), ['user_id' => 'engineer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'avatar']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'cover_photo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'stamp']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemorandum()
    {
        return $this->hasOne(Files::className(), ['id' => 'memo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectVolumes()
    {
        return $this->hasMany(ProjectVolumes::className(), ['practice_id' => 'engineer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLegalFiles()
    {
        return \common\models\LegalFiles::find()->where(['entity_id' => $this->engineer_id, 'entity' => 'practice']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getMemo()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->engineer_id, 'entity' => 'practice', 'type' => 'memo-header'])->one();
        return $doc ? $doc->file->name : false;
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
   /*public function getStamp()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->engineer_id, 'entity' => 'practice', 'type' => 'company_stamp'])->one();
        return $doc ? $doc->file->name : false;
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getSignature()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->engineer_id, 'entity' => 'practice', 'type' => 'signature'])->one();
        return $doc ? $doc->file->name : false;
    }*/

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeal($w=120, $h=120)
    {        
        return $this->sFile ? \yii\helpers\Html::img('@web/images/legal_files/stamps/'.$this->sFile->name, ['style'=>'width:'.$w.'px; max-height:'.$h.'px;']) : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApr()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->engineer_id, 'entity' => 'practice', 'type' => 'apr'])->one();
        return $doc ? $doc->file->name : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogo($w=120, $h=120)
    {
        return $this->aFile ? \yii\helpers\Html::img('@web/images/profiles/'.$this->aFile->name, ['style'=>'width:'.$w.'px; max-height:'.$h.'px;']) : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogoID()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->engineer_id, 'entity' => 'practice', 'type' => 'logo'])->one();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemoID()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->engineer_id, 'entity' => 'practice', 'type' => 'memo-header'])->one();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStampID()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->engineer_id, 'entity' => 'practice', 'type' => 'company_stamp'])->one();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSignatureID()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->engineer_id, 'entity' => 'practice', 'type' => 'signature'])->one();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAprID()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->engineer_id, 'entity' => 'practice', 'type' => 'apr'])->one();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintEngineer()
    {
        return 'Direktor nije na listi? ' .\yii\helpers\Html::a('Dodaj direktora.', \yii\helpers\Url::to(['/engineers/create']));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirector()
    {
        $director = \common\models\PracticeEngineers::find()->where('practice_id='.$this->engineer_id.' and position="direktor"')->one();

        return $director ? $director->engineer : null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCertificates()
    {
        $doc = \common\models\ProfilePortfolio::find()->where(['profile_id' => $this->user_id, 'profile_type' => 'practice', 'portfolio_type' => 'certificate'])->all();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatents()
    {
        $doc = \common\models\ProfilePortfolio::find()->where(['profile_id' => $this->user_id, 'profile_type' => 'practice', 'portfolio_type' => 'patent'])->all();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublications()
    {
        $doc = \common\models\ProfilePortfolio::find()->where(['profile_id' => $this->user_id, 'profile_type' => 'practice', 'portfolio_type' => 'publication'])->all();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortfolioProjects()
    {
        $doc = \common\models\ProfilePortfolio::find()->where(['profile_id' => $this->user_id, 'profile_type' => 'practice', 'portfolio_type' => 'projects'])->all();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortfolioLicences()
    {
        $doc = \common\models\ProfilePortfolio::find()->where(['profile_id' => $this->user_id, 'profile_type' => 'practice', 'portfolio_type' => 'licence'])->all();
        return $doc ? $doc : false;
    }
}
