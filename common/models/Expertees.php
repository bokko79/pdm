<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "expertees".
 *
 * @property string $id
 * @property string $name
 * @property string $short
 * @property string $description
 *
 * @property Engineers[] $engineers
 */
class Expertees extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'expertees';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'short'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 128],
            [['short'], 'string', 'max' => 15],
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
            'short' => Yii::t('app', 'Short'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEngineers()
    {
        return $this->hasMany(Engineers::className(), ['expertees_id' => 'id']);
    }
}
