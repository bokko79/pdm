<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_lot_existing_buildings".
 *
 * @property string $id
 * @property string $project_id
 * @property string $building_type_id
 * @property string $conditions
 * @property integer $gross_area
 * @property integer $removal
 * @property string $file_id
 * @property string $storeys
 * @property string $description
 * @property string $note
 *
 * @property Projects $project
 * @property BuildingTypes $buildingType
 */
class ProjectLotExistingBuildings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_lot_existing_buildings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id'], 'required'],
            [['project_id', 'building_type_id', 'gross_area', 'removal', 'file_id'], 'integer'],
            [['conditions', 'description', 'note'], 'string'],
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
            'building_type_id' => Yii::t('app', 'Building Type ID'),
            'conditions' => Yii::t('app', 'Conditions'),
            'gross_area' => Yii::t('app', 'Gross Area'),
            'removal' => Yii::t('app', 'Removal'),
            'file_id' => Yii::t('app', 'File ID'),
            'storeys' => Yii::t('app', 'Storeys'),
            'description' => Yii::t('app', 'Description'),
            'note' => Yii::t('app', 'Note'),
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
