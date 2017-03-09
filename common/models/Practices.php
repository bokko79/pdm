<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "practices".
 *
 * @property string $id
 * @property string $name
 * @property string $location_id
 * @property string $phone
 * @property string $email
 * @property string $engineer_id
 * @property string $fax
 * @property string $tax_no
 * @property string $company_no
 * @property string $account_no
 * @property string $bank
 *
 * @property PracticeEngineers[] $practiceEngineers
 * @property Locations $location
 * @property Engineers $engineer
 * @property ProjectVolumes[] $projectVolumes
 */
class Practices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'practices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'location_id', 'engineer_id'], 'required'],
            [['location_id', 'engineer_id', 'tax_no', 'company_no'], 'integer'],
            [['name'], 'string', 'max' => 128],
            [['phone', 'fax'], 'string', 'max' => 25],
            [['email'], 'string', 'max' => 64],
            [['account_no', 'bank'], 'string', 'max' => 32],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::className(), 'targetAttribute' => ['location_id' => 'id']],
            [['engineer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Engineers::className(), 'targetAttribute' => ['engineer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Naziv preduzeća'),
            'location_id' => Yii::t('app', 'Adresa'),
            'phone' => Yii::t('app', 'Telefon'),
            'email' => Yii::t('app', 'Email'),
            'engineer_id' => Yii::t('app', 'Direktor'),
            'fax' => Yii::t('app', 'Fax'),
            'tax_no' => Yii::t('app', 'PIB'),
            'company_no' => Yii::t('app', 'Matični broj'),
            'account_no' => Yii::t('app', 'Broj računa'),
            'bank' => Yii::t('app', 'Banka'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPracticeEngineers()
    {
        return $this->hasMany(PracticeEngineers::className(), ['practice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Locations::className(), ['id' => 'location_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEngineer()
    {
        return $this->hasOne(Engineers::className(), ['id' => 'engineer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectVolumes()
    {
        return $this->hasMany(ProjectVolumes::className(), ['practice_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLegalFiles()
    {
        return \common\models\LegalFiles::find()->where(['entity_id' => $this->id, 'entity' => 'practice']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemo()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->id, 'entity' => 'practice', 'type' => 'memo-header'])->one();
        return $doc ? $doc->file->name : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStamp()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->id, 'entity' => 'practice', 'type' => 'company_stamp'])->one();
        return $doc ? $doc->file->name : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSignature()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->id, 'entity' => 'practice', 'type' => 'signature'])->one();
        return $doc ? $doc->file->name : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApr()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->id, 'entity' => 'practice', 'type' => 'apr'])->one();
        return $doc ? $doc->file->name : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogo()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->id, 'entity' => 'practice', 'type' => 'logo'])->one();
        return $doc ? $doc->file->name : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLogoID()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->id, 'entity' => 'practice', 'type' => 'logo'])->one();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemoID()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->id, 'entity' => 'practice', 'type' => 'memo-header'])->one();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStampID()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->id, 'entity' => 'practice', 'type' => 'company_stamp'])->one();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSignatureID()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->id, 'entity' => 'practice', 'type' => 'signature'])->one();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAprID()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->id, 'entity' => 'practice', 'type' => 'apr'])->one();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintEngineer()
    {
        return 'Direktor nije na listi? ' .\yii\helpers\Html::a('Dodaj direktora.', \yii\helpers\Url::to(['/engineers/create']));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirector()
    {
        return \common\models\PracticeEngineers::find()->where('position="direktor"')->one()->engineer;
    }
}
