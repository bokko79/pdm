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
            [['type'], 'string'],
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
            'project_building_storey_id' => Yii::t('app', 'Project Building Storey ID'),
            'type' => Yii::t('app', 'Type'),
            'name' => Yii::t('app', 'Name'),
            'mark' => Yii::t('app', 'Mark'),
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
}
