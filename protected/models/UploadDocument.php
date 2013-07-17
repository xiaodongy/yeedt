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
 * @property string $is_invoice
 * @property string $type
 * @property string $status
 * @property integer $create_time
 * @property string $translation
 * @property string $t_document
 * @property integer $user_id
 */
class UploadDocument extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UploadDocument the static model class
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
			array('t_document', 'file',  'allowEmpty'=>false, 'types'=>'doc,docx,xls,xlsx,txt,htm,html,htmls,xhtml,pdf,rar,zip', 'wrongType'=>'不支持的文件类型', 'maxSize' => 1024 * 1024 * 20, 'tooLarge' => '文件大小不能超过20M', 'message'=>'请选择文件'),
			array('word_count, create_time, user_id', 'numerical', 'integerOnly'=>true),
			array('language, document, upload_file_name, name, email, is_invoice, type, status, t_document', 'length', 'max'=>128),
			array('price', 'length', 'max'=>64),
			array('phone, qq', 'length', 'max'=>32),
			array('original, demand, translation', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, language, original, document, upload_file_name, word_count, price, demand, name, phone, email, qq, is_invoice, type, status, create_time, translation, t_document, user_id', 'safe', 'on'=>'search'),
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
			'name' => '姓&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;名',
			'phone' => '联系电话',
			'email' => '电子邮箱',
			'qq' => 'Qq',
			'is_invoice' => 'Is Invoice',
			'type' => 'Type',
			'status' => '状&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;态',
			'create_time' => 'Create Time',
			'translation' => '译文内容',
			't_document' => '译文文档',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('original',$this->original,true);
		$criteria->compare('document',$this->document,true);
		$criteria->compare('upload_file_name',$this->upload_file_name,true);
		$criteria->compare('word_count',$this->word_count);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('demand',$this->demand,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('qq',$this->qq,true);
		$criteria->compare('is_invoice',$this->is_invoice,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('translation',$this->translation,true);
		$criteria->compare('t_document',$this->t_document,true);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
