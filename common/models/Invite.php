<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class Invite extends Model
{
    public $email;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            ['email', 'email'],
            //['email', 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'email' => Yii::t('app', 'Email adresa'),
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function invite()
    {
        if ($this->validate()) {
            \Yii::$app->mailer->compose(['html' => '/user/mail/invite'])
                ->setFrom([\Yii::$app->params['supportEmail'] => 'Masterplan ARC d.o.o.'])
                ->setTo($this->email)
                ->setSubject('Poziv na Masterplan.rs' )
                ->send();
        } else {
            return false;
        }
    }
}
