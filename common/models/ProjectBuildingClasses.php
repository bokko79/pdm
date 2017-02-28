<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_building_classes".
 *
 * @property string $id
 * @property string $project_id
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
            [['project_id', 'building_id'], 'required'],
            [['project_id', 'building_id'], 'integer'],
            [['percent', 'area'], 'number'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'id']],
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
            'project_id' => Yii::t('app', 'Project ID'),
            'building_id' => Yii::t('app', 'Building ID'),
            'percent' => Yii::t('app', 'Percent'),
            'area' => Yii::t('app', 'Area'),
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
    public function getBuilding()
    {
        return $this->hasOne(Buildings::className(), ['id' => 'building_id']);
    }
}
