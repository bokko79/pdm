<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "location_lots".
 *
 * @property string $id
 * @property string $location_id
 * @property string $lot
 *
 * @property Locations $location
 */
class LocationLots extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'location_lots';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['location_id', 'lot'], 'required'],
            [['location_id'], 'integer'],
            [['lot', 'type'], 'string', 'max' => 10],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::className(), 'targetAttribute' => ['location_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'location_id' => Yii::t('app', 'Lokacija'),
            'lot' => Yii::t('app', 'Broj katastarske parcele'),
            'type' => Yii::t('app', 'Vrsta parcele'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Locations::className(), ['id' => 'location_id']);
    }
}
