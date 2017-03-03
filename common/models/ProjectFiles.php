<?php

namespace common\models;

use Yii;
use yii\imagine\Image;

/**
 * This is the model class for table "project_files".
 *
 * @property string $id
 * @property string $project_id
 * @property string $type
 * @property string $number
 * @property string $date
 * @property string $file_id
 * @property string $name
 *
 * @property Projects $project
 * @property Files $file
 */
class ProjectFiles extends \yii\db\ActiveRecord
{
    public $docFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'type'], 'required'],
            [['project_id', 'file_id'], 'integer'],
            [['type'], 'string'],
            [['date'], 'safe'],
            [['number'], 'string', 'max' => 64],
            [['name'], 'string', 'max' => 256],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['file_id' => 'id']],
            [['docFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif, pdf'],
        ];
    }

    public function uploadFiles()
    {
        if ($this->validate()) {
           
            $fileName = $this->id . '_' . time();            
            if($this->docFile->extension!='pdf'){
                $this->docFile->saveAs('images/projects/'.date('Y').'/'.$this->project_id.'/'.$fileName . '1.' . $this->docFile->extension); 
            } else {
                $this->docFile->saveAs('images/projects/'.date('Y').'/'.$this->project_id.'/'.$fileName . '.' . $this->docFile->extension);
            }        
            
            $image = new \common\models\Files();
            $image->name = $fileName . '.' . $this->docFile->extension;
            $image->type = ($this->docFile->extension!='pdf') ? 'jpg' : 'pdf';
            $image->time = time();
            
            if($this->docFile->extension!='pdf'){
                $thumb = 'images/projects/'.date('Y').'/'.$this->project_id.'/'.$fileName.'1.'.$this->docFile->extension;
                Image::thumbnail($thumb, 800, 640)->save(\Yii::getAlias('images/projects/'.date('Y').'/'.$this->project_id.'/'.$fileName.'.'.$this->docFile->extension), ['quality' => 80]); 
                unlink(\Yii::getAlias($thumb));
            }  
            $image->save();

            if($image->save()){
                //$this->file_id = $image->id;
                //$this->save();
                $this->docFile = null;
                return $image->id;
            }
            
            return false;
        }
        return false;        
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'project_id' => Yii::t('app', 'Projekat'),
            'type' => Yii::t('app', 'Vrsta dokumenta'),
            'number' => Yii::t('app', 'Broj dokumenta'),
            'date' => Yii::t('app', 'Datum dokumenta'),
            'file_id' => Yii::t('app', 'File ID'),
            'authority_id' => Yii::t('app', 'Nadležni organ/Izdavalac dokumenta'),
            'docFile' => Yii::t('app', 'Dokument'),
            'name' => Yii::t('app', 'Naziv dokumenta'),
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
    public function getAuthority()
    {
        return $this->hasOne(Authorities::className(), ['id' => 'authority_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'file_id']);
    }    
}
