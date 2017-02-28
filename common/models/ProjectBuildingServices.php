<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_building_services".
 *
 * @property string $id
 * @property string $project_id
 * @property string $type
 * @property string $text
 *
 * @property Projects $project
 */
class ProjectBuildingServices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_building_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'type', 'text'], 'required'],
            [['project_id'], 'integer'],
            [['type', 'text'], 'string'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'id']],
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
            'text' => Yii::t('app', 'Text'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }
}
