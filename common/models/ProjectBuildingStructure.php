<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_building_structure".
 *
 * @property string $project_id
 * @property string $construction
 * @property string $foundation
 * @property string $wall_external
 * @property string $wall_bearing
 * @property string $wall_internal
 * @property string $slab
 * @property string $columns
 * @property string $beam
 * @property string $truss
 * @property string $stair
 * @property string $arch
 * @property string $door
 * @property string $window
 * @property string $roof
 * @property string $chimney
 * @property string $facade
 * @property string $tinwork
 * @property string $woodwork
 * @property string $steelwork
 *
 * @property Projects $project
 */
class ProjectBuildingStructure extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_building_structure';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id'], 'required'],
            [['project_id'], 'integer'],
            [['construction', 'foundation', 'wall_external', 'wall_bearing', 'wall_internal', 'slab', 'columns', 'beam', 'truss', 'stair', 'arch', 'door', 'window', 'roof', 'chimney', 'facade', 'tinwork', 'woodwork', 'steelwork'], 'string'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_id' => Yii::t('app', 'Projekat'),
            'construction' => Yii::t('app', 'Konstrukcija i konstruktivni sistem objekta'),
            'foundation' => Yii::t('app', 'Temelji'),
            'wall_external' => Yii::t('app', 'Spoljašnji zidovi'),
            'wall_bearing' => Yii::t('app', 'Noseći konstruktivni zidovi i platna'),
            'wall_internal' => Yii::t('app', 'Unutrašnji pregradni zidovi'),
            'slab' => Yii::t('app', 'Ploče i međuspratne konstrukcije objekta'),
            'columns' => Yii::t('app', 'Stubovi i vertikalni serklaži objekta'),
            'beam' => Yii::t('app', 'Grede i horizontalni serklaži objekta'),
            'truss' => Yii::t('app', 'Rešetke'),
            'stair' => Yii::t('app', 'Stepenište'),
            'arch' => Yii::t('app', 'Lukovi i svodovi objekta'),
            'door' => Yii::t('app', 'Vrata'),
            'window' => Yii::t('app', 'Prozori'),
            'roof' => Yii::t('app', 'Krovna konstrkcija objekta'),
            'chimney' => Yii::t('app', 'Dimnjaci i ventilacioni kanali objekta'),
            'facade' => Yii::t('app', 'Fasada objekta'),
            'tinwork' => Yii::t('app', 'Limarija objekta'),
            'woodwork' => Yii::t('app', 'Stolarija'),
            'steelwork' => Yii::t('app', 'Bravarija'),
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