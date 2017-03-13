<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_building_storey_part_insulations".
 *
 * @property string $project_building_storey_part_id
 * @property string $thermal
 * @property string $sound
 * @property string $hidro
 * @property string $fireproof
 * @property string $chemical
 *
 * @property ProjectBuildingStoreyParts $projectBuildingStoreyPart
 */
class ProjectBuildingStoreyPartInsulations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_building_storey_part_insulations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_building_storey_part_id'], 'required'],
            [['project_building_storey_part_id'], 'integer'],
            [['thermal', 'sound', 'hidro', 'fireproof', 'chemical'], 'string'],
            [['project_building_storey_part_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectBuildingStoreyParts::className(), 'targetAttribute' => ['project_building_storey_part_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_building_storey_part_id' => Yii::t('app', 'Project Building Storey Part ID'),
            'thermal' => Yii::t('app', 'Termička izolacija objekta'),
            'sound' => Yii::t('app', 'Zvukoizolacija objekta'),
            'hidro' => Yii::t('app', 'Hidroizolacija objekta'),
            'fireproof' => Yii::t('app', 'Protivpožarna izolacija objekta'),
            'chemical' => Yii::t('app', 'Izolacija objekta od hemijskih sredstava'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildingStoreyPart()
    {
        return $this->hasOne(ProjectBuildingStoreyParts::className(), ['id' => 'project_building_storey_part_id']);
    }
}
