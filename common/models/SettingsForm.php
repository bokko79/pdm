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

use dektrium\user\helpers\Password;
use dektrium\user\Mailer;
use dektrium\user\Module;
use dektrium\user\traits\ModuleTrait;
use Yii;
use yii\imagine\Image;
use dektrium\user\models\SettingsForm as BaseSettingForm;

/**
 * SettingsForm gets user's username, email and password and changes them.
 *
 * @property User $user
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class SettingsForm extends BaseSettingForm
{
    use ModuleTrait;

    /** @var User */
    private $_user;
    public $theme;
    public $avatar;
    public $avatarFile;

    /** @return User */
    public function getUser()
    {
        if ($this->_user == null) {
            $this->_user = \common\models\UserAccount::findOne(\Yii::$app->user->id);
        }

        return $this->_user;
    }

    /** @inheritdoc */
    public function __construct(Mailer $mailer, $config = [])
    {
        $this->mailer = $mailer;
        $this->setAttributes([
            'username' => $this->user->username,
            'theme' => $this->user->theme,
            'avatar' => $this->user->avatar,
            'email'    => $this->user->unconfirmed_email ?: $this->user->email,
        ], false);
        parent::__construct($mailer, $config);
    }

    // event init
    public function init()
    {
    }

    /** @inheritdoc */
    public function rules()
    {
        $rules = parent::rules();  
        $rules['theme'] = [['theme',], 'integer']; 
        $rules['avatar'] = [['avatar'], 'integer'];
        $rules['avatarFile'] = [['avatarFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'];
        return $rules;
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'email'            => Yii::t('user', 'Email'),
            'username'         => Yii::t('user', 'Korisničko ime'),
            'new_password'     => Yii::t('user', 'Nova lozinka'),
            'current_password' => Yii::t('user', 'Trenutna lozinka'),
            'theme'            => Yii::t('user', 'Tema'),
            'avatarFile'            => Yii::t('user', 'Profilna slika'),
        ];
    }

    public function uploadAvatar()
    {
        if ($this->validate()) {
           
            $fileName = $this->user->id . '_' . time(); 
            $thumb = 'images/profiles/'.$fileName.'1.'.$this->avatarFile->extension;

            $this->avatarFile->saveAs($thumb); 
            
            $image = new \common\models\Files();
            $image->name = $fileName . '.' . $this->avatarFile->extension;
            $image->type = 'jpg';
            $image->time = time();
            
                
            Image::thumbnail($thumb, 262,262)->save(\Yii::getAlias('images/profiles/'.$fileName.'.'.$this->avatarFile->extension), ['quality' => 80]); 
            unlink(\Yii::getAlias($thumb));
            $image->save();

            if($image->save()){
                $this->avatarFile = null;
                return $image->id;
            }
            
            return false;
        }
        return false;        
    }

    /**
     * Saves new account settings.
     *
     * @return bool
     */
    public function save()
    {
        if ($this->validate()) {
            $this->user->scenario = 'settings';
            $this->user->username = $this->username;
            $this->user->password = $this->new_password;
            $this->user->theme = $this->theme;
            $this->user->avatarFile = $this->avatarFile;
            $this->user->avatar = $this->avatar;
            if ($this->email == $this->user->email && $this->user->unconfirmed_email != null) {
                $this->user->unconfirmed_email = null;
            } elseif ($this->email != $this->user->email) {
                switch ($this->module->emailChangeStrategy) {
                    case Module::STRATEGY_INSECURE:
                        $this->insecureEmailChange();
                        break;
                    case Module::STRATEGY_DEFAULT:
                        $this->defaultEmailChange();
                        break;
                    case Module::STRATEGY_SECURE:
                        $this->secureEmailChange();
                        break;
                    default:
                        throw new \OutOfBoundsException('Invalid email changing strategy');
                }
            }

            return $this->user->save();
        }

        return false;
    }
}
