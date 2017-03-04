<?php

namespace common\models;

use Yii;
use yii\imagine\Image;

/**
 * This is the model class for table "engineer_licences".
 *
 * @property string $id
 * @property string $engineer_id
 * @property integer $type
 * @property string $no
 * @property string $copy_id
 * @property string $conf_id
 * @property string $stamp_id
 *
 * @property Engineers $engineer
 * @property Files $copy
 * @property Files $conf
 * @property Files $stamp
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
            [['engineer_id', 'no', ], 'required'],
            [['engineer_id', 'type', 'copy_id', 'conf_id', 'stamp_id'], 'integer'],
            [['no'], 'string', 'max' => 12],
            [['engineer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Engineers::className(), 'targetAttribute' => ['engineer_id' => 'id']],
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
            'engineer_id' => Yii::t('app', 'Engineer ID'),
            'type' => Yii::t('app', 'Type'),
            'no' => Yii::t('app', 'No'),
            'copy_id' => Yii::t('app', 'Copy ID'),
            'conf_id' => Yii::t('app', 'Conf ID'),
            'stamp_id' => Yii::t('app', 'Stamp ID'),
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

            $this->stampFile->saveAs('images/legal_files/licences/'. $fileName . '1.' . $this->stampFile->extension);         
            
            $image = new \common\models\Files();
            $image->name = $fileName . '.' . $this->stampFile->extension;
            $image->type = 'jpg';
            $image->time = time();
            
            $thumb = 'images/legal_files/licences/'.$fileName.'1.'.$this->stampFile->extension;
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
        return $this->hasOne(Engineers::className(), ['id' => 'engineer_id']);
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
