<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "request_files".
 *
 * @property string $id
 * @property string $request_id
 * @property string $file_id
 * @property string $type
 *
 * @property Requests $request
 * @property Files $file
 */
class RequestFiles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'request_files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_id', 'file_id'], 'required'],
            [['request_id', 'file_id'], 'integer'],
            [['type'], 'string'],
            [['request_id'], 'exist', 'skipOnError' => true, 'targetClass' => Requests::className(), 'targetAttribute' => ['request_id' => 'id']],
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
            'request_id' => Yii::t('app', 'Request ID'),
            'file_id' => Yii::t('app', 'File ID'),
            'type' => Yii::t('app', 'Type'),
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
    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'file_id']);
    }
}
