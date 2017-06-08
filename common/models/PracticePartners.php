<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "practice_partners".
 *
 * @property string $id
 * @property string $practice_id
 * @property string $partner_id
 * @property integer $status
 *
 * @property Practices $practice
 * @property Engineers $engineer
 */
class PracticePartners extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'practice_partners';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['practice_id', 'partner_id'], 'required'],
            [['practice_id', 'partner_id', 'time'], 'integer'],
            [['status'], 'string'],
            [['practice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Practices::className(), 'targetAttribute' => ['practice_id' => 'engineer_id']],
            [['partner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Practices::className(), 'targetAttribute' => ['partner_id' => 'engineer_id']],
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
            'partner_id' => Yii::t('app', 'Firma-partner'),
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
    public function getPartner()
    {
        return $this->hasOne(Practices::className(), ['engineer_id' => 'partner_id']);
    }
}
