<?php

/**
 * This is the model class for table "{{charge}}".
 *
 * The followings are the available columns in table '{{charge}}':
 * @property integer $id
 * @property string $chargetype
 * @property string $money
 * @property integer $charge_time
 * @property string $recharge_way
 * @property integer $translate_id
 * @property integer $user_id
 */
class Charge extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Charge the static model class
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
		return '{{charge}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('chargetype, money, charge_time, recharge_way, user_id', 'required'),
			array('charge_time, translate_id, user_id', 'numerical', 'integerOnly'=>true),
			array('chargetype, recharge_way', 'length', 'max'=>128),
			array('money', 'length', 'max'=>16),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, chargetype, money, charge_time, recharge_way, translate_id, user, email', 'safe', 'on'=>'search'),
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
            'user'=>array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'chargetype' => '交易类型',
			'money' => '交易金额',
			'charge_time' => '交易时间',
			'recharge_way' => '交易方式',
			'translate_id' => '订单编号',
			'user_id' => '用户ID',
            'user' => '登陆邮箱',
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
		$criteria->condition = 'money!=""';
        $criteria->compare('chargetype',$this->chargetype,true);
		$criteria->compare('translate_id',$this->translate_id);
        if(Yii::app()->user->checkAccess('member'))
        	$criteria->addCondition('user_id=' . Yii::app()->user->id);
		$criteria->compare('money',$this->money,true);
		$criteria->compare('charge_time',$this->charge_time);
		$criteria->compare('recharge_way',$this->recharge_way,true);
        $criteria->with = array('user');
		$criteria->compare('email',$this->user, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
			    'defaultOrder'=>'charge_time DESC',
            ),
		));
	}
}
