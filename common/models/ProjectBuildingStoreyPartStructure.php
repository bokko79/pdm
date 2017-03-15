<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_building_storey_part_structure".
 *
 * @property string $project_building_storey_part_id
 * @property string $construction
 * @property string $wall_external
 * @property string $wall_bearing
 * @property string $wall_internal
 * @property string $slab
 * @property string $columns
 * @property string $beam
 * @property string $stair
 * @property string $arch
 * @property string $door
 * @property string $window
 * @property string $chimney
 * @property string $facade
 * @property string $tinwork
 * @property string $woodwork
 * @property string $steelwork
 *
 * @property ProjectBuildingStoreyParts $projectBuildingStoreyPart
 */
class ProjectBuildingStoreyPartStructure extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_building_storey_part_structure';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_building_storey_part_id'], 'required'],
            [['project_building_storey_part_id'], 'integer'],
            [['construction', 'wall_external', 'wall_bearing', 'wall_internal', 'slab', 'columns', 'beam', 'stair', 'arch', 'door', 'window', 'chimney', 'facade', 'tinwork', 'woodwork', 'steelwork'], 'string'],
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
            'wall_external' => Yii::t('app', 'Spoljašnji zidovi'),
            'wall_bearing' => Yii::t('app', 'Noseći konstruktivni zidovi i platna'),
            'wall_internal' => Yii::t('app', 'Unutrašnji pregradni zidovi'),
            'slab' => Yii::t('app', 'Ploče i međuspratne konstrukcije'),
            'columns' => Yii::t('app', 'Stubovi i vertikalni serklaži'),
            'beam' => Yii::t('app', 'Grede i horizontalni serklaži'),
            'stair' => Yii::t('app', 'Stepenište'),
            'arch' => Yii::t('app', 'Lukovi i svodovi'),
           'chimney' => Yii::t('app', 'Dimnjaci i ventilacioni kanali'),
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
    public function getHintConstruction()
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
    public function getHintSlab()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintColumns()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintBeam()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintTruss()
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
    public function getHintArch()
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
    public function getHintChimney()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderConstruction()
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
    public function getPlaceholderSlab()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderColumns()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderBeam()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderTruss()
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
    public function getPlaceholderArch()
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
    public function getPlaceholderChimney()
    {
        return '';
    }
}
