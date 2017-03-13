<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_building_storey_part_materials".
 *
 * @property string $project_building_storey_part_id
 * @property string $access
 * @property string $foundation
 * @property string $wall_external
 * @property string $wall_bearing
 * @property string $wall_internal
 * @property string $facade
 * @property string $flooring
 * @property string $ceiling
 * @property string $door
 * @property string $window
 * @property string $tinwork
 * @property string $stair
 * @property string $woodwork
 * @property string $steelwork
 * @property string $roof
 * @property string $light
 * @property string $sanitary
 * @property string $electrical
 * @property string $plumbing
 * @property string $hvac
 * @property string $chimney
 * @property string $furniture
 * @property string $kitchen
 * @property string $bathroom
 * @property string $lift
 * @property string $roofing
 *
 * @property ProjectBuildingStoreyParts $projectBuildingStoreyPart
 */
class ProjectBuildingStoreyPartMaterials extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_building_storey_part_materials';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_building_storey_part_id'], 'required'],
            [['project_building_storey_part_id'], 'integer'],
            [['access', 'foundation', 'wall_external', 'wall_bearing', 'wall_internal', 'facade', 'flooring', 'ceiling', 'door', 'window', 'tinwork', 'stair', 'woodwork', 'steelwork', 'roof', 'light', 'sanitary', 'electrical', 'plumbing', 'hvac', 'chimney', 'furniture', 'kitchen', 'bathroom', 'lift', 'roofing'], 'string'],
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
            'access' => Yii::t('app', 'Prilazi objektu'),
            'foundation' => Yii::t('app', 'Temelji'),
            'wall_external' => Yii::t('app', 'Spoljašnji i fasadni zidovi'),
            'wall_bearing' => Yii::t('app', 'Noseći konstruktivni zidovi'),
            'wall_internal' => Yii::t('app', 'Unutrašnji pregradni zidovi'),
            'facade' => Yii::t('app', 'Fasada'),
            'flooring' => Yii::t('app', 'Obrada podova'),
            'ceiling' => Yii::t('app', 'Obrada plafona'),
            'door' => Yii::t('app', 'Vrata'),
            'window' => Yii::t('app', 'Prozori'),
            'tinwork' => Yii::t('app', 'Limarija'),
            'stair' => Yii::t('app', 'Stepenište'),
            'woodwork' => Yii::t('app', 'Stolarija'),
            'steelwork' => Yii::t('app', 'Bravarija'),
            'roof' => Yii::t('app', 'Krovna konstrukcija'),
            'light' => Yii::t('app', 'Rasveta'),
            'sanitary' => Yii::t('app', 'Sanitarni uređaji'),
            'electrical' => Yii::t('app', 'Električni uređaji'),
            'plumbing' => Yii::t('app', 'Vodovod i kanalizacija'),
            'hvac' => Yii::t('app', 'Instalacije grejanja, klimatizacije i ventilacije'),
            'chimney' => Yii::t('app', 'Dimnjaci i ventilacioni kanali'),
            'furniture' => Yii::t('app', 'Nameštaj'),
            'kitchen' => Yii::t('app', 'Kuhinjski nameštaj'),
            'bathroom' => Yii::t('app', 'Kupatilski nameštaj'),
            'lift' => Yii::t('app', 'Liftovi'),
            'roofing' => Yii::t('app', 'Krovni pokrivač'),
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
