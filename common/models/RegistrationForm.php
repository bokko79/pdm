<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace common\models;

use dektrium\user\traits\ModuleTrait;
use Yii;
use dektrium\user\models\RegistrationForm as BaseRegistrationForm;

/**
 * Registration form collects user input on registration process, validates it and creates new User model.
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class RegistrationForm extends BaseRegistrationForm
{
    /**
     * @var string Password
     */
    public $location;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();        

        $rules['locationRule'] = ['location', 'safe'];
        
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Yii::t('app', 'Korisničko ime'),
            'password' => Yii::t('app', 'Lozinka'),
        ];
    }

    /**
     * Registers a new user account. If registration was successful it will set flash message.
     *
     * @return bool
     */
    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        /** @var User $user */
        $user = Yii::createObject(\dektrium\user\models\User::className());
        $user->setScenario('register');
        $this->loadAttributes($user);

        if (!$user->register()) {
            return false;
        }

        Yii::$app->session->setFlash(
            'info',
            Yii::t(
                'user',
                'Vaš nalog je uspešno kreiran! Potrebno je još da potvrdite Vaš identitet klikom na aktivacioni link koji je upravo poslat na unetu email adresu. Proverite Vaš email i pratite jednostavno uputstvo.'
            )
        );

        return true;
    }

    /**
     * Loads attributes to the user model. You should override this method if you are going to add new fields to the
     * registration form. You can read more in special guide.
     *
     * By default this method set all attributes of this model to the attributes of User model, so you should properly
     * configure safe attributes of your User model.
     *
     * @param User $user
     */
    protected function loadAttributes(\dektrium\user\models\User $user)
    {
        $user->setAttributes($this->attributes);
    }
}
