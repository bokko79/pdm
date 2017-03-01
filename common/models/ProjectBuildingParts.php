<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_building_parts".
 *
 * @property string $id
 * @property string $project_id
 * @property string $name
 * @property string $building_type_id
 * @property string $gross_area
 * @property string $net_area
 * @property string $height
 * @property string $storeys
 * @property string $description
 *
 * @property Projects $project
 * @property BuildingTypes $buildingType
 */
class ProjectBuildingParts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_building_parts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'name', 'building_type_id'], 'required'],
            [['project_id', 'building_type_id'], 'integer'],
            [['gross_area', 'net_area', 'height'], 'number'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 64],
            [['storeys'], 'string', 'max' => 32],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['building_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => BuildingTypes::className(), 'targetAttribute' => ['building_type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'project_id' => Yii::t('app', 'Project ID'),
            'name' => Yii::t('app', 'Name'),
            'building_type_id' => Yii::t('app', 'Building Type ID'),
            'gross_area' => Yii::t('app', 'Gross Area'),
            'net_area' => Yii::t('app', 'Net Area'),
            'height' => Yii::t('app', 'Height'),
            'storeys' => Yii::t('app', 'Storeys'),
            'description' => Yii::t('app', 'Description'),
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
    public function getBuildingType()
    {
        return $this->hasOne(BuildingTypes::className(), ['id' => 'building_type_id']);
    }
}
