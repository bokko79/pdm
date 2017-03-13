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
        return 'building_classes';
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
            'name' => Yii::t('app', 'Tip objekta'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuildingName()
    {
        $name;
        switch ($this->id) {
            case 1:
            case 2:
            case 3:
                $name = 'Jednoporodična kuća';
                break;
            case 17:
            case 18:
            case 21:
            case 22:
                $name = 'Hotel';
                break;
            case 19:
            case 20:
                $name = 'Ugostiteljski objekat';
                break;
            case 23:
            case 24:
            case 25:
            case 26:
            case 27:
            case 28:
                $name = 'Poslovni objekat';
                break;
            case 29:
            case 30:
            case 31:
            case 32:
            case 33:
            case 34:
            case 35:
            case 36:
            case 37:
            case 38:
            case 39:
            case 40:
                $name = 'Saobraćajni objekat';
                break;
            case 41:
            case 42:
                $name = 'Garaža';
                break;
            case 43:
            case 44:
            case 45:
            case 46:
            case 47:
            case 48:
                $name = 'Industrijski objekat';
                break;
            case 49:
            case 50:
            case 51:
            case 52:
            case 53:            
                $name = 'Skladište';
                break;
            case 54:
            case 55:
            case 56:
            case 57:
                $name = 'Objekat kulture';
                break;
            case 58:
            case 59:
                $name = 'Muzej';
                break;
            case 60:
            case 61:
            case 62:
            case 63:
            case 64:
            case 65:
            case 66:
            case 67:
            case 68:
                $name = 'Škola';
                break;
            case 69:
            case 70:
            case 71:
            case 72:
            case 73:
            case 74:
            case 75:
            case 76:
            case 77:
            case 78:
                $name = 'Bolnica';
                break;
            case 79:
                $name = 'Dvorana';
                break;
            case 80:
            case 81:
            case 82:
            case 83:
            case 84:
            case 85:
            case 86:
            case 87:
            case 88:
            case 89:
            case 90:
                $name = 'Poljoprivredni objakat';
                break;
            case 91:
            case 92:
            case 93:
            case 94:
            case 95:
                $name = 'Verski objakat';
                break;
            case 96:
            case 97:
            case 98:
                $name = 'Spomenik';
                break;
            case 99:
                $name = 'Kasarna';
                break;
            default:
                $name = 'Stambeni objekat';
                break;
        }
        return $name;
    }
}
