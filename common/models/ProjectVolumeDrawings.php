<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_volume_drawings".
 *
 * @property string $id
 * @property string $project_volume_id
 * @property string $project_building_storey_id
 * @property string $type
 * @property string $number
 * @property string $name
 * @property string $title
 * @property integer $scale
 * @property string $note
 *
 * @property ProjectVolumes $projectVolume
 * @property ProjectBuildingStoreys $projectBuildingStorey
 */
class ProjectVolumeDrawings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_volume_drawings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_volume_id', 'number', 'name', 'scale'], 'required'],
            [['project_volume_id', 'project_building_storey_id', 'scale'], 'integer'],
            [['type', 'note'], 'string'],
            [['number'], 'string', 'max' => 5],
            [['name'], 'string', 'max' => 40],
            [['title'], 'string', 'max' => 128],
            [['project_volume_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectVolumes::className(), 'targetAttribute' => ['project_volume_id' => 'id']],
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
            'project_volume_id' => Yii::t('app', 'Project Volume ID'),
            'project_building_storey_id' => Yii::t('app', 'Project Building Storey ID'),
            'type' => Yii::t('app', 'Type'),
            'number' => Yii::t('app', 'Number'),
            'name' => Yii::t('app', 'Name'),
            'title' => Yii::t('app', 'Title'),
            'scale' => Yii::t('app', 'Scale'),
            'note' => Yii::t('app', 'Note'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectVolume()
    {
        return $this->hasOne(ProjectVolumes::className(), ['id' => 'project_volume_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildingStorey()
    {
        return $this->hasOne(ProjectBuildingStoreys::className(), ['id' => 'project_building_storey_id']);
    }
}
