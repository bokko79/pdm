<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "project_building_characteristics".
 *
 * @property string $project_building_id
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
 * @property Projects $project
 */
class ProjectBuildingCharacteristics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project_building_characteristics';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_building_id'], 'required'],
            [['project_building_id'], 'integer'],
            [['function', 'access', 'entrance', 'position', 'shape', 'architecture', 'style', 'context', 'ventilation', 'lights', 'orientation', 'adjacent', 'environment'], 'string'],
            [['project_building_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProjectBuilding::className(), 'targetAttribute' => ['project_building_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_building_id' => Yii::t('app', 'Objekat projekta'),
            'function' => Yii::t('app', 'Funkcija objekta'),
            'access' => Yii::t('app', 'Pristupi i prilazi objektu'),
            'entrance' => Yii::t('app', 'Ulazi u objekat'),
            'position' => Yii::t('app', 'Položaj objekta u okruženju'),
            'shape' => Yii::t('app', 'Oblik objekta'),
            'architecture' => Yii::t('app', 'Arhitektura objekta'),
            'style' => Yii::t('app', 'Arhitektonski stil objekta'),
            'context' => Yii::t('app', 'Opis objekta'),
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
    public function getProjectBuilding()
    {
        return $this->hasOne(ProjectBuilding::className(), ['id' => 'project_building_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintFunction()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintAccess()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintEntrance()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintPosition()
    {
        return 'Opis pozicije predmetnog objekta u okviru naselja, bloka i/ili ulice. Položaj/uvlačenje u odnosu na regulacionu i građevinsku liniju.<br>Opis napisati u formi rečenice.';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintShape()
    {
        return 'Opis geometrijskog oblika predmetnog objekta. Oblik osnove. Oblik ugla, ako ga ima. Forma fasade.<br>Opis napisati u formi rečenice.';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintArchitecture()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintStyle()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintContext()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintVentilation()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintLights()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintAdjacent()
    {
        return 'Opis odnosa objekta sa susednim objektima. Tip objekta: slobodnostojeći, objekat u neprekinutom blokovskom nizu, dvojni objekat, ugaoni objekat. Udaljenost objekta od susednih objekata. Otvori prema susednim objektima. <br>Opis napisati u formi rečenice.';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintOrientation()
    {
        return 'Orjentacija objekta u prostoru, prema stranama sveta, npr. ulična fasada okrenuta prema jugozapadu, dvorišna prema severoistoku, itd.<br>Opis napisati u formi rečenice.';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHintEnvironment()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderFunction()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderAccess()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderEntrance()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderPosition()
    {
        return 'Npr. Objekat se nalazi na uglu ulica xxxx. i xxxx., u bloku xxx., u neposrednoj blizini xxxx. i postavljen je na građevinske linije kao deo objekata u blokovskom nizu i to tako da se građevinska linija prema ulici xxx povlači xx m od regulacione linije, a građevinska linija prema ulici xxx xx m od regulacione linije...';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderShape()
    {
        return 'Npr. Objekat je ugaoni sa zaobljenim uglom od 90 stepeni.... ili Objekat je kvadratne/pravougaone/složene osnove sa izdvojenim delom takođe pravougaone osnove.';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderArchitecture()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderStyle()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderContext()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderVentilation()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderLights()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderAdjacent()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderOrientation()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlaceholderEnvironment()
    {
        return '';
    }
}
