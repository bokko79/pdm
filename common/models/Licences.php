<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "licences".
 *
 * @property string $id
 * @property string $name
 * @property string $number
 * @property string $description
 *
 * @property EngineerLicences[] $engineerLicences
 */
class Licences extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'licences';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'number'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 128],
            [['number'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'number' => Yii::t('app', 'Number'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEngineerLicences()
    {
        return $this->hasMany(EngineerLicences::className(), ['licence_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFullname()
    {
        return $this->number. ' - '. $this->name;
    }
}
