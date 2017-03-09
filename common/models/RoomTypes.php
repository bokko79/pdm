<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "room_types".
 *
 * @property string $id
 * @property string $name
 * @property string $type
 * @property string $description
 *
 * @property ProjectBuildingStoreyPartRooms[] $projectBuildingStoreyPartRooms
 */
class RoomTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['type', 'description'], 'string'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Vrsta Prostorije'),
            'type' => Yii::t('app', 'Kategorija prostorije'),
            'description' => Yii::t('app', 'Opis prostorije'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildingStoreyPartRooms()
    {
        return $this->hasMany(ProjectBuildingStoreyPartRooms::className(), ['room_type_id' => 'id']);
    }
}
