<?php

/**
 * This is the model class for table "{{user_center}}".
 *
 * The followings are the available columns in table '{{user_center}}':
 * @property integer $id
 * @property string $real_name
 * @property string $identity_card_number
 * @property string $recipient_address
 * @property string $bank_type
 * @property string $bank_number
 * @property string $rebate_ratio
 * @property string $sharing_ratio
 * @property string $partner
 * @property string $key
 * @property integer $user_id
 */
class UserCenter extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserCenter the static model class
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
		return '{{user_center}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('real_name', 'required','message'=>"请输入真实的姓名"),
            array('real_name', 'match','pattern' => '/^[\x{4e00}-\x{9fa5}]{1,4}/u','message' => '请输入真实的姓名'),
			array('identity_card_number', 'required','message'=>"请输入有效的身份证号码"),
            array('identity_card_number', 'match','pattern' => '/^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/','message' => '请输入有效的身份证号码'),
			array('recipient_address', 'required','message'=>"请输入有效的收件地址"),
			array('bank_type', 'required','message'=>"请选择开户银行类型"),
			array('bank_number', 'required','message'=>"请输入正确的银行卡号"),
            array('bank_number', 'match','pattern' => '/^\d{16,19}$|^\d{6}[- ]\d{10,13}$|^\d{4}[- ]\d{4}[- ]\d{4}[- ]\d{4,7}$/','message' => '请输入正确的银行卡号'),
			array('id, real_name, identity_card_number, recipient_address, bank_type, bank_number, rebate_ratio, sharing_ratio, partner, key, user_id', 'safe', 'on'=>'search'),
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
			'real_name' => '<i class="important">*</i> 真实姓名：',
			'identity_card_number' => '<i class="important">*</i> 身份证号：',
			'recipient_address' => '<i class="important">*</i> 收件地址：',
			'bank_type' => '<i class="important">*</i> 开户银行：',
			'bank_number' => '<i class="important">*</i> 银行卡号：',
			'rebate_ratio' => '返点比率',
			'sharing_ratio' => '分成比率',
			'partner' => '合作商',
			'key' => '密匙',
			'user_id' => '会员ID',
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
		$criteria->compare('real_name',$this->real_name,true);
		$criteria->compare('identity_card_number',$this->identity_card_number,true);
		$criteria->compare('recipient_address',$this->recipient_address,true);
		$criteria->compare('bank_type',$this->bank_type,true);
		$criteria->compare('bank_number',$this->bank_number,true);
		$criteria->compare('rebate_ratio',$this->rebate_ratio,true);
		$criteria->compare('sharing_ratio',$this->sharing_ratio,true);
		$criteria->compare('partner',$this->partner,true);
		$criteria->compare('key',$this->key,true);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
