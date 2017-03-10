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
            [['project_id', 'building_type_id', 'removal', 'file_id'], 'integer'],
            [['gross_area'], 'number'],
            [['conditions', 'description', 'note'], 'string'],
            [['storeys', 'mark'], 'string', 'max' => 32],
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
            'project_id' => Yii::t('app', 'Projekat'),
            'building_type_id' => Yii::t('app', 'Namena objekta'),
            'conditions' => Yii::t('app', 'Stanje objekta'),
            'gross_area' => Yii::t('app', 'Bruto površina objekta'),
            'removal' => Yii::t('app', 'Objekat se ruši?'),
            'file_id' => Yii::t('app', 'Slike objekta'),
            'storeys' => Yii::t('app', 'Spratnost objekta'),
            'description' => Yii::t('app', 'Opis objekta'),
            'note' => Yii::t('app', 'Napomena'),
            'mark' => Yii::t('app', 'Oznaka objekta na snimku/planu'),
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
