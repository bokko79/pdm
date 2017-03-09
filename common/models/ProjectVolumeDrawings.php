<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_volume_drawings".
 *
 * @property string $id
 * @property string $project_volume_id
 * @property string $project_building_storey_id
 * @property string $type
 * @property string $number
 * @property string $name
 * @property string $title
 * @property integer $scale
 * @property string $note
 *
 * @property ProjectVolumes $projectVolume
 * @property ProjectBuildingStoreys $projectBuildingStorey
 */
class ProjectVolumeDrawings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_volume_drawings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_volume_id', 'number', 'scale'], 'required'],
            [['project_volume_id', 'project_building_storey_id', 'scale', 'print_title'], 'integer'],
            [['type', 'note'], 'string'],
            [['number'], 'string', 'max' => 5],
            [['name'], 'string', 'max' => 80],
            [['title'], 'string', 'max' => 128],
            [['project_volume_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectVolumes::className(), 'targetAttribute' => ['project_volume_id' => 'id']],
            [['project_building_storey_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectBuildingStoreys::className(), 'targetAttribute' => ['project_building_storey_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'project_volume_id' => Yii::t('app', 'Sveska projekta'),
            'project_building_storey_id' => Yii::t('app', 'Etaža objekta'),
            'type' => Yii::t('app', 'Vrsta crteža'),
            'number' => Yii::t('app', 'Broj crteža'),
            'name' => Yii::t('app', 'Naziv crteža'),
            'title' => Yii::t('app', 'Glavni naslov'),
            'print_title' => Yii::t('app', 'Ispisivanje naslova'),
            'scale' => Yii::t('app', 'Razmera'),
            'note' => Yii::t('app', 'Napomena'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectVolume()
    {
        return $this->hasOne(ProjectVolumes::className(), ['id' => 'project_volume_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildingStorey()
    {
        return $this->hasOne(ProjectBuildingStoreys::className(), ['id' => 'project_building_storey_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFullType()
    {
        $type;
        switch ($this->type) {
            case 'osnova': $type = 'osnova'; break; 
            case 'etaza': $type = 'osnova etaže'; break; 
            case 'temelj': $type ='osnova temelja'; break; 
            case 'krovna': $type = 'osnova krovne konstrukcije'; break; 
            case 'presek': $type = 'presek'; break; 
            case 'izgled': $type = 'izgled'; break; 
            case 'detalj': $type = 'detalj'; break; 
            case 'situacija': $type = 'situacija'; break; 
            case 'izv1': $type = 'situacioni plan sa osnovom krova'; break;
            case 'izv2': $type = 'situaciono nivelacioni plan sa osnovom prizemlja'; break; 
            case 'izv3': $type = 'situaciono nivelacioni plan sa prikazom saobraćajnog rešenja'; break; 
            case 'izv4': $type = 'situacioni plan sa prikazom sinhron-plana instalacija'; break; 
            case 'izv5': $type = 'osnova etaže pristup svetlarniku'; break;
            case '3d': $type = '3D prikaz'; break;
            case 'sema': $type = 'šema'; break;
            
            default:
                'Osnova';
                break;
        }
        return $type;
    }
}
