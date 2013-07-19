<?php
class ForgetPassword extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return '{{user}}';
	}

	public function rules()
	{
		return array(
			array('email', 'required','message'=>'<span class="err_left"></span><span class="err_img1"></span><em>请输入注册时的邮箱地址。</em>'),
			array('email', 'email', 'message'=>'<span class="err_left"></span><span class="err_img1"></span><em>邮箱格式错误，请检查。</em>'),
			array('email', 'exist', 'message'=>'<span class="err_left"></span><span class="err_img1"></span><em>邮箱地址不存在。</em>'),
			array('email', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
		);
	}

	public function attributeLabels()
	{
		return array(
			'email' => '注册邮箱',
		);
	}
}
