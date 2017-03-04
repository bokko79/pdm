<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "engineers".
 *
 * @property string $id
 * @property string $name
 * @property string $title
 * @property string $phone
 * @property string $email
 *
 * @property PracticeEngineers[] $practiceEngineers
 * @property Practices[] $practices
 * @property ProjectVolumes[] $projectVolumes
 */
class Engineers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'engineers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'title'], 'required'],
            [['name', 'email'], 'string', 'max' => 64],
            [['title'], 'string', 'max' => 20],
            [['phone'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Ime inženjera'),
            'title' => Yii::t('app', 'Titula'),
            'phone' => Yii::t('app', 'Telefon'),
            'email' => Yii::t('app', 'Email'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEngineerLicences()
    {
        return $this->hasMany(EngineerLicences::className(), ['engineer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPracticeEngineers()
    {
        return $this->hasMany(PracticeEngineers::className(), ['engineer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPractices()
    {
        return $this->hasMany(Practices::className(), ['engineer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectVolumes()
    {
        return $this->hasMany(ProjectVolumes::className(), ['engineer_id' => 'id']);
    }  

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLegalFiles()
    {
        return \common\models\LegalFiles::find()->where(['entity_id' => $this->id, 'entity' => 'engineer']);
    }  

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSignature()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->id, 'entity' => 'engineer', 'type' => 'signature'])->one();
        return $doc ? $doc->file->name : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSignatureID()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->id, 'entity' => 'engineer', 'type' => 'signature'])->one();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOther()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->id, 'entity' => 'engineer', 'type' => 'other'])->one();
        return $doc ? $doc->file->name : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOtherID()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->id, 'entity' => 'engineer', 'type' => 'other'])->one();
        return $doc ? $doc : false;
    }
}
