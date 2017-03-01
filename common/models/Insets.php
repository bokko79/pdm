<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "insets".
 *
 * @property string $id
 * @property string $name
 * @property string $info
 * @property string $file_id
 *
 * @property Files $file
 * @property PhaseVolumeInsets[] $phaseVolumeInsets
 */
class Insets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'insets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['info'], 'string'],
            [['file_id'], 'integer'],
            [['name'], 'string', 'max' => 128],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['file_id' => 'id']],
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
            'info' => Yii::t('app', 'Info'),
            'file_id' => Yii::t('app', 'File ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'file_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhaseVolumeInsets()
    {
        return $this->hasMany(PhaseVolumeInsets::className(), ['inset_id' => 'id']);
    }
}
