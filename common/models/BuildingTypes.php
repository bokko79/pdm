<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "building_types".
 *
 * @property string $id
 * @property string $name
 *
 * @property ProjectBuilding[] $projectBuildings
 * @property ProjectBuildingParts[] $projectBuildingParts
 * @property ProjectLotExistingBuildings[] $projectLotExistingBuildings
 * @property ProjectLotFutureDevelopments[] $projectLotFutureDevelopments
 */
class BuildingTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'building_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Namena objekta'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildings()
    {
        return $this->hasMany(ProjectBuilding::className(), ['building_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildingParts()
    {
        return $this->hasMany(ProjectBuildingParts::className(), ['building_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectLotExistingBuildings()
    {
        return $this->hasMany(ProjectLotExistingBuildings::className(), ['building_type_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectLotFutureDevelopments()
    {
        return $this->hasMany(ProjectLotFutureDevelopments::className(), ['building_type_id' => 'id']);
    }
}
