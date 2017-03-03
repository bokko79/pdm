<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "buildings".
 *
 * @property string $id
 * @property string $name
 * @property string $title
 * @property string $criteria
 * @property string $class
 * @property string $category
 *
 * @property ProjectBuilding[] $projectBuildings
 * @property ProjectBuildingClasses[] $projectBuildingClasses
 */
class Buildings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'buildings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'class', 'category'], 'required'],
            [['category'], 'string'],
            [['name'], 'string', 'max' => 64],
            [['title'], 'string', 'max' => 256],
            [['criteria'], 'string', 'max' => 128],
            [['class'], 'string', 'max' => 6],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Naziv'),
            'fullname' => Yii::t('app', 'Pun naziv objekta'),
            'title' => Yii::t('app', 'Opis'),
            'criteria' => Yii::t('app', 'Kriterijum'),
            'class' => Yii::t('app', 'Klasa objekta'),
            'category' => Yii::t('app', 'Kategorija objekta'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildings()
    {
        return $this->hasMany(ProjectBuilding::className(), ['building_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildingClasses()
    {
        return $this->hasMany(ProjectBuildingClasses::className(), ['building_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFullname()
    {
        return $this->name. ': '. $this->title. ' -- '.$this->criteria. ' // '.$this->category. '-'.$this->class;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFullClass()
    {
        return $this->class . ' (' .$this->category. '): '.$this->name. ': '. $this->title. ' -- '.$this->criteria;
    }
}
