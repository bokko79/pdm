<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "volume_insets".
 *
 * @property string $id
 * @property string $volume_id
 * @property string $inset_id
 * @property integer $required
 *
 * @property Volumes $volume
 * @property Insets $inset
 */
class VolumeInsets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'volume_insets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['volume_id', 'inset_id'], 'required'],
            [['volume_id', 'inset_id', 'required'], 'integer'],
            [['volume_id'], 'exist', 'skipOnError' => true, 'targetClass' => Volumes::className(), 'targetAttribute' => ['volume_id' => 'id']],
            [['inset_id'], 'exist', 'skipOnError' => true, 'targetClass' => Insets::className(), 'targetAttribute' => ['inset_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'volume_id' => Yii::t('app', 'Volume ID'),
            'inset_id' => Yii::t('app', 'Inset ID'),
            'required' => Yii::t('app', 'Required'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVolume()
    {
        return $this->hasOne(Volumes::className(), ['id' => 'volume_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInset()
    {
        return $this->hasOne(Insets::className(), ['id' => 'inset_id']);
    }
}
