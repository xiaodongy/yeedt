<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $name
 * @property string $phone
 * @property string $receive_email
 * @property string $qq
 */
class User extends CActiveRecord
{
    public $rebate_ratio;
    public $sharing_ratio;
	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required', 'message'=>'请输入账户姓名'),
			array('name','length','min'=>2,'max'=>8,'tooShort'=>'姓名请控制在2-8个字符','tooLong'=>'姓名请控制在2-8个字符'),
			array('email', 'required', 'message'=>'请输入登录邮箱'),
			array('email', 'email', 'message'=>'请输入正确的邮箱地址'),
			array('email', 'unique', 'message'=>'此邮箱已被启用'),
            array('phone', 'match','pattern' => '/^((0*\d{1,4}|\+\d{1,4}|\(\d{1,4}\))[ -]?)?(\d{2,4}[ -]?)?\d{3,4}[ -]?\d{3,4}([ -]\d{1,5})?$/','message' => '请输入正确的电话号码'),
            array('qq', 'match','pattern' => '/^[1-9]{1}[0-9]{4,14}$/','message' => '请输入正确的QQ号码'),
			array('rebate_ratio', 'required', 'message'=>'请输入返点比率'),
			array('sharing_ratio', 'required', 'message'=>'请输入分成比率'),
			array('password', 'required', 'message'=>'请输入登录密码'),
			array('password','length','min'=>6,'max'=>16,'tooShort'=>'密码请控制在6-16个字符','tooLong'=>'密码请控制在6-16个字符'),
			array('roles', 'required', 'message'=>'请选择角色'),
			array('email, password, name, phone, receive_email', 'length', 'max'=>128),
			array('qq', 'length', 'max'=>16),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, name, phone, receive_email, qq, roles, rebate_ratio, sharing_ratio', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
        $from_date = ("" != Yii::app()->request->cookies['from_date'] && strtotime(Yii::app()->request->cookies['from_date'])) ? strtotime(Yii::app()->request->cookies['from_date']) : strtotime("2013-01-01");
        $to_date = ("" != Yii::app()->request->cookies['to_date'] && strtotime(Yii::app()->request->cookies['to_date'])) ? strtotime(Yii::app()->request->cookies['to_date']) : time();
		return array(
            'referral'=>array(self::HAS_MANY, 'Referral', 'user_id'),
            'user_center'=>array(self::HAS_ONE, 'UserCenter', 'user_id'),
            'charge'=>array(self::HAS_MANY, 'Charge', 'user_id'),
            'translate'=>array(self::HAS_MANY, 'Translate', 'user_id'),
            'translateCount' => array(self::STAT, 'Translate', 'user_id',
                'condition' => "status='finish' and create_time BETWEEN $from_date and $to_date",
            ),
            'priceSum' => array(self::STAT, 'Translate', 'user_id',
                'select' => 'SUM(price)',
                'condition' => "status='finish' and create_time BETWEEN $from_date and $to_date",
            ),
            'chargeSum' => array(self::STAT, 'Charge', 'user_id',
                'select' => 'SUM(money)',
                'condition' => "chargetype = 0 and money > 0",
            ),
            /*
            'total_price' => array(self::STAT, 'Translate', 't_referral.yuid',
                'select' => 'SUM(price)',
                'condition' =>"status='finish' and create_time BETWEEN $from_date and $to_date",
            ),
             */
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '账户编号',
			'email' => '登录邮箱',
            'balance' => '帐户余额',
			'password' => '密码',
			'name' => '姓名',
			'phone' => '手机',
			'receive_email' => '接收邮箱',
			'qq' => 'QQ号码',
            'roles' => '角色',
            'rebate_ratio' => '返点比率',
            'sharing_ratio' => '分成比率',
            'join_date' => '注册时间',
            'ip' => 'IP地址及归属',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		//$criteria->compare('id',$this->id);
		$criteria->compare('email',$this->email,true);
		//$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		//$criteria->compare('receive_email',$this->receive_email,true);
		//$criteria->compare('qq',$this->qq,true);
		$criteria->compare('roles',$this->roles,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function RemindByMail($email, $subject, $body)
    {
        $subject = "=?UTF-8?B?".base64_encode($subject)."?=";
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; // Additional headers
        $headers .= "From: {$email}\r\nReply-To: {$email}";
        mail($email, $subject, $body, $headers);
    }
}
