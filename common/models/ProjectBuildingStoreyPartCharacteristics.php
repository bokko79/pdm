<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_building_storey_part_characteristics".
 *
 * @property string $project_building_storey_part_id
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
 * @property ProjectBuildingStoreyParts $projectBuildingStoreyPart
 */
class ProjectBuildingStoreyPartCharacteristics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_building_storey_part_characteristics';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_building_storey_part_id'], 'required'],
            [['project_building_storey_part_id'], 'integer'],
            [['function', 'access', 'entrance', 'position', 'shape', 'architecture', 'style', 'context', 'ventilation', 'lights', 'orientation', 'adjacent', 'environment'], 'string'],
            [['project_building_storey_part_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectBuildingStoreyParts::className(), 'targetAttribute' => ['project_building_storey_part_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_building_storey_part_id' => Yii::t('app', 'Project Building Storey Part ID'),
            'function' => Yii::t('app', 'Funkcija jedinice'),
            'access' => Yii::t('app', 'Pristupi i prilazi jedinici'),
            'entrance' => Yii::t('app', 'Ulazi u jedinicu'),
            'position' => Yii::t('app', 'Položaj jedinice u okviru objektu'),
            'shape' => Yii::t('app', 'Oblik jedinice'),
            'architecture' => Yii::t('app', 'Arhitektura jedinice'),
            'style' => Yii::t('app', 'Arhitektonski stil jedinice'),
            'context' => Yii::t('app', 'Opis jedinice'),
            'ventilation' => Yii::t('app', 'Provetravanje jedinice'),
            'lights' => Yii::t('app', 'Osvetljenje jedinice'),
            'orientation' => Yii::t('app', 'Orjentacija jedinice'),
            'adjacent' => Yii::t('app', 'Odnos jedinice sa susednim jedinicama'),
            'environment' => Yii::t('app', 'Prirodno okruženje i zelenilo jedinice'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildingStoreyPart()
    {
        return $this->hasOne(ProjectBuildingStoreyParts::className(), ['id' => 'project_building_storey_part_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintFunction()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintAccess()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintEntrance()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintPosition()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintShape()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintArchitecture()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintStyle()
    {
        return 'Stil jedinice';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintContext()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintVentilation()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintLights()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintAdjacent()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintOrientation()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintEnvironment()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderFunction()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderAccess()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderEntrance()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderPosition()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderShape()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderArchitecture()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderStyle()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderContext()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderVentilation()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderLights()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderAdjacent()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderOrientation()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderEnvironment()
    {
        return '';
    }
}
