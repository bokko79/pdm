<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_volumes".
 *
 * @property string $id
 * @property string $project_id
 * @property string $volume_id
 * @property string $practice_id
 * @property string $engineer_id
 * @property string $engineer_licence_id
 * @property string $number
 * @property string $name
 * @property string $code
 * @property string $control_practice_id
 * @property string $control_engineer_id
 * @property string $control_engineer_licence_id
 *
 * @property Projects $project
 * @property Volumes $volume
 * @property Practices $practice
 * @property Engineers $engineer
 * @property Practices $controlPractice
 * @property Engineers $controlEngineer
 * @property EngineerLicences $engineerLicence
 * @property EngineerLicences $controlEngineerLicence
 */
class ProjectVolumes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_volumes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'volume_id', 'practice_id', 'engineer_id', 'engineer_licence_id', 'name', 'code'], 'required'],
            [['project_id', 'volume_id', 'practice_id', 'engineer_id', 'engineer_licence_id', 'control_practice_id', 'control_engineer_id', 'control_engineer_licence_id'], 'integer'],
            [['number'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 64],
            [['code'], 'string', 'max' => 20],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['volume_id'], 'exist', 'skipOnError' => true, 'targetClass' => Volumes::className(), 'targetAttribute' => ['volume_id' => 'id']],
            [['practice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Practices::className(), 'targetAttribute' => ['practice_id' => 'id']],
            [['engineer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Engineers::className(), 'targetAttribute' => ['engineer_id' => 'id']],
            [['control_practice_id'], 'exist', 'skipOnError' => true, 'targetClass' => Practices::className(), 'targetAttribute' => ['control_practice_id' => 'id']],
            [['control_engineer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Engineers::className(), 'targetAttribute' => ['control_engineer_id' => 'id']],
            [['engineer_licence_id'], 'exist', 'skipOnError' => true, 'targetClass' => EngineerLicences::className(), 'targetAttribute' => ['engineer_licence_id' => 'id']],
            [['control_engineer_licence_id'], 'exist', 'skipOnError' => true, 'targetClass' => EngineerLicences::className(), 'targetAttribute' => ['control_engineer_licence_id' => 'id']],
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
            'volume_id' => Yii::t('app', 'Deo projekta'),
            'practice_id' => Yii::t('app', 'Projektant'),
            'engineer_id' => Yii::t('app', 'Odgovorni/glavni projektant'),
            'engineer_licence_id' => Yii::t('app', 'Licenca odgovornog projektanta'),
            'number' => Yii::t('app', 'Redni broj projekta'),
            'name' => Yii::t('app', 'Naziv projekta'),
            'code' => Yii::t('app', 'Broj projektne dokumentacije dela projekta'),
            'control_practice_id' => Yii::t('app', 'Vršilac tehničke kontrole'),
            'control_engineer_id' => Yii::t('app', 'Odgovorno lice vršioca tehničke kontrole'),
            'control_engineer_licence_id' => Yii::t('app', 'Licenca vršioca tehničke kontrole'),
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
    public function getVolume()
    {
        return $this->hasOne(Volumes::className(), ['id' => 'volume_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPractice()
    {
        return $this->hasOne(Practices::className(), ['id' => 'practice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEngineer()
    {
        // return $this->hasOne(Engineers::className(), ['id' => 'engineer_id']);
        return $this->engineerLicence->engineer;
    } 

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControlPractice()
    {
        return $this->hasOne(Practices::className(), ['id' => 'control_practice_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControlEngineer()
    {
        //return $this->hasOne(Engineers::className(), ['id' => 'control_engineer_id']);
        return $this->controlEngineerLicence->engineer;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEngineerLicence()
    {
        return $this->hasOne(EngineerLicences::className(), ['id' => 'engineer_licence_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getControlEngineerLicence()
    {
        return $this->hasOne(EngineerLicences::className(), ['id' => 'control_engineer_licence_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintProject()
    {
        return 'Projekat nije kreiran? ' .\yii\helpers\Html::a('Dodaj novi projekat', \yii\helpers\Url::to(['/projects/create']));
    }   

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintPractice()
    {
        return 'Projektant nije na listi? ' .\yii\helpers\Html::a('Dodaj novog projektanta', \yii\helpers\Url::to(['/practices/create']));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintEngineer()
    {
        return 'Odgovorni/glavni projektant nije na listi? ' .\yii\helpers\Html::a('Dodaj novog projektanta', \yii\helpers\Url::to(['/engineers/create']));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintControlPractice()
    {
        return 'Ovaj podatak je obavezan samo za Izvod iz projekta u fazi PGD. Vršilac tehničke kontrole nije na listi? ' .\yii\helpers\Html::a('Dodaj novog vršioca', \yii\helpers\Url::to(['/practices/create']));
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintControlEngineer()
    {
        return 'Ovaj podatak je obavezan samo za Izvod iz projekta u fazi PGD. Odgovorno lice vršioca tehničke kontrole nije na listi? ' .\yii\helpers\Html::a('Dodaj novog projektanta', \yii\helpers\Url::to(['/engineers/create']));
    }
}
