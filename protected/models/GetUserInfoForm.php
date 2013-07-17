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
class GetUserInfoForm extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return GetUserInfoForm the static model class
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
			array('name', 'required', 'message'=>'姓名不能为空'),
			array('phone', 'required', 'message'=>'电话不能为空'),
			array('receive_email', 'required', 'message'=>'邮箱不能为空'),
            array('name','length','min'=>2,'max'=>8,'tooShort'=>'长度请控制在2-8个字符','tooLong'=>'长度请控制在2-8个字符'),
            array('phone', 'match','pattern' => '/^((0*\d{1,4}|\+\d{1,4}|\(\d{1,4}\))[ -]?)?(\d{2,4}[ -]?)?\d{3,4}[ -]?\d{3,4}([ -]\d{1,5})?$/','message' => '请输入正确的电话号码'),
            array('receive_email', 'email', 'message'=>'请输入正确的邮箱地址'),
            array('qq', 'match','pattern' => '/^[1-9]{1}[0-9]{4,14}$/','message' => '请输入正确的QQ号码'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name, phone, receive_email, qq', 'safe', 'on'=>'search'),
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
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'name' => '<i class="important">*</i> 姓名：',
			'phone' => '<i class="important">*</i> 电话：',
			'receive_email' => '<i class="important">*</i> 接收邮箱：',
			'qq' => 'QQ 号：',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('receive_email',$this->receive_email,true);
		$criteria->compare('qq',$this->qq,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
