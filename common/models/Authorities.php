<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "authorities".
 *
 * @property string $id
 * @property string $name
 * @property string $location_id
 * @property string $phone
 * @property string $phone_fax
 * @property string $email
 * @property string $contact
 */
class Authorities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'authorities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'location_id'], 'required'],
            [['location_id'], 'integer'],
            [['name'], 'string', 'max' => 80],
            [['phone', 'phone_fax'], 'string', 'max' => 25],
            [['email', 'contact'], 'string', 'max' => 64],
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
            'location_id' => Yii::t('app', 'Location ID'),
            'phone' => Yii::t('app', 'Phone'),
            'phone_fax' => Yii::t('app', 'Phone Fax'),
            'email' => Yii::t('app', 'Email'),
            'contact' => Yii::t('app', 'Contact'),
        ];
    }
}
