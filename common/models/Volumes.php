<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "volumes".
 *
 * @property string $id
 * @property string $name
 * @property integer $no
 *
 * @property ProjectVolumes[] $projectVolumes
 * @property VolumeInsets[] $volumeInsets
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
            [['file_id'], 'integer'],
            [['no', 'type', 'info'], 'string'],
            [['name'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Naziv'),
            'no' => Yii::t('app', 'Broj'),
            'type' => Yii::t('app', 'Vrsta'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectVolumes()
    {
        return $this->hasMany(ProjectVolumes::className(), ['volume_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVolumeInsets()
    {
        return $this->hasMany(VolumeInsets::className(), ['volume_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(VolumeInsets::className(), ['id' => 'file_id']);
    }
}
