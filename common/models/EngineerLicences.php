<?php

namespace common\models;

use Yii;
use yii\imagine\Image;

/**
 * This is the model class for table "engineer_licences".
 *
 * @property string $id
 * @property string $engineer_id
 * @property string $licence_id
 * @property string $no
 * @property string $copy_id
 * @property string $conf_id
 * @property string $stamp_id
 *
 * @property Files $copy
 * @property Files $conf
 * @property Files $stamp
 * @property Licences $licence
 * @property ProjectVolumes[] $projectVolumes
 * @property ProjectVolumes[] $projectVolumes0
 */
class EngineerLicences extends \yii\db\ActiveRecord
{
    public $copyFile;
    public $confFile;
    public $stampFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'engineer_licences';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['engineer_id', 'no', 'licence_id'], 'required'],
            [['engineer_id', 'licence_id', 'copy_id', 'conf_id', 'stamp_id'], 'integer'],
            [['no'], 'string', 'max' => 12],
            [['engineer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Engineers::className(), 'targetAttribute' => ['engineer_id' => 'user_id']],
            [['copy_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['copy_id' => 'id']],
            [['conf_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['conf_id' => 'id']],
            [['stamp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['stamp_id' => 'id']],
            [['copyFile', 'confFile', 'stampFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'engineer_id' => Yii::t('app', 'Inženjer'),
            'licence_id' => Yii::t('app', 'Vrsta licence'),
            'no' => Yii::t('app', 'Broj licence'),
            'copy_id' => Yii::t('app', 'Kopija licence'),
            'conf_id' => Yii::t('app', 'Potvrda licence'),
            'stamp_id' => Yii::t('app', 'Lični pečat inženjera'),
            'copyFile' => Yii::t('app', 'Kopija licence'),
            'confFile' => Yii::t('app', 'Potvrda licence'),
            'stampFile' => Yii::t('app', 'Lični pečat inženjera'),

        ];
    }

    public function uploadCopyFile()
    {
        if ($this->validate()) {
           
            $fileName = $this->id . '_' . time();            

            $this->copyFile->saveAs('images/legal_files/licences/'. $fileName . '1.' . $this->copyFile->extension);         
            
            $image = new \common\models\Files();
            $image->name = $fileName . '.' . $this->copyFile->extension;
            $image->type = 'jpg';
            $image->time = time();
            
            $thumb = 'images/legal_files/licences/'.$fileName.'1.'.$this->copyFile->extension;
            Image::thumbnail($thumb, 800, 640)->save(\Yii::getAlias('images/legal_files/licences/'.$fileName.'.'.$this->copyFile->extension), ['quality' => 80]); 
            unlink(\Yii::getAlias($thumb));
            
            $image->save();

            if($image->save()){
                $this->copyFile = null;
                return $image->id;
            }
            
            return false;
        }
        return false;        
    }

    public function uploadConfFile()
    {
        if ($this->validate()) {
           
            $fileName = $this->id . '_' . time();            

            $this->confFile->saveAs('images/legal_files/licences/'. $fileName . '1.' . $this->confFile->extension);         
            
            $image = new \common\models\Files();
            $image->name = $fileName . '.' . $this->confFile->extension;
            $image->type = 'jpg';
            $image->time = time();
            
            $thumb = 'images/legal_files/licences/'.$fileName.'1.'.$this->confFile->extension;
            Image::thumbnail($thumb, 800, 640)->save(\Yii::getAlias('images/legal_files/licences/'.$fileName.'.'.$this->confFile->extension), ['quality' => 80]); 
            unlink(\Yii::getAlias($thumb));
            
            $image->save();

            if($image->save()){
                $this->confFile = null;
                return $image->id;
            }
            
            return false;
        }
        return false;        
    }

    public function uploadStampFile()
    {
        if ($this->validate()) {
           
            $fileName = $this->id . '_' . time();            
            $thumb = 'images/legal_files/licences/'.$fileName.'1.'.$this->stampFile->extension;
            $this->stampFile->saveAs($thumb);         
            
            $image = new \common\models\Files();
            $image->name = $fileName . '.' . $this->stampFile->extension;
            $image->type = 'jpg';
            $image->time = time();
            
            
            Image::thumbnail($thumb, 800, 640)->save(\Yii::getAlias('images/legal_files/licences/'.$fileName.'.'.$this->stampFile->extension), ['quality' => 80]); 
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
    public function getLicence()
    {
        return $this->hasOne(Licences::className(), ['id' => 'licence_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCopy()
    {
        return $this->hasOne(Files::className(), ['id' => 'copy_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConf()
    {
        return $this->hasOne(Files::className(), ['id' => 'conf_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStamp()
    {
        return $this->hasOne(Files::className(), ['id' => 'stamp_id']);
    }    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectVolumes()
    {
        return $this->hasMany(ProjectVolumes::className(), ['engineer_licence_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectVolumes0()
    {
        return $this->hasMany(ProjectVolumes::className(), ['control_engineer_licence_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFullname()
    {
        return $this->engineer->name . ': '. $this->no;
    }
}
