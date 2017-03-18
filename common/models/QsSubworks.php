<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "qs_subworks".
 *
 * @property string $id
 * @property integer $work_id
 * @property string $name
 * @property string $description
 *
 * @property ProjectQs[] $projectQs
 * @property QsPositions[] $qsPositions
 * @property QsWorks $work
 */
class QsSubworks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qs_subworks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['work_id', 'name'], 'required'],
            [['work_id'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 48],
            [['work_id'], 'exist', 'skipOnError' => true, 'targetClass' => QsWorks::className(), 'targetAttribute' => ['work_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'work_id' => Yii::t('app', 'Potkategorija radova'),
            'name' => Yii::t('app', 'Naziv potkategorije'),
            'description' => Yii::t('app', 'Opis potkategorije'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectQs()
    {
        return $this->hasMany(ProjectQs::className(), ['subwork_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQsPositions()
    {
        return $this->hasMany(QsPositions::className(), ['subwork_id' => 'id']);
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
    public function getFullname()
    {
        return $this->work->name . '/'. $this->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function posOfProject($project)
    {
        return \common\models\ProjectQs::find()->where('project_id='.$project.' and subwork_id='.$this->id)->all();
    }
}
