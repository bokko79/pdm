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

use yii\helpers\Html;
use yii\helpers\Url;
use dektrium\user\Finder;
use dektrium\user\helpers\Password;
use dektrium\user\Mailer;
use dektrium\user\Module;
use dektrium\user\traits\ModuleTrait;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\Application as WebApplication;
use yii\web\IdentityInterface;
use yii\helpers\ArrayHelper;
use dektrium\user\models\User as BaseUser;
use common\models\Log;

/**
 * User ActiveRecord model.
 *
 * @property bool    $isAdmin
 * @property bool    $isBlocked
 * @property bool    $isConfirmed
 *
 * Database fields:
 * @property integer $id
 * @property string  $username
 * @property string  $email
 * @property string  $unconfirmed_email
 * @property string  $password_hash
 * @property string  $phone
 * @property integer $language_id
 * @property integer $currency_id
 * @property string  $units
 * @property integer $type
 * @property integer $status
 * @property integer $membership_type
 * @property integer $current_location
 * @property integer $invited_by
 * @property string  $auth_key
 * @property string  $phone_verification_key
 * @property string  $location_verification_key
 * @property string  $invite_key
 * @property integer $registration_ip
 * @property integer $login_ip
 * @property integer $login_count
 * @property integer $login_time
 * @property integer $last_activity_time
 * @property integer $phone_verification_time
 * @property integer $location_verification_time
 * @property integer $membership_update_time
 * @property integer $membership_expiry_time
 * @property integer $status_update_time
 * @property integer $confirmed_at
 * @property integer $blocked_at
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $flags
 *
 * Defined relations:
 * @property Account[] $accounts
 * @property Profile[] $profiles
 *
 * Dependencies:
 * @property-read Finder $finder
 * @property-read Module $module
 * @property-read Mailer $mailer
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class UserAccount extends BaseUser
{
    use ModuleTrait;

    const BEFORE_CREATE   = 'beforeCreate';
    const AFTER_CREATE    = 'afterCreate';
    const BEFORE_REGISTER = 'beforeRegister';
    const AFTER_REGISTER  = 'afterRegister';
    const BEFORE_CONFIRM  = 'beforeConfirm';
    const AFTER_CONFIRM   = 'afterConfirm';

    // following constants are used on secured email changing process
    const OLD_EMAIL_CONFIRMED = 0b1;
    const NEW_EMAIL_CONFIRMED = 0b10;

    /** @var string Plain password. Used for model validation. */
    public $password; 

    public $avatarFile;   

    /** @var Profile|null */
    private $_profile;

    /** @var string Default username regexp */
    public static $usernameRegexp = '/^[-a-zA-Z0-9_\.@]+$/';    

    // event init
    public function init()
    {
          $this->on(self::AFTER_CREATE, [$this, 'afterCreate']);
          $this->on(self::AFTER_REGISTER, [$this, 'afterRegister']);
    } 

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules = parent::rules();        

        $rules['role'] = [['role',], 'string'];
        
        return $rules;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEngineer()
    {
        return $this->hasOne(Engineers::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['user_id' => 'id']);
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'username'          => \Yii::t('user', 'Username'),
            'email'             => \Yii::t('user', 'Email'),
            'password'          => \Yii::t('user', 'Password'),
            'created_at'        => \Yii::t('user', 'Registration time'),
            'confirmed_at'      => \Yii::t('user', 'Confirmation time'),
        ];
    }

    /**
     * Creates new user account. It generates password if it is not provided by user.
     *
     * @return bool
     */
    public function create()
    {
        if ($this->getIsNewRecord() == false) {
            throw new \RuntimeException('Calling "' . __CLASS__ . '::' . __METHOD__ . '" on existing user');
        }

        $transaction = $this->getDb()->beginTransaction();

        try {
            $this->confirmed_at = time();
            $this->password = $this->password == null ? Password::generate(8) : $this->password;

            $this->trigger(self::BEFORE_CREATE);

            if (!$this->save()) {
                $transaction->rollBack();
                return false;
            }

            $this->mailer->sendWelcomeMessage($this, null, true);
            $this->trigger(self::AFTER_CREATE);

            $transaction->commit();

            return true;
        } catch (\Exception $e) {
            $transaction->rollBack();
            \Yii::warning($e->getMessage());
            return false;        
        }
    }

    /** @inheritdoc */
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->setAttribute('auth_key', \Yii::$app->security->generateRandomString());
            //$this->setAttribute('phone_verification_key', \Yii::$app->security->generateRandomString(4));
            //$this->setAttribute('location_verification_key', \Yii::$app->security->generateRandomString(8));
            //$this->setAttribute('invite_key', \Yii::$app->security->generateRandomString(13));
            if (\Yii::$app instanceof WebApplication) {
                $this->setAttribute('registration_ip', \Yii::$app->request->userIP);
            }
        }

        if (!empty($this->password)) {
            $this->setAttribute('password_hash', Password::hash($this->password));
        }

        return parent::beforeSave($insert);
    }

    /** @inheritdoc */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($insert) {
            if ($this->_profile == null) {
                $this->_profile = \Yii::createObject(Profile::className());                
            }
            $this->_profile->link('user', $this);
            /*$profileContact = new \common\models\ProfileContact();
            $profileContact->profile_id = $this->_profile->id;
            $profileContact->contact_type = 1;
            $profileContact->contact_value = $this->email;
            $profileContact->save();*/
        }
    }

    /**
     * @return \yii\db\ActiveQueryInterface
     */
    public function getLocation()
    {
        return $this->hasOne(\common\models\Locations::className(), ['id' => 'current_location']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'avatar']);
    }

    public function afterCreate($event){        
        return;
    }

    public function afterRegister($event){        
        return;
    }

    // User account statuses
    /*public function accountStatus()
    {
        switch ($this->status) {
            case 2: $accountStatus = 'deactivated'; break;
            case 3: $accountStatus = 'hibernated'; break;
            case 4: $accountStatus = 'suspended'; break;
            case 5: $accountStatus = 'banned'; break;
            default: $accountStatus = 'active'; break;
        }
        return $accountStatus;
    }

    public function accountMembershipType()
    {
        switch ($this->membership_type) {
            case 1: $accountMembershipType = 'basic'; break;
            case 2: $accountMembershipType = 'silver'; break;
            case 3: $accountMembershipType = 'gold'; break;
            case 4: $accountMembershipType = 'premium'; break;            
            default: $accountMembershipType = 'free'; break;
        }
        return $accountMembershipType;
    }*/

    /**
     * Attempts user confirmation.
     *
     * @param string $code Confirmation code.
     *
     * @return boolean
     */
    public function attemptConfirmation($code)
    {
        $token = $this->finder->findTokenByParams($this->id, $code, \dektrium\user\models\Token::TYPE_CONFIRMATION);

        if ($token instanceof \dektrium\user\models\Token && !$token->isExpired) {
            $token->delete();
            if (($success = $this->confirm())) {
                \Yii::$app->user->login($this, $this->module->rememberFor);
                $message = \Yii::t('user', 'Registracija je uspešno obavljena. Hvala.');
            } else {
                $message = \Yii::t('user', 'Došlo je do greške, a Vaš nalog nije potvrđen.');
            }
        } else {
            $success = false;
            $message = \Yii::t('user', 'Potvrdni link nije validan ili je istekao. Probajte da zatražite novi link.');
        }

        \Yii::$app->session->setFlash($success ? 'success' : 'danger', $message);

        return $success;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function dataReqs()
    {  
        $model = $this;
        $content = ['info'=>'', 'success'=>'', 'danger'=>'', 'warning'=>'', 'setup'=>0];
        $engineer = $model->engineer;
        $practice = $engineer->practice;

        // User types:
        // 1. User: can create requests and estates and posts (if editors)
        // 2. Engineer: can create everything user can plus can create engineer profile, practice and projects/presentations

        // User data:
        // --- username, email, avatar
        // Engineer data:
        // --- name, expertees, email, phone, signature, cover_photo, about
        // --- #licences, #practices, #portfolio
        // Practices data:
        // --- name, #location (street, number, city), phone, email, fax, tax_no, company_no, account_no, bank, avatar, cover_photo, stamp, memo, about
        // --- #engineers, #partners, #portfolio
        if(!$model->username or !$model->email){
            $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> '.Html::a('Morate se ispravno registrovati! ', Url::to(['/user/registration/register']), ['target'=>'_blank']).'</p>';
        } else {
            if(!$engineer){
              $content['info'] .= '<p><i class="fa fa-info-circle"></i> '.Html::a('Prijavite se kao inženjer/projektant. ', Url::to(['/user/registration/register']), ['target'=>'_blank']).'</p>';
            } else {
                if($engineer->practiceEngineers==null){          
                  $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Trenutno niste prijavljeni ni u jednoj firmi. Da biste mogli da kreirate projekte, '.Html::a('registrujte svoju firmu kao direktor', Url::to(['/practices/create', 'engineer_id'=>$model->engineer->user_id]), ['target'=>'_blank']).' ili se '.Html::a('prijavite u postojeću', Url::to(['/practices']), ['target'=>'_blank']).' kao zaposleni ili saradnik te firme.</p>';
                } else {
                    foreach($engineer->practiceEngineers as $peng){
                        if($peng->status=='invited'){
                            $content['info'] .= '<p><i class="fa fa-info-circle"></i> Pozvani ste u članstvo u firmi <b>'.$peng->practice->name.'</b> kao '.$peng->position.'. '.Html::a('Potvrdite članstvo', Url::to(['/practice-engineers/confirm', 'id'=>$peng->id]), ['target'=>'_blank']).'.</p>';
                        }
                    }
                }
                if($engineer and $engineer->expertees_id != 31 and $engineer->engineerLicences==null){
                  $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Unesite svoje projektantske licencne pakete da biste kreirali projekte. '.Html::a('Unesi', Url::to(['/engineer-licences/create', 'EngineerLicences[engineer_id]'=>$model->engineer->user_id]), ['target'=>'_blank']).'</p>';
                }
                if($engineer and $engineer->expertees_id != 31 and $engineer->engSignature==null){
                  $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Unesite skenirani potpis u .jpg ili .png formatu da biste kreirali projekte. '.Html::a('Unesi', Url::to(['/legal-files/create', 'LegalFilesSearch[entity_id]'=>$model->engineer->user_id, 'LegalFilesSearch[entity]'=>'engineer', 'LegalFilesSearch[type]'=>'signature']), ['target'=>'_blank']).'</p>';
                }
            }

                
            if(!$practice){

            } else {
                if($practice->director->engSignature==null or $practice->name==''){
                  $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Morate podesiti podatke Vašeg preduzeća. '.Html::a('Podesi', Url::to(['/practices/update', 'id'=>$model->engineer->user_id]), ['target'=>'_blank']).'</p>';
                }
                if($practice->practiceEngineers==null){          
                  $content['danger'] .= '<p><i class="fa fa-exclamation-circle"></i> Trenutno niste prijavljeni ni u jednom preduzeće. Da biste mogli da kreirate projekte, '.Html::a('registrujte svoju firmu kao direktor', Url::to(['/practices/create', 'engineer_id'=>$model->engineer->user_id]), ['target'=>'_blank']).' ili se '.Html::a('prijavite u postojeću', Url::to(['/practices']), ['target'=>'_blank']).' kao zaposleni ili saradnik.</p>';
                } else {
                    foreach($practice->practiceEngineers as $peng){                   
                        if($peng->status=='to_join'){
                            $content['info'] .= '<p><i class="fa fa-info-circle"></i> Inženjer <b>'.$peng->engineer->name.'</b> Vam je poslao zahtev za članstvo u Vašoj firmi '.$peng->practice->name.' kao '.$peng->position.'. '.Html::a('Potvrdite članstvo', Url::to(['/practice-engineers/confirm', 'id'=>$peng->id]), ['target'=>'_blank']).'.</p>';
                        }
                    }
                }
                if($practice->practicePartners==null){          
                  
                } else {
                    foreach($practice->practicePartners as $ppartner){                   
                        if($ppartner->status=='invited'){
                            if($ppartner->practice_id!=$model->id){
                                //
                                $content['info'] .= '<p><i class="fa fa-info-circle"></i> Firma <b>'.$ppartner->practice->name.'</b> Vam je poslala zahtev za partnerstvo sa Vašom firmom '.$ppartner->practice->name.'. '.Html::a('Potvrdite partnerstvo', Url::to(['/practice-partners/confirm', 'id'=>$ppartner->id]), ['target'=>'_blank']).'.</p>';
                            } else {
                                $content['info'] .= '<p><i class="fa fa-info-circle"></i> Poslali ste zahtev za partnerstvo firmi <b>'.$ppartner->partner->name.'</b></p>';
                            }
                            
                        }
                    }
                }
            }
        }      
            
        return $content;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function dataReqFlash($content)
    {  
        $content['danger'] ? \Yii::$app->session->setFlash('danger', $content['danger']) : null;
        $content['warning'] ? \Yii::$app->session->setFlash('warning', $content['warning']) : null;
        $content['info'] ? \Yii::$app->session->setFlash('info', $content['info']) : null;
        $content['success'] ? \Yii::$app->session->setFlash('success', $content['success']) : null;
        //return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function setupMeter($content)
    {  
        return $content['setup'];
        //return false;
    }
}
