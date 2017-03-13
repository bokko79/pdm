<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property string $id
 * @property string $name
 * @property string $location_id
 * @property string $phone
 * @property string $email
 * @property string $type
 * @property string $contact_person
 * @property string $tax_no
 * @property string $company_no
 * @property string $account_no
 * @property string $bank
 *
 * @property Locations $location
 * @property ProjectClients[] $projectClients
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'location_id', 'type'], 'required'],
            /*['contact_person', 'required', 
                'when' => function($model) {               
                    return $model->type == 'company';                 
                },],*/
            [['contact_person'], 'required', 'when' => function ($model) {
                            return $model->type == 'company';
                        }, 'whenClient' => "function (attribute, value) {
                            return $('input[name=\"Clients[type]\"]:checked').val() == 'company';
                        }"],
            [['location_id', 'tax_no', 'company_no'], 'integer'],
            [['type'], 'string'],
            [['name'], 'string', 'max' => 128],
            [['account_no', 'bank'], 'string', 'max' => 32],
            [['phone'], 'string', 'max' => 25],
            [['email', 'contact_person'], 'string', 'max' => 64],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::className(), 'targetAttribute' => ['location_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Naziv/ime investitora'),
            'location_id' => Yii::t('app', 'Adresa'),
            'phone' => Yii::t('app', 'Telefon'),
            'email' => Yii::t('app', 'Email'),
            'type' => Yii::t('app', 'Pravni oblik'),
            'contact_person' => Yii::t('app', 'Odgovorno lice/zastupnik'),
            'tax_no' => Yii::t('app', 'PIB'),
            'company_no' => Yii::t('app', 'Matični broj'),
            'account_no' => Yii::t('app', 'Broj računa'),
            'bank' => Yii::t('app', 'Banka'),
        ];
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
    public function getProjectClients()
    {
        return $this->hasMany(ProjectClients::className(), ['client_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLegalFiles()
    {
        return \common\models\LegalFiles::find()->where(['entity_id' => $this->id, 'entity' => 'client']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemo()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->id, 'entity' => 'client', 'type' => 'memo-header'])->one();
        return $doc ? $doc->file->name : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStamp()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->id, 'entity' => 'client', 'type' => 'company_stamp'])->one();
        return $doc ? $doc->file->name : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSignature()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->id, 'entity' => 'client', 'type' => 'signature'])->one();
        return $doc ? $doc->file->name : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApr()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->id, 'entity' => 'client', 'type' => 'apr'])->one();
        return $doc ? $doc->file->name : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMemoID()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->id, 'entity' => 'client', 'type' => 'memo-header'])->one();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStampID()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->id, 'entity' => 'client', 'type' => 'company_stamp'])->one();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSignatureID()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->id, 'entity' => 'client', 'type' => 'signature'])->one();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAprID()
    {
        $doc = \common\models\LegalFiles::find()->where(['entity_id' => $this->id, 'entity' => 'client', 'type' => 'apr'])->one();
        return $doc ? $doc : false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirector()
    {        
        return $this->contact_person ?: $this->name;
    }
}
