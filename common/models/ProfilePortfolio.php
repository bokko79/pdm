<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "profile_portfolio".
 *
 * @property string $id
 * @property string $profile_type
 * @property string $profile_id
 * @property string $portfolio_type
 * @property string $title
 * @property string $company
 * @property string $start_month
 * @property integer $start_year
 * @property integer $current
 * @property string $end_month
 * @property integer $end_year
 * @property string $summary
 *
 * @property Profile $profile
 */
class ProfilePortfolio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profile_portfolio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profile_type', 'portfolio_type', 'summary'], 'string'],
            [['profile_id', 'portfolio_type', 'title', 'start_month', 'start_year', 'end_month', 'end_year'], 'required'],
            [['profile_id', 'start_year', 'current', 'end_year'], 'integer'],
            [['title'], 'string', 'max' => 64],            
            [['company'], 'string', 'max' => 128],
            [['start_month', 'end_month'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'profile_type' => Yii::t('app', 'Profile Type'),
            'profile_id' => Yii::t('app', 'Profile ID'),
            'portfolio_type' => Yii::t('app', 'Vrsta podatka portfolia'),
            'title' => Yii::t('app', 'Naziv'),
            'company' => Yii::t('app', 'Instutucija/preduzeće'),
            'start_month' => Yii::t('app', 'Mesec početka'),
            'start_year' => Yii::t('app', 'Godina početka'),
            'current' => Yii::t('app', 'Trenutno?'),
            'end_month' => Yii::t('app', 'Mesec završetka'),
            'end_year' => Yii::t('app', 'Godina završetka'),
            'summary' => Yii::t('app', 'Opis'),
        ];
    }    
}
