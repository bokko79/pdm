<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "volumes".
 *
 * @property string $id
 * @property string $name
 * @property string $type
 * @property string $no
 * @property string $info
 * @property string $file_id
 *
 * @property PhaseVolumes[] $phaseVolumes
 * @property ProjectVolumes[] $projectVolumes
 */
class Volumes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'volumes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['type', 'info'], 'string'],
            [['file_id'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['no'], 'string', 'max' => 4],
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
            'type' => Yii::t('app', 'Type'),
            'no' => Yii::t('app', 'No'),
            'info' => Yii::t('app', 'Info'),
            'file_id' => Yii::t('app', 'File ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhaseVolumes()
    {
        return $this->hasMany(PhaseVolumes::className(), ['volume_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectVolumes()
    {
        return $this->hasMany(ProjectVolumes::className(), ['volume_id' => 'id']);
    }
}
