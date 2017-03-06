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
            'project_id' => Yii::t('app', 'Projekat'),
            'conditions' => Yii::t('app', 'Ispunjenje uslova parcele'),
            'width' => Yii::t('app', 'Prosečna širina parcele'),
            'length' => Yii::t('app', 'Prosečna dužina parcele'),
            'disposition' => Yii::t('app', 'Pozicija i položaj parcele'),
            'type' => Yii::t('app', 'Vrsta parcele'),
            'area' => Yii::t('app', 'Površina parcele'),
            'ground_level' => Yii::t('app', 'Kota terena'),
            'road_level' => Yii::t('app', 'Kota nivelete'),
            'underwater_level' => Yii::t('app', 'Kota maksimalnih podzemnih voda'),
            'ground' => Yii::t('app', 'Teren'),
            'access' => Yii::t('app', 'Pristup parceli'),
            'ownership' => Yii::t('app', 'Vlasnička struktura parcele'),
            'adjacent_border' => Yii::t('app', 'Granica parcele i odnos sa susednim parcelama'),
            'services' => Yii::t('app', 'Instalacije parcele'),
            'description' => Yii::t('app', 'Opis'),
            'note' => Yii::t('app', 'Napomena'),
            'legal' => Yii::t('app', 'Pravni opis parcele'),
            'green_area_reg' => Yii::t('app', 'Predviđeno zelenih površina'),
            'green_area' => Yii::t('app', 'Ostvarene zelene površine'),
            'occupancy_reg' => Yii::t('app', 'Zahtevana zauzetost'),
            'built_index_reg' => Yii::t('app', 'Zahtevani indeks izgrađenosti'),
            'parking' => Yii::t('app', 'Parking'),
            'parking_spaces' => Yii::t('app', 'Broj parking mesta'),
            'parking_disabled' => Yii::t('app', 'Br. parking m. za osobe sa inv.'),
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
    public function getGroundType()
    {
        $ground;
        switch ($this->ground) {
            case 'ravan':
                $ground = 'ravan';
                break;
            case 'strm':
                $ground = 'strm';
                break;
            case 'pretezno':
                $ground = 'pretežno ravan';
                break;
            case 'blago':
                $ground = 'u blagom nagibu';
                break;
            case 'nepristupacan':
                $ground = 'nepristupačan';
                break;
            
            default:
                $ground = 'ravan';
                break;
        }
        return $ground;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGreenPctReg()
    {
        return ($this->green_area_reg and $this->area) ? $this->green_area_reg*$this->area/100 : null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGreenPct()
    {
        return ($this->green_area_reg and $this->area) ? $this->green_area*100/$this->area : null;
    }
}
