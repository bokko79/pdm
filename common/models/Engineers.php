<?php

namespace common\models;

use Yii;
use yii\imagine\Image;

/**
 * This is the model class for table "engineers".
 *
 * @property string $id
 * @property string $name
 * @property string $title
 * @property string $phone
 * @property string $email
 *
 * @property PracticeEngineers[] $practiceEngineers
 * @property Practices[] $practices
 * @property ProjectVolumes[] $projectVolumes
 */
class Engineers extends \yii\db\ActiveRecord
{
    public $avatarFile;
    public $coverFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'engineers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'title'], 'required'],
            [['name', 'email'], 'string', 'max' => 64],
            [['title'], 'string', 'max' => 20],
            [['about'], 'string'],
            [['avatar', 'cover_photo'], 'integer'],
            [['phone'], 'string', 'max' => 25],
            [['avatarFile', 'coverFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Ime inženjera'),
            'title' => Yii::t('app', 'Titula'),
            'phone' => Yii::t('app', 'Telefon'),
            'email' => Yii::t('app', 'Email'),
            'about' => Yii::t('app', 'O meni'),
            'avatar' => Yii::t('app', 'Dokument'),
            'cover_photo' => Yii::t('app', 'Dokument'),
            'avatarFile' => Yii::t('app', 'Profilna slika'),
            'coverFile' => Yii::t('app', 'Baner slika'),
        ];
    }

    public function uploadAvatar()
    {
        if ($this->validate()) {
           
            $fileName = $this->user_id . '_' . time(); 
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
           
            $fileName = $this->user_id . '_' . time(); 
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
    public function getUser()
    {
        return $this->hasOne(UserAccount::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEngineerLicences()
    {
        return $this->hasMany(EngineerLicences::className(), ['engineer_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPracticeEngineers()
    {
        return $this->hasMany(PracticeEngineers::className(), ['engineer_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPractice()
    {
        return $this->hasOne(Practices::className(), ['engineer_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectVolumes()
    {
        return $this->hasMany(ProjectVolumes::className(), ['engineer_id' => 'user_id']);
    }  

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLegalFiles()
    {
        return \common\models\LegalFiles::find()->where(['entity_id' => $this->user_id, 'entity' => 'engineer']);
    }  

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSignature()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->user_id, 'entity' => 'engineer', 'type' => 'signature'])->one();
        return $doc ? $doc->file->name : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSignatureID()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->user_id, 'entity' => 'engineer', 'type' => 'signature'])->one();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOther()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->user_id, 'entity' => 'engineer', 'type' => 'other'])->one();
        return $doc ? $doc->file->name : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOtherID()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->user_id, 'entity' => 'engineer', 'type' => 'other'])->one();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCertificates()
    {
        $doc = \common\models\ProfilePortfolio::find()->where(['profile_id' => $this->user_id, 'profile_type' => 'engineer', 'portfolio_type' => 'certificate'])->all();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExperiences()
    {
        $doc = \common\models\ProfilePortfolio::find()->where(['profile_id' => $this->user_id, 'profile_type' => 'engineer', 'portfolio_type' => 'experience'])->all();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEducations()
    {
        $doc = \common\models\ProfilePortfolio::find()->where(['profile_id' => $this->user_id, 'profile_type' => 'engineer', 'portfolio_type' => 'education'])->all();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        $doc = \common\models\ProfilePortfolio::find()->where(['profile_id' => $this->user_id, 'profile_type' => 'engineer', 'portfolio_type' => 'course'])->all();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPatents()
    {
        $doc = \common\models\ProfilePortfolio::find()->where(['profile_id' => $this->user_id, 'profile_type' => 'engineer', 'portfolio_type' => 'patent'])->all();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublications()
    {
        $doc = \common\models\ProfilePortfolio::find()->where(['profile_id' => $this->user_id, 'profile_type' => 'engineer', 'portfolio_type' => 'publication'])->all();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReferences()
    {
        $doc = \common\models\ProfilePortfolio::find()->where(['profile_id' => $this->user_id, 'profile_type' => 'engineer', 'portfolio_type' => 'reference'])->all();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortfolioProjects()
    {
        $doc = \common\models\ProfilePortfolio::find()->where(['profile_id' => $this->user_id, 'profile_type' => 'engineer', 'portfolio_type' => 'projects'])->all();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPortfolioLicences()
    {
        $doc = \common\models\ProfilePortfolio::find()->where(['profile_id' => $this->user_id, 'profile_type' => 'engineer', 'portfolio_type' => 'licence'])->all();
        return $doc ? $doc : false;
    }
}
