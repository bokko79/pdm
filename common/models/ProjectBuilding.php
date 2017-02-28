<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_building".
 *
 * @property string $id
 * @property string $project_id
 * @property string $building_id
 * @property string $name
 * @property string $type
 * @property string $building_line_dist
 * @property string $lot_area
 * @property string $green_area_reg
 * @property string $green_area
 * @property string $gross_area_part
 * @property string $gross_area
 * @property string $gross_area_above
 * @property string $gross_area_below
 * @property string $gross_built_area
 * @property string $net_area
 * @property string $ground_floor_area
 * @property string $occupancy_area
 * @property string $occupancy_reg
 * @property string $occupancy
 * @property string $built_index_reg
 * @property string $built_index
 * @property string $storey
 * @property string $storey_height
 * @property integer $units_total
 * @property integer $parking_total
 * @property string $facade_material
 * @property string $ridge_orientation
 * @property string $roof_pitch
 * @property string $roof_material
 * @property string $characteristics
 * @property string $cost
 *
 * @property Projects $project
 * @property Buildings $building
 * @property ProjectBuildingHeights[] $projectBuildingHeights
 */
class ProjectBuilding extends \yii\db\ActiveRecord
{
    public $podrum;
    public $suteren;
    public $prizemlje;
    public $visokoprizemlje;
    public $mezanin;
    public $galerija;
    public $sprat;
    public $povucenisprat;
    public $potkrovlje;
    public $mansarda;
    public $tavan;
    public $krov;
    public $duplex;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_building';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'building_id'], 'required'],
            [['project_id', 'building_id', 'units_total', 'parking_total'], 'integer'],
            [['type', 'facade_material', 'roof_material', 'characteristics'], 'string'],
            [['building_line_dist', 'lot_area', 'green_area_reg', 'green_area', 'gross_area_part', 'gross_area', 'gross_area_above', 'gross_area_below', 'gross_built_area', 'net_area', 'ground_floor_area', 'occupancy_area', 'occupancy_reg', 'occupancy', 'built_index_reg', 'built_index', 'storey_height', 'roof_pitch', 'cost'], 'number'],
            [['name'], 'string', 'max' => 128],
            [['storey', 'ridge_orientation'], 'string', 'max' => 64],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['building_id'], 'exist', 'skipOnError' => true, 'targetClass' => Buildings::className(), 'targetAttribute' => ['building_id' => 'id']],
            [['podrum', 'suteren', 'prizemlje', 'visokoprizemlje', 'mezanin', 'galerija', 'sprat', 'povucenisprat', 'potkrovlje', 'mansarda', 'tavan', 'krov', 'duplex'], 'safe'],
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
            'building_id' => Yii::t('app', 'Objekat'),
            'name' => Yii::t('app', 'Naziv objekta'),
            'type' => Yii::t('app', 'Tip objekta'),
            'building_line_dist' => Yii::t('app', 'Rastojanje građ linije'),
            'lot_area' => Yii::t('app', 'Površina parcele'),
            'green_area_reg' => Yii::t('app', 'Tražena zelena površina'),
            'green_area' => Yii::t('app', 'Ostvarena zelena površina'),
            'gross_area_part' => Yii::t('app', 'BRGP dela objekta'),
            'gross_area' => Yii::t('app', 'BRGP'),
            'gross_area_above' => Yii::t('app', 'BRGP nadzemno'),
            'gross_area_below' => Yii::t('app', 'BRGP podzemno'),
            'gross_built_area' => Yii::t('app', 'Bruto izgrađena površina'),
            'net_area' => Yii::t('app', 'Neto površina'),
            'ground_floor_area' => Yii::t('app', 'Površina prizemlja'),
            'occupancy_area' => Yii::t('app', 'Zauzeta površina'),
            'occupancy_reg' => Yii::t('app', 'Tražena zauzetost'),
            'occupancy' => Yii::t('app', 'Zauzetost'),
            'built_index_reg' => Yii::t('app', 'Tražena izgrađenost'),
            'built_index' => Yii::t('app', 'Indeks izgrađenosti'),
            'storey' => Yii::t('app', 'Spratnost'),
            'storey_height' => Yii::t('app', 'Spratna visina'),
            'units_total' => Yii::t('app', 'Broj funkcionalnih jedinica'),
            'parking_total' => Yii::t('app', 'Broj parking mesta'),
            'facade_material' => Yii::t('app', 'Materijalizacija fasade'),
            'ridge_orientation' => Yii::t('app', 'Orjentacija slemena'),
            'roof_pitch' => Yii::t('app', 'Nagib krova'),
            'roof_material' => Yii::t('app', 'Materijalizacija krova'),
            'characteristics' => Yii::t('app', 'Ostale karakteristike objekta'),
            'cost' => Yii::t('app', 'Predračunska vrednost'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuilding()
    {
        return $this->hasOne(Buildings::className(), ['id' => 'building_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildingHeights()
    {
        return $this->hasMany(ProjectBuildingHeights::className(), ['project_building_id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPo()
    {
        return \common\models\ProjectBuildingStoreys::find()->where('project_id='.$this->project_id. ' and storey="podrum"')->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getS()
    {
        return \common\models\ProjectBuildingStoreys::find()->where('project_id='.$this->project_id. ' and storey="suteren"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVp()
    {
        return \common\models\ProjectBuildingStoreys::find()->where('project_id='.$this->project_id. ' and storey="visokoprizemlje"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMz()
    {
        return \common\models\ProjectBuildingStoreys::find()->where('project_id='.$this->project_id. ' and storey="mezanin"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getG()
    {
        return \common\models\ProjectBuildingStoreys::find()->where('project_id='.$this->project_id. ' and storey="galerija"')->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSp()
    {
        return \common\models\ProjectBuildingStoreys::find()->where('project_id='.$this->project_id. ' and storey="sprat"')->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPs()
    {
        return \common\models\ProjectBuildingStoreys::find()->where('project_id='.$this->project_id. ' and storey="povucenisprat"')->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPk()
    {
        return \common\models\ProjectBuildingStoreys::find()->where('project_id='.$this->project_id. ' and storey="potkrovlje"')->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getM()
    {
        return \common\models\ProjectBuildingStoreys::find()->where('project_id='.$this->project_id. ' and storey="mansarda"')->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getT()
    {
        return \common\models\ProjectBuildingStoreys::find()->where('project_id='.$this->project_id. ' and storey="tavan"')->one();
    }
}
