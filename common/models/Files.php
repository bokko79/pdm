<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "files".
 *
 * @property string $id
 * @property string $name
 * @property string $type
 * @property string $time
 *
 * @property LegalFiles[] $legalFiles
 * @property ProjectFiles[] $projectFiles
 * @property ProjectVolumeInsets[] $projectVolumeInsets
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'time'], 'required'],
            [['type'], 'string'],
            [['time'], 'integer'],
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
            'type' => Yii::t('app', 'Type'),
            'time' => Yii::t('app', 'Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLegalFiles()
    {
        return $this->hasMany(LegalFiles::className(), ['file_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectFiles()
    {
        return $this->hasMany(ProjectFiles::className(), ['file_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectVolumeInsets()
    {
        return $this->hasMany(ProjectVolumeInsets::className(), ['file_id' => 'id']);
    }
}
