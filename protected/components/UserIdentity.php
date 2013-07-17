<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
    private $_id;
    const ERROR_EMAIL_INACTIVE = 1;

    public function authenticate()
    {
        $record = User::model()->findByAttributes(array('email' => $this->username));
        if ($record === null)
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        elseif ($record->password !== $this->password)
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        elseif(Yii::app()->params['is_verifyEmail'] && 0 == $record->is_verify)
            $this->errorCode = self::ERROR_EMAIL_INACTIVE;
        else
        {
            $this->_id = $record->id;
            $this->setState('roles', $record->roles);
            $this->setState('name', $record->name);
            $this->setState('email', $record->email);
            $this->setState('phone', $record->phone);
            $this->setState('receive_email', $record->receive_email);
            $this->setState('qq', $record->qq);
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id;
    }
}
