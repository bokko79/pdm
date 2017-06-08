<?php

namespace common\models;

use Yii;
use yii\imagine\Image;

/**
 * This is the model class for table "project_images".
 *
 * @property string $id
 * @property string $project_id
 * @property string $number
 * @property string $file_id
 *
 * @property Projects $project
 * @property Files $file
 */
class ProjectImages extends \yii\db\ActiveRecord
{
    public $docFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id'], 'required'],
            [['project_id', 'file_id', 'number'], 'integer'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['file_id' => 'id']],
            [['docFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
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
            'number' => Yii::t('app', 'Broj dokumenta'),
            'file_id' => Yii::t('app', 'File ID'),
            'docFile' => Yii::t('app', 'Slika/fotografija'),
        ];
    }

    public function uploadFiles()
    {
        if ($this->validate()) {
           
            $fileName = $this->id . '_' . time(); 
            $this->docFile->saveAs('images/projects/'.$this->project->year.'/'.$this->project_id.'/'.$fileName . '1.' . $this->docFile->extension); 
                   
            
            $image = new \common\models\Files();
            $image->name = $fileName . '.' . $this->docFile->extension;
            $image->type = 'jpg';
            $image->time = time();
            
            $thumb = 'images/projects/'.$this->project->year.'/'.$this->project_id.'/'.$fileName.'1.'.$this->docFile->extension;
            Image::thumbnail($thumb, 800, 640)->save(\Yii::getAlias('images/projects/'.$this->project->year.'/'.$this->project_id.'/'.$fileName.'.'.$this->docFile->extension), ['quality' => 80]); 
            unlink(\Yii::getAlias($thumb));
             
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
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'file_id']);
    }  
}
