<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ChargeForm extends CFormModel
{
	public $money;
	public $recharge_way;
	public $charge_time;
	public $user_id;
	//public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('money', 'required', 'message'=>'请输入正确的充值金额'),
            array('money', 'match','pattern' => '/^-?(?:\d+\.?)?\d{1,2}$/','message' => '请输入正确的充值金额'),
            array('money','numerical','min'=>0.01,'tooSmall'=>'充值金额不能少于0.01元'),
			array('recharge_way', 'required', 'message'=>'请选择支付方式'),
			// verifyCode needs to be entered correctly

			//array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(),'message'=>'请输入正确的验证码'),
            array('money, recharge_way', 'safe'),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
            'money'=>'充值金额：',
            'recharge_way'=>'请选择充值方式：',
            'charge_time'=>'交易时间',
            'user_id'=>'会员ID',
			//'verifyCode'=>'验证码',
		);
	}
}
