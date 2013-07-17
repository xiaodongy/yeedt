<?php
class FastEdit extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return FastEdit the static model class
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
			array('translation', 'required', 'message'=>'请输入译文内容'),
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
			'language' => 'Language',
			'original' => '翻译内容',
			'document' => 'Document',
			'upload_file_name' => 'Upload File Name',
			'word_count' => 'Word Count',
			'price' => 'Price',
			'demand' => '需求备注',
			'name' => 'Name',
			'phone' => 'Phone',
			'email' => 'Email',
			'qq' => 'Qq',
			'is_invoice' => 'Is Invoice',
			'type' => 'Type',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'translation' => '译文内容',
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
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
} 
