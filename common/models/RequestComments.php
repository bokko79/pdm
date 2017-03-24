<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "request_comments".
 *
 * @property string $id
 * @property string $request_id
 * @property string $user_id
 * @property string $body
 * @property string $time
 *
 * @property Requests $request
 * @property User $user
 */
class RequestComments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_id', 'user_id', 'body', 'time'], 'required'],
            [['request_id', 'user_id', 'time'], 'integer'],
            [['body'], 'string'],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Requests::className(), 'targetAttribute' => ['request_id' => 'id']],
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
            'request_id' => Yii::t('app', 'Request ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'body' => Yii::t('app', 'Body'),
            'time' => Yii::t('app', 'Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequest()
    {
        return $this->hasOne(Requests::className(), ['id' => 'request_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
