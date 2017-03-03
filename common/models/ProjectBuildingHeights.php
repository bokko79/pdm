<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_building_heights".
 *
 * @property string $id
 * @property string $project_id
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
            [['project_id','part', 'level'], 'required'],
            [['project_id'], 'integer'],
            [['part', 'name'], 'string'],
            [['level'], 'number'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'id']],
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
            'part' => Yii::t('app', 'Deo objekta'),
            'level' => Yii::t('app', 'Visinska kota'),
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
    public function getAbsoluteLevel()
    {
        return $this->level+$this->project->projectBuilding->ground_floor_level;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbsoluteHeight()
    {
        return $this->level+$this->project->projectLot->ground_level;
    }
}
