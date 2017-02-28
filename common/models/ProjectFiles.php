<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_files".
 *
 * @property string $id
 * @property string $project_id
 * @property string $type
 * @property string $number
 * @property string $date
 * @property string $file_id
 * @property string $name
 *
 * @property Projects $project
 * @property Files $file
 */
class ProjectFiles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'type', 'file_id'], 'required'],
            [['project_id', 'file_id'], 'integer'],
            [['type'], 'string'],
            [['date'], 'safe'],
            [['number'], 'string', 'max' => 64],
            [['name'], 'string', 'max' => 128],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'id']],
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
            'project_id' => Yii::t('app', 'Project ID'),
            'type' => Yii::t('app', 'Type'),
            'number' => Yii::t('app', 'Number'),
            'date' => Yii::t('app', 'Date'),
            'file_id' => Yii::t('app', 'File ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'file_id']);
    }
}
