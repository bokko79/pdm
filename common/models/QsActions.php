<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "qs_actions".
 *
 * @property string $id
 * @property string $action
 *
 * @property QsPositions[] $qsPositions
 */
class QsActions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qs_actions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['action'], 'required'],
            [['action'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'action' => Yii::t('app', 'Opis pozicije'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQsPositions()
    {
        return $this->hasMany(QsPositions::className(), ['action_id' => 'id']);
    }
}
