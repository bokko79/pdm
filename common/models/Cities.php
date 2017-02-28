<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property string $id
 * @property string $county
 * @property string $city
 * @property string $town
 */
class Cities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['county', 'city'], 'required'],
            [['county', 'city', 'town'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'county' => Yii::t('app', 'Opština'),
            'city' => Yii::t('app', 'Grad'),
            'town' => Yii::t('app', 'Mesto'),
        ];
    }
}
