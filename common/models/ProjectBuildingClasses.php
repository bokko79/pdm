<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_building_classes".
 *
 * @property string $id
 * @property string $project_building_id
 * @property string $building_id
 * @property string $percent
 * @property string $area
 *
 * @property Projects $project
 * @property Buildings $building
 */
class ProjectBuildingClasses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_building_classes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_building_id', 'building_id'], 'required'],
            [['project_building_id', 'building_id'], 'integer'],
            [['percent', 'area'], 'number'],
            [['project_building_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectBuilding::className(), 'targetAttribute' => ['project_building_id' => 'id']],
            [['building_id'], 'exist', 'skipOnError' => true, 'targetClass' => Buildings::className(), 'targetAttribute' => ['building_id' => 'id']],
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
            'building_id' => Yii::t('app', 'Klasa objekta'),
            'percent' => Yii::t('app', 'Procenat'),
            'area' => Yii::t('app', 'Površina'),
        ];
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
    public function getBuilding()
    {
        return $this->hasOne(Buildings::className(), ['id' => 'building_id']);
    }
}
