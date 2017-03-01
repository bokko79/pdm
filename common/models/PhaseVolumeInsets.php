<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "phase_volume_insets".
 *
 * @property string $id
 * @property string $phase_volume_id
 * @property string $inset_id
 * @property string $info
 * @property string $file_id
 * @property integer $requirement
 *
 * @property PhaseVolumes $phaseVolume
 * @property Insets $inset
 * @property Files $file
 */
class PhaseVolumeInsets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phase_volume_insets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phase_volume_id', 'inset_id'], 'required'],
            [['phase_volume_id', 'inset_id', 'file_id', 'requirement'], 'integer'],
            [['info'], 'string'],
            [['phase_volume_id'], 'exist', 'skipOnError' => true, 'targetClass' => PhaseVolumes::className(), 'targetAttribute' => ['phase_volume_id' => 'id']],
            [['inset_id'], 'exist', 'skipOnError' => true, 'targetClass' => Insets::className(), 'targetAttribute' => ['inset_id' => 'id']],
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
            'phase_volume_id' => Yii::t('app', 'Phase Volume ID'),
            'inset_id' => Yii::t('app', 'Inset ID'),
            'info' => Yii::t('app', 'Info'),
            'file_id' => Yii::t('app', 'File ID'),
            'requirement' => Yii::t('app', 'Requirement'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhaseVolume()
    {
        return $this->hasOne(PhaseVolumes::className(), ['id' => 'phase_volume_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInset()
    {
        return $this->hasOne(Insets::className(), ['id' => 'inset_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'file_id']);
    }
}
