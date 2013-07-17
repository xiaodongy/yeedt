<?php

/**
 * This is the model class for table "{{translate}}".
 *
 * The followings are the available columns in table '{{translate}}':
 * @property integer $id
 * @property string $language
 * @property string $original
 * @property string $document
 * @property string $upload_file_name
 * @property integer $word_count
 * @property string $price
 * @property string $demand
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $qq
 * @property integer $is_invoice
 * @property string $type
 * @property string $status
 * @property integer $create_time
 * @property string $translation
 * @property integer $user_id
 */
class Translate extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Translate the static model class
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
		return '{{translate}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('language, phone, email, type, create_time, user_id', 'required'),
			array('word_count, is_invoice, create_time, user_id', 'numerical', 'integerOnly'=>true),
			array('language, document, upload_file_name, name, email, type, status', 'length', 'max'=>128),
			array('price', 'length', 'max'=>64),
			array('phone, qq', 'length', 'max'=>32),
			array('original, demand, translation', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, language, original, document, upload_file_name, word_count, price, demand, name, phone, email, qq, is_invoice, type, status, create_time, translation, user_id', 'safe', 'on'=>'search'),
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
			'charge'=>array(self::HAS_ONE, 'Charge', 'translate_id'),
            'user'=>array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '订单编号',
			'language' => '翻译语言',
			'original' => '主题',
			'document' => '主题',
			'upload_file_name' => 'Upload File Name',
			'word_count' => '字数',
			'price' => '价格',
			'demand' => '需求备注',
			'name' => '姓名',
			'phone' => '电话',
			'email' => '邮箱',
			'qq' => 'QQ',
			'is_invoice' => 'Is Invoice',
			'type' => 'Type',
			'status' => '订单状态',
			'create_time' => '下单时间',
			'translation' => 'Translation',
			'user_id' => 'User',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('status',$this->status,true);
        //if(Yii::app()->user->checkAccess('member'))
        if('member' === Yii::app()->user->roles)
        	$criteria->addCondition('user_id=' . Yii::app()->user->id);
        elseif('orderFast' == Yii::app()->controller->action->id)
        	$criteria->addCondition('type="fast"');
        elseif('orderFile' == Yii::app()->controller->action->id)
        	$criteria->addCondition('type="file"');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
				'defaultOrder'=>'create_time DESC',
            ),
		));
	}

    public function afterDelete()
    {
        parent::afterDelete();
        
        $delete_charge = Charge::model()->deleteAll('translate_id=' . $this->id);

        if ($this->upload_file_name && file_exists(Yii::getPathOfAlias('webroot') . '/upload/' . $this->upload_file_name))
            unlink(Yii::getPathOfAlias('webroot').'/upload/' . $this->upload_file_name);

        if ($this->t_upload_file_name && file_exists(Yii::getPathOfAlias('webroot') . '/upload/t/' . $this->t_upload_file_name))
            unlink(Yii::getPathOfAlias('webroot').'/upload/t/' . $this->t_upload_file_name);

        if ($delete_charge)
            return true;
        else
            return false;
    }
}
