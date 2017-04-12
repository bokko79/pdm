<?php

namespace common\models;

use Yii;
use yii\imagine\Image;

/**
 * This is the model class for table "legal_files".
 *
 * @property string $id
 * @property string $type
 * @property string $entity
 * @property string $entity_id
 * @property string $file_id
 * @property string $value
 *
 * @property Files $file
 */
class LegalFiles extends \yii\db\ActiveRecord
{
    public $docFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'legal_files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'entity', 'entity_id', 'docFile'], 'required'],
            [['type', 'entity'], 'string'],
            [['entity_id', 'file_id'], 'integer'],
            [['value'], 'string', 'max' => 64],
            /*[['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['file_id' => 'id']],*/
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
            'type' => Yii::t('app', 'Vrsta dokumenta'),
            'entity' => Yii::t('app', 'Entitet'),
            'entity_id' => Yii::t('app', 'ID entiteta'),
            'file_id' => Yii::t('app', 'Dokument'),
            'docFile' => Yii::t('app', 'Dokument'),
            'value' => Yii::t('app', 'Vrednost'),
        ];
    }

    public function uploadFiles()
    {
        if ($this->validate()) {
           
            $fileName = $this->id . '_' . time();            
            if($this->docFile->extension!='pdf'){
                $this->docFile->saveAs('images/legal_files/' .$this->folder.'/'. $fileName . '1.' . $this->docFile->extension); 
            } else {
                $this->docFile->saveAs('images/legal_files/' .$this->folder.'/'. $fileName . '.' . $this->docFile->extension);
            }        
            
            $image = new \common\models\Files();
            $image->name = $fileName . '.' . $this->docFile->extension;
            $image->type = ($this->docFile->extension!='pdf') ? 'jpg' : 'pdf';
            $image->time = time();
            
            if($this->docFile->extension!='pdf'){
                $thumb = 'images/legal_files/'.$this->folder.'/'.$fileName.'1.'.$this->docFile->extension;
                Image::thumbnail($thumb, 800, 640)->save(\Yii::getAlias('images/legal_files/'.$this->folder.'/'.$fileName.'.'.$this->docFile->extension), ['quality' => 80]); 
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
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'file_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocType()
    {
        $type = null;
        switch($this->type){
            case 'licence_no':
                $type = 'broj licence IKS';
                break;
            case 'licence_copy':
                $type = 'kopija licence IKS';
                break;
            case 'licence_conf':
                $type = 'potvrda licence IKS';
                break;
            case 'apr':
                $type = 'APR';
                break;
            case 'signature':
                $type = 'potpis';
                break;
            case 'licence_stamp':
                $type = 'pečat licencni';
                break;
            case 'company_stamp':
                $type = 'pečat preduzeća';
                break;
            case 'stamp':
                $type = 'pečat';
                break;
            case 'memo-header':
                $type = 'memorandum zaglavlje';
                break;
            case 'memo-footer':
                $type = 'memorandum podnožje';
                break;
            case 'logo':
                $type = 'logo';
                break;
            default:
                $type = 'ostalo';
                break;
        }
        return $type;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFolder()
    {
        $folder = 'other';
        if($this->type == 'signature'){$folder='signatures';}
        if($this->type == 'apr'){$folder='docs';}
        if($this->type == 'licence_copy' or $this->type == 'licence_conf'){$folder='licences';}
        if($this->type == 'licence_stamp' or $this->type == 'company_stamp' or $this->type == 'stamp'){$folder='stamps';}
        if($this->type == 'memo-header' or $this->type == 'memo-footer' or $this->type == 'logo'){$folder='visual';}
        return $folder;
    }
}
