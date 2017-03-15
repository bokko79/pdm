<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "locations".
 *
 * @property string $id
 * @property string $name
 * @property string $street
 * @property string $number
 * @property string $city_id
 * @property string $country
 * @property string $county_id
 * @property string $county
 *
 * @property Clients[] $clients
 * @property LocationLots[] $locationLots
 * @property Counties $county0
 * @property Practices[] $practices
 */
class Locations extends \yii\db\ActiveRecord
{
    public $lot;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'locations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id'], 'required'],
            [['county_id'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['street'], 'string', 'max' => 80],
            [['number', 'lot'], 'string', 'max' => 20],
            [['city_id', 'county'], 'string', 'max' => 64],
            [['country'], 'string', 'max' => 40],
            [['county_id'], 'exist', 'skipOnError' => true, 'targetClass' => Counties::className(), 'targetAttribute' => ['county_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Naziv adrese'),
            'street' => Yii::t('app', 'Ulica'),
            'number' => Yii::t('app', 'Broj'),
            'city_id' => Yii::t('app', 'Grad'),
            'country' => Yii::t('app', 'Država'),
            'county_id' => Yii::t('app', 'Katastarska opština parcele'),
            'county' => Yii::t('app', 'Katastarska opština parcele'),
            'lot' => Yii::t('app', 'Broj katastarske parcele'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasMany(Clients::className(), ['location_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocationLots()
    {
        return $this->hasMany(LocationLots::className(), ['location_id' => 'id'])->where(['type'=>'object']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceLots()
    {
        return $this->hasMany(LocationLots::className(), ['location_id' => 'id'])->where(['type'=>'service']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccessLots()
    {
        return $this->hasMany(LocationLots::className(), ['location_id' => 'id'])->where(['type'=>'access']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['location_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCounty0()
    {
        return $this->hasOne(Counties::className(), ['id' => 'county_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPractices()
    {
        return $this->hasMany(Practices::className(), ['location_id' => 'id']);
    } 

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFullAddress()
    {
        return (($this->street and $this->number) ? 'ul. '.$this->street . ' br. '.$this->number. ', ' : null).$this->city->town;
    } 

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLotAddress($br=false)
    {
        $address = $this->fullAddress;
        $lottext = 'kat.parc.br. ';
        if($lots = $this->locationLots and $this->county0){
            foreach($lots as $lot){
                $lottext .= $lot->lot .', ';
            }
            $lottext .= 'K.O. '.$this->county0->name;
        }
        return $address . ($br ? '<br>':', ') . $lottext;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLot($text=null)
    {
        if($text==1){
            if(count($this->locationLots)>1){
                $t = 'katastarske parcele broj';
            } else {
                $t = 'katastarska parcela broj';
            }
        }
        if($text==2){
            if(count($this->locationLots)>1){
                $t = 'katastarskih parcela broj';
            } else {
                $t = 'katastarske parcele broj';
            }
        }
        if($lots = $this->locationLots and $this->county0){
            foreach($lots as $lot){
                $lottext .= $lot->lot .', ';
            }
            $lottext .= 'K.O. '.$this->county0->name;
        }
        return $t . ' ' . $lottext;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceLot($text=null)
    {
        if($text==1){
            if(count($this->serviceLots)>1){
                $t = 'katastarske parcele broj';
            } else {
                $t = 'katastarska parcela broj';
            }
        }
        if($text==2){
            if(count($this->serviceLots)>1){
                $t = 'katastarskih parcela broj';
            } else {
                $t = 'katastarske parcele broj';
            }
        }
        if($lots = $this->serviceLots and $this->county0){
            foreach($lots as $lot){
                $lottext .= $lot->lot .', ';
            }
            $lottext .= 'K.O. '.$this->county0->name;
        }
        return $t . ' ' . $lottext;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccessLot($text=null)
    {
        if($text==1){
            if(count($this->accessLots)>1){
                $t = 'katastarske parcele broj';
            } else {
                $t = 'katastarska parcela broj';
            }
        }
        if($text==2){
            if(count($this->accessLots)>1){
                $t = 'katastarskih parcela broj';
            } else {
                $t = 'katastarske parcele broj';
            }
        }
        if($lots = $this->accessLots and $this->county0){
            foreach($lots as $lot){
                $lottext .= $lot->lot .', ';
            }
            $lottext .= 'K.O. '.$this->county0->name;
        }
        return $t . ' ' . $lottext;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceLotAddress($br=false)
    {
        $address = (($this->street and $this->number) ? 'ul. '.$this->street . ' br. '.$this->number. ', ' : null).$this->city->town;
        $lottext = 'kat.parc.br. ';
        if($lots = $this->serviceLots and $this->county0){
            foreach($lots as $lot){
                $lottext .= $lot .', ';
            }
            $lottext .= 'K.O. '.$this->county0->name;
        }
        return $address . ($br ? '<br>':null) . $lottext;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccessLotAddress($br=false)
    {
        $address = (($this->street and $this->number) ? 'ul. '.$this->street . ' br. '.$this->number. ', ' : null).$this->city->town;
        $lottext = 'kat.parc.br. ';
        if($lots = $this->accessLots and $this->county0){
            foreach($lots as $lot){
                $lottext .= $lot .', ';
            }
            $lottext .= 'K.O. '.$this->county0->name;
        }
        return $address . ($br ? '<br>':null) . $lottext;
    } 
}
