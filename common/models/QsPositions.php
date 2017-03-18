<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "qs_positions".
 *
 * @property string $id
 * @property string $subwork_id
 * @property string $action_id
 * @property string $name
 * @property integer $unit
 * @property string $price
 * @property string $subtext
 *
 * @property ProjectQs[] $projectQs
 * @property QsSubworks $subwork
 * @property QsActions $action
 */
class QsPositions extends \yii\db\ActiveRecord
{
    public $act;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qs_positions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subwork_id', 'name', 'unit', 'price'], 'required'],
            [['subwork_id', 'action_id', 'unit'], 'integer'],
            [['price'], 'number'],
            [['subtext', 'act'], 'string'],
            [['name'], 'string', 'max' => 256],
            [['subwork_id'], 'exist', 'skipOnError' => true, 'targetClass' => QsSubworks::className(), 'targetAttribute' => ['subwork_id' => 'id']],
            [['action_id'], 'exist', 'skipOnError' => true, 'targetClass' => QsActions::className(), 'targetAttribute' => ['action_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'subwork_id' => Yii::t('app', 'Potkategorija radova'),
            'action_id' => Yii::t('app', 'Opis pozicije'),
            'act' => Yii::t('app', 'Opis pozicije'),
            'name' => Yii::t('app', 'Naziv pozicije'),
            'unit' => Yii::t('app', 'Jedinica mere'),
            'price' => Yii::t('app', 'Jedinična cena'),
            'subtext' => Yii::t('app', 'Tekst'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectQs()
    {
        return $this->hasMany(ProjectQs::className(), ['position_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubwork()
    {
        return $this->hasOne(QsSubworks::className(), ['id' => 'subwork_id']);
    }
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAction()
    {
        return $this->hasOne(QsActions::className(), ['id' => 'action_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnits()
    {
        $unit = '';
        switch ($this->unit) {
            case 1: $unit = 'paušalno'; break;
            case 2: $unit = 'm<sup>2</sup>/dan'; break;
            case 3: $unit = 'kom'; break;
            case 4: $unit = 'm<sup>2</sup>'; break;
            case 5: $unit = 'm<sup>3</sup>'; break;
            case 6: $unit = 'm'; break;
            case 7: $unit = 'kg'; break;
            case 8: $unit = 'dan'; break;
            default: $unit = 'm'; break;
        }
        return $unit;
    }
}
