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
 * @property string $roles
 * @property string $balance
 * @property string $experience
 * @property integer $join_date
 * @property integer $is_verify
 * @property string $consumer_state
 * @property string $ip
 * @property string $ip_attribution
 */
class ForgetPassword extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ForgetPassword the static model class
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
			array('email, password, roles', 'required'),
			array('join_date, is_verify', 'numerical', 'integerOnly'=>true),
			array('email, password, name, phone, receive_email, roles, ip_attribution', 'length', 'max'=>128),
			array('qq, ip', 'length', 'max'=>16),
			array('balance, experience', 'length', 'max'=>32),
			array('consumer_state', 'length', 'max'=>18),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, email, password, name, phone, receive_email, qq, roles, balance, experience, join_date, is_verify, consumer_state, ip, ip_attribution', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'email' => 'Email',
			'password' => 'Password',
			'name' => 'Name',
			'phone' => 'Phone',
			'receive_email' => 'Receive Email',
			'qq' => 'Qq',
			'roles' => 'Roles',
			'balance' => 'Balance',
			'experience' => 'Experience',
			'join_date' => 'Join Date',
			'is_verify' => 'Is Verify',
			'consumer_state' => 'Consumer State',
			'ip' => 'Ip',
			'ip_attribution' => 'Ip Attribution',
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
		$criteria->compare('roles',$this->roles,true);
		$criteria->compare('balance',$this->balance,true);
		$criteria->compare('experience',$this->experience,true);
		$criteria->compare('join_date',$this->join_date);
		$criteria->compare('is_verify',$this->is_verify);
		$criteria->compare('consumer_state',$this->consumer_state,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('ip_attribution',$this->ip_attribution,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}