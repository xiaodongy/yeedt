<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'PathController'.
 */
class ContactForm extends CActiveRecord
{
	public $verifyCode;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{contact}}';
	}

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('name', 'required', 'message'=>'姓名不能为空'),
			array('email', 'required', 'message'=>'邮箱不能为空'),
			array('phone', 'required', 'message'=>'电话不能为空'),
			array('body', 'required', 'message'=>'留言内容不能为空'),
            array('name','length','min'=>2,'max'=>8,'tooShort'=>'长度请控制在2-8个字符','tooLong'=>'长度请控制在2-8个字符'),
            array('phone', 'match','pattern' => '/^((0*\d{1,4}|\+\d{1,4}|\(\d{1,4}\))[ -]?)?(\d{2,4}[ -]?)?\d{3,4}[ -]?\d{3,4}([ -]\d{1,5})?$/','message' => '请输入正确的电话号码'),
            array('email', 'email', 'message'=>'请输入正确的邮箱地址'),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(),'message'=>"请输入正确的验证码"),
		);
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
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
			'name' => '<span class="star"></span>&nbsp;姓名：',
			'email' => '<span class="star"></span>&nbsp;常用邮件地址：',
			'phone' => '<span class="star"></span>&nbsp;常用电话：',
			'body' => '<span class="star"></span>&nbsp;留言内容：',
			'verifyCode' => '<span class="star"></span>&nbsp;验证码：',		
		);
	}
	
    protected function beforeSave()
    {
        if(parent::beforeSave())
        {
            $this->create_time = time();
            if(!Yii::app()->user->isGuest)
            	$this->user_id = Yii::app()->user->id;
            return true;
        }
        else
            return false;
    }
}
