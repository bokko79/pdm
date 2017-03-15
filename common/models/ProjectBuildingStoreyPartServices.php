<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_building_storey_part_services".
 *
 * @property string $project_building_storey_part_id
 * @property string $heating
 * @property string $ac
 * @property string $ventilation
 * @property string $gas
 * @property string $sprinkler
 * @property string $water
 * @property string $sewage
 * @property string $phone
 * @property string $tv
 * @property string $electricity
 * @property string $catv
 * @property string $internet
 * @property string $lift
 * @property string $pool
 * @property string $geotech
 * @property string $traffic
 * @property string $construction
 * @property string $fire
 * @property string $special
 *
 * @property ProjectBuildingStoreyParts $projectBuildingStoreyPart
 */
class ProjectBuildingStoreyPartServices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_building_storey_part_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_building_storey_part_id'], 'required'],
            [['project_building_storey_part_id'], 'integer'],
            [['general', 'heating', 'ac', 'ventilation', 'gas', 'sprinkler', 'water', 'sewage', 'phone', 'tv', 'electricity', 'catv', 'internet', 'lift', 'pool', 'geotech', 'traffic', 'construction', 'fire', 'special'], 'string'],
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
            'general' => Yii::t('app', 'Opis instalacija jedinice'),
            'heating' => Yii::t('app', 'Grejanje jedinice'),
            'ac' => Yii::t('app', 'Klimatizacija jedinice'),
            'ventilation' => Yii::t('app', 'Ventilacija jedinice'),
            'gas' => Yii::t('app', 'Gasne instalacije jedinice'),
            'sprinkler' => Yii::t('app', 'Sprinkler instalacije jedinice'),
            'water' => Yii::t('app', 'Vodovodna i hidrantska mreža jedinice'),
            'sewage' => Yii::t('app', 'Kanalizacija jedinice'),
            'phone' => Yii::t('app', 'Telefonske i telekomunikacione instalacije jedinice'),
            'tv' => Yii::t('app', 'Televizija i kablovska televizija'),
            'electricity' => Yii::t('app', 'Elektroinstalacije jake struje jedinice'),
            'catv' => Yii::t('app', 'Video nadzor jedinice'),
            'internet' => Yii::t('app', 'Internet'),
            'lift' => Yii::t('app', 'Lift i eskalatori'),
            'pool' => Yii::t('app', 'Bazenske instalacije'),
            'geotech' => Yii::t('app', 'Geotermalne instalacije'),
            'traffic' => Yii::t('app', 'Saobraćajne instalacije'),
            'construction' => Yii::t('app', 'Konstrukcija'),
            'fire' => Yii::t('app', 'Protivpožarne instalacije'),
            'special' => Yii::t('app', 'Specijalne i ostale instalacije jedinice'),
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
    public function getHintHeating()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintAc()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintVentilation()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintGas()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintSprinkler()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintWater()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintSewage()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintPhone()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintTv()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintElectricity()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintCatv()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintInternet()
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
    public function getHintPool()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintGeotech()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintTraffic()
    {
        return '';
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
    public function getHintFire()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintSpecial()
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
    public function getPlaceholderHeating()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderAc()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderVentilation()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderGas()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderSprinkler()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderWater()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderSewage()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderPhone()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderTv()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderElectricity()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderCatv()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderInternet()
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
    public function getPlaceholderPool()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderGeotech()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderTraffic()
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
    public function getPlaceholderFire()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderSpecial()
    {
        return '';
    }
}
