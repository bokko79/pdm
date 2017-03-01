<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phase_volumes".
 *
 * @property string $id
 * @property string $phase
 * @property string $volume_id
 * @property string $no
 * @property string $info
 * @property string $file_id
 *
 * @property PhaseVolumeInsets[] $phaseVolumeInsets
 * @property Volumes $volume
 * @property Files $file
 */
class PhaseVolumes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phase_volumes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phase', 'volume_id', 'no'], 'required'],
            [['phase', 'info'], 'string'],
            [['volume_id', 'file_id'], 'integer'],
            [['no'], 'string', 'max' => 4],
            [['volume_id'], 'exist', 'skipOnError' => true, 'targetClass' => Volumes::className(), 'targetAttribute' => ['volume_id' => 'id']],
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
            'phase' => Yii::t('app', 'Phase'),
            'volume_id' => Yii::t('app', 'Volume ID'),
            'no' => Yii::t('app', 'No'),
            'info' => Yii::t('app', 'Info'),
            'file_id' => Yii::t('app', 'File ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhaseVolumeInsets()
    {
        return $this->hasMany(PhaseVolumeInsets::className(), ['phase_volume_id' => 'id']);
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
    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'file_id']);
    }
}
