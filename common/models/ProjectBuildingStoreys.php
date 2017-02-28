<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_building_storeys".
 *
 * @property string $id
 * @property string $project_id
 * @property string $storey
 * @property string $order_no
 * @property string $sub_net_area
 * @property string $net_area
 * @property string $gross_area
 *
 * @property ProjectBuildingStoreyParts[] $projectBuildingStoreyParts
 * @property Projects $project
 */
class ProjectBuildingStoreys extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_building_storeys';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'storey'], 'required'],
            [['project_id', 'order_no'], 'integer'],
            [['storey'], 'string'],
            [['sub_net_area', 'net_area', 'gross_area'], 'number'],
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
            'project_id' => Yii::t('app', 'Naziv projekta'),
            'storey' => Yii::t('app', 'Etaža'),
            'order_no' => Yii::t('app', 'Redni broj'),
            'sub_net_area' => Yii::t('app', 'Redukovana neto površina'),
            'net_area' => Yii::t('app', 'Neto Površina'),
            'gross_area' => Yii::t('app', 'Bruto Površina'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildingStoreyParts()
    {
        return $this->hasMany(ProjectBuildingStoreyParts::className(), ['project_building_storey_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }
}
