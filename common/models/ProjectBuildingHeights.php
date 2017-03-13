<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_building_heights".
 *
 * @property string $id
 * @property string $project_building_id
 * @property string $part
 * @property string $level
 *
 * @property Projects $project
 */
class ProjectBuildingHeights extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_building_heights';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_building_id','part', 'level'], 'required'],
            [['project_building_id'], 'integer'],
            [['part', 'name'], 'string'],
            [['level'], 'number'],
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
            'part' => Yii::t('app', 'Deo objekta'),
            'level' => Yii::t('app', 'Visinska kota'),
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
    public function getAbsoluteLevel()
    {
        return $this->level+$this->projectBuilding->ground_floor_level;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbsoluteHeight()
    {
        return $this->level+$this->projectBuilding->project->projectLot->ground_level;
    }
}
