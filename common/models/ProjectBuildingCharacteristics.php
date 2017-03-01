<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_building_characteristics".
 *
 * @property string $project_id
 * @property string $function
 * @property string $access
 * @property string $entrance
 * @property string $position
 * @property string $shape
 * @property string $architecture
 * @property string $style
 * @property string $context
 * @property string $ventilation
 * @property string $lights
 * @property string $orientation
 * @property string $adjacent
 * @property string $environment
 *
 * @property Projects $project
 */
class ProjectBuildingCharacteristics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_building_characteristics';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id'], 'required'],
            [['project_id'], 'integer'],
            [['function', 'access', 'entrance', 'position', 'shape', 'architecture', 'style', 'context', 'ventilation', 'lights', 'orientation', 'adjacent', 'environment'], 'string'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_id' => Yii::t('app', 'Projekat'),
            'function' => Yii::t('app', 'Funkcija objekta'),
            'access' => Yii::t('app', 'Pristupi i prilazi objektu'),
            'entrance' => Yii::t('app', 'Ulazi u objekat'),
            'position' => Yii::t('app', 'Položaj objekta u okruženju'),
            'shape' => Yii::t('app', 'Oblik objekta'),
            'architecture' => Yii::t('app', 'Arhitektura objekta'),
            'style' => Yii::t('app', 'Arhitektonski stil objekta'),
            'context' => Yii::t('app', 'Context'),
            'ventilation' => Yii::t('app', 'Provetravanje objekta'),
            'lights' => Yii::t('app', 'Osvetljenje objekta'),
            'orientation' => Yii::t('app', 'Orjentacija objekta'),
            'adjacent' => Yii::t('app', 'Odnos objekta sa susednim objektima'),
            'environment' => Yii::t('app', 'Prirodno okruženje i zelenilo objekta'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }
}
