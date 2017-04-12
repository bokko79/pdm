<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "practice_engineers".
 *
 * @property string $id
 * @property string $practice_id
 * @property string $engineer_id
 * @property string $position
 * @property integer $status
 *
 * @property Practices $practice
 * @property Engineers $engineer
 */
class PracticeEngineers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'practice_engineers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['practice_id', 'engineer_id'], 'required'],
            [['practice_id', 'engineer_id', 'time'], 'integer'],
            [['position', 'status'], 'string'],
            [['practice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Practices::className(), 'targetAttribute' => ['practice_id' => 'engineer_id']],
            [['engineer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Engineers::className(), 'targetAttribute' => ['engineer_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'practice_id' => Yii::t('app', 'Firma'),
            'engineer_id' => Yii::t('app', 'Inženjer'),
            'position' => Yii::t('app', 'Pozicija'),
            'status' => Yii::t('app', 'Status'), // to_join, invited, joined
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPractice()
    {
        return $this->hasOne(Practices::className(), ['engineer_id' => 'practice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEngineer()
    {
        return $this->hasOne(Engineers::className(), ['user_id' => 'engineer_id']);
    }
}
