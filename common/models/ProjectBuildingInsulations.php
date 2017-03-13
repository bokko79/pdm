<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_building_insulations".
 *
 * @property string $project_building_id
 * @property string $thermal
 * @property string $sound
 * @property string $hidro
 * @property string $fireproof
 * @property string $chemical
 *
 * @property Projects $project
 */
class ProjectBuildingInsulations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_building_insulations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_building_id'], 'required'],
            [['project_building_id'], 'integer'],
            [['thermal', 'sound', 'hidro', 'fireproof', 'chemical'], 'string'],
            [['project_building_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectBuilding::className(), 'targetAttribute' => ['project_building_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_building_id' => Yii::t('app', 'Objekat projekta'),
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
    public function getProjectBuilding()
    {
        return $this->hasOne(ProjectBuilding::className(), ['id' => 'project_building_id']);
    }
}
