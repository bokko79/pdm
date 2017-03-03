<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_building_storey_part_rooms".
 *
 * @property string $id
 * @property string $project_building_storey_part_id
 * @property string $type
 * @property string $name
 * @property string $mark
 * @property string $circumference
 * @property string $flooring
 * @property string $length
 * @property string $width
 * @property string $height
 * @property string $sub_net_area
 * @property string $net_area
 *
 * @property ProjectBuildingStoreyParts $projectBuildingStoreyPart
 */
class ProjectBuildingStoreyPartRooms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_building_storey_part_rooms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_building_storey_part_id', 'type'], 'required'],
            [['project_building_storey_part_id', 'mark'], 'integer'],
            [['type', 'flooring'], 'string'],
            [['circumference', 'length', 'width', 'height', 'sub_net_area', 'net_area'], 'number'],
            [['name'], 'string', 'max' => 32],
           // [['mark'], 'string', 'max' => 12],
            [['project_building_storey_part_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectBuildingStoreyParts::className(), 'targetAttribute' => ['project_building_storey_part_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'project_building_storey_part_id' => Yii::t('app', 'Jedinica etaže'),
            'type' => Yii::t('app', 'Vrsta prostorije'),
            'name' => Yii::t('app', 'Naziv prostorije'),
            'mark' => Yii::t('app', 'Oznaka'),
            'circumference' => Yii::t('app', 'Obim'),
            'flooring' => Yii::t('app', 'Obrada poda'),
            'length' => Yii::t('app', 'Dužina'),
            'width' => Yii::t('app', 'Širina'),
            'height' => Yii::t('app', 'Visina'),
            'sub_net_area' => Yii::t('app', 'Redukovana podna površina'),
            'net_area' => Yii::t('app', 'Ukupna podna površina'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildingStoreyPart()
    {
        return $this->hasOne(ProjectBuildingStoreyParts::className(), ['id' => 'project_building_storey_part_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFullname()
    {
        return $this->mark. ' ' .$this->name. ' '.$this->type;
    }
}
