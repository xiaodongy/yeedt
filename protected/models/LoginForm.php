<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;
	public $rememberMe;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that email and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// email and password are required
			array('username', 'required', 'message'=>'<span class="err_left"></span><span class="err_img1"></span><em>请输入您的账号。</em>'),
            array('password', 'required', 'message'=>'<span class="err_left"></span><span class="err_img1"></span><em>请输入您的密码。</em>'),
            array('username', 'email', 'message'=>'<span class="err_left"></span><span class="err_img1"></span><em>请输入正确的邮箱地址。</em>'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
            'username'=>'<span class="star"></span>&nbsp;帐号：',
            'password'=>'<span class="star"></span>&nbsp;密码：',
			'rememberMe'=>'记住账户登录状态',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
            $this->_identity=new UserIdentity($this->username,RegForm::encypt($this->password));
			if(!$this->_identity->authenticate() && $this->_identity->errorCode !== UserIdentity::ERROR_EMAIL_INACTIVE)
				$this->addError('password','<span class="err_left"></span><span class="err_img1"></span><em>帐号或密码错误。</em>');
            if($this->_identity->errorCode === UserIdentity::ERROR_EMAIL_INACTIVE)
				$this->addError('username','<span class="err_left"></span><span class="err_img1"></span><em>邮箱未注册或未被验证。</em>');
		}
	}

	/**
	 * Logs in the user using the given email and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false;
	}
}
