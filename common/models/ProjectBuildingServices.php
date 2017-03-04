<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_building_services".
 *
 * @property string $project_id
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
 * @property Projects $project
 */
class ProjectBuildingServices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_building_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id'], 'required'],
            [['project_id'], 'integer'],
            [['heating', 'ac', 'ventilation', 'gas', 'sprinkler', 'water', 'sewage', 'phone', 'tv', 'electricity', 'catv', 'internet', 'lift', 'pool', 'geotech', 'traffic', 'construction', 'fire', 'special'], 'string'],
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
            'heating' => Yii::t('app', 'Grejanje objekta'),
            'ac' => Yii::t('app', 'Klimatizacija objekta'),
            'ventilation' => Yii::t('app', 'Ventilacija objekta'),
            'gas' => Yii::t('app', 'Gasne instalacije objekta'),
            'sprinkler' => Yii::t('app', 'Sprinkler instalacije objekta'),
            'water' => Yii::t('app', 'Vodovodna i hidrantska mreža objekta'),
            'sewage' => Yii::t('app', 'Kanalizacija objekta'),
            'phone' => Yii::t('app', 'Telefonske i telekomunikacione instalacije objekta'),
            'tv' => Yii::t('app', 'Televizija i kablovska televizija'),
            'electricity' => Yii::t('app', 'Elektroinstalacije jake struje objekta'),
            'catv' => Yii::t('app', 'Video nadzor objekta'),
            'internet' => Yii::t('app', 'Internet'),
            'lift' => Yii::t('app', 'Lift i eskalatori'),
            'pool' => Yii::t('app', 'Bazenske instalacije'),
            'geotech' => Yii::t('app', 'Geotermalne instalacije'),
            'traffic' => Yii::t('app', 'Saobraćajne instalacije'),
            'construction' => Yii::t('app', 'Konstrukcija'),
            'fire' => Yii::t('app', 'Protivpožarne instalacije'),
            'special' => Yii::t('app', 'Specijalne i ostale instalacije objekta'),
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
