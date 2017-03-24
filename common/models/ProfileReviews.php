<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profile_reviews".
 *
 * @property string $id
 * @property string $profile_id
 * @property string $profile_type
 * @property string $user_id
 * @property string $content
 * @property integer $status
 * @property string $time
 *
 * @property User $user
 */
class ProfileReviews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile_reviews';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_id', 'user_id', 'content', 'time'], 'required'],
            [['profile_id', 'user_id', 'status', 'time'], 'integer'],
            [['profile_type', 'content'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'profile_id' => Yii::t('app', 'Profile ID'),
            'profile_type' => Yii::t('app', 'Profile Type'),
            'user_id' => Yii::t('app', 'User ID'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Status'),
            'time' => Yii::t('app', 'Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
