<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "project_building_storeys".
 *
 * @property string $id
 * @property string $project_building_id
 * @property string $storey
 * @property integer $order_no
 * @property string $sub_net_area
 * @property string $net_area
 * @property string $gross_area
 * @property string $name
 * @property string $level
 * @property string $height
 * @property integer $units_total
 * @property string $description
 *
 * @property ProjectBuildingStoreyParts[] $projectBuildingStoreyParts
 * @property Projects $project
 */
class ProjectBuildingStoreys extends \yii\db\ActiveRecord
{
    public $samePart; // u generatoru etaža objekta
    public $copiedPart;

    public $stan;
    public $biz;
    public $stamb;
    public $posl;
    public $garage;
    public $common;
    public $tech;
    public $external;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_building_storeys';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_building_id', 'storey'], 'required'],
            [['project_building_id', 'units_total', 'same_as_id', 'stan', 'biz', 'stamb', 'posl', 'garage', 'common', 'tech', 'external'], 'integer'],
            [['storey', 'description', 'order_no'], 'string'],
            [['sub_net_area', 'net_area', 'gross_area', 'level', 'height'], 'number'],
            [['name'], 'string', 'max' => 64],
            [['project_building_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectBuilding::className(), 'targetAttribute' => ['project_building_id' => 'id']],            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'project_building_id' => Yii::t('app', 'Objekat projekta'),
            'same_as_id' => Yii::t('app', 'Kopirana etaža'),
            'storey' => Yii::t('app', 'Etaža'),
            'order_no' => Yii::t('app', 'Redni broj'),
            'sub_net_area' => Yii::t('app', 'Redukovana neto površina'),
            'net_area' => Yii::t('app', 'Neto površina'),
            'gross_area' => Yii::t('app', 'Bruto Površina'),
            'name' => Yii::t('app', 'Naziv etaže'),
            'level' => Yii::t('app', 'Relativna visinska kota'),
            'height' => Yii::t('app', 'Spratna visina'),
            'units_total' => Yii::t('app', 'Broj jedinica'),
            'stan' => Yii::t('app', 'Stan (stambena jedinica)'),
            'stamb' => Yii::t('app', 'Stambene prostorije'),
            'biz' => Yii::t('app', 'Lokal (poslovni prostor)'),
            'posl' => Yii::t('app', 'Poslovne prostorije'),
            'common' => Yii::t('app', 'Zajedničke prostorije'),
            'tech' => Yii::t('app', 'Tehničke prostorije'),
            'garage' => Yii::t('app', 'Garažne i parking prostorije'),
            'external' => Yii::t('app', 'Spoljašnje prostorije'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildingStoreyParts()
    {
        return $this->hasMany(ProjectBuildingStoreyParts::className(), ['project_building_storey_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildingStoreyDoorwin()
    {
        return $this->hasMany(ProjectBuildingStoreyDoorwin::className(), ['project_building_storey_id' => 'id']);
    }    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuilding()
    {
        return $this->hasOne(ProjectBuilding::className(), ['id' => 'project_building_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCopies()
    {
        return $this->hasMany(ProjectBuildingStoreys::className(), ['same_as_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSameAs()
    {
        return $this->hasOne(ProjectBuildingStoreys::className(), ['id' => 'same_as_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSt()
    {
        return \common\models\ProjectBuildingStoreyParts::find()->where('project_building_storey_id='.$this->id. ' and type="stan"')->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getS()
    {
        return \common\models\ProjectBuildingStoreyParts::find()->where('project_building_storey_id='.$this->id. ' and type="stamb"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getT()
    {
        return \common\models\ProjectBuildingStoreyParts::find()->where('project_building_storey_id='.$this->id. ' and type="tech"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getB()
    {
        return \common\models\ProjectBuildingStoreyParts::find()->where('project_building_storey_id='.$this->id. ' and type="biz"')->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getP()
    {
        return \common\models\ProjectBuildingStoreyParts::find()->where('project_building_storey_id='.$this->id. ' and type="posl"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getG()
    {
        return \common\models\ProjectBuildingStoreyParts::find()->where('project_building_storey_id='.$this->id. ' and type="garage"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getC()
    {
        return \common\models\ProjectBuildingStoreyParts::find()->where('project_building_storey_id='.$this->id. ' and type="common"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getW()
    {
        return \common\models\ProjectBuildingStoreyParts::find()->where('project_building_storey_id='.$this->id. ' and type="whole"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getE()
    {
        return \common\models\ProjectBuildingStoreyParts::find()->where('project_building_storey_id='.$this->id. ' and type="external"')->one();
    }

    public function getNetArea()
    {
        $total = 0;
        if($parts = $this->projectBuildingStoreyParts){
            foreach($parts as $part){
                $total += $part->netArea;
            }
        }
        return $total;
    }

    public function getSubNetArea()
    {
        $total = 0;
        if($parts = $this->projectBuildingStoreyParts){
            foreach($parts as $part){
                $total += $part->subNetArea;
            }
        }
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNetAreaStan()
    {
        $total = 0;
        if($parts = $this->projectBuildingStoreyParts){
            foreach($parts as $part){
                if($part->type=='stan' or $part->type=='stamb'){
                    $total += $part->netArea;
                }
            }
        } 
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubNetAreaStan()
    {
        $total = 0;
        if($parts = $this->projectBuildingStoreyParts){
            foreach($parts as $part){
                if($part->type=='stan' or $part->type=='stamb'){
                    $total += $part->subNetArea;
                }
            }
        } 
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNetAreaStamb()
    {
        $total = 0;
        if($parts = $this->projectBuildingStoreyParts){
            foreach($parts as $part){
                if($part->type=='stamb'){
                    $total += $part->netArea;
                }
            }
        } 
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubNetAreaStamb()
    {
        $total = 0;
        if($parts = $this->projectBuildingStoreyParts){
            foreach($parts as $part){
                if($part->type=='stamb'){
                    $total += $part->subNetArea;
                }
            }
        } 
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNetAreaBiz()
    {
        $total = 0;
        if($parts = $this->projectBuildingStoreyParts){
            foreach($parts as $part){
                if($part->type=='biz' or $part->type=='posl'){
                    $total += $part->netArea;
                }
            }
        } 
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubNetAreaBiz()
    {
        $total = 0;
        if($parts = $this->projectBuildingStoreyParts){
            foreach($parts as $part){
                if($part->type=='biz' or $part->type=='posl'){
                    $total += $part->subNetArea;
                }
            }
        } 
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNetAreaPosl()
    {
        $total = 0;
        if($parts = $this->projectBuildingStoreyParts){
            foreach($parts as $part){
                if($part->type=='posl'){
                    $total += $part->netArea;
                }
            }
        } 
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubNetAreaPosl()
    {
        $total = 0;
        if($parts = $this->projectBuildingStoreyParts){
            foreach($parts as $part){
                if($part->type=='posl'){
                    $total += $part->subNetArea;
                }
            }
        } 
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNetAreaGarage()
    {
        $total = 0;
        if($parts = $this->projectBuildingStoreyParts){
            foreach($parts as $part){
                if($part->type=='garage'){
                    $total += $part->netArea;
                }
            }
        } 
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubNetAreaGarage()
    {
        $total = 0;
        if($parts = $this->projectBuildingStoreyParts){
            foreach($parts as $part){
                if($part->type=='garage'){
                    $total += $part->subNetArea;
                }
            }
        } 
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNetAreaCommon()
    {
        $total = 0;
        if($parts = $this->projectBuildingStoreyParts){
            foreach($parts as $part){
                if($part->type=='common'){
                    $total += $part->netArea;
                }
            }
        } 
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubNetAreaCommon()
    {
        $total = 0;
        if($parts = $this->projectBuildingStoreyParts){
            foreach($parts as $part){
                if($part->type=='common'){
                    $total += $part->subNetArea;
                }
            }
        } 
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNetAreaTech()
    {
        $total = 0;
        if($parts = $this->projectBuildingStoreyParts){
            foreach($parts as $part){
                if($part->type=='tech'){
                    $total += $part->netArea;
                }
            }
        } 
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubNetAreaTech()
    {
        $total = 0;
        if($parts = $this->projectBuildingStoreyParts){
            foreach($parts as $part){
                if($part->type=='tech'){
                    $total += $part->subNetArea;
                }
            }
        } 
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbsoluteLevel()
    {
        return $this->level+$this->projectBuilding->ground_floor_level;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbsoluteHeight()
    {
        return $this->level+$this->project->projectLot->ground_level;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrStanova()
    {
        $total = 0;
        if($parts = $this->projectBuildingStoreyParts){
            foreach($parts as $part){
                if($part->type=='stan'){
                    $total++;
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
        if($parts = $this->projectBuildingStoreyParts){
            foreach($parts as $part){
                if($part->type=='biz'){
                    $total++;
                }
            }
        }
        return $total;
    }  

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchemePosition($doorwin_id)
    {
        return \common\models\ProjectBuildingStoreyDoorwin::find()->where('project_building_storey_id='.$this->id. ' and project_building_doorwin_id='.$doorwin_id)->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchemePositionTotal()
    {
        $total = 0;
        if($pos = $this->projectBuildingStoreyDoorwin){
            foreach($pos as $ps){
                $total += $ps->total;
            }
        }
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchemePositionLeftsTotal()
    {
        $total = 0;
        if($pos = $this->projectBuildingStoreyDoorwin){
            foreach($pos as $ps){
                $total += $ps->lefts;
            }
        }
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchemePositionRightsTotal()
    {
        $total = 0;
        if($pos = $this->projectBuildingStoreyDoorwin){
            foreach($pos as $ps){
                $total += $ps->rights;
            }
        }
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOtherStoreysOfBuilding()
    {
        $storeys = [];
        if($otherStoreys = $this->projectBuilding->projectBuildingStoreys){
            foreach($otherStoreys as $otherStorey){
                if($otherStorey->id!=$this->id){
                    $storeys[] = $otherStorey;
                }
            }
        }
        return $storeys;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOtherUniqueStoreysOfBuilding()
    {
        $storeys = [];
        if($otherStoreys = $this->projectBuilding->projectBuildingStoreys){
            foreach($otherStoreys as $otherStorey){
                if($otherStorey->id!=$this->id and $otherStorey->same_as_id==null){
                    $storeys[] = $otherStorey;
                }
            }
        }
        return $storeys;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        $query_cla = \common\models\ProjectBuildingStoreyPartRooms::find()->where('id=0');
        
        if($parts = $this->projectBuildingStoreyParts){
            foreach ($parts as $key => $part) {
                $query_cla->orWhere(['project_building_storey_part_id' => $part->id]);
            }
        }
        return new \yii\data\ActiveDataProvider([
                'query' => $query_cla->orderBy('project_building_storey_part_id ASC, CAST(mark AS INTEGER)')->groupBy(''),
            ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParts()
    {
        $query_cla = \common\models\ProjectBuildingStoreyParts::find()->where('project_building_storey_id='.$this->id);
        return new \yii\data\ActiveDataProvider([
                'query' => $query_cla->orderBy('')->groupBy(''),
            ]);
    }
}   
