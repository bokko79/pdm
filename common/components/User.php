<?php
// app/components/Request.php
namespace common\components;


class User extends \yii\web\User
{ 
    /**
     * Returns a value that uniquely represents the user.
     * @return string|integer the unique identifier for the user. If null, it means the user is a guest.
     * @see getIdentity()
     */
    public function getData()
    {
        $identity = $this->getIdentity();
        if($identity !== null) {
            $user = $identity->findOne($identity->getId());
        }

        return ($user) ? $user : null;
    }

	/**
     * Returns a value that uniquely represents the user.
     * @return string|integer the unique identifier for the user. If null, it means the user is a guest.
     * @see getIdentity()
     */
    public function getUsername()
    {
        $identity = $this->getIdentity();
        if($identity !== null) {
            $user = $identity->findOne($identity->getId());
        }

        return ($user->username) ? $user->username : null;
    }

    /**
     * Returns a value that uniquely represents the user.
     * @return string|integer the unique identifier for the user. If null, it means the user is a guest.
     * @see getIdentity()
     */
    public function getTheme()
    {
        $identity = $this->getIdentity();
        if($identity !== null) {
            $user = $identity->findOne($identity->getId());
        }

        return ($user->theme) ? $user->theme : null;
    }

    /**
     * Returns a value that uniquely represents the user.
     * @return string|integer the unique identifier for the user. If null, it means the user is a guest.
     * @see getIdentity()
     */
    public function getAvatar($w=null, $h=null, $class='user-img')
    {
        $identity = $this->getIdentity();
        if($identity !== null) {
            $user = $identity->findOne($identity->getId());
        }

        return ($user->avatar) ? \yii\helpers\Html::img('@web/images/profiles/'.$user->aFile->name, ['style'=>'width:'.$w.'px; max-height:'.$h.'px;', 'class'=>$class]) : \yii\helpers\Html::img('@web/images/no_pic_image.png', ['style'=>'width:'.$w.'px; max-height:'.$h.'px;', 'class'=>$class]);
    }

    /**
     * Returns a value that uniquely represents the user.
     * @return string|integer the unique identifier for the user. If null, it means the user is a guest.
     * @see getIdentity()
     */
    public function getEngineer()
    {
        $identity = $this->getIdentity();
        if($identity !== null) {
            $user = $identity->findOne($identity->getId());
        }

        return ($user->engineer) ? $user->engineer : null;
    }

    /**
     * Returns a value that uniquely represents the user.
     * @return string|integer the unique identifier for the user. If null, it means the user is a guest.
     * @see getIdentity()
     */
    public function getPractice()
    {
        $identity = $this->getIdentity();
        if($identity !== null) {
            $user = $identity->findOne($identity->getId());
        }
        if($engineer = $user->engineer)
        {
            if($engineer->practice){
                return $engineer->practice;
            }
            elseif($engineer->practiceEngineers){
                return $engineer->practiceEngineers[0]->practice;
            }
        }
        return false;
    }

    /**
     * Returns a value that uniquely represents the user.
     * @return string|integer the unique identifier for the user. If null, it means the user is a guest.
     * @see getIdentity()
     */
   /* public function getClient()
    {
        $identity = $this->getIdentity();
        if($identity !== null) {
            $user = $identity->findOne($identity->getId());
        }

        return ($user->client) ? $user->client : null;
    }*/

    /**
     * Returns a value that uniquely represents the user.
     * @return string|integer the unique identifier for the user. If null, it means the user is a guest.
     * @see getIdentity()
     */
    public function getEmail()
    {
        $identity = $this->getIdentity();
        if($identity !== null) {
            $user = $identity->findOne($identity->getId());
        }

        return ($user->email) ? $user->email : null;
    }

    /**
     * Returns a value that uniquely represents the user.
     * @return string|integer the unique identifier for the user. If null, it means the user is a guest.
     * @see getIdentity()
     */
    public function getLocation()
    {
        $identity = $this->getIdentity();
        if($identity !== null) {
            $user = \common\models\User::findOne($identity->getId());
            return ($user->location) ? $user->location : null;
        }

        return null;
    }

    /**
     * Returns a value that uniquely represents the user.
     * @return string|integer the unique identifier for the user. If null, it means the user is a guest.
     * @see getIdentity()
     */
    public function getRole()
    {
        $identity = $this->getIdentity();
        if($identity !== null) {
            $user = \common\models\UserAccount::findOne($identity->getId());
            return ($user->role) ? $user->role : null;
        }

        return null;
    }

    /**
     * Returns a value that uniquely represents the user.
     * @return string|integer the unique identifier for the user. If null, it means the user is a guest.
     * @see getIdentity()
     */
    /*public function getAvatar()
    {
        $identity = $this->getIdentity();        
        $avatar = '@frontend-images/users/default_avatar.jpg';

        if($identity !== null) {
            $user = \common\models\UserAccount::findOne($identity->getId());
            if($user->details and $user->details->file){
                $avatar = '@frontend-images/users/thumbs/'.$user->details->file->ime;
            }
        }

        return \yii\helpers\Html::img($avatar, ['class' => 'img-responsive img-rounded']);
    }*/

    /** @inheritdoc */
    /*public function afterLogin($identity, $cookieBased, $duration)
    {
        $identity = $this->getIdentity();  
        if($identity !== null) {
            $user = \common\models\User::findOne($identity->getId());
            $user->login_count++;
            $user->logged_in_at = time();
            $user->logged_in_from = \Yii::$app->request->userIP;
            $user->update();
        }        

        return parent::afterLogin($identity, $cookieBased, $duration);
    }*/
}