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
            [['general', 'thermal', 'sound', 'hidro', 'fireproof', 'chemical'], 'string'],
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
            'general' => Yii::t('app', 'Opis izolacija jedinice'),
            'thermal' => Yii::t('app', 'Termička izolacija jedinice'),
            'sound' => Yii::t('app', 'Zvukoizolacija jedinice'),
            'hidro' => Yii::t('app', 'Hidroizolacija jedinice'),
            'fireproof' => Yii::t('app', 'Protivpožarna izolacija jedinice'),
            'chemical' => Yii::t('app', 'Izolacija jedinice od hemijskih sredstava'),
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
    public function getHintGeneral()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintThermal()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintSound()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintHidro()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintFireproof()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintChemical()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderGeneral()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderThermal()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderSound()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderHidro()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderFireproof()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderChemical()
    {
        return '';
    }
}
