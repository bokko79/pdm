<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "insets".
 *
 * @property string $id
 * @property string $name
 *
 * @property ProjectVolumeInsets[] $projectVolumeInsets
 * @property VolumeInsets[] $volumeInsets
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
            [['name'], 'string', 'max' => 128],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectVolumeInsets()
    {
        return $this->hasMany(ProjectVolumeInsets::className(), ['inset_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVolumeInsets()
    {
        return $this->hasMany(VolumeInsets::className(), ['inset_id' => 'id']);
    }
}
