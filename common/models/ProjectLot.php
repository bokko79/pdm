<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_lot".
 *
 * @property string $project_id
 * @property integer $conditions
 * @property string $width
 * @property string $length
 * @property string $disposition
 * @property string $type
 * @property string $area
 * @property string $ground_level
 * @property string $road_level
 * @property string $underwater_level
 * @property string $ground
 * @property string $access
 * @property string $ownership
 * @property string $adjacent_border
 * @property string $services
 * @property string $description
 * @property string $note
 * @property string $legal
 * @property string $green_area_reg
 * @property string $green_area
 * @property string $occupancy_reg
 * @property string $built_index_reg
 * @property string $parking
 * @property integer $parking_spaces
 * @property integer $parking_disabled
 *
 * @property Projects $project
 */
class ProjectLot extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_lot';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id'], 'required'],
            [['project_id', 'conditions', 'parking_spaces', 'parking_disabled'], 'integer'],
            [['width', 'length', 'area', 'ground_level', 'road_level', 'underwater_level', 'green_area_reg', 'green_area', 'occupancy_reg', 'built_index_reg'], 'number'],
            [['disposition', 'type', 'ground', 'access', 'ownership', 'adjacent_border', 'services', 'description', 'note', 'legal', 'parking'], 'string'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_id' => Yii::t('app', 'Project ID'),
            'conditions' => Yii::t('app', 'Conditions'),
            'width' => Yii::t('app', 'Width'),
            'length' => Yii::t('app', 'Length'),
            'disposition' => Yii::t('app', 'Disposition'),
            'type' => Yii::t('app', 'Type'),
            'area' => Yii::t('app', 'Area'),
            'ground_level' => Yii::t('app', 'Ground Level'),
            'road_level' => Yii::t('app', 'Road Level'),
            'underwater_level' => Yii::t('app', 'Underwater Level'),
            'ground' => Yii::t('app', 'Ground'),
            'access' => Yii::t('app', 'Access'),
            'ownership' => Yii::t('app', 'Ownership'),
            'adjacent_border' => Yii::t('app', 'Adjacent Border'),
            'services' => Yii::t('app', 'Services'),
            'description' => Yii::t('app', 'Description'),
            'note' => Yii::t('app', 'Note'),
            'legal' => Yii::t('app', 'Legal'),
            'green_area_reg' => Yii::t('app', 'Green Area Reg'),
            'green_area' => Yii::t('app', 'Green Area'),
            'occupancy_reg' => Yii::t('app', 'Occupancy Reg'),
            'built_index_reg' => Yii::t('app', 'Built Index Reg'),
            'parking' => Yii::t('app', 'Parking'),
            'parking_spaces' => Yii::t('app', 'Parking Spaces'),
            'parking_disabled' => Yii::t('app', 'Parking Disabled'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }
}
