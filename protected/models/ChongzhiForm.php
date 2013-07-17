<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ChongzhiForm extends CFormModel
{
	public $money;
	public $recharge_way;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('money', 'required', 'message'=>'请输入正确的充值金额'),
            array('money', 'match','pattern' => '/^-?(?:\d+\.?)?\d{1,2}$/','message' => '请输入正确的充值金额'),
            array('money','numerical','min'=>$this->money,'tooSmall'=>"支付金额小于订单金额，请重新输入"),
			array('recharge_way', 'required', 'message'=>'请选择支付方式'),
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
            'money'=>'还需要支付金额：',
            'recharge_way'=>'请选择充值方式',
		);
	}
}
