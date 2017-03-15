<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_building_materials".
 *
 * @property string $project_building_id
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
 * @property Projects $project
 */
class ProjectBuildingMaterials extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_building_materials';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_building_id'], 'required'],
            [['project_building_id'], 'integer'],
            [['access', 'foundation', 'wall_external', 'wall_bearing', 'wall_internal', 'facade', 'flooring', 'ceiling', 'door', 'window', 'tinwork', 'stair', 'woodwork', 'steelwork', 'roof', 'light', 'sanitary', 'electrical', 'plumbing', 'hvac', 'chimney', 'furniture', 'kitchen', 'bathroom', 'lift', 'roofing'], 'string'],
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
    public function getProjectBuilding()
    {
        return $this->hasOne(ProjectBuilding::className(), ['id' => 'project_building_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintAccess()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintFoundation()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintWallExternal()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintWallBearing()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintWallInternal()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintFacade()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintFlooring()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintCeiling()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintDoor()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintWindow()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintTinwork()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintStair()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintWoodwork()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintSteelwork()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintRoof()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintLight()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintSanitary()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintElectrical()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintPlumbing()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintHvac()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintChimney()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintFurniture()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintKitchen()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintBathroom()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintLift()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintRoofing()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderAccess()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderFoundation()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderWallExternal()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderWallBearing()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderWallInternal()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderFacade()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderFlooring()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderCeiling()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderDoor()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderWindow()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderTinwork()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderStair()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderWoodwork()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderSteelwork()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderRoof()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderLight()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderSanitary()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderElectrical()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderPlumbing()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderHvac()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderChimney()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderFurniture()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderKitchen()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderBathroom()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderLift()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderRoofing()
    {
        return '';
    }
}
