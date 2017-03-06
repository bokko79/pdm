<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "volumes".
 *
 * @property string $id
 * @property string $name
 * @property string $type
 * @property string $no
 * @property string $info
 * @property string $file_id
 *
 * @property PhaseVolumes[] $phaseVolumes
 * @property ProjectVolumes[] $projectVolumes
 */
class Volumes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'volumes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['type', 'info'], 'string'],
            [['file_id'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['no'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'no' => Yii::t('app', 'No'),
            'info' => Yii::t('app', 'Info'),
            'file_id' => Yii::t('app', 'File ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhaseVolumes()
    {
        return $this->hasMany(PhaseVolumes::className(), ['volume_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectVolumes()
    {
        return $this->hasMany(ProjectVolumes::className(), ['volume_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNameGen()
    {
        $name;
        switch ($this->name) {
            case 'glavna sveska': $name = 'glavne sveske'; break;
            case 'projekat arhitekture': $name = 'projekta arhitekture'; break;
            case 'projekat konstrukcije': $name = 'projekta konstrukcije'; break;
            case 'projekat saobraćajnica': $name = 'projekta saobraćajnica'; break;
            case 'projekat hidrotehničkih instalacija': $name = 'projekta hidrotehničkih instalacija'; break;
            case 'projekat elektroenergetskih instalacija': $name = 'projekta elektroenergetskih instalacija'; break;
            case 'projekat telekomunikacionih i signalnih instalacija': $name = 'projekta telekomunikacionih i signalnih instalacija'; break;
            case 'projekat mašinskih instalacija': $name = 'projekta mašinskih instalacija'; break;
            case 'projekat tehnologije': $name = 'projekat tehnologije'; break;
            case 'projekat saobraćaja i saobraćajne signalizacije': $name = 'projekat saobraćaja i saobraćajne signalizacije'; break;
            case 'projekat spoljnog uređenja': $name = 'projekta spoljnog uređenja'; break;
            case 'projekat pripremnih radova': $name = 'projekta pripremnih radova'; break;
            case 'elaborat o geotehničkim uslovima izgradnje': $name = 'elaborat o geotehničkim uslovima izgradnje'; break;
            case 'elaborat zaštite od požara': $name = 'elaborata zaštite od požara'; break;
            case 'elaborat energetske efikasnosti': $name = 'elaborata energetske efikasnosti'; break;
            case 'projekat sprinkler instalacija': $name = 'projektaa sprinkler instalacija'; break;
            case 'izvod iz projekta': $name = 'izvoda iz projekta'; break;
            
            default:
                $name = '';
                break;
        }
        return $name;
    }
}
