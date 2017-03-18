<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_qs".
 *
 * @property string $id
 * @property string $project_id
 * @property string $subwork_id
 * @property string $position_id
 * @property string $name
 * @property string $action
 * @property string $qty
 *
 * @property Projects $project
 * @property QsSubworks $subwork
 * @property QsPositions $position
 */
class ProjectQs extends \yii\db\ActiveRecord
{
    public $posish = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_qs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'subwork_id', 'qty'], 'required'],
            [['project_id', 'subwork_id', 'position_id', 'work_id',  'posish'], 'integer'],
            [['action'], 'string'],
            [['qty'], 'number'],
            [['name'], 'string', 'max' => 256],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['subwork_id'], 'exist', 'skipOnError' => true, 'targetClass' => QsSubworks::className(), 'targetAttribute' => ['subwork_id' => 'id']],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => QsPositions::className(), 'targetAttribute' => ['position_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'project_id' => Yii::t('app', 'Projekat'),
            'work_id' => Yii::t('app', 'Kategorija radova'),
            'subwork_id' => Yii::t('app', 'Podkategorija radova'),
            'position_id' => Yii::t('app', 'Pozicija'),
            'name' => Yii::t('app', 'Naziv pozicije'),
            'action' => Yii::t('app', 'Opis poziije'),
            'qty' => Yii::t('app', 'Količina'),
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
    public function getWork()
    {
        return $this->hasOne(QsWorks::className(), ['id' => 'work_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubwork()
    {
        return $this->hasOne(QsSubworks::className(), ['id' => 'subwork_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(QsPositions::className(), ['id' => 'position_id']);
    }
}
