<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_building_storey_doorwin".
 *
 * @property string $id
 * @property string $project_building_storey_id
 * @property string $project_building_doorwin_id
 * @property integer $lefts
 * @property integer $rights
 * @property integer $total
 *
 * @property ProjectBuildingStoreys $projectBuildingStorey
 * @property ProjectBuildingDoorwin $projectBuildingDoorwin
 */
class ProjectBuildingStoreyDoorwin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_building_storey_doorwin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_building_storey_id', 'project_building_doorwin_id'], 'required'],
            [['project_building_storey_id', 'project_building_doorwin_id', 'lefts', 'rights', 'total'], 'integer'],
            [['project_building_storey_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectBuildingStoreys::className(), 'targetAttribute' => ['project_building_storey_id' => 'id']],
            [['project_building_doorwin_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectBuildingDoorwin::className(), 'targetAttribute' => ['project_building_doorwin_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'project_building_storey_id' => Yii::t('app', 'Project Building Storey ID'),
            'project_building_doorwin_id' => Yii::t('app', 'Project Building Doorwin ID'),
            'lefts' => Yii::t('app', 'Lefts'),
            'rights' => Yii::t('app', 'Rights'),
            'total' => Yii::t('app', 'Total'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildingStorey()
    {
        return $this->hasOne(ProjectBuildingStoreys::className(), ['id' => 'project_building_storey_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildingDoorwin()
    {
        return $this->hasOne(ProjectBuildingDoorwin::className(), ['id' => 'project_building_doorwin_id']);
    }
}
