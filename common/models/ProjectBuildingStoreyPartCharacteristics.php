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
    public function getProjectBuildingStoreyPart()
    {
        return $this->hasOne(ProjectBuildingStoreyParts::className(), ['id' => 'project_building_storey_part_id']);
    }
}
