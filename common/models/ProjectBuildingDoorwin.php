<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_building_doorwin".
 *
 * @property string $id
 * @property integer $pos_no
 * @property string $pos_type
 * @property string $type
 * @property string $name
 * @property string $project_building_id
 * @property string $description
 * @property integer $width
 * @property integer $height
 * @property integer $length
 * @property integer $length_slanted
 * @property string $frame
 * @property string $sash
 * @property string $opening_type
 * @property string $material
 * @property string $metal
 * @property string $note
 * @property integer $scale
 * @property string $file_id
 *
 * @property ProjectBuildingStoreyDoorwin[] $projectBuildingStoreyDoorwins
 */
class ProjectBuildingDoorwin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_building_doorwin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pos_no', 'project_building_id', 'scale', 'file_id'], 'integer'],
            [['width', 'height', 'length', 'length_slanted', ], 'number'],
            [['pos_type', 'type', 'description', 'opening_type'], 'string'],
            [['name', 'frame', 'sash', 'material', 'metal', 'note'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pos_no' => Yii::t('app', 'Broj pozicije'),
            'pos_type' => Yii::t('app', 'Vrsta'),
            'type' => Yii::t('app', 'Podvrsta'),
            'name' => Yii::t('app', 'Naziv'),
            'project_building_id' => Yii::t('app', 'Objekat projekta'),
            'description' => Yii::t('app', 'Opis pozicije'),
            'width' => Yii::t('app', 'Širina'),
            'height' => Yii::t('app', 'Visina'),
            'length' => Yii::t('app', 'Dužina'),
            'length_slanted' => Yii::t('app', 'Dužina kosih elemenata'),
            'frame' => Yii::t('app', 'Okvir'),
            'sash' => Yii::t('app', 'Ispuna'),
            'opening_type' => Yii::t('app', 'Način otvaranja'),
            'material' => Yii::t('app', 'Obrada'),
            'metal' => Yii::t('app', 'Okovi'),
            'note' => Yii::t('app', 'Napomena'),
            'scale' => Yii::t('app', 'Razmera'),
            'file_id' => Yii::t('app', 'Fajl'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuildingStoreyDoorwins()
    {
        return $this->hasMany(ProjectBuildingStoreyDoorwin::className(), ['project_building_doorwin_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjectBuilding()
    {
        return $this->hasOne(ProjectBuilding::className(), ['id' => 'project_building_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getschemeType()
    {
        $type;
        switch ($this->pos_type) {
            case 'wood_int':
                $type = 'Unutrašnja stolarija';
                break;

            case 'wood_ext':
                $type = 'Spoljašnja/fasadna stolarija';
                break;

            case 'metal_int':
                $type = 'Unutrašnja bravarija';
                break;

            case 'metal_ext':
                $type = 'Spoljašnja/fasadna bravarija';
                break;
            
            default:
                $type = 'Bravarija';
                break;
        }
        return $type;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getschemeSubType()
    {
        $type;
        switch ($this->type) {
            case 'prozor':
                $type = 'Prozor';
                break;

            case 'vrata':
                $type = 'Vrata';
                break;

            case 'portal':
                $type = 'Portal';
                break;

            case 'balkonska':
                $type = 'Balkonska vrata';
                break;

            case 'rukohvat':
                $type = 'Rukohvat';
                break;

            case 'ograda':
                $type = 'Ograda';
                break;
            
            default:
                $type = 'Ostalo';
                break;
        }
        return $type;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTotal()
    {
        $total = 0;
        if($pos = $this->projectBuildingStoreyDoorwins){
            foreach($pos as $ps){
                $total += $ps->total;
            }
        }
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLefts()
    {
        $total = 0;
        if($pos = $this->projectBuildingStoreyDoorwins){
            foreach($pos as $ps){
                $total += $ps->lefts;
            }
        }
        return $total;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRights()
    {
        $total = 0;
        if($pos = $this->projectBuildingStoreyDoorwins){
            foreach($pos as $ps){
                $total += $ps->rights;
            }
        }
        return $total;
    }
}
