<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_clients".
 *
 * @property string $id
 * @property string $project_id
 * @property string $client_id
 * @property integer $status
 *
 * @property Projects $project
 * @property Clients $client
 */
class ProjectClients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_clients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'client_id'], 'required'],
            [['project_id', 'client_id', 'status'], 'integer'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['client_id' => 'id']],
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
            'client_id' => Yii::t('app', 'Investitor'),
            'status' => Yii::t('app', 'Status'),
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
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintClient()
    {
        return 'Investitor nije na listi? ' .\yii\helpers\Html::a('Dodaj novog investitora', \yii\helpers\Url::to(['/clients/create']));
    }
}
