<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_building_storey_part_rooms".
 *
 * @property string $id
 * @property string $project_building_storey_part_id
 * @property string $type
 * @property string $name
 * @property string $mark
 * @property string $circumference
 * @property string $flooring
 * @property string $length
 * @property string $width
 * @property string $height
 * @property string $sub_net_area
 * @property string $net_area
 *
 * @property ProjectBuildingStoreyParts $projectBuildingStoreyPart
 */
class ProjectBuildingStoreyPartRooms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_building_storey_part_rooms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_building_storey_part_id', 'type'], 'required'],
            [['project_building_storey_part_id', 'mark'], 'integer'],
            [['type', 'flooring'], 'string'],
            [['circumference', 'length', 'width', 'height', 'sub_net_area', 'net_area'], 'number'],
            [['name'], 'string', 'max' => 32],
           // [['mark'], 'string', 'max' => 12],
            [['project_building_storey_part_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectBuildingStoreyParts::className(), 'targetAttribute' => ['project_building_storey_part_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'project_building_storey_part_id' => Yii::t('app', 'Jedinica etaže'),
            'type' => Yii::t('app', 'Vrsta prostorije'),
            'name' => Yii::t('app', 'Naziv prostorije'),
            'mark' => Yii::t('app', 'Oznaka'),
            'circumference' => Yii::t('app', 'Obim'),
            'flooring' => Yii::t('app', 'Obrada poda'),
            'length' => Yii::t('app', 'Dužina'),
            'width' => Yii::t('app', 'Širina'),
            'height' => Yii::t('app', 'Visina'),
            'sub_net_area' => Yii::t('app', 'Redukovana podna površina'),
            'net_area' => Yii::t('app', 'Ukupna podna površina'),
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
    public function getFullname()
    {
        return $this->mark. ' ' .$this->name. ' '.$this->type;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFullType()
    {
        $type;
        switch ($this->type) {
            case 'soba': $type = 'soba'; break;
            case 'terasa': $type = 'terasa';  break;
            case 'kupatilo': $type = 'kupatilo';  break;
            case 'sanitarni': $type = 'sanitarni čvor';  break;
            case 'kuhinja': $type = 'kuhinja';  break;
            case 'trpezarija': $type = 'trpezarija';  break;
            case 'dnevna': $type = 'dnevna soba';  break;
            case 'radna': $type = 'radna soba';  break;
            case 'spavaca': $type = 'spavaća soba';  break;
            case 'tehnicka': $type = 'tehnička prostorija';  break;
            case 'balkon': $type = 'balkon';  break;
            case 'hodnik': $type = 'hodnik';  break;
            case 'predprostor': $type = 'predprostor';  break;
            case 'degazman': $type = 'degažman';  break;
            case 'ulaz': $type = 'ulaz';  break;
            case 'trem': $type = 'trem';  break;
            case 'laboratorija': $type = 'laboratorija'; break;
            case 'studio': $type = 'studio';  break;
            case 'igraonica': $type = 'igraonica';  break;
            case 'radionica': $type = 'radionica';  break;
            case 'stepeniste': $type = 'stepenište'; break;
            case 'vesernica': $type = 'vešernica';  break;
            case 'kotlarnica': $type = 'kotlarnica';  break;
            case 'lift': $type = 'lift';  break;
            case 'dnevna_kuhinja': $type = 'dnevna soba sa kuhinjom'; break;
            case 'dnevna_kuhinja_trp': $type = 'dDnevna soba sa kuhinjom i trpezarijom'; break;
            case 'ostava': $type = 'ostava'; break;
            case 'garaza': $type = 'garaža'; break;
            case 'pasaz': $type = 'pasaž'; break;
            case 'parking': $type = 'parking prostor'; break;
            case 'dnevna_trp': $type = 'dnevna soba sa trpezarijom'; break;
            case 'lounge': $type = 'laundž'; break;
            case 'kancelarija': $type = 'kancelarija'; break;
            case 'poslovni': $type = 'poslovni prostor'; break;
            case 'garderober': $type = 'garderober'; break;
            case 'toalet': $type = 'toalet'; break;
            case 'svlacionica': $type = 'svlačionica'; break;
            case 'spa': $type = 'wellness&Spa'; break;
            case 'masina_lifta': $type = 'mašina lifta'; break;
            case 'rampa': $type = 'rampa'; break;
            case 'hidrocel': $type = 'hirdocel'; break;
            case 'vetrobran': $type = 'vetrobran'; break;
            case 'vestibil': $type = 'vestibil'; break;
            case 'izlozbeni': $type = 'izložbeni prostor'; break;
            case 'blagajna': $type = 'blagajna'; break;
            case 'vinski': $type = 'vinski podrum'; break;
            case 'hladna': $type = 'hladna ostava'; break;
            case 'teretana': $type = 'teretana'; break;
            case 'biblioteka': $type = 'biblioteka'; break;
            case 'citaonica': $type = 'čitaionica'; break;
            case 'ucionica': $type = 'učionica'; break;
            //default: $type = 'drugo';
        }
        return $type;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        $type;
        switch ($this->type) {
            case 'soba': $type = 'Stambene prostorije';  break;
            case 'terasa': $type = 'Stambene prostorije';  break;
            case 'kupatilo': $type = 'Stambene prostorije';  break;
            case 'sanitarni': $type = 'Sanitarni čvor';  break;
            case 'kuhinja': $type = 'Stambene prostorije';   break;
            case 'trpezarija': $type = 'Stambene prostorije';   break;
            case 'dnevna': $type = 'Stambene prostorije';   break;
            case 'radna': $type = 'Stambene prostorije';   break;
            case 'spavaca': $type = 'Stambene prostorije';   break;
            case 'tehnicka': $type = 'Tehničke prostorije';   break;
            case 'balkon': $type = 'Stambene prostorije';   break;
            case 'hodnik': $type = 'Stambene prostorije';   break;
            case 'predprostor': $type = 'Ulaz i hodnici';   break;
            case 'degazman': $type = 'Stambene prostorije';   break;
            case 'ulaz': $type = 'Ulaz i hodnici';   break;
            case 'trem': $type = 'Ulaz i hodnici';   break;
            case 'laboratorija': $type = 'Tehničke prostorije';  break;
            case 'studio': $type = 'Poslovne prostorije';   break;
            case 'igraonica': $type = 'Ostale prostorije';   break;
            case 'radionica': $type = 'Poslovne prostorije';   break;
            case 'stepeniste': $type = 'Ulaz i hodnici';  break;
            case 'vesernica': $type = 'Tehničke prostorije';   break;
            case 'kotlarnica': $type = 'Tehničke prostorije';   break;
            case 'lift': $type = 'Tehničke prostorije';   break;
            case 'dnevna_kuhinja': $type = 'Stambene prostorije';  break;
            case 'dnevna_kuhinja_trp': $type = 'Stambene prostorije';  break;
            case 'ostava': $type = 'Stambene prostorije';  break;
            case 'garaza': $type = 'Ostale prostorije';  break;
            case 'pasaz': $type = 'Ulaz i hodnici';  break;
            case 'parking': $type = 'Ostale prostorije';  break;
            case 'dnevna_trp': $type = 'Stambene prostorije';  break;
            case 'lounge': $type = 'Poslovne prostorije';  break;
            case 'kancelarija': $type = 'Poslovne prostorije';  break;
            case 'poslovni': $type = 'Poslovne prostorije';  break;
            case 'garderober': $type = 'Stambene prostorije';  break;
            case 'toalet': $type = 'Stambene prostorije';  break;
            case 'svlacionica': $type = 'Ostale prostorije';  break;
            case 'spa': $type = 'Ostale prostorije';  break;
            case 'masina_lifta': $type = 'Tehničke prostorije';  break;
            case 'rampa': $type = 'Ulaz i hodnici';  break;
            case 'hidrocel': $type = 'Tehničke prostorije';  break;
            case 'vetrobran': $type = 'Ulaz i hodnici';  break;
            case 'vestibil': $type = 'Ulaz i hodnici';  break;
            case 'izlozbeni': $type = 'Ostale prostorije';  break;
            case 'blagajna': $type = 'Poslovne prostorije';  break;
            case 'vinski': $type = 'Stambene prostorije';  break;
            case 'hladna': $type = 'Stambene prostorije';  break;
            case 'teretana': $type = 'Ostale prostorije';  break;
            case 'biblioteka': $type = 'Stambene prostorije';  break;
            case 'citaonica': $type = 'Ostale prostorije';  break;
            case 'ucionica': $type = 'Ostale prostorije';  break;
            default: $type = 'Ostale prostorije';  break;
        }
        return $type;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypesofRooms()
    {
        $type = [];
        $type[] = [ 'type'=>'soba', 'text'=> 'soba', 'group' => 'Stambene prostorije']; 
        $type[] = [ 'type'=> 'terasa','text'=> 'terasa', 'group' => 'Stambene prostorije']; 
        $type[] = [ 'type'=> 'kupatilo', 'text'=> 'kupatilo', 'group' => 'Stambene prostorije']; 
        $type[] = [ 'type'=> 'sanitarni', 'text'=> 'sanitarni čvor', 'group' => 'Sanitarni čvor']; 
        $type[] = [ 'type'=> 'kuhinja', 'text'=> 'kuhinja', 'group' => 'Stambene prostorije']; 
        $type[] = [ 'type'=> 'trpezarija', 'text'=> 'trpezarija', 'group' => 'Stambene prostorije']; 
        $type[] = [ 'type'=> 'dnevna', 'text'=> 'dnevna soba', 'group' => 'Stambene prostorije']; 
        $type[] = [ 'type'=> 'radna', 'text'=> 'radna soba', 'group' => 'Stambene prostorije']; 
        $type[] = [ 'type'=> 'spavaca', 'text'=> 'spavaća soba', 'group' => 'Stambene prostorije']; 
        $type[] = [ 'type'=> 'tehnicka', 'text'=> 'tehnička prostorija', 'group' => 'Tehničke prostorije']; 
        $type[] = [ 'type'=> 'balkon', 'text'=> 'balkon', 'group' => 'Stambene prostorije']; 
        $type[] = [ 'type'=> 'hodnik', 'text'=> 'hodnik', 'group' => 'Stambene prostorije']; 
        $type[] = [ 'type'=> 'predprostor', 'text'=> 'predprostor', 'group' => 'Ulaz i hodnici']; 
        $type[] = [ 'type'=> 'degazman', 'text'=> 'degažman', 'group' => 'Stambene prostorije']; 
        $type[] = [ 'type'=> 'ulaz', 'text'=> 'ulaz', 'group' => 'Ulaz i hodnici']; 
        $type[] = [ 'type'=> 'trem', 'text'=> 'trem', 'group' => 'Ulaz i hodnici']; 
        $type[] = [ 'type'=> 'laboratorija', 'text'=> 'laboratorija', 'group' => 'Tehničke prostorije']; 
        $type[] = [ 'type'=> 'studio', 'text'=> 'studio', 'group' => 'Poslovne prostorije']; 
        $type[] = [ 'type'=> 'igraonica', 'text'=> 'igraonica', 'group' => 'Ostale prostorije']; 
        $type[] = [ 'type'=> 'radionica', 'text'=> 'radionica', 'group' => 'Poslovne prostorije']; 
        $type[] = [ 'type'=> 'stepeniste', 'text'=> 'stepenište', 'group' => 'Ulaz i hodnici']; 
        $type[] = [ 'type'=> 'vesernica', 'text'=> 'vešernica', 'group' => 'Tehničke prostorije']; 
        $type[] = [ 'type'=> 'kotlarnica', 'text'=> 'kotlarnica', 'group' => 'Tehničke prostorije']; 
        $type[] = [ 'type'=> 'lift', 'text'=> 'lift', 'group' => 'Tehničke prostorije']; 
        $type[] = [ 'type'=> 'dnevna_kuhinja', 'text'=> 'dnevna soba sa kuhinjom', 'group' => 'Stambene prostorije']; 
        $type[] = [ 'type'=> 'dnevna_kuhinja_trp', 'text'=> 'dnevna soba sa kuhinjom i trpezarijom','Stambene prostorije']; 
        $type[] = [ 'type'=> 'ostava', 'text'=> 'ostava', 'group' => 'Stambene prostorije']; 
        $type[] = [ 'type'=> 'garaza', 'text'=> 'garaža', 'group' => 'Ostale prostorije']; 
        $type[] = [ 'type'=> 'pasaz', 'text'=> 'pasaž', 'group' => 'Ulaz i hodnici']; 
        $type[] = [ 'type'=> 'parking', 'text'=> 'parking', 'group' => 'Ostale prostorije']; 
        $type[] = [ 'type'=> 'dnevna_trp', 'text'=> 'dnevna soba sa trpezarijom', 'group' => 'Stambene prostorije']; 
        $type[] = [ 'type'=> 'lounge', 'text'=> 'laundž', 'group' => 'Poslovne prostorije']; 
        $type[] = [ 'type'=> 'kancelarija', 'text'=> 'kancelarija', 'group' => 'Poslovne prostorije']; 
        $type[] = [ 'type'=> 'poslovni', 'text'=> 'poslovni prostor', 'group' => 'Poslovne prostorije']; 
        $type[] = [ 'type'=> 'garderober', 'text'=> 'garderober', 'group' => 'Stambene prostorije']; 
        $type[] = [ 'type'=> 'toalet', 'text'=> 'toalet', 'group' => 'Stambene prostorije']; 
        $type[] = [ 'type'=> 'svlacionica', 'text'=> 'svlačionica', 'group' => 'Ostale prostorije']; 
        $type[] = [ 'type'=> 'spa', 'text'=> 'wellness&spa', 'group' => 'Ostale prostorije']; 
        $type[] = [ 'type'=> 'masina_lifta', 'text'=> 'mašina lifta', 'group' => 'Tehničke prostorije']; 
        $type[] = [ 'type'=> 'rampa', 'text'=> 'rampa', 'group' => 'Ulaz i hodnici']; 
        $type[] = [ 'type'=> 'hidrocel', 'text'=> 'hidrocel', 'group' => 'Tehničke prostorije']; 
        $type[] = [ 'type'=> 'vetrobran', 'text'=> 'vetrobran', 'group' => 'Ulaz i hodnici']; 
        $type[] = [ 'type'=> 'vestibil', 'text'=> 'vestibil', 'group' => 'Ulaz i hodnici']; 
        $type[] = [ 'type'=> 'izlozbeni', 'text'=> 'izložbeni prostor', 'group' => 'Ostale prostorije']; 
        $type[] = [ 'type'=> 'blagajna', 'text'=> 'blagajna', 'group' => 'Poslovne prostorije']; 
        $type[] = [ 'type'=> 'vinski', 'text'=> 'vinski podrum', 'group' => 'Stambene prostorije']; 
        $type[] = [ 'type'=> 'hladna', 'text'=> 'hladna ostava', 'group' => 'Stambene prostorije']; 
        $type[] = [ 'type'=> 'teretana', 'text'=> 'teretana', 'group' => 'Ostale prostorije']; 
        $type[] = [ 'type'=> 'biblioteka', 'text'=> 'biblioteka', 'group' => 'Stambene prostorije']; 
        $type[] = [ 'type'=> 'citaonica', 'text'=> 'čitaonica', 'group' => 'Ostale prostorije']; 
        $type[] = [ 'type'=> 'ucionica', 'text'=> 'učionica', 'group' => 'Ostale prostorije'];        
        return $type;
    }
}
