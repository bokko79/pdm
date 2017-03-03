<?php

namespace common\models;

use Yii;
use yii\imagine\Image;

/**
 * This is the model class for table "project_building".
 *
 * @property string $project_id
 * @property string $building_id
 * @property string $name
 * @property string $building_type_id
 * @property string $type
 * @property string $ground_floor_level
 * @property string $building_line_dist
 * @property string $gross_area_part
 * @property string $gross_area
 * @property string $gross_area_above
 * @property string $gross_area_below
 * @property string $gross_built_area
 * @property string $net_area
 * @property string $ground_floor_area
 * @property string $occupancy_area
 * @property string $storey
 * @property string $storey_height
 * @property integer $units_total
 * @property string $ridge_orientation
 * @property string $roof_pitch
 * @property string $characteristics
 * @property string $cost
 *
 * @property Projects $project
 * @property Buildings $building
 * @property BuildingTypes $buildingType
 * @property ProjectBuildingHeights[] $projectBuildingHeights
 */
class ProjectBuilding extends \yii\db\ActiveRecord
{
    public $buildFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_building';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'building_id'], 'required'],
            [['project_id', 'building_id', 'building_type_id', 'units_total', 'file_id'], 'integer'],
            [['type', 'characteristics'], 'string'],
            [['ground_floor_level', 'building_line_dist', 'gross_area_part', 'gross_area', 'gross_area_above', 'gross_area_below', 'gross_built_area', 'net_area', 'ground_floor_area', 'occupancy_area', 'storey_height', 'roof_pitch', 'cost'], 'number'],
            [['name'], 'string', 'max' => 128],
            [['storey', 'ridge_orientation'], 'string', 'max' => 64],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['building_id'], 'exist', 'skipOnError' => true, 'targetClass' => Buildings::className(), 'targetAttribute' => ['building_id' => 'id']],
            [['building_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => BuildingTypes::className(), 'targetAttribute' => ['building_type_id' => 'id']],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['file_id' => 'id']],
            [['podrum', 'suteren', 'prizemlje', 'visokoprizemlje', 'mezanin', 'galerija', 'sprat', 'povucenisprat', 'potkrovlje', 'mansarda', 'tavan', 'krov', 'duplex'], 'safe'],
            [['buildFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_id' => Yii::t('app', 'Naziv projekta'),
            'building_id' => Yii::t('app', 'Klasa objekta'),
            'name' => Yii::t('app', 'Naziv objekta'),
            'type' => Yii::t('app', 'Tip objekta'),
            'ground_floor_level' => Yii::t('app', 'Apsolutna kota prizemlja'),
            'building_type_id' => Yii::t('app', 'Namena objekta'),
            'building_line_dist' => Yii::t('app', 'Rastojanje građ. od reg. linije'),
            'gross_area_part' => Yii::t('app', 'BRGP dela objekta'),
            'gross_area' => Yii::t('app', 'BRGP'),
            'gross_area_above' => Yii::t('app', 'BRGP nadzemno'),
            'gross_area_below' => Yii::t('app', 'BRGP podzemno'),
            'gross_built_area' => Yii::t('app', 'Bruto izgrađena površina'),
            'net_area' => Yii::t('app', 'Neto površina'),
            'ground_floor_area' => Yii::t('app', 'Površina prizemlja'),
            'occupancy_area' => Yii::t('app', 'Zauzeta površina'),            
            'storey' => Yii::t('app', 'Spratnost'),
            'storey_height' => Yii::t('app', 'Spratna visina'),
            'units_total' => Yii::t('app', 'Broj funkcionalnih jedinica'),            
            'ridge_orientation' => Yii::t('app', 'Orjentacija slemena'),
            'roof_pitch' => Yii::t('app', 'Nagib krova'),
            'characteristics' => Yii::t('app', 'Ostale karakteristike objekta'),
            'cost' => Yii::t('app', 'Predračunska vrednost'),
            'buildFile' => Yii::t('app', 'Slika objekta'),
        ];
    }

    public function uploadFiles()
    {
        if ($this->validate()) {
           
            $fileName = $this->project_id . '_' . time(); 
            $this->buildFile->saveAs('images/projects/'.date('Y').'/'.$this->project_id.'/'.$fileName . '1.' . $this->buildFile->extension);
               
            
            $image = new \common\models\Files();
            $image->name = $fileName . '.' . $this->buildFile->extension;
            $image->type = 'jpg';
            $image->time = time();
            
            $thumb = 'images/projects/'.date('Y').'/'.$this->project_id.'/'.$fileName.'1.'.$this->buildFile->extension;
            Image::thumbnail($thumb, 800, 640)->save(\Yii::getAlias('images/projects/'.date('Y').'/'.$this->project_id.'/'.$fileName.'.'.$this->buildFile->extension), ['quality' => 80]); 
            unlink(\Yii::getAlias($thumb));
        
            $image->save();

            if($image->save()){
                //$this->file_id = $image->id;
                //$this->save();
                $this->buildFile = null;
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
    public function getBuilding()
    {
        return $this->hasOne(Buildings::className(), ['id' => 'building_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuildingType()
    {
        return $this->hasOne(BuildingTypes::className(), ['id' => 'building_type_id']);
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
    public function getPo()
    {
        return \common\models\ProjectBuildingStoreys::find()->where('project_id='.$this->project_id. ' and storey="podrum"')->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getS()
    {
        return \common\models\ProjectBuildingStoreys::find()->where('project_id='.$this->project_id. ' and storey="suteren"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPr()
    {
        return \common\models\ProjectBuildingStoreys::find()->where('project_id='.$this->project_id. ' and storey="prizemlje"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVp()
    {
        return \common\models\ProjectBuildingStoreys::find()->where('project_id='.$this->project_id. ' and storey="visokoprizemlje"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMz()
    {
        return \common\models\ProjectBuildingStoreys::find()->where('project_id='.$this->project_id. ' and storey="mezanin"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getG()
    {
        return \common\models\ProjectBuildingStoreys::find()->where('project_id='.$this->project_id. ' and storey="galerija"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSp()
    {
        return \common\models\ProjectBuildingStoreys::find()->where('project_id='.$this->project_id. ' and storey="sprat"')->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPs()
    {
        return \common\models\ProjectBuildingStoreys::find()->where('project_id='.$this->project_id. ' and storey="povucenisprat"')->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPk()
    {
        return \common\models\ProjectBuildingStoreys::find()->where('project_id='.$this->project_id. ' and storey="potkrovlje"')->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getM()
    {
        return \common\models\ProjectBuildingStoreys::find()->where('project_id='.$this->project_id. ' and storey="mansarda"')->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getT()
    {
        return \common\models\ProjectBuildingStoreys::find()->where('project_id='.$this->project_id. ' and storey="tavan"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassPercentageTotal()
    {
        $total = 0;
        if($classes = $this->project->projectBuildingClasses){
            foreach($classes as $class){
                $total += $class->percent;
            }
        }
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpratnost()
    {
        $storey = '';
        if(count($this->po)>0){
            if(count($this->po)==1){
                $storey .= 'Po+';
            } else {
                for ($x = 0; $x < count($this->po); $x++) {
                    $storey .= 'Po'.($x+1).'+';
                }
            }
        }
        if($this->s){              
            $storey .= 'Su+';
        }
        // prizemlje
        $storey .= 'P+';
        if($this->g){        
            $storey .= 'G+';                   
        }
        if(count($this->sp)>0){            
            $storey .= count($this->sp).'+';
        }
        if(count($this->ps)>0){
            if(count($this->ps)==1){
                $storey .= 'Ps+';
            } else {
                for ($x = 0; $x < count($this->ps); $x++) {
                    $storey .= 'Ps'.($x+1).'+';
                }
            }
        }
        if(count($this->pk)>0){
            if(count($this->pk)==1){
                $storey .= 'Pk+';
            } else {
                for ($x = 0; $x < count($this->pk); $x++) {
                    $storey .= 'Pk'.($x+1).'+';
                }
            }
        }
        if(count($this->m)>0){
            if(count($this->m)==1){
                $storey .= 'M+';
            } else {
                for ($x = 0; $x < count($this->m); $x++) {
                    $storey .= 'M'.($x+1).'+';
                }
            }
        }
        if($this->t){
            $storey .= 'T';                   
        }
        if(substr($storey, -1)=='+'){$storey = substr($storey, 0, -1);}
        
        return $storey;
    }  

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrossArea()
    {
        $total = 0;
        if($storeys = $this->project->projectBuildingStoreys){
            foreach($storeys as $storey){
                $total += $storey->gross_area;
            }
        }        
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrossAboveArea()
    {
        $total = 0;
        if($storeys = $this->project->projectBuildingStoreys){
            foreach($storeys as $storey){
                if($storey->storey!='podrum' and $storey->storey!='suteren'){
                    $total += $storey->gross_area;
                }                
            }
        }        
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrossBelowArea()
    {
        $total = 0;
        if($storeys = $this->project->projectBuildingStoreys){
            foreach($storeys as $storey){
                if($storey->storey=='podrum' or $storey->storey=='suteren'){
                    $total += $storey->gross_area;
                }                
            }
        }        
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNetArea()
    {
        $total = 0;
        if($storeys = $this->project->projectBuildingStoreys){
            foreach($storeys as $storey){
                $total += $storey->netArea;
            }
        }        
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubNetArea()
    {
        $total = 0;
        if($storeys = $this->project->projectBuildingStoreys){
            foreach($storeys as $storey){
                $total += $storey->SubNetArea;
            }
        }        
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrStanova()
    {
        $total = 0;
        if($storeys = $this->project->projectBuildingStoreys){
            foreach($storeys as $storey){
                if($parts = $storey->projectBuildingStoreyParts){
                    foreach($parts as $part){
                        if($part->type='stan'){
                            $total++;
                        }
                    }
                }
            }
        }        
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrPoslProstora()
    {
        $total = 0;
        if($storeys = $this->project->projectBuildingStoreys){
            foreach($storeys as $storey){
                if($parts = $storey->projectBuildingStoreyParts){
                    foreach($parts as $part){
                        if($part->type='biz'){
                            $total++;
                        }
                    }
                }
            }
        }        
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuiltAreaReg()
    {                
        return ($this->project->projectLot->area) ? $this->project->projectLot->built_index_reg*$this->project->projectLot->area : null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOccupancyAreaReg()
    {                
        return ($this->project->projectLot->area) ? $this->project->projectLot->occupancy_reg*$this->project->projectLot->area/100 : null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOccupancy()
    {                
        return ($this->project->projectLot->area) ? $this->pr->gross_area/$this->project->projectLot->area : null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuiltIndex()
    {                
        return ($this->project->projectLot->area) ? $this->grossAboveArea/$this->project->projectLot->area : null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectType()
    {
        $type = 0;
        switch ($this->type) {
           case 'slobodno':
               $type = 'slobodnostojeći objekat';
               break;
            case 'niz':
               $type = 'objekat u neprekinutom nizu';
               break;
            case 'dvojna':
               $type = 'deo dvojnog objekta';
               break;
            case 'ugaona':
               $type = 'ugaoni objekat';
               break;           
           default:
               $type = 'ostali objekti';
               break;
       }       
        return $type;
    }
}
