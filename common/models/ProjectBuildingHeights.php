<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_building_heights".
 *
 * @property string $id
 * @property string $project_building_id
 * @property string $part
 * @property string $type
 * @property string $value
 *
 * @property ProjectBuilding $projectBuilding
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
            [['project_building_id'], 'required'],
            [['project_building_id'], 'integer'],
            [['part', 'type'], 'string'],
            [['value'], 'number'],
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
            'project_building_id' => Yii::t('app', 'Project Building ID'),
            'part' => Yii::t('app', 'Part'),
            'type' => Yii::t('app', 'Type'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuilding()
    {
        return $this->hasOne(ProjectBuilding::className(), ['id' => 'project_building_id']);
    }
}
