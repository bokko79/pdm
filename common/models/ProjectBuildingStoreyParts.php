<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_building_storey_parts".
 *
 * @property string $id
 * @property string $project_building_storey_id
 * @property string $type
 * @property string $name
 * @property string $mark
 * @property string $structure
 * @property string $area
 * @property string $description
 *
 * @property ProjectBuildingStoreyPartRooms[] $projectBuildingStoreyPartRooms
 * @property ProjectBuildingStoreys $projectBuildingStorey
 */
class ProjectBuildingStoreyParts extends \yii\db\ActiveRecord
{
    public $sameRoom; // u generatoru etaža objekta
    public $copiedRoom;

    public $room_to_add;
    public $qty;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_building_storey_parts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_building_storey_id', 'type', 'mode'], 'required'],
            [['project_building_storey_id', 'same_as_id', 'qty', 'room_to_add'], 'integer'],
            [['type', 'structure', 'description'], 'string'],
            [['area'], 'number'],
            [['name'], 'string', 'max' => 64],
            [['mark'], 'string', 'max' => 12],
            [['project_building_storey_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectBuildingStoreys::className(), 'targetAttribute' => ['project_building_storey_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'project_building_storey_id' => Yii::t('app', 'Etaža'),
            'same_as_id' => Yii::t('app', 'Kopirana jedinica'),
            'type' => Yii::t('app', 'Vrsta'),
            'name' => Yii::t('app', 'Naziv'),
            'mark' => Yii::t('app', 'Oznaka'),
            'structure' => Yii::t('app', 'Struktura'),
            'area' => Yii::t('app', 'Površina'),
            'description' => Yii::t('app', 'Opis'),
            'room_to_add' => 'Lista prostorija za dodavanje celini',
            'fullType' => 'Vrsta celine',
            'subNetArea' => 'Reduk. neto površina',
            'netArea' => 'Neto površina',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildingStoreyPartRooms()
    {
        return $this->hasMany(ProjectBuildingStoreyPartRooms::className(), ['project_building_storey_part_id' => 'id'])->orderBy('mark');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildingStoreyPartCharacteristics()
    {
        return $this->hasOne(ProjectBuildingStoreyPartCharacteristics::className(), ['project_building_storey_part_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildingStoreyPartInsulations()
    {
        return $this->hasOne(ProjectBuildingStoreyPartInsulations::className(), ['project_building_storey_part_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildingStoreyPartMaterials()
    {
        return $this->hasOne(ProjectBuildingStoreyPartMaterials::className(), ['project_building_storey_part_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildingStoreyPartServices()
    {
        return $this->hasOne(ProjectBuildingStoreyPartServices::className(), ['project_building_storey_part_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildingStoreyPartStructure()
    {
        return $this->hasOne(ProjectBuildingStoreyPartStructure::className(), ['project_building_storey_part_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildingStorey()
    {
        return $this->hasOne(ProjectBuildingStoreys::className(), ['id' => 'project_building_storey_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCopies()
    {
        return $this->hasMany(ProjectBuildingStoreyParts::className(), ['same_as_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSameAs()
    {
        return $this->hasOne(ProjectBuildingStoreyParts::className(), ['id' => 'same_as_id']);
    }

    public function getNetArea()
    {
        $total = 0;
        if($rooms = $this->projectBuildingStoreyPartRooms){
            foreach($rooms as $room){
                $total += $room->net_area;
            }
        }
        return $total;
    }

    public function getSubNetArea()
    {
        $total = 0;
        if($rooms = $this->projectBuildingStoreyPartRooms){
            foreach($rooms as $room){
                $total += $room->sub_net_area;
            }
        }
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFullname()
    {
        return $this->mark. ' '.$this->type;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFullType()
    {
        $type;
        switch ($this->type) {
            case 'stan':
                $type = 'stan';
                break;
            case 'stamb':
                $type = 'stambene prostorije';
                break;
            case 'biz':
                $type = 'poslovni prostor';
                break;
            case 'posl':
                $type = 'poslovne prostorije';
                break;
            case 'common':
                $type = 'zajedničke prostorije';
                break;
            case 'garage':
                $type = 'garažne prostorije';
                break;
            case 'tech':
                $type = 'tehničke prostorije';
                break;
            
            default:
                $type = 'drugo';
                break;
        }
        return $type;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStambene()
    {
        $rooms = [];
        foreach($this->projectBuildingStoreyParts as $room){
            if ($room->group=='Stambene prostorije'){
                $rooms[] = $room;
            }
        }
        return $rooms;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPoslovne()
    {
        $rooms = [];
        foreach($this->projectBuildingStoreyParts as $room){
            if ($room->group=='Poslovne prostorije'){
                $rooms[] = $room;
            }
        }
        return $rooms;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getZajednicke()
    {
        $rooms = [];
        foreach($this->projectBuildingStoreyParts as $room){
            if ($room->group=='Zajedničke prostorije'){
                $rooms[] = $room;
            }
        }
        return $rooms;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTehnicke()
    {
        $rooms = [];
        foreach($this->projectBuildingStoreyParts as $room){
            if ($room->group=='Tehničke prostorije'){
                $rooms[] = $room;
            }
        }
        return $rooms;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOstale()
    {
        $rooms = [];
        foreach($this->projectBuildingStoreyParts as $room){
            if ($room->group=='Ostale prostorije'){
                $rooms[] = $room;
            }
        }
        return $rooms;
    }

    public function saveNewRoom()
    {
        $new_room = new \common\models\ProjectBuildingStoreyPartRooms();
        $new_room->project_building_storey_part_id = $this->id;
        $new_room->room_type_id = 15;
        $new_room->name = 'ulaz';
        $new_room->mark = '1';
        $new_room->flooring = 'keramika';
        $new_room->save();
    }
}
