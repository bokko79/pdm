<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_volume_insets".
 *
 * @property string $id
 * @property string $project_volume_id
 * @property string $inset_id
 * @property string $file_id
 * @property string $time
 *
 * @property ProjectVolumes $projectVolume
 * @property Insets $inset
 * @property Files $file
 */
class ProjectVolumeInsets extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_volume_insets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_volume_id', 'inset_id'], 'required'],
            [['project_volume_id', 'inset_id', 'file_id', 'time'], 'integer'],
            [['project_volume_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectVolumes::className(), 'targetAttribute' => ['project_volume_id' => 'id']],
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
            'project_volume_id' => Yii::t('app', 'Project Volume ID'),
            'inset_id' => Yii::t('app', 'Inset ID'),
            'file_id' => Yii::t('app', 'File ID'),
            'time' => Yii::t('app', 'Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectVolume()
    {
        return $this->hasOne(ProjectVolumes::className(), ['id' => 'project_volume_id']);
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
