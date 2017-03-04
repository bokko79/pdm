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
            [['project_building_storey_id', 'type'], 'required'],
            [['project_building_storey_id'], 'integer'],
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
            'type' => Yii::t('app', 'Vrsta'),
            'name' => Yii::t('app', 'Naziv'),
            'mark' => Yii::t('app', 'Oznaka'),
            'structure' => Yii::t('app', 'Struktura'),
            'area' => Yii::t('app', 'Površina'),
            'description' => Yii::t('app', 'Opis'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildingStoreyPartRooms()
    {
        return $this->hasMany(ProjectBuildingStoreyPartRooms::className(), ['project_building_storey_part_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildingStorey()
    {
        return $this->hasOne(ProjectBuildingStoreys::className(), ['id' => 'project_building_storey_id']);
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
            case 'biz':
                $type = 'poslovni prostor';
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
}
