<?php
class AutoBaojia extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return CheckRates the static model class
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
			array('quality_level', 'required','message'=>'请输入有效的字数'),
			array('quality_level, word_count, price, finish_time, status, remark', 'safe'),
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
			'id' => '订单编号',
			'language' => '翻译语言',
			'original' => 'Original',
			'document' => '翻译文档',
			'upload_file_name' => 'Upload File Name',
			'word_count' => '字&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;数',
			'price' => '价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;格',
			'demand' => '其他需求',
			'remark' => '客户反馈',
			'name' => '姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名',
			'phone' => '联系电话',
			'email' => '电子邮箱',
			'qq' => 'Qq',
			'is_invoice' => 'Is Invoice',
			'type' => 'Type',
			'status' => '状&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;态',
			'create_time' => 'Create Time',
			'translation' => 'Translation',
			'user_id' => 'User',
		);
	}
}